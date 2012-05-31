<?php

class CharacterSelect extends CFormModel
{
	public $characterName;
	public $realmName;
	public $realmId;
	public $step = 1;
	public $character;
	public $characterApi;
	public $itemsForConfirm;

	public function rules()
	{
		return array(
			array('characterName, realmName', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'characterName'=>'Имя персонажа',
			'realmName'=>'Игровой мир',
		);
	}

	public function getCharacter()
	{
		$realm = Realm::model()->findByName($this->realmName);
		if (!$realm) {
			$this->addError('realmName', 'Игровой мир не найден');
		} else {
			$this->realmId = $realm->id;
			Character::model()->apiLoad($this->characterApi, $this->realmId);
		}

		$character = Character::model()->findByNameAndRealmId($this->characterName, $realm->id);
		
		if (!$character) {
			$this->addError('characterName', 'Персонаж не найден');
		}

		return $character;
	}

	public function getCharacterApi()
	{
		return Yii::app()->wowapi->getCharacter($this->characterName, $this->realmName, 'items');
	}

	public function selectItemsForConfirm()
	{
		$slots = array();
		foreach ($this->characterApi->items as $item_key => $item) {
			if (!(($item_key == 'averageItemLevel') or ($item_key == 'averageItemLevelEquipped'))) {
				$slots[] = $item_key;
			}
		}
		$rand_keys = array_rand($slots, 2);
		$this->itemsForConfirm = $slots[$rand_keys[0]].','.$slots[$rand_keys[1]];
	}

	public function checkItems()
	{
		$items = explode(',', $this->itemsForConfirm);
		foreach ($items as $item) {
			if (isset($this->characterApi->items->$item)) return false;
		}

		return true;
	}

	public function validate()
	{
		if (parent::validate()) {
			$this->characterApi = $this->getCharacterApi();
			$this->character = $this->getCharacter();
		}

		return !$this->hasErrors();
	}
}

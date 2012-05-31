<?php

class Realm extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'realms';
	}	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Игровой Мир',
			'slug' => 'Сокрощение',
			'wolid' => 'Код World Of Logs'
		);
	}

	public function apiLoad($realm_api)
	{
        $realm = $this->findBySlug($realm_api->slug);
        if (!$realm) $realm = new Realm;
        $realm->setAttributes(get_object_vars($realm_api), false);
	    $realm->save();
	}

	public function findBySlug($slug)
	{
		$attributes = array('slug' => $slug);
		return $this->findByAttributes($attributes);
	}

	public function findByName($name)
	{
		$attributes = array('name' => $name);
		return $this->findByAttributes($attributes);
	}	
}

?>
<?php

/**
 * This is the model class for table "raid_bosses".
 */
class RaidBoss extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'raid_bosses';
	}

    public function behaviors(){
        return array(
            'CommentBehavior' => array(
                'class' => 'application.components.behaviors.CommentBehavior',
                'modelClassName' => 'RaidBoss',
            )
        );
    }

	public function rules()
	{
		return array(
			array('name, raid_id, description', 'required'),
			array('raid_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>250),
            array('youtube_search', 'length', 'max'=>250),
            array('youtube_search_ru', 'length', 'max'=>250),
			array('id, name, raid_id, youtube_search, youtube_search_ru', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'raid' => array(self::BELONGS_TO, 'Raids', 'raid_id'),
            'raidBossAbilities' => array(self::HAS_MANY, 'RaidBossAbility', 'raid_boss_id'),
            'raidRootBossAbilities' => array(self::HAS_MANY, 'RaidBossAbility', 'raid_boss_id',
                'on'=>'raidRootBossAbilities.parent_id IS NULL'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'raid_id' => 'Рейд',
            'description' => 'Описание',
            'youtube_search' => 'Строка поиска для Youtube (eng)',
            'youtube_search_ru' => 'Строка поиска для Youtube (ru)',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('raid_id',$this->raid_id,true);
        $criteria->compare('youtube_search',$this->youtube_search,true);
        $criteria->compare('youtube_search_ru',$this->youtube_search_ru,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
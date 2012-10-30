<?php

/**
 * This is the model class for table "guild_class_leaders".
 */
class GuildClassLeader extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'guild_class_leaders';
	}

	public function rules()
	{
		return array(
			array('guild_id, warcraft_class_role_id, character_id', 'required'),
			array('guild_id, warcraft_class_role_id, character_id', 'length', 'max'=>10),
			array('id, guild_id, warcraft_class_role_id, character_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'guild' => array(self::BELONGS_TO, 'Guild', 'guild_id'),
			'warcraftClassRole' => array(self::BELONGS_TO, 'WarcraftClassRole', 'warcraft_class_role_id'),
			'character' => array(self::BELONGS_TO, 'Character', 'character_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'guild_id' => 'Гильдия',
			'warcraft_class_role_id' => 'Роль',
			'character_id' => 'Персонаж',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('guild_id',$this->guild_id,true);
		$criteria->compare('warcraft_class_role_id',$this->warcraft_class_role_id,true);
		$criteria->compare('character_id',$this->character_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
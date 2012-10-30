<?php

/**
 * This is the model class for table "warcraft_class_roles".
 */
class WarcraftClassRole extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'warcraft_class_roles';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>50),
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'guildClassLeaders' => array(self::HAS_MANY, 'GuildClassLeader', 'warcraft_class_role_id'),
			'warcraftClassSpecs' => array(self::HAS_MANY, 'WarcraftClassSpec', 'warcraft_class_role_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
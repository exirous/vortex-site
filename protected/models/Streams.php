<?php

/**
 * This is the model class for table "streams".
 */
class Streams extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'streams';
	}

	public function rules()
	{
		return array(
			array('name, description, owner_id, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('owner_id', 'length', 'max'=>10),
			array('id, name, description, owner_id, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'owner' => array(self::BELONGS_TO, 'Profiles', 'owner_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'owner_id' => 'Owner',
			'type' => 'Type',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
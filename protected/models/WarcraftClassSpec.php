<?php

/**
 * This is the model class for table "warcraft_class_specs".
 */
class WarcraftClassSpec extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'warcraft_class_specs';
	}

	public function rules()
	{
		return array(
			array('warcraft_class_id, name, english_name', 'required'),
			array('name, english_name', 'length', 'max'=>50),
			array('id, warcraft_class_id, name, english_name', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'warcraftClass'=>array(self::BELONGS_TO, 'WarcraftClass', 'warcraft_class_id'),
            'mainSpecCharacters'=>array(self::HAS_MANY, 'Character', 'main_spec_id'),
            'offSpecCharacters'=>array(self::HAS_MANY, 'Character', 'off_spec_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'warcraft_class_id' => 'Warcraft Class',
			'name' => 'Name',
			'english_name' => 'English Name',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('warcraft_class_id',$this->warcraft_class_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('english_name',$this->english_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
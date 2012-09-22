<?php

/**
 * This is the model class for table "streams".
 */
class Stream extends CActiveRecord
{
    const Twitch=1;
    const Own3d=2;
    private $stream_types = array(self::Twitch=>"Twitch.Tv", self::Own3d=>"Own3d.Tv");

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
			array('name, channel', 'length', 'max'=>250),
			array('owner_id', 'length', 'max'=>10),
			array('id, name, description, owner_id, type, channel', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'owner' => array(self::BELONGS_TO, 'Profile', 'owner_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'description' => 'Описание',
			'owner_id' => 'Владелец',
			'type' => 'Тип',
            'channel' => 'Канал',
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
        $criteria->compare('channel',$this->channel);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTypes(){
        return $this->stream_types;
    }
}
<?php

class WarcraftClass extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'warcraft_classes';
	}	

	public function relations()
    {
	    return array(
            'characters'=>array(self::HAS_MANY, 'Character', 'warcraft_class_id'),
        );
	}	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
		);
	}
}

?>
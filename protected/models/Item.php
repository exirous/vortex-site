<?php

/**
 * This is the model class for table "items".
 */
class Item extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'items';
	}

	public function rules()
	{
		return array(
			array('id, raw_date, item_level', 'required'),
			array('item_level', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>10),
			array('id, raw_date, item_level', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'raw_date' => 'Raw Date',
			'item_level' => 'Item Level',
		);
	}

    public static function getItemById($id) {
        $item = self::model()->findByPk($id);
        if (!$item) {
            $rawData = Yii::app()->wowapi->getItem($id);
            $item = new Item;
            $item->setAttributes(array('id'=>$id, 'raw_data'=>json_encode($rawData), 'item_level'=>$rawData->itemLevel), false);
            $item->save(false);
        }
        return $item;
    }

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('raw_date',$this->raw_date,true);
		$criteria->compare('item_level',$this->item_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
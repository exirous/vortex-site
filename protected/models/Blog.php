<?php

/**
 * This is the model class for table "blogs".
 *
 * The followings are the available columns in table 'blogs':
 * @property string $id
 * @property string $title
 * @property integer $owner_id
 * @property string $created
 * @property string $updated
 */
class Blog extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'blogs';
	}

	public function rules()
	{
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>200),
			array('id, title, owner_id, created, updated', 'safe', 'on'=>'search'),
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
			'title' => 'Название блога',
			'owner_id' => 'Владелец блога',
			'created' => 'Создан',
			'updated' => 'Обновлен',
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAccessableBlogs() {
		if(Yii::app()->user->checkAccess('administrator')){
			return $this->findAll();
		} else {
			return false;
		}
	}

	protected function beforeSave()
	{
	    if(parent::beforeSave())
	    {
	        if($this->isNewRecord)
	        {
	            $this->created=$this->updated=new CDbExpression('NOW()');
	            $this->owner_id=Yii::app()->user->id;
	        }
	        else
	            $this->updated=new CDbExpression('NOW()');
	        return true;
	    }
	    else
	        return false;
	}		
}
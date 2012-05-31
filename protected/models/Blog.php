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

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blogs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('owner_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, owner_id, created, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

	    return array(
	        'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
	    );

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

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
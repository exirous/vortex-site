<?php

/**
 * This is the model class for table "raid_bosses".
 *
 * The followings are the available columns in table 'raid_bosses':
 * @property string $id
 * @property string $name
 * @property string $raid_id
 *
 * The followings are the available model relations:
 * @property Raids $raid
 */
class RaidBoss extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RaidBoss the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'raid_bosses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, raid_id, description', 'required'),
			array('raid_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>250),
            array('youtube_search', 'length', 'max'=>250),
            array('youtube_search_ru', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, raid_id, youtube_search, youtube_search_ru', 'safe', 'on'=>'search'),
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
			'raid' => array(self::BELONGS_TO, 'Raids', 'raid_id'),
            'raidBossAbilities' => array(self::HAS_MANY, 'RaidBossAbility', 'raid_boss_id'),
            'raidRootBossAbilities' => array(self::HAS_MANY, 'RaidBossAbility', 'raid_boss_id',
                'on'=>'raidRootBossAbilities.parent_id IS NULL'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('raid_id',$this->raid_id,true);
        $criteria->compare('youtube_search',$this->youtube_search,true);
        $criteria->compare('youtube_search_ru',$this->youtube_search_ru,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
<?php

/**
 * This is the model class for table "raid_boss_abilities".
 *
 * The followings are the available columns in table 'raid_boss_abilities':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $parent_id
 * @property string $raid_boss_id
 *
 * The followings are the available model relations:
 * @property RaidBosses $raidBoss
 * @property RaidBossAbility $parent
 * @property RaidBossAbility[] $raidBossAbilities
 */
class RaidBossAbility extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RaidBossAbility the static model class
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
		return 'raid_boss_abilities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, raid_boss_id', 'required'),
			array('name', 'length', 'max'=>255),
			array('parent_id, raid_boss_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, parent_id, raid_boss_id', 'safe', 'on'=>'search'),
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
			'raidBoss' => array(self::BELONGS_TO, 'RaidBoss', 'raid_boss_id'),
			'parent' => array(self::BELONGS_TO, 'RaidBossAbility', 'parent_id'),
			'raidBossAbilities' => array(self::HAS_MANY, 'RaidBossAbility', 'parent_id'),
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
			'description' => 'Описание',
			'parent_id' => 'Родительская способность',
			'raid_boss_id' => 'Рейдовый босс',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('raid_boss_id',$this->raid_boss_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function withChilds($func, $func_childs = null) {
        $temp = $func($this);
        $temp_childs = "";
        foreach ($this->raidBossAbilities as $raidBossAbility) {
            $temp_childs .= $raidBossAbility->withChilds($func, $func_childs);
        }
        if ($func_childs && $temp_childs) {
            $temp_childs = $func_childs($temp_childs);
        }
        $temp .= $temp_childs;
        return $temp;
    }

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if ($this->parent_id == 0) $this->parent_id = NULL;
            return true;
        }
        else
            return false;
    }
}
<?php

class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'profiles';
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'realname' => 'Имя',
			'phone' => 'Мобильный телефон',
			'place' => 'Расположение',
		);
	}	

	public function rules()
	{
		return array(
			array('realname', 'length', 'max'=>30),
			array('phone', 'length', 'max'=>30),
			array('place', 'length', 'max'=>50),
		);
	}	

	public function relations()
    {
	    return array(
            'characters'=>array(self::HAS_MANY, 'Character', 'profile_id'),
            'characterCount'=>array(self::STAT, 'Character', 'profile_id'),
            'mainCharacter'=>array(self::HAS_ONE, 'Character', 'profile_id', 'condition' => 'main_character = TRUE'),
        );
	}

	public function getOrCreateProfileByPhpbb($phpbb_id)
	{
		$profile_attributes = array('phpbb_id' => $phpbb_id); 
		$profile = $this->findByAttributes($profile_attributes);
		if ($profile) {
			return $profile;
		} else {
			$profile = new Profile;
			$profile->setAttributes($profile_attributes, false);
		    $profile->save();
		    return $profile;
		}

	}
}
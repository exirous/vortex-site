<?php

class Character extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'characters';
	}	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ts3_normal_token' => 'TS3 token',
			'ts3_admin_token' => 'TS3 admin token'
		);
	}

	public function relations()
    {
        return array(
            'profile'=>array(self::BELONGS_TO, 'Profile', 'profile_id'),
            'warcraftClass'=>array(self::BELONGS_TO, 'WarcraftClass', 'warcraft_class_id'),
            'rank'=>array(self::BELONGS_TO,'Rank','rank_id')
        );
	}

	public function ts3_token_link ($token, $label)
	{
		$ts3 = Yii::app()->ts3;
		$link = "ts3server://".$ts3->server_ip."?port=".$ts3->server_port.
			"&nickname=".$this->name.
			"&token=".$token.
			"&addbookmark=1";

		$a_link = "<a href='$link'>".$label."</a>";
		return $a_link;
	}	

	public function apiLoadFromGuild($character_api, $rank, $guild_id, $realm_id)
	{
		$warcraftCless = WarcraftClass::model()->findByAttributes(array('api_id' => $character_api->class));
		$rank = Rank::model()->getByApiIdAndGuildID($rank, $guild_id);

 		$character_attributes = array(
 			'name' => $character_api->name, 
 			'guild_id' => $guild_id, 
 			'realm_id' => $realm_id,
 			'rank_id' => $rank->id, 
 			'warcraft_class_id' => $warcraftCless->id, 
 			'warcraft_race_id' => $character_api->race, 
 			'gender' => $character_api->gender, 
 			'level' => $character_api->level, 
 			'thumbnail' => $character_api->thumbnail
 		);

		$attributes = array('name' => $character_api->name, 'realm_id' => $realm_id);
		$character = $this->findByAttributes($attributes);
 		if (!$character) $character = new Character;
		$character->setAttributes($character_attributes, false);
	    $character->save();
	}

	public function apiLoad($character_api, $realm_id)
	{
		$warcraftCless = WarcraftClass::model()->findByAttributes(array('api_id' => $character_api->class));

 		$character_attributes = array(
 			'name' => $character_api->name, 
 			'realm_id' => $realm_id,
 			'warcraft_class_id' => $warcraftCless->id, 
 			'warcraft_race_id' => $character_api->race, 
 			'gender' => $character_api->gender, 
 			'level' => $character_api->level, 
 		);

		$attributes = array('name' => $character_api->name, 'realm_id' => $realm_id);
		$character = $this->findByAttributes($attributes);


 		if (!$character) $character = new Character;
		$character->setAttributes($character_attributes, false);
		$character->save();
		return $character;
	}

	public function leaveGuild($character_id) {
		$character = $this->findByPk($character_id);
 		$character_attributes = array(
 			'guild_id' => null, 
 			'rank_id' => null, 
 		);
 		
 		$character->setAttributes($character_attributes, false);
		$character->save();
    }

    public function generateTs3Tokens() {
    	$ts3 = Yii::app()->ts3;
    	if (!$ts3) return;
    	if (!$ts3->checkToken($this->ts3_normal_token)) {
    		$normalToken = $ts3->generateNormalToken($this->name);
    		$this->ts3_normal_token = $normalToken;
    		$this->save();
    	}

    	if ($this->rank->ts_admin) {
    		if (!$ts3->checkToken($this->ts3_admin_token)) {
    			$adminToken = $ts3->generateAdminToken($this->name);
    			$this->ts3_admin_token = $adminToken;
    			$this->save();    			
    		}
    	}
    }

    public function findByNameAndRealmId($characterName, $realmId) {
    	$character_attributes = array('name' => $characterName, 'realm_id' => $realmId);
    	return $this->findByAttributes($character_attributes); 	
    }

    public function findByName($characterName) {
    	$realm = Realm::model()->findByName("Черный Шрам");
    	if ($realm) {
    		return $this->findByNameAndRealmId($characterName, $realm->id);
    	} else {
    		return false;
    	}
    }
}

?>
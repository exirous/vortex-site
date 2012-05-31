<?php

class Guild extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'guilds';
	}	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
		);
	}

	public function apiLoad($guild_api, $guild_slug)
	{
        $realm = Realm::model()->findByName($guild_api->realm);
        $guild = $this->findBySlug($guild_slug);
        $guild_attributes = array('name' => $guild_api->name, 'slug' => $guild_slug, 'realm_id' => $realm->id);
        if (!$guild) $guild = new Guild;
        $guild->setAttributes($guild_attributes, false);
	    $guild->save();
        
        $characters_api = array();

        foreach ($guild_api->members as $member) {
            $character = $member->character;
            $rank = $member->rank;
            Character::model()->apiLoadFromGuild($character, $rank, $guild->id, $realm->id); 
            
            array_push($characters_api, $member->character->name);
        }

		$attributes = array('guild_id' => $guild->id);
		$characters = Character::model()->findAllByAttributes($attributes);

		$characters_db = array();
		foreach($characters as $character)
		{
    		$characters_db[$character->id] = $character->name;
		}

        $characters_leaved = array_diff($characters_db, $characters_api);
     
        foreach ($characters_leaved as $character_id => $character_name) {
 			Character::model()->leaveGuild($character_id); 
        } 
	}

	public function findBySlug($slug)
	{
		$attributes = array('slug' => $slug);
		return $this->findByAttributes($attributes);
	}

	public function getCharacters($guild_id)
	{
		$attributes = array('guild_id' => $guild_id);
		$characters = Character::model()->findAllByAttributes($attributes);

		$characters_db = array();
		foreach($characters as $character)
		{
			$character_array =  array(
				'name' =>  $character->name, 
				'rank' =>  $character->rank_id, 
				'thumbnail' => $character->thumbnail, 
				'class' => $character->warcraft_class_id, 
				'achievement_points'=> $character->achievement_points
			);
    		$characters_db[$character->id] = $character_array;
		}	
		return 	$characters_db;
	}
}

?>
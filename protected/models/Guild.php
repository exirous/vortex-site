<?php

class Guild extends CActiveRecord
{
    private $ranks = array(0, 1, 3, 4, 8, 12);

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'guilds';
	}

    public function relations()
    {
        return array(
            'guildClassLeaders' => array(self::HAS_MANY, 'GuildClassLeader', 'guild_id'),
            'characters' => array(self::HAS_MANY, 'Character', 'guild_id'),
            'realm' => array(self::BELONGS_TO, 'Realm', 'realm_id')
        );
    }

    public function scopes() {
        return array(
            'roster'=>array(
                'condition'=>$this->ranks,
            ),
        );
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

	public function getCharacters()
	{
		$attributes = array('guild_id' => $this->guild_id);
		$characters = Character::model()->findAllByAttributes($attributes);
		return 	$characters;
	}

    public function getRoster()
    {
        $attributes = array('guild_id' => $this->id, 'rank_id' => $this->ranks);
        $characters = Character::model()->findAllByAttributes($attributes);
        return 	$characters;
    }

    public function getRosterByClassRole($class_role_id = null)
    {
        $attributes = array('guild_id' => $this->id, 'rank_id' => $this->ranks);
        if ($class_role_id)
            $characters = Character::model()->findAllByAttributes($attributes, array(
                'with'=>'mainSpecRole',
                'condition'=>'mainSpecRole.id='.$class_role_id,
                'order'=>'t.rank_id ASC, t.warcraft_class_id ASC, t.name ASC'
            ));
        else
            $characters = Character::model()->findAllByAttributes($attributes, array(
                'with'=>'mainSpecRole',
                'condition'=>'mainSpecRole.id IS NULL',
                'order'=>'t.rank_id ASC, t.warcraft_class_id ASC, t.name ASC'
            ));
        return 	$characters;
    }

    public function getFullName($include_id = false) {
        $fullName = $this->name." - ".$this->realm->name;
        if ($include_id) $fullName .= " (".$this->id.")";
        return $fullName;
    }
}

?>
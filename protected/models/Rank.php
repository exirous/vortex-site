<?php

class Rank extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'ranks';
	}	

	public function relations()
    {
	    return array(
            'characters'=>array(self::HAS_MANY, 'Character', 'rank_id'),
        );
	}	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
		);
	}

	public function getByApiIdAndGuildID($rank_api, $guild_id)
	{
		$rank_attributes = array('api_id' => $rank_api, 'guild_id' => $guild_id);
		$rank = $this->findByAttributes($rank_attributes);
		if (!$rank) {
			$rank_attributes['name'] = '' . $guild_id . ' - ' . $rank_api;
			$rank = new Rank;
			$rank->setAttributes($rank_attributes, false);
		    $rank->save();
		}
		
		return $rank;
	}
}

?>
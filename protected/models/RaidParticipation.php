<?php

/**
 * User: Русинов Максим
 * Date: 11.06.12
 * Time: 16:17
 */
class RaidParticipation extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName() {
        return 'raid_event_participations';
    }


    public function relations()
    {
        return array(
            'character' => array(self::BELONGS_TO, 'Character', 'character_id'),
            'raidEvent' => array(self::BELONGS_TO, 'RaidEvent', 'raid_event_id'),
        );
    }

}
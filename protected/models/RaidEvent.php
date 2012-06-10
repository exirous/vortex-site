<?php

/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 12:36
 */
class RaidEvent extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName() {
        return 'raid_events';
    }

}
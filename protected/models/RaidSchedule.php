<?php

/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 12:08
 */
class RaidSchedule extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName() {
        return 'raid_schedules';
    }

    public function relations() {
        return array(
            'raidEvents' => array(self::HAS_MANY, 'RaidEvent', 'raid_schedule_id'),
            'raidEventsCount' => array(self::STAT, 'RaidEvent', 'raid_schedule_id'),
            'raidRanks' => array(self::MANY_MANY, 'Rank', 'raid_schedule_rank(raid_schedule_id, rank_id)'),
        );
    }

    public function generateRaidEvents($time){
        if (!isset($time)) $time = time();

        $time_passed = (date('N', $time)-1)* 24 * 3600;
        $startOfWeek = mktime(0,0,0,date('m', $time),date('d', $time),date('Y', $time)) - $time_passed;

        foreach ($this->days_of_week() as $field => $time_since_begin_week) {
            $startOfDay = $startOfWeek + $time_since_begin_week;
            if (RaidEvent::model()->find('raid_schedule_id = '.$this->id." AND event_datetime BETWEEN '" . MySQL::timestampToMySqlString($startOfDay). "' AND '".MySQL::timestampToMySqlString($startOfDay+24*60*60-1)."'")) continue;
            if ($this->$field) {
                $raid_event_attributes = array(
                    'title' => $this->title,
                    'event_datetime' => MySQL::timestampToMySqlString($startOfDay + $this->raid_time),
                    'raid_schedule_id' => $this->id,
                );

                $raid_event = new RaidEvent;
                $raid_event->setAttributes($raid_event_attributes, false);
                $raid_event->save();
            }
        }
        $this->refresh();
    }

    private function days_of_week(){
        return array(
            'is_monday' => 0,
            'is_tuesday' => 24*60*60,
            'is_wednesday' => 2*24*60*60,
            'is_thursday' => 3*24*60*60,
            'is_friday' => 4*24*60*60,
            'is_saturday' => 5*24*60*60,
            'is_sunday' => 6*24*60*60,
        );
    }
}
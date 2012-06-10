<?php
/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 12:01
 */

class RaidScheduleTest extends CDbTestCase {

    public $fixtures = array(
        'raid_schedules' => 'RaidSchedule',
        'raid_events' => 'RaidEvent',
    );

    public function testRaidScheduleGenerateRaidEvents(){
        $raidSchedule = $this->raid_schedules('raid25');
        $this->assertTrue($raidSchedule->raidEventsCount == 0);

        $time = time();

        $raidSchedule->generateRaidEvents($time);
        $this->assertTrue($raidSchedule->raidEventsCount == 2);
    }

    public function testRaidScheduleGenerateRaidEventsRepeat(){
        $raidSchedule = $this->raid_schedules('raid25');
        $time = time();

        $raidSchedule->generateRaidEvents($time);
        $raidSchedule->generateRaidEvents($time);
        $this->assertTrue($raidSchedule->raidEventsCount == 2);
    }
}
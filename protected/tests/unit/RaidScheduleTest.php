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
        'raid_schedule_ranks' => ':raid_schedule_rank',
    );

    public function testRaidScheduleGenerateRaidEvents(){
        $raidSchedule = $this->raid_schedules('raid25');
        $raid_count_before = $raidSchedule->raidEventsCount;

        $time = time();

        $raidSchedule->generateRaidEvents($time);
        $this->assertTrue($raidSchedule->raidEventsCount == $raid_count_before + 2);
    }

    public function testRaidScheduleGenerateRaidEventsRepeat(){
        $raidSchedule = $this->raid_schedules('raid25');
        $raid_count_before = $raidSchedule->raidEventsCount;
        $time = time();

        $raidSchedule->generateRaidEvents($time);
        $raidSchedule->generateRaidEvents($time);
        $this->assertTrue($raidSchedule->raidEventsCount == $raid_count_before + 2);
    }

    public function testRaidScheduleGenerateRaidEvents2Week(){
        $raidSchedule = $this->raid_schedules('raid25');
        $raid_count_before = $raidSchedule->raidEventsCount;
        $time = time();

        $raidSchedule->generateRaidEvents($time);
        $raidSchedule->generateRaidEvents($time+7*24*60*60);
        $this->assertTrue($raidSchedule->raidEventsCount == $raid_count_before + 4);
    }

    public function testGetRankList(){
        $raidSchedule = $this->raid_schedules('raid25');
        $this->assertTrue(is_array($raidSchedule->raidRanks));
        $this->assertEquals(4, count($raidSchedule->raidRanks));
    }
}
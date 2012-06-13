<?php
/**
 * User: Русинов Максим
 * Date: 11.06.12
 * Time: 14:15
 */
class RaidEventTest extends CDbTestCase{

    public $fixtures = array(
        'raid_events' => 'RaidEvent',
        'raid_schedules' => 'RaidSchedule',
        'characters' => 'Character',
        'raid_schedule_ranks' => ':raid_schedule_rank',
        'raid_event_participations' => ':raid_event_participations',
    );

    public function testParticipantsReturnArray() {
        $test_raid_event = $this->raid_events('fixed_event');
        $this->assertTrue(is_array($test_raid_event->participants));
    }

    public function testParticipantsReturnArrayOfRaidParticipations() {
        $test_raid_event = $this->raid_events('fixed_event');

        $character = $this->characters('Asta');
        $state = RaidEvent::RAID_PARTICIPATION_NO;
        $test_raid_event->setCharacterState($character, $state);

        $this->assertEquals(1, count($test_raid_event->participants), 'Wrong count Participants');
        foreach ($test_raid_event->participants as $participant) {
            $this->assertInstanceOf('RaidParticipation', $participant);
        }
    }

    public function testSetCharacterCannotBeInRaid(){
        $test_raid_event = $this->raid_events('fixed_event');
        $character = $this->characters('Asta');
        $state = RaidEvent::RAID_PARTICIPATION_NO;
        $this->assertTrue($test_raid_event->setCharacterState($character, $state));
        $state = RaidEvent::RAID_PARTICIPATION_LATE;
        $this->assertTrue($test_raid_event->setCharacterState($character, $state));
    }

    public function testFixedParticipations() {
        $test_raid_event = $this->raid_events('fixed_event');
        $this->assertEquals(0, count($test_raid_event->fixedParticipations));
        $character = $this->characters('Asta');
        $state = RaidEvent::RAID_PARTICIPATION_NO;
        $test_raid_event->setCharacterState($character, $state);
        $this->assertEquals(1, count($test_raid_event->fixedParticipations));
    }

    public function testNotFixedEventGotFixedAfterFind(){
        $test_raid_event = $this->raid_events('not_fixed_event');
        $this->assertEquals(3, count($test_raid_event->fixedParticipations));
    }

}

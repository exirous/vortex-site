<?php

class m120613_114650_add_raid_participants extends CDbMigration
{
	public function up()
	{
        $this->createTable('raid_event_participations',
            array(
                'id' => 'int(11) PRIMARY KEY AUTO_INCREMENT',
                'raid_event_id' => 'int(11) NOT NULL',
                'character_id' => 'int(11) NOT NULL',
                'raid_participation_state' => 'int(1) NOT NULL',
                'UNIQUE (raid_event_id, character_id)'
            ));

        $this->addColumn('raid_events', 'is_fixed', 'int(1) NOT NULL DEFAULT 0');

        $this->createTable('raid_schedule_rank', array(
            'raid_schedule_id' => 'int(11) NOT NULL',
            'rank_id' => 'int(11) NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('raid_event_participations');
        $this->dropColumn('raid_events', 'is_fixed');
        $this->dropTable('raid_schedule_rank');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
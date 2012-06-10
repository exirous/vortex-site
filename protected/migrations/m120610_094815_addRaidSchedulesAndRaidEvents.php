<?php

class m120610_094815_addRaidSchedulesAndRaidEvents extends CDbMigration
{
	public function up()
	{
        $this->createTable('raid_schedules',
            array(
                'id' => 'int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL',
                'title' => 'varchar(200) NOT NULL',
                'raid_time' => 'integer(10) NOT NULL',
                'is_monday' => 'integer(1) DEFAULT 0',
                'is_tuesday' => 'integer(1) DEFAULT 0',
                'is_wednesday' => 'integer(1) DEFAULT 0',
                'is_thursday' => 'integer(1) DEFAULT 0',
                'is_friday' => 'integer(1) DEFAULT 0',
                'is_saturday' => 'integer(1) DEFAULT 0',
                'is_sunday' => 'integer(1) DEFAULT 0',
            ));

        $this->createTable('raid_events',
            array(
                'id' => 'int(11) PRIMARY KEY AUTO_INCREMENT',
                'title' => 'varchar(200) NOT NULL',
                'event_datetime' => 'datetime NOT NULL',
                'raid_schedule_id' => 'int(11) DEFAULT NULL',
            ));
	}

	public function down()
	{
		$this->dropTable('raid_schedules');
        $this->dropTable('raid_events');
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
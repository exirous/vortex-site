<?php
$c = Yii::app()->getDb()->createCommand();
$c->createTable('profiles', array(
    'id' => 'int(10) PRIMARY KEY NOT NULL',
    'phpbb_id' => 'int(10)',
    'role' => 'varchar(30)',
    'realname' => 'varchar(30)',
    'phone' => 'varchar(30)',
    'place' => 'varchar(50)',
));

$c->createTable('characters', array(
    'id' => 'int(10) PRIMARY KEY NOT NULL',
    'name' => 'varchar(25) NOT NULL',
    'rank_id' => 'int(10) DEFAULT NULL',
    'warcraft_class_id' => 'int(10) NOT NULL',
    'warcraft_race_id' => 'int(10) NOT NULL',
    'profile_id' => 'int(10) DEFAULT NULL',
    'guild_id' => 'int(10) DEFAULT NULL',
    'realm_id' => 'int(10) DEFAULT NULL',
    'thumbnail' => 'varchar(100) DEFAULT NULL',
    'level' => 'int(11) DEFAULT NULL',
    'achievement_points' => 'int(11) DEFAULT NULL',
    'main_character' => 'smallint(1) DEFAULT NULL',
    'gender' => 'int(1) NOT NULL',
    'ts3_normal_token' => ' varchar(40) DEFAULT NULL',
    'ts3_admin_token' => 'varchar(40) DEFAULT NULL',
));

$c->createTable('ranks', array(
    'id' => 'int(10) PRIMARY KEY NOT NULL',
    'name' => 'varchar(20) NOT NULL',
    'api_id' => 'int(11) NOT NULL',
    'guild_id' => 'int(10) DEFAULT NULL',
    'ts_admin' => 'int(1) DEFAULT NULL',
    'role' => 'varchar(30) DEFAULT NULL',
));

$c->createTable('blogs', array(
    'id' => 'int(10) PRIMARY KEY NOT NULL',
    'title' => 'varchar(200) NOT NULL',
    'owner_id' => 'int(11) NOT NULL',
    'created' => 'timestamp DEFAULT NULL',
    'updated' => 'timestamp DEFAULT NULL',
    'is_public' => 'int(1) DEFAULT NULL',
));

$c->createTable('blog_profile_role', array(
    'blog_id' => 'int(11) NOT NULL',
    'profile_id' => 'int(11) NOT NULL',
    'role' => 'VARCHAR(50) NOT NULL',
));

$c->createTable('raid_schedules', array(
    'id' => 'int(11) PRIMARY KEY NOT NULL',
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

$c->createTable('raid_schedule_rank', array(
    'raid_schedule_id' => 'int(11) NOT NULL',
    'rank_id' => 'int(11) NOT NULL',
));

$c->createTable('raid_events', array(
    'id' => 'int(11) PRIMARY KEY',
    'title' => 'varchar(200) NOT NULL',
    'event_datetime' => 'TEXT NOT NULL',
    'raid_schedule_id' => 'int(11) DEFAULT NULL',
    'is_fixed' => 'int(1) NOT NULL DEFAULT 0',
));

$c->createTable('raid_event_participations', array(
    'raid_event_id' => 'int(11) NOT NULL',
    'character_id' => 'int(11) NOT NULL',
    'raid_participation_state' => 'int(1) NOT NULL',
    'UNIQUE (raid_event_id, character_id)'
));
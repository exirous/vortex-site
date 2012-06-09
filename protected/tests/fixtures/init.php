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
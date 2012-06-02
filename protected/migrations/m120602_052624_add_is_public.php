<?php

class m120602_052624_add_is_public extends CDbMigration
{
	public function up()
	{
		$this->addColumn('blogs', 'is_public', 'boolean');
	}

	public function down()
	{
		$this->dropColumn('blogs', 'is_public');
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
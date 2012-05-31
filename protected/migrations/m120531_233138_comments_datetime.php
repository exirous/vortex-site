<?php

class m120531_233138_comments_datetime extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('comments', 'created', 'datetime');
        $this->alterColumn('comments', 'updated', 'datetime');
	}

	public function down()
	{
		$this->alterColumn('comments', 'created', 'date');
		$this->alterColumn('comments', 'updated', 'date');
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
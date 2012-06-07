<?php

class m120606_093938_add_roles_to_ranks extends CDbMigration
{
	public function up()
	{
        $this->addColumn('ranks', 'role', 'varchar(30)');
	}

	public function down()
	{
        $this->dropColumn('ranks', 'role');
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
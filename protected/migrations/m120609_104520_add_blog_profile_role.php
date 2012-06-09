<?php

class m120609_104520_add_blog_profile_role extends CDbMigration
{
	public function up()
	{
        $this->createTable('blog_profile_role',
            array(
                'blog_id' => 'INT(11) NOT NULL',
                'profile_id' => 'INT(11) NOT NULL',
                'role' => 'VARCHAR(50) NOT NULL',
                'primary key (blog_id,profile_id,role)'
            ));
	}

	public function down()
	{
		$this->dropTable('blog_profile_role');
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
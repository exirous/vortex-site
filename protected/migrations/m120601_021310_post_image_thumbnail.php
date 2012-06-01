<?php

class m120601_021310_post_image_thumbnail extends CDbMigration
{
	public function up()
	{
		$this->addColumn('posts', 'post_thumbnail', 'varchar(200)');
	}

	public function down()
	{
		$this->dropColumn('posts', 'post_thumbnail');
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
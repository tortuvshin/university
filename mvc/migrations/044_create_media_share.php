<?php

class Migration_create_media_share extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'shareID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'public' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'file_or_folder' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE,
			),
			'item_id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'create_time' => array(
				'type' => 'TIMESTAMP',
				'null' => FALSE
			),
		));
		$this->dbforge->add_key('shareID', TRUE);
		$this->dbforge->create_table('media_share');
	}

	public function down()
	{
		$this->dbforge->drop_table('media_share');
	}
}
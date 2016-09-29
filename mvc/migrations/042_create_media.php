<?php

class Migration_create_media extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'mediaID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'userID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'mcategoryID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE,
				 'default' => 0,
			),
			'file_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'file_name_display' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
		));
		$this->dbforge->add_key('mediaID', TRUE);
		$this->dbforge->create_table('media');
	}

	public function down()
	{
		$this->dbforge->drop_table('media');
	}
}
<?php

class Migration_create_media_category extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'mcategoryID' => array(
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
			'folder_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'create_time' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('mcategoryID', TRUE);
		$this->dbforge->create_table('media_category');
	}

	public function down()
	{
		$this->dbforge->drop_table('media_category');
	}
}
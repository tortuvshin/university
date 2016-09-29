<?php

class Migration_create_message extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'messageID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'receiverID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'receiverType' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE				
			),
			'message' => array(
				'type' => 'TEXT',
				'null' => FALSE				
			),
			'attach' => array(
				'type' => 'TEXT',
				'null' => TRUE				
			),
			'attach_file_name' => array(
				'type' => 'TEXT',
				'null' => TRUE				
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
			'useremail' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FALSE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP'
			),
			'read_status' => array(
				'type' => 'BOOLEAN',
				'null' => FALSE
			),
			'from_status' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'to_status' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'fav_status' => array(
				'type' => 'BOOLEAN',
				'null' => FALSE
			),
			'fav_status_sent' => array(
				'type' => 'BOOLEAN',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('messageID', TRUE);
		$this->dbforge->create_table('message');
	}

	public function down()
	{
		$this->dbforge->drop_table('message');
	}
}
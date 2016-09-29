<?php

class Migration_create_visitorinfo extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'visitorID' => array(
				'type' => 'BIGINT',
				'constraint' => 12,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => TRUE
			),
			'email_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => TRUE
			),
			'phone' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'company_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => TRUE
			),
			'coming_from' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => TRUE
			),
			'to_meet' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => TRUE
			),
			'to_meet_personID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'to_meet_person_usertype' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'check_in' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP',
				'null' => TRUE
			),
			'check_out' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'INT', 
				'constant' => 2,
				'null' => 'TRUE'
			),

		));
		$this->dbforge->add_key('visitorID', TRUE);
		$this->dbforge->create_table('visitorinfo');
	}

	public function down()
	{
		$this->dbforge->drop_table('visitorinfo');
	}
}
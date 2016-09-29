<?php

class Migration_create_transport_member extends CI_Migration {

	public function up() {

		$this->dbforge->add_field(array(
			'tmemberID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'transportID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'phone' => array(
				'type' => 'TEXT',
				'constraint' => '25',
				'null' => TRUE
			),
			'tbalance' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => TRUE
			),
			'tjoindate' => array(
				'type' => 'DATE',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('tmemberID', TRUE);
		$this->dbforge->create_table('tmember');
	}

	public function down()
	{
		$this->dbforge->drop_table('tmember');
	}
}
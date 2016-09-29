<?php

class Migration_create_library_member extends CI_Migration {

	public function up() {

		$this->dbforge->add_field(array(
			'lmemberID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'lID' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => '11',
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
			'lbalance' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			),
			'ljoindate' => array(
				'type' => 'DATE',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('lmemberID', TRUE);
		$this->dbforge->create_table('lmember');
	}

	public function down()
	{
		$this->dbforge->drop_table('lmember');
	}
}
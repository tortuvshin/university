<?php

class Migration_create_leave extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'leaveID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'fdate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'tdate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'details' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'tousername' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'fromusername' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => '11',
				'default' => 0
			),
			'create_date' => array(
				'type' => 'TIMESTAMP',
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('leaveID', TRUE);
		$this->dbforge->create_table('leave');
	}

	public function down()
	{
		$this->dbforge->drop_table('leave');
	}
}

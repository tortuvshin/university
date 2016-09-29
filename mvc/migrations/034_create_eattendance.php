<?php

class Migration_create_eattendance extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'eattendanceID' => array(
				'type' => 'INT',
				'constraint' => 200,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'examID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'subjectID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'date' => array(
				'type' => 'date',
				'null' => FALSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			),
			's_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => TRUE
			),
			'eattendance' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => TRUE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FAlSE
			),
			'eextra' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => TRUE 
			)
		));
		$this->dbforge->add_key('eattendanceID', TRUE);
		$this->dbforge->create_table('eattendance');
	}

	public function down()
	{
		$this->dbforge->drop_table('eattendance');
	}
}
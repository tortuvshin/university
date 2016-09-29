<?php

class Migration_create_examschedule extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'examscheduleID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'examID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'sectionID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'subjectID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'edate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'examfrom' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'examto' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'room' => array(
				'type' => 'TEXT',
				'constraint' => '10',
				'null' => TRUE
			), 
			'year' => array(
				'type' => 'YEAR',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('examscheduleID', TRUE);
		$this->dbforge->create_table('examschedule');
	}

	public function down()
	{
		$this->dbforge->drop_table('examschedule');
	}
}
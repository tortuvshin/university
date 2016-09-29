<?php

class Migration_create_routine extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'routineID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
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
			'day' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'start_time' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'end_time' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'room' => array(
				'type' => 'TEXT',
				'constraint' => '11',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('routineID', TRUE);
		$this->dbforge->create_table('routine');
	}

	public function down()
	{
		$this->dbforge->drop_table('routine');
	}
}
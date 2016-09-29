<?php

class Migration_create_automation_rec extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'automation_recID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'day' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => FAlSE
			),
			'month' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => FAlSE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FAlSE
			),
			'nofmodule' => array(
				'type' => 'INT',
				'null' => FAlSE
			)
		));
		$this->dbforge->add_key('automation_recID', TRUE);
		$this->dbforge->create_table('automation_rec');
	}

	public function down()
	{
		$this->dbforge->drop_table('automation_rec');
	}
}
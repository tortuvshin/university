<?php

class Migration_create_mark extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'markID' => array(
				'type' => 'INT',
				'constraint' => 200,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'examID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'exam' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'subjectID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'mark' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FAlSE
			),
		));
		$this->dbforge->add_key('markID', TRUE);
		$this->dbforge->create_table('mark');
	}

	public function down()
	{
		$this->dbforge->drop_table('mark');
	}
}
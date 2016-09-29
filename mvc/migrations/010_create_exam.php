<?php

class Migration_create_exam extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'examID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'exam' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'note' => array(
				'type' => 'TEXT',
				'constraint' => '200',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('examID', TRUE);
		$this->dbforge->create_table('exam');
	}

	public function down()
	{
		$this->dbforge->drop_table('exam');
	}
}
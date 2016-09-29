<?php

class Migration_create_holiday extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'holidayID' => array(
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
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP',
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('holidayID', TRUE);
		$this->dbforge->create_table('holiday');
	}

	public function down()
	{
		$this->dbforge->drop_table('holiday');
	}
}

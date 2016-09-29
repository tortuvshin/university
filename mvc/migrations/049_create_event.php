<?php

class Migration_create_event extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'eventID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'fdate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
      'ftime' => array(
				'type' => 'TIME',
				'null' => FALSE
			),
			'tdate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
      'ttime' => array(
				'type' => 'TIME',
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
		$this->dbforge->add_key('eventID', TRUE);
		$this->dbforge->create_table('event');
	}

	public function down()
	{
		$this->dbforge->drop_table('event');
	}
}

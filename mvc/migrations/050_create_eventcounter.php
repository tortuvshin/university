<?php

class Migration_create_eventcounter extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'eventcounterID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'eventID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
      'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP',
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('eventcounterID', TRUE);
		$this->dbforge->create_table('eventcounter');
	}

	public function down()
	{
		$this->dbforge->drop_table('eventcounter');
	}
}

<?php

class Migration_create_hostel extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'hostelID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FAlSE
			),
			'htype' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => FALSE
			),
			'address' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE
			),
			'note' => array(
				'type' => 'text',
				'constraint' => '200',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('hostelID', TRUE);
		$this->dbforge->create_table('hostel');
	}

	public function down()
	{
		$this->dbforge->drop_table('hostel');
	}
}
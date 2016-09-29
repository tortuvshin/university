<?php

class Migration_create_transport extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'transportID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'route' => array(
				'type' => 'TEXT',
				'constraint' => '128',
				'null' => FALSE
			),
			'vehicle' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'fare' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => FALSE
			),
			'note' => array(
				'type' => 'text',
				'constraint' => '200',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('transportID', TRUE);
		$this->dbforge->create_table('transport');
	}

	public function down()
	{
		$this->dbforge->drop_table('transport');
	}
}
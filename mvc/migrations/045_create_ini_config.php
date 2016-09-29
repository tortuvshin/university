<?php

class Migration_create_ini_config extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'configID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'config_key' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'value' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
		));
		$this->dbforge->create_table('ini_config');
	}

	public function down()
	{
		$this->dbforge->drop_table('ini_config');
	}
}
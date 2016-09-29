<?php

class Migration_create_reset extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'resetID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'keyID' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FAlSE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			)
		));
		$this->dbforge->add_key('resetID', TRUE);
		$this->dbforge->create_table('reset');
	}

	public function down()
	{
		$this->dbforge->drop_table('reset');
	}
}
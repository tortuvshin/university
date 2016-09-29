<?php

class Migration_create_feetype extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'feetypeID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'feetype' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'note' => array(
				'type' => 'TEXT',
				'constraint' => 200,
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('feetypeID', TRUE);
		$this->dbforge->create_table('feetype');
	}

	public function down()
	{
		$this->dbforge->drop_table('feetype');
	}
}
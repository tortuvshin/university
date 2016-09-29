<?php

class Migration_create_automation_shudulu extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'automation_shuduluID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'day' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => FAlSE
			),
			'month' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => FAlSE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FAlSE
			)
		));
		$this->dbforge->add_key('automation_shuduluID', TRUE);
		$this->dbforge->create_table('automation_shudulu');
	}

	public function down()
	{
		$this->dbforge->drop_table('automation_shudulu');
	}
}
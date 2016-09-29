<?php

class Migration_create_alert extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'alertID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'noticeID' => array(
				'type' => 'INT',
				'constraint' => '128'
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '128'
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => '128'
			)
		));
		$this->dbforge->add_key('alertID', TRUE);
		$this->dbforge->create_table('alert');
	}

	public function down()
	{
		$this->dbforge->drop_table('alert');
	}
}
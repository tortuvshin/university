<?php

class Migration_create_notice extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'noticeID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'notice' => array(
				'type' => 'TEXT',
				'null' => FALSE
				
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FALSE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('noticeID', TRUE);
		$this->dbforge->create_table('notice');
	}

	public function down()
	{
		$this->dbforge->drop_table('notice');
	}
}
<?php

class Migration_create_hmember extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'hmemberID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'hostelID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'categoryID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'hbalance' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			),
			'hjoindate' => array(
				'type' => 'DATE',
				'null' => FAlSE
			)
		));
		$this->dbforge->add_key('hmemberID', TRUE);
		$this->dbforge->create_table('hmember');
	}

	public function down()
	{
		$this->dbforge->drop_table('hmember');
	}
}
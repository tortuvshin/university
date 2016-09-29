<?php

class Migration_create_category extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'categoryID' => array(
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
			'class_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FAlSE
			),
			'hbalance' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'note' => array(
				'type' => 'text',
				'constraint' => '200',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('categoryID', TRUE);
		$this->dbforge->create_table('category');
	}

	public function down()
	{
		$this->dbforge->drop_table('category');
	}
}
<?php

class Migration_create_book extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'bookID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'book' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'subject_code' => array(
				'type' => 'TEXT',
				'constraint' => '20',
				'null' => FALSE
			),
			'author' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'price' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'quantity' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'due_quantity' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'rack' => array(
				'type' => 'text',
				'constraint' => '60',
				'null' => FALSE
			),
		));
		$this->dbforge->add_key('bookID', TRUE);
		$this->dbforge->create_table('book');
	}

	public function down()
	{
		$this->dbforge->drop_table('book');
	}
}
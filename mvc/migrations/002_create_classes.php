<?php

class Migration_create_classes extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'classes' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				"null" => FALSE
			),
			'classes_numeric' => array(
				'type' => 'INT',
				'constraint' => '11',
				"null" => FALSE
			),
			'teacherID' => array(
				'type' => 'INT',
				'constraint' => '11',
				"null" => FALSE
			),
			'note' => array(
				'type' => 'TEXT',
				'constraint' => '200',
				"null" => TRUE
			),
			'create_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE
			),
			'modify_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE
			),
			'create_userID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'create_username' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'create_usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('classesID', TRUE);
		$this->dbforge->create_table('classes');
	}

	public function down()
	{
		$this->dbforge->drop_table('classes');
	}
}
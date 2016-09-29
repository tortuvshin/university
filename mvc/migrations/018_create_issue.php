<?php

class Migration_create_issue extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'issueID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'lID' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'bookID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'book' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'author' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'serial_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'issue_date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'due_date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'return_date' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'fine' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => TRUE
			),
			'note' => array(
				'type' => 'text',
				'constraint' => '200',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('issueID', TRUE);
		$this->dbforge->create_table('issue');
	}

	public function down()
	{
		$this->dbforge->drop_table('issue');
	}
}
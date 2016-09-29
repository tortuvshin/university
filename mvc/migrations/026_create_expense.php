<?php

class Migration_create_expense extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'expenseID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'create_date' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'expense' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FAlSE
			),
			'amount' => array(
				'type' => 'VARCHAR',
				'constraint' => 11,
				'null' => FAlSE
			),
			'userID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'uname' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FAlSE
			),
			'expenseyear' => array(
				'type' => 'YEAR',
				'null' => FAlSE 
			),
			'note' => array(
				'type' => 'text',
				'constraint' => 200,
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('expenseID', TRUE);
		$this->dbforge->create_table('expense');
	}

	public function down()
	{
		$this->dbforge->drop_table('expense');
	}
}
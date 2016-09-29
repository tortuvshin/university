<?php

class Migration_create_invoice extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'invoiceID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'classes' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				"null" => FAlSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'student' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				"null" => FAlSE
			),
			'roll' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				"null" => FAlSE
			),
			'feetype' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FAlSE
			),
			'amount' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FAlSE
			),
			'paidamount' => array(
				'type' => 'VARCHAR',
				'constraint' => 11,
				'null' => TRUE
			),
			'userID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => TRUE
			),
			'uname' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => TRUE
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'paymenttype' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			'date' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'paiddate' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FAlSE 
			)
		));
		$this->dbforge->add_key('invoiceID', TRUE);
		$this->dbforge->create_table('invoice');
	}

	public function down()
	{
		$this->dbforge->drop_table('invoice');
	}
}
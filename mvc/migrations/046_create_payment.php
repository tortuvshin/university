<?php

class Migration_create_payment extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'paymentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'invoiceID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'paymentamount' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FAlSE
			),
			'paymenttype' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FAlSE
			),
			'paymentdate' => array(
				'type' => 'DATE',
				'null' => FAlSE
			),
			'paymentmonth' => array(
				'constraint' => 10,
				'type' => 'VARCHAR',
				'null' => FAlSE
			),
			'paymentyear' => array(
				'type' => 'YEAR',
				'null' => FAlSE 
			)
		));
		$this->dbforge->add_key('paymentID', TRUE);
		$this->dbforge->create_table('payment');
	}

	public function down()
	{
		$this->dbforge->drop_table('payment');
	}
}
<?php

class Migration_create_paymentfee extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'paymentfeeID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				"null" => FAlSE
			),
			'student' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'classes' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				"null" => FAlSE
			),
			'roll' => array(
				'type' => 'TEXT',
				'constraint' => 40,
				"null" => FAlSE
			),
			'paiddate' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'paidamount' => array(
				'type' => 'VARCHAR',
				'constraint' => 11,
				'null' => FALSE
			),
			'userID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FAlSE
			),
			'uname' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FAlSE
			),
			'paymentfeeyear' => array(
				'type' => 'YEAR',
				'null' => FAlSE 
			)
		));
		$this->dbforge->add_key('paymentfeeID', TRUE);
		$this->dbforge->create_table('paymentfee');
	}

	public function down()
	{
		$this->dbforge->drop_table('paymentfee');
	}
}
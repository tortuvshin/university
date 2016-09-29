<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_mailandsms extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'mailandsmsID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'users' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 10,
				'null' => FALSE
			),
			'message' => array(
				'type' => 'TEXT',
				'constraint' => 20000,
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP',
				'null' => FALSE
			),
			'year' => array(
				'type' => 'YEAR',
				'null' => FALSE
			),
		));
		$this->dbforge->add_key('mailandsmsID', TRUE);
		$this->dbforge->create_table('mailandsms');
	}

	public function down()
	{
		$this->dbforge->drop_table('mailandsms');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */
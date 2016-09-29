<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_setting extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'settingID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sname' => array(
				'type' => 'TEXT',
				'constraint' => '128',
				'null' => TRUE
			),
			'phone' => array(
				'type' => 'TEXT',
				'constraint' => '25',
				'null' => TRUE
			),
			'address' => array(
				'type' => 'TEXT',
				'constraint' => '200',
				'null' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'automation' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => TRUE
			),
			'currency_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => TRUE
			),
			'currency_symbol' => array(
				'type' => 'TEXT',
				'constraint' => '128',
				'null' => TRUE
			),
			'language' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'theme' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'fontorbackend' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			),
			'footer' => array(
				'type' => 'TEXT',
				'constraint' => '200',
				'null' => TRUE
			),
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => TRUE
			),
			'purchase_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'updateversion' => array(
				'type' => 'TEXT',
				'constraint' => 255,
				'null' => TRUE
			),
			'attendance' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('settingID', TRUE);
		$this->dbforge->create_table('setting');
	}

	public function down()
	{
		$this->dbforge->drop_table('setting');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */

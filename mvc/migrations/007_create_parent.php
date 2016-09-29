<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_parent extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'parentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'father_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'mother_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'father_profession' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'mother_profession' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
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
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
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
			),
			'parentactive' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('parentID', TRUE);
		$this->dbforge->create_table('parent');
	}

	public function down()
	{
		$this->dbforge->drop_table('parent');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */

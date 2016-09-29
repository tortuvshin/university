<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_student extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'studentID' => array(
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
			'dob' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'sex' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'religion' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				'null' => TRUE	
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
			'classesID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'sectionID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'section' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'roll' => array(
				'type' => 'TEXT',
				'constraint' => '40',
				'null' => FALSE
			),
			'library' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'hostel' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'transport' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'totalamount' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			'paidamount' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE
			),
			'parentID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'year' => array(
				'type' => 'YEAR',
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
			'studentactive' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('studentID', TRUE);
		$this->dbforge->create_table('student');
	}

	public function down()
	{
		$this->dbforge->drop_table('student');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */
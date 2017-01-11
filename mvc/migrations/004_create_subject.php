<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_subject extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'subjectID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'teacherID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'subject_author' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'subject_code' => array(
				'type' => 'TEXT',
				'constraint' => '25',
				'null' => FALSE
			),
			'teacher_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
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
		));
		$this->dbforge->add_key('subjectID', TRUE);
		$this->dbforge->create_table('subject');
	}

	public function down()
	{
		$this->dbforge->drop_table('subject');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */
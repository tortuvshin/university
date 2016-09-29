<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_section extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'sectionID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'section' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
				'null' => FALSE
			),
			'category' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => FALSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'teacherID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'note' => array(
				'type' => 'TEXT',
				'constraint' => '200',
				'null' => TRUE
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
			)
		));
		$this->dbforge->add_key('sectionID', TRUE);
		$this->dbforge->create_table('section');
	}

	public function down()
	{
		$this->dbforge->drop_table('section');
	}

}

/* End of file 003_create_teacher.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_teacher.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_promotion_subject extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'promotionSubjectID' => array(
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
			'subjectID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'subjectCode' => array(
				'type' => 'TEXT',
				'constraint' => '25',
				'null' => FALSE
			),
			'subjectMark' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => TRUE	
			),
		));
		$this->dbforge->add_key('promotionSubjectID', TRUE);
		$this->dbforge->create_table('promotionsubject');
	}

	public function down()
	{
		$this->dbforge->drop_table('promotionsubject');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_mailandsmstemplate extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'mailandsmstemplateID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE
			),
			'user' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 10,
				'null' => FALSE
			),
			'template' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('mailandsmstemplateID', TRUE);
		$this->dbforge->create_table('mailandsmstemplate');
	}

	public function down()
	{
		$this->dbforge->drop_table('mailandsmstemplate');
	}

}

/* End of file 038_create_mailandsmstemplate.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/038_create_mailandsmstemplate.php */
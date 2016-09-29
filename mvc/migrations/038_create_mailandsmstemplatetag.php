<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_mailandsmstemplatetag extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'mailandsmstemplatetagID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'usersID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE
			),
			'tagname' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE
			),
			'mailandsmstemplatetag_extra' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE
			),
			'create_date' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('mailandsmstemplatetagID', TRUE);
		$this->dbforge->create_table('mailandsmstemplatetag');
	}

	public function down()
	{
		$this->dbforge->drop_table('mailandsmstemplatetag');
	}

}

/* End of file 038_create_mailandsmstemplatetag.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/038_create_mailandsmstemplatetag.php */
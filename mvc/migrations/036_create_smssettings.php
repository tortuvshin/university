<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_smssettings extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'smssettingsID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'types' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE
			),
			'field_names' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE
			),
			'field_values' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE
			),
			'smssettings_extra' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('smssettingsID', TRUE);
		$this->dbforge->create_table('smssettings');
	}

	public function down()
	{
		$this->dbforge->drop_table('smssettings');
	}

}

/* End of file 003_create_subject.php */
/* Location: .//D/xampp/htdocs/school/mvc/migrations/003_create_subject.php */
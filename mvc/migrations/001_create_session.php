<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_session extends CI_Migration {

	public function up() {
		$fields = array(
			'session_id varchar(40) DEFAULT \'0\' NOT NULL',
			'ip_address varchar(45) DEFAULT \'0\' NOT NULL',
			'user_agent varchar(120) NOT NULL',
			'last_activity int(10) unsigned DEFAULT 0 NOT NULL',
			'user_data text NOT NULL',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key("session_id", TRUE);
		$this->dbforge->create_table("school_sessions");
		$this->db->query('ALTER TABLE `school_sessions` ADD KEY `last_activity_idx` (`last_activity`)');
	}

	public function down() {
		$this->dbforge->dorp_table('school_sessions');
	}

}

/* End of file 003_create_session.php */
/* Location: ./application/migrations/003_create_session.php */
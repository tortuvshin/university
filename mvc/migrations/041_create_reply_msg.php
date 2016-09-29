<?php

class Migration_create_reply_msg extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'replyID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'messageID' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'reply_msg' => array(
				'type' => 'TEXT',
				'null' => FALSE				
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FAlSE
			),
			'create_time' => array(
				'type' => 'TIMESTAMP', 
				'constant' => 'CURRENT_TIMESTAMP'
			)
		));
		$this->dbforge->add_key('replyID', TRUE);
		$this->dbforge->create_table('reply_msg');
	}

	public function down()
	{
		$this->dbforge->drop_table('reply_msg');
	}
}
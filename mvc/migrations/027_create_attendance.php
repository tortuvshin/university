<?php

class Migration_create_attendance extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'attendanceID' => array(
				'type' => 'INT',
				'constraint' => 200,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'studentID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'classesID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'userID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FAlSE
			),
			'usertype' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FAlSE
			),
			'monthyear' => array(
				'type' => 'VARCHAR',
				'constraint' => 10,
				'null' => FAlSE
			),
			'a1' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a2' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a3' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a4' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a5' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a6' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a7' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a8' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a9' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a10' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a11' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a12' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a13' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a14' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a15' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a16' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a17' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a18' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a19' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a20' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a21' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a22' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a23' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a24' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a25' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a26' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a27' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a28' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a29' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a30' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			),
			'a31' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('attendanceID', TRUE);
		$this->dbforge->create_table('attendance');
	}

	public function down()
	{
		$this->dbforge->drop_table('attendance');
	}
}
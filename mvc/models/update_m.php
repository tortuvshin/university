<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class update_m extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function create_table($schema) {
		$sql = $this->db->query($schema);
	}

	function delete_table($table_name)
	{
		$sql = $this->db->query("DROP TABLE IF EXISTS $table_name");
	}

	function add_field($table_name, $field_name, $type)
	{
		$sql = $this->db->query("SHOW COLUMNS FROM $table_name LIKE '$field_name'");

		if($sql->num_rows==0) {
			$sql = $this->db->query("ALTER TABLE $table_name ADD $field_name $type");
		}
	}

	function delete_field($table_name, $field_name)
	{
		$sql = $this->db->query("SHOW COLUMNS FROM $table_name LIKE '$field_name'");

		if($sql->num_rows==1) {
			$sql = $this->db->query("ALTER TABLE $table_name DROP COLUMN $field_name");
		}
	}

	function update_data($table_name, $field_name, $value)
	{
		if(gettype($value)=='string') {
			$sql = $this->db->query("UPDATE $table_name SET $field_name = '$value'");
		} else {
			$sql = $this->db->query("UPDATE $table_name SET $field_name = $value");
		}
	}

	function insert_data($data)
	{
		$sql = $this->db->insert_string('systemadmin', $data);
		$sql = $this->db->query($sql);
		return $sql;
	}

}

/* End of file update_m.php */
/* Location: ./school/mvc/models/update_m.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_password_m extends MY_Model {
	
	function __construct() {
		parent::__construct();
	}

	function get_username($table, $data=NULL) {
		$query = $this->db->get_where($table, $data);
		return $query->result();
	}

	function hash($string) {
		return parent::hash($string);
	}	

	function update_reset_password($table, $data=NULL, $tableID, $userID ) {
		$this->db->update($table, $data, $tableID." = ". $userID);
		return TRUE;
	}
}

/* End of file classes_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/classes_m.php */
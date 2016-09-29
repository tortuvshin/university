<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tattendance_m extends MY_Model {

	protected $_table_name = 'tattendance';
	protected $_primary_key = 'tattendanceID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "monthyear asc";

	function __construct() {
		parent::__construct();
	}

	function get_tattendance($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_tattendance($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_tattendance($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_tattendance($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function update_tattendance_all($array, $id) {
		$this->db->update($this->_table_name, $array, $id);
		return $id;
	}

	public function delete_tattendance($id){
		parent::delete($id);
	}


	

}

/* End of file attendance_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/attendance_m.php */
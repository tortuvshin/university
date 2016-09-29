<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hostel_m extends MY_Model {

	protected $_table_name = 'hostel';
	protected $_primary_key = 'hostelID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "hostelID asc";

	function __construct() {
		parent::__construct();
	}

	function get_hostel($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_hostel($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_hostel($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_hostel($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_hostel($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_hostel($id){
		parent::delete($id);
	}
}

/* End of file hostel_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/hostel_m.php */
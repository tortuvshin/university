<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_m extends MY_Model {

	protected $_table_name = 'holiday';
	protected $_primary_key = 'holidayID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "fdate asc";

	function __construct() {
		parent::__construct();
	}

	function get_holiday($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_holiday($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_holiday($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_holiday($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_holiday($id){
		parent::delete($id);
	}
}

/* End of file holiday_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/holiday_m.php */

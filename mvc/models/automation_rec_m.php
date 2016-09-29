<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Automation_rec_m extends MY_Model {

	protected $_table_name = 'automation_rec';
	protected $_primary_key = 'automation_recID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "automation_recID desc";

	function __construct() {
		parent::__construct();
	}

	function get_automation_rec($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_automation_rec($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_automation_rec($array) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_automation_rec($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_automation_rec($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_automation_rec($id){
		parent::delete($id);
	}


	

}

/* End of file alert_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/alert_m.php */
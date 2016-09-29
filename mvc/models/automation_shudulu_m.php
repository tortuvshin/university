<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Automation_shudulu_m extends MY_Model {

	protected $_table_name = 'automation_shudulu';
	protected $_primary_key = 'automation_shuduluID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "automation_shuduluID desc";

	function __construct() {
		parent::__construct();
	}

	function get_automation_shudulu($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_automation_shudulu($array) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_order_by_automation_shudulu($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_automation_shudulu($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_automation_shudulu($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function delete_automation_shudulu($id){
		parent::delete($id);
	}

	/* infinite code starts here */
}

/* End of file student_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/student_m.php */
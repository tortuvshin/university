<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice_m extends MY_Model {

	protected $_table_name = 'notice';
	protected $_primary_key = 'noticeID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "noticeID desc";

	function __construct() {
		parent::__construct();
	}

	function get_notice($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_notice($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_notice($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_notice($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_notice($id){
		parent::delete($id);
	}
}

/* End of file notice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/notice_m.php */
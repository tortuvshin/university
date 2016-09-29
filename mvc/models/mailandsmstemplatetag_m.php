<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailandsmstemplatetag_m extends MY_Model {

	protected $_table_name = 'mailandsmstemplatetag';
	protected $_primary_key = 'mailandsmstemplatetagID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "mailandsmstemplatetagID asc";

	function __construct() {
		parent::__construct();
	}

	function get_mailandsmstemplatetag($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_mailandsmstemplatetag($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_mailandsmstemplatetag($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_mailandsmstemplatetag($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_mailandsmstemplatetag($id){
		parent::delete($id);
	}
}

/* End of file notice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/notice_m.php */
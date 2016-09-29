<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailandsmstemplate_m extends MY_Model {

	protected $_table_name = 'mailandsmstemplate';
	protected $_primary_key = 'mailandsmstemplateID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "mailandsmstemplateID asc";

	function __construct() {
		parent::__construct();
	}

	function get_mailandsmstemplate($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_mailandsmstemplate($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_mailandsmstemplate($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_mailandsmstemplate($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_mailandsmstemplate($id){
		parent::delete($id);
	}
}

/* End of file notice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/notice_m.php */
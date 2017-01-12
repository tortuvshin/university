<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credit_m extends MY_Model {
	protected $_table_name = 'credit';
	protected $_primary_key = 'creditID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "credit asc";
	function __construct() {
		parent::__construct();
	}
	function get_credit($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}
	function get_order_by_credit($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}
	function insert_credit($array) {
		$error = parent::insert($array);
		return TRUE;
	}
	function update_credit($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}
	public function delete_credit($id){
		parent::delete($id);
	}
}
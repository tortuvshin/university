<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transport_m extends MY_Model {

	protected $_table_name = 'transport';
	protected $_primary_key = 'transportID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "transportID asc";

	function __construct() {
		parent::__construct();
	}

	function get_transport($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_transport($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_transport($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_transport($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_transport($id){
		parent::delete($id);
	}
}

/* End of file transport_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/transport_m.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class visitorinfo_m extends MY_Model {

	protected $_table_name = 'visitorinfo';
	protected $_primary_key = 'visitorID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "visitorID desc";

	function __construct() {
		parent::__construct();
	}

	function get_visitorinfo($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_visitorinfo($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_visitorinfo($array) {
		$id = parent::insert($array);
		return $id;
	}

	function update_visitorinfo($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_visitorinfo($id){
		parent::delete($id);
	}
}

/* End of file visitorinfo_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/visitorinfo_m.php */
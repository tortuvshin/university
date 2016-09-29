<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_category_m extends MY_Model {

	protected $_table_name = 'media_category';
	protected $_primary_key = 'mcategoryID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "mcategoryID desc";

	function __construct() {
		parent::__construct();
	}

	function get_media_category($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_mcategory($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_mcategory($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_mcategory($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_mcategory($id){
		parent::delete($id);
	}
}

/* End of file media_category_category_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/media_category_category_m.php */
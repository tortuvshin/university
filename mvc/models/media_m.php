<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_m extends MY_Model {

	protected $_table_name = 'media';
	protected $_primary_key = 'mediaID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "mediaID desc";

	function __construct() {
		parent::__construct();
	}

	function get_media($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_media($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_media($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_media($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_media($id){
		parent::delete($id);
	}
	
}

/* End of file media_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/media_m.php */
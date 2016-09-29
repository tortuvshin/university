<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_share_m extends MY_Model {

	protected $_table_name = 'media_share';
	protected $_primary_key = 'shareID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "shareID asc";

	function __construct() {
		parent::__construct();
	}

	function get_media_share($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_media_share($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_media_share($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_media_share($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_media_share($id){
		parent::delete($id);
	}
	public function delete_share_folder($id) {
		if (!$id) {
			return FALSE;
		}
		$this->db->where(array("file_or_folder" => 1, "item_id" => $id));
		$this->db->delete($this->_table_name); 
	}
	public function delete_share_file($id) {
		if (!$id) {
			return FALSE;
		}
		$this->db->where(array("file_or_folder" => 0, "item_id" => $id));
		$this->db->delete($this->_table_name); 
	}
	public function get_media_share_distinct()
	{
		$this->db->distinct();
		$query = $this->db->get('media_share');
		return $query->result();
	}
}

/* End of file media_share_share_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/media_share_share_m.php */
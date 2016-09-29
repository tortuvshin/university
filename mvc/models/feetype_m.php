<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feetype_m extends MY_Model {

	protected $_table_name = 'feetype';
	protected $_primary_key = 'feetypeID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "feetypeID asc";

	function __construct() {
		parent::__construct();
	}

	function get_feetype($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_feetype($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_feetype($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_feetype($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_feetype($id){
		parent::delete($id);
	}

	function allfeetype($feetype) {
		$query = $this->db->query("SELECT * FROM feetype WHERE feetype LIKE '$feetype%'");
		return $query->result();
	}
}

/* End of file feetype_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/feetype_m.php */
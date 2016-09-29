<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue_m extends MY_Model {

	protected $_table_name = 'issue';
	protected $_primary_key = 'issueID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "issueID asc";

	function __construct() {
		parent::__construct();
	}

	function get_issue($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_issue($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}


	function get_order_by_issue($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_issue($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_issue($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_issue($id){
		parent::delete($id);
	}

	function fine($data) {
		$alldata = array();
		$r = array();
		$like = "";
		$temp_data = $this->db->query("SELECT * FROM issue");

		
		if($temp_data) {
			$db_data = $temp_data->result();

			foreach ($db_data as $value) {
				$alldata[] = $value->return_date;
				$likes = explode('-', $value->return_date);
			}
			return $alldata;
		}
	}
}

/* End of file issue_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/issue_m.php */
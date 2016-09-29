<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reply_msg_m extends MY_Model {

	protected $_table_name = 'reply_msg';
	protected $_primary_key = 'replyID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "replyID asc";

	function __construct() {
		parent::__construct();
	}

	function get_reply_msg($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_reply_msg($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}


	function insert_reply_msg($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_reply_msg($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_reply_msg($id){
		parent::delete($id);
	}
}

/* End of file reply_msg_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/reply_msg_m.php */
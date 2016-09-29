<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class message_m extends MY_Model {

	protected $_table_name = 'message';
	protected $_primary_key = 'messageID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "messageID desc";

	function __construct() {
		parent::__construct();
	}

	function get_message($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_recivers($single=FALSE, $array=NULL) {
		if ($array) {
			$query = $this->db->get_where($single, $array);
		} else {
			$query = $this->db->get($single);
		}
		return $query->result();
	}

	function get_order_by_message($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}
	function get_trash_message($email, $userID, $usertype) {
		$where = "(email = '$email' AND to_status = 1) OR (usertype = '$usertype' AND userID = $userID AND from_status = 1)";
		$this->db->where($where);
		$query = $this->db->get('message');
		return $query->result();
	}


	function insert_message($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_message($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_message($id){
		parent::delete($id);
	}

	public function counter($array=NULL)
	{
		$query = $this->db->get_where($this->_table_name, $array);
		return count($query->result());
	}
}

/* End of file message_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/message_m.php */

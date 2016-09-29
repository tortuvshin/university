<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends MY_Model {

	protected $_table_name = 'notice';
	protected $_primary_key = 'noticeID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "date desc";

	function __construct() {
		parent::__construct();
	}

	function get_notice($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_user() {
		$table = strtolower($this->session->userdata("usertype"));
		if($table == "admin") {
			$table = "setting";
		}

		if($table == "accountant") {
			$table = "user";
		}
		if($table == "librarian") {
			$table = "user";
		}
		
		$username = $this->session->userdata("username");

		$user = $this->db->get_where($table, array("username" => $username));

		return $user->row();
	}
}
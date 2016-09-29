<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_m extends MY_Model {

	protected $_table_name = 'expense';
	protected $_primary_key = 'expenseID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "expenseID desc";

	function __construct() {
		parent::__construct();
	}

	function get_expense($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_expense($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_expense($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_expense($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_expense($id){
		parent::delete($id);
	}

	public function user_expense($table, $username, $email){
		$query = $this->db->get_where($table, array("username" => $username, "email" => $email));
		return $query->row();
	}
}

/* End of file expense_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/expense_m.php */
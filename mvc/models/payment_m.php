<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_m extends MY_Model {

	protected $_table_name = 'payment';
	protected $_primary_key = 'paymentID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "paymentID desc";

	function __construct() {
		parent::__construct();
	}

	function get_payment($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_payment($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_payment($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_payment($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_payment($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_payment($id){
		parent::delete($id);
	}
}

/* End of file payment_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/payment_m.php */
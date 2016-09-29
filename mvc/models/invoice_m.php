<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_m extends MY_Model {

	protected $_table_name = 'invoice';
	protected $_primary_key = 'invoiceID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "invoiceID desc";
	

	function __construct() {
		parent::__construct();
	}

	function get_join_where_classes($studentID, $classesID) {
		$this->db->select('*');
		$this->db->from('invoice');
		$this->db->join('classes', 'classes.classesID = invoice.classesID', 'LEFT');
		$this->db->where("invoice.classesID", $classesID);
		$this->db->where("invoice.studentID", $studentID);
		$query = $this->db->get();
		return $query->result();
	}

	function get_invoice($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_invoice($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_invoice($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_invoice($array) {
		$error = parent::insert($array);
		return $error;
	}

	function update_invoice($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_invoice($id){
		parent::delete($id);
	}
}

/* End of file invoice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/invoice_m.php */
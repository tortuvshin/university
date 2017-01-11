<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_m extends MY_Model {

	protected $_table_name = 'subject';
	protected $_primary_key = 'subjectID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "classesID asc";

	function __construct() {
		parent::__construct();
	}

	function get_join_subject($id) {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->join('classes', 'classes.ClassesID = subject.classesID', 'LEFT');
		$this->db->where('subject.ClassesID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_where_subject($id) {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->join('classes', 'classes.ClassesID = subject.classesID', 'LEFT');
		$this->db->where("subject.classesID", $id);
		$query = $this->db->get();
		return $query->result();
	}


	function get_classes() {
		$this->db->select('*')->from('classes')->order_by('classes_numeric asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_subject($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_subject_call($id) {
		$query = $this->db->get_where('subject', array('classesID' => $id));
		return $query->result();
	}

	function get_order_by_subject($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_subject($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_subject($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_subject($id){
		parent::delete($id);
	}

}

/* End of file subject_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/subject_m.php */
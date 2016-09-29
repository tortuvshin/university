<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section_m extends MY_Model {

	protected $_table_name = 'section';
	protected $_primary_key = 'sectionID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "sectionID asc";

	function __construct() {
		parent::__construct();
	}


	function get_allsection($id) {
		$query = $this->db->get_where('section', array('classesID' => $id));
		return $query->result();
	}

	function get_join_section($id) {
		$this->db->select('*');
		$this->db->from('section');
		$this->db->join('teacher', 'section.teacherID = teacher.teacherID', 'LEFT');
		$this->db->where('section.classesID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_section_with_classes() {
		$this->db->select('*');
		$this->db->from('section');
		$this->db->join('classes', 'section.sectionID = classes.classesID', 'LEFT');
		// $this->db->where('section.ClassesID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_single_section($array) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_section($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_section($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_section($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_section($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_section($id){
		parent::delete($id);
	}
}

/* End of file section_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/section_m.php */
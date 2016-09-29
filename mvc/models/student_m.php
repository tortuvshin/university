<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_m extends MY_Model {

	protected $_table_name = 'student';
	protected $_primary_key = 'studentID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "roll asc";

	function __construct() {
		parent::__construct();
	}

	function get_username($table, $data=NULL) {
		$query = $this->db->get_where($table, $data);
		return $query->result();
	}

	function get_class($id=NULL) {
		$query = $this->db->get_where('classes', array('classesID' => $id));
		return $query->row();
	}

	function get_classes() {
		$this->db->select('*')->from('classes')->order_by('classes_numeric asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_parent($id = NULL) {
		$query = $this->db->get_where('parent', array('studentID' => $id));
		return $query->row();
	}

	function get_parent_info($username = NULL) {
		$query = $this->db->get_where('parent', array('username' => $username));
		return $query->row();
	}

	function get_order_by_roll($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_student($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_student($array) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_order_by_student($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_order_by_student_year($classesID) {
		$query = $this->db->query("SELECT * FROM student WHERE year = (SELECT MIN(year) FROM student) && classesID = $classesID order by roll asc");
		return $query->result();
	}

	function get_order_by_student_single_year($classesID) {
		$query = $this->db->query("SELECT year FROM student WHERE year = (SELECT MIN(year) FROM student) && classesID = $classesID order by roll asc");
		return $query->row();
	}

	function get_order_by_student_single_max_year($classesID) {
		$query = $this->db->query("SELECT year FROM student WHERE year = (SELECT MAX(year) FROM student) && classesID = $classesID order by roll asc");
		return $query->row();
	}

	function get_order_by_studen_with_section_and_classes($classesID) {
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('classes', 'student.classesID = classes.classesID', 'LEFT');
		$this->db->join('section', 'student.sectionID = section.sectionID', 'LEFT');
		$this->db->where('student.classesID', $classesID);
		$query = $this->db->get();
		return $query->result();
	}

	function get_order_by_studen_with_section($classesID, $sectionID) {
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('classes', 'student.classesID = classes.classesID', 'LEFT');
		$this->db->join('section', 'student.sectionID = section.sectionID', 'LEFT');
		$this->db->where('student.ClassesID', $classesID);
		$this->db->where('student.sectionID', $sectionID);
		$query = $this->db->get();
		return $query->result();
	}


	function insert_student($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function insert_parent($array) {
		$this->db->insert('parent', $array);
		return TRUE;
	}

	function update_student($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function update_student_classes($data, $array = NULL) {
		$this->db->set($data);
		$this->db->where($array);
		$this->db->update($this->_table_name);
	}

	function delete_student($id){
		parent::delete($id);
	}

	function delete_parent($id){
		$this->db->delete('parent', array('studentID' => $id));
	}

	function hash($string) {
		return parent::hash($string);
	}

	/* infinite code starts here */
}

/* End of file student_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/student_m.php */
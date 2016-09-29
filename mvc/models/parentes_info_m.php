<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parentes_info_m extends MY_Model {

	public function get_parentes_info(){
		$username = $this->session->userdata("username");
		$query = $this->db->get_where("parent", array('username' => $username));
		return $query->row();
	}

	public function get_student_info($id){
		$query = $this->db->get_where("student", array('studentID' => $id));
		return $query->row();
	}

	function get_join_where_subject($id) {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->join('class', 'classes.classesID = subject.classesID', 'LEFT');
		$this->db->where("subject.classesID", $id);
		$query = $this->db->get();
		return $query->result();
	}
}
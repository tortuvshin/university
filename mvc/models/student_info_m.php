<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_info_m extends MY_Model {

	public function get_student_info(){
		$username = $this->session->userdata("username");
		$query = $this->db->get_where("student", array('username' => $username));
		return $query->row();
	}

	function get_join_where_subject($id) {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->join('classes', 'classes.ClassesID = subject.classesID', 'LEFT');
		$this->db->where("subject.classesID", $id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_all_examschedule($id) {
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('examschedule');
		$this->db->where(array('examschedule.classesID' => $id, 'examschedule.edate >=' => $date));
		$this->db->join('exam', 'exam.examID = examschedule.examID', 'LEFT');
		$this->db->join('classes', 'classes.classesID = examschedule.classesID', 'LEFT');
		$this->db->join('subject', 'subject.subjectID = examschedule.subjectID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_all_examschedule_wsection($id, $sectionID) {
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('examschedule');
		$this->db->where(array('examschedule.classesID' => $id, 'examschedule.sectionID' => $sectionID, 'examschedule.edate >=' => $date));
		$this->db->join('exam', 'exam.examID = examschedule.examID', 'LEFT');
		$this->db->join('classes', 'classes.classesID = examschedule.classesID', 'LEFT');
		$this->db->join('section', 'section.sectionID = examschedule.sectionID', 'LEFT');
		$this->db->join('subject', 'subject.subjectID = examschedule.subjectID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_all_routine($id) {
		$this->db->select('*');
		$this->db->from('routine');
		$this->db->where('routine.classesID', $id);
		$this->db->join('classes', 'classes.classesID = routine.classesID', 'LEFT');
		$this->db->join('subject', 'subject.subjectID = routine.subjectID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_join_all_library($id) {
		$this->db->select('*');
		$this->db->from('classes');
		$this->db->where('classes.classesID', $id);
		$this->db->join('library', 'library.classesID = classes.classesID');
		$query = $this->db->get();
		return $query->result();
	}
}
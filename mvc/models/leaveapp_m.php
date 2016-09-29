<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaveapp_m extends MY_Model {

	protected $_table_name = 'leaveapp';
	protected $_primary_key = 'leaveID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "leaveID desc";

	function __construct() {
		parent::__construct();
	}

	function get_leave($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_leave($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function join_my_leave($username,$jointable,$id=NULL) {
		$this->db->select('*,'.$jointable.'.name as '.substr($jointable,0,1).'_name');
		$this->db->from('leaveapp');
		$this->db->join($jointable, $jointable.'.username = leaveapp.tousername', 'LEFT');
		$this->db->where('leaveapp.fromusername', $username);
		if($id!=NULL) {
			$this->db->where('leaveapp.leaveID', $id);
		}
		$this->db->order_by("leaveapp.leaveID", "desc");

		$query = $this->db->get();
		if($id!=NULL) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	function join_submit_leave($username,$id=NULL) {
		$this->db->select('leaveapp.*,
		student.studentID as s_id,
		student.classesID as s_class,
		student.name as s_name,
		parent.name as p_name,
		parent.parentID as p_id,
		user.name as u_name,
		user.userID as u_id,
		user.usertype as u_type,
		teacher.teacherID as t_id,
		teacher.name as t_name');
		$this->db->from('leaveapp');
		$this->db->join('teacher', 'teacher.username = leaveapp.fromusername', 'LEFT');
		$this->db->join('student', 'student.username = leaveapp.fromusername', 'LEFT');
		$this->db->join('parent', 'parent.username = leaveapp.fromusername', 'LEFT');
		$this->db->join('user', 'user.username = leaveapp.fromusername', 'LEFT');
		$this->db->where('leaveapp.tousername', $username);
		if($id!=NULL) {
			$this->db->where('leaveapp.leaveID', $id);
		}
		$this->db->order_by("leaveapp.leaveID", "desc");

		$query = $this->db->get();
		if($id!=NULL) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	function all_accept_or_denied($username,$value)
	{
		$sql = "UPDATE `leaveapp` SET status=".$value." where tousername='".$username."'";
		$query = $this->db->query($sql);
		return $this->db->affected_rows();
	}

	function insert_leave($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_leave($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_leave($id){
		parent::delete($id);
	}
}

/* End of file leave_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/leave_m.php */

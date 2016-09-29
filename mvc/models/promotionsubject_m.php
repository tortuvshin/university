<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotionsubject_m extends MY_Model {

	protected $_table_name = 'promotionsubject';
	protected $_primary_key = 'promotionSubjectID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "promotionSubjectID asc";

	function __construct() {
		parent::__construct();
	}

	function get_promotionsubject($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_promotionsubject($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_order_by_promotionsubject_with_subject($classes) {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->join('promotionsubject', 'subject.subjectID = promotionsubject.subjectID', 'LEFT');
		$this->db->where('subject.classesID', $classes);
		$query = $this->db->get();
		return $query->result();
	}

	function insert_promotionsubject($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_promotionsubject($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_promotionsubject($id){
		parent::delete($id);
	}
}

/* End of file promotionsubject_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/promotionsubject_m.php */
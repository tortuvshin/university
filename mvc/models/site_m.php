<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_m extends MY_Model {

	protected $_table_name = 'setting';
	protected $_primary_key = 'settingID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "settingID asc";

	function __construct() {
		parent::__construct();
	}

	function get_site($array=NULL) {
		$query = parent::get($array);
		return $query;
	}
}

/* End of file site_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/site_m.php */
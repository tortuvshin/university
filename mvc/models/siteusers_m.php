<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteusers_m extends MY_Model {

	protected $_table_name = 'systemadmin';
	protected $_primary_key = 'systemadminID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "systemadminID asc";

	function __construct() {
		parent::__construct();
	}

	function get_site($array=NULL) {
		$query = parent::get($array);
		return $query;
	}
}

/* End of file siteusers_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/siteusers_m.php */

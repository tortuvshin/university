<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/

	function __construct () {

		parent::__construct();
		$this->load->model("signin_m");
		$this->load->model("message_m");
		$this->load->model("site_m");
		$this->data["siteinfos"] = $this->site_m->get_site(1, "TRUE");
		$this->load->library("session");
		$this->load->helper('language');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');

		/* Alert System Start.........*/
		$this->load->model("notice_m");
		$this->load->model("alert_m");
		$this->data['all'] = array();
		$this->data['alert'] = array();
		$notices = $this->notice_m->get_notice();
		$i = 0;
		if(count($notices) >0) {
			foreach ($notices as $notice) {
				$this->data['all'][] = $this->alert_m->get_order_by_alert(array("noticeID" => $notice->noticeID, "username" => $this->session->userdata("username")));
				if(count($this->data['all'][$i]) == 0) {
					$this->data['alert'][] = $notice;
				}
				$i++;
			}
		}
		$this->data['alert'];
		/* Alert System End.........*/
		/*message counter*/
		$email = $this->session->userdata('email');
		$usertype = $this->session->userdata('usertype');
		// $userID = $this->userID();
		$this->data['unread'] = $this->message_m->get_order_by_message(array('email' => $email, 'receiverType' => $usertype, 'to_status' => 0, 'read_status' => 0));
		/*message counter end*/

		$language = $this->session->userdata('lang');
		$this->lang->load('topbar_menu', $language);

		$exception_uris = array(
			"signin/index",
			"signin/signout"
		);

		if(in_array(uri_string(), $exception_uris) == FALSE) {
			if($this->signin_m->loggedin() == FALSE) {
				redirect(base_url("signin/index"));
			}
		}
	}
}

/* End of file Admin_Controller.php */
/* Location: .//D/xampp/htdocs/school/mvc/libraries/Admin_Controller.php */

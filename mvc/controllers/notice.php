<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends Admin_Controller {
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
	function __construct() {
		parent::__construct();
		$this->load->model("notice_m");
		$this->load->model("alert_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('notice', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$year = date("Y");
			$this->data['notices'] = $this->notice_m->get_order_by_notice(array('year' => $year));
			$this->data["subview"] = "notice/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "notice/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'title', 
					'label' => $this->lang->line("notice_title"), 
					'rules' => 'trim|required|xss_clean|max_length[128]'
				), 
				array(
					'field' => 'date', 
					'label' => $this->lang->line("notice_date"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
				),
				array(
					'field' => 'notice', 
					'label' => $this->lang->line("notice_notice"),
					'rules' => 'trim|required|xss_clean'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		$year = date("Y");
		if($usertype == "Admin") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "notice/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"title" => $this->input->post("title"),
						"notice" => $this->input->post("notice"),
						"year" => $year,
						"date" => date("Y-m-d", strtotime($this->input->post("date")))	
					);
					$this->notice_m->insert_notice($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("notice/index"));
				}
			} else {
				$this->data["subview"] = "notice/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['notice'] = $this->notice_m->get_notice($id);
				if($this->data['notice']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "notice/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"title" => $this->input->post("title"),
								"notice" => $this->input->post("notice"),
								"date" => date("Y-m-d", strtotime($this->input->post("date")))
							);

							$this->notice_m->update_notice($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("notice/index"));
						}
					} else {
						$this->data["subview"] = "notice/edit";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function view() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_notice($id);
			if($this->data['notice']) {
				$alert = $this->alert_m->get_alert_by_notic($id);
				if(!count($alert)) {
					$array = array(
						"noticeID" => $id,
						"username" => $this->session->userdata("username"),
						"usertype" => $this->session->userdata("usertype")
					);
					$this->alert_m->insert_alert($array);
					$this->data["subview"] = "notice/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "notice/view";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->notice_m->delete_notice($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("notice/index"));
			} else {
				redirect(base_url("notice/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function date_valid($date) {
		if(strlen($date) <10) {
			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);   
	        $dd = $arr[0];            
	        $mm = $arr[1];              
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
	      		return TRUE;
	      	} else {
	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     		return FALSE;
	      	}
	    } 
	} 

	public function print_preview() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_notice($id);
			if($this->data['notice']) {

				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('panel_title');
				$html = $this->load->view('notice/print_preview', $this->data, true);
				$this->html2pdf->html($html);
				$this->html2pdf->create();
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}
	public function send_mail() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			if ((int)$id) {
				$this->data['notice'] = $this->notice_m->get_notice($id);
				if($this->data['notice']) {

					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('notice/print_preview', $this->data, true);
					$this->html2pdf->html($html);
					$this->html2pdf->create('save');
					
					if($path = $this->html2pdf->create('save')) {
					$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from($this->data["siteinfos"]->email, $this->data['siteinfos']->sname);
					$this->email->to($this->input->post('to'));
					$this->email->subject($this->input->post('subject'));
					$this->email->message($this->input->post('message'));	
					$this->email->attach($path);
						if($this->email->send()) {
							$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						} else {
							$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						}
					}
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
}

/* End of file notice.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/notice.php */
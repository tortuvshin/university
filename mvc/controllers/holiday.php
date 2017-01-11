<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday extends Admin_Controller {
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
		$this->load->model("holiday_m");
		$this->load->model("alert_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('holiday', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$this->data['holidays'] = $this->holiday_m->get_order_by_holiday();
			$this->data["subview"] = "holiday/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "holiday/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'title',
					'label' => $this->lang->line("holiday_title"),
					'rules' => 'trim|required|xss_clean|max_length[75]|min_length[3]'
				),
				array(
					'field' => 'fdate',
					'label' => $this->lang->line("holiday_fdate"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
				),
				array(
					'field' => 'tdate',
					'label' => $this->lang->line("holiday_tdate"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_todate_valid'
				),
				array(
					'field' => 'photo',
					'label' => $this->lang->line("holiday_photo"),
					'rules' => 'trim|max_length[200]|xss_clean'
				),
				array(
					'field' => 'holiday_details',
					'label' => $this->lang->line("holiday_details"),
					'rules' => 'trim|required|xss_clean'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors();
					$this->data["subview"] = "holiday/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array["title"] = $this->input->post("title");
					$array["fdate"] = date("Y-m-d", strtotime($this->input->post("fdate")));
					$array["tdate"] = date("Y-m-d", strtotime($this->input->post("tdate")));
					$array["details"] = $this->input->post("holiday_details");

					$new_file = "holiday.png";
					if($_FILES["image"]['name'] !="") {
						$file_name = $_FILES["image"]['name'];
						$file_name_rename = rand(1, 100000000000);
						$explode = explode('.', $file_name);
						if(count($explode) >= 2) {

							$new_file = $file_name_rename.'.'.$explode[1];
							$config['upload_path'] = "./uploads/images";
							$config['allowed_types'] = "gif|jpg|png";
							$config['file_name'] = $new_file;
							$config['max_size'] = '1024';
							$config['max_width'] = '3000';
							$config['max_height'] = '3000';
							$array["photo"] = $new_file;
							$this->load->library('upload', $config);
							if(!$this->upload->do_upload("image")) {
								$this->data["image"] = $this->upload->display_errors();
								$this->data["subview"] = "holiday/add";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->holiday_m->insert_holiday($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("holiday/index"));
							}
						} else {
							$this->data["image"] = "Invalid file";
							$this->data["subview"] = "holiday/add";
							$this->load->view('_layout_main', $this->data);
						}
					} else {
						$array["photo"] = $new_file;
						$this->holiday_m->insert_holiday($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("holiday/index"));
					}
				}
			} else {
				$this->data["subview"] = "holiday/add";
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
				$this->data['holiday'] = $this->holiday_m->get_holiday($id);
				if($this->data['holiday']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "holiday/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$array = array(
								"title" => $this->input->post("title"),
								"details" => $this->input->post("holiday_details"),
								"fdate" => date("Y-m-d", strtotime($this->input->post("fdate"))),
								"tdate" => date("Y-m-d", strtotime($this->input->post("tdate")))
							);
							if($_FILES["image"]['name'] !="") {
								$file_name = $_FILES["image"]['name'];
								$file_name_rename = rand(1, 100000000000);
								$explode = explode('.', $file_name);
								if(count($explode) >= 2) {

									$new_file = $file_name_rename.'.'.$explode[1];
									$config['upload_path'] = "./uploads/images";
									$config['allowed_types'] = "gif|jpg|png";
									$config['file_name'] = $new_file;
									$config['max_size'] = '1024';
									$config['max_width'] = '3000';
									$config['max_height'] = '3000';
									$array["photo"] = $new_file;
									$this->load->library('upload', $config);
									if(!$this->upload->do_upload("image")) {
										$this->data["image"] = $this->upload->display_errors();
										$this->data["subview"] = "holiday/add";
										$this->load->view('_layout_main', $this->data);
									} else {
										$data = array("upload_data" => $this->upload->data());
										$this->holiday_m->update_holiday($array,$id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("holiday/index"));
									}
								} else {
									$this->data["image"] = "Invalid file";
									$this->data["subview"] = "holiday/add";
									$this->load->view('_layout_main', $this->data);
								}
							} else {
								$this->holiday_m->update_holiday($array,$id);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("holiday/index"));
							}
						}
					} else {
						$this->data["subview"] = "holiday/edit";
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
			$this->data['holiday'] = $this->holiday_m->get_holiday($id);
			if($this->data['holiday']) {
				$this->data["subview"] = "holiday/view";
				$this->load->view('_layout_main', $this->data);
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
				$this->holiday_m->delete_holiday($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("holiday/index"));
			} else {
				redirect(base_url("holiday/index"));
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

	function todate_valid($date) {
		$fdate = $this->input->post('fdate');
		if(strlen($date) <10) {
			$this->form_validation->set_message("todate_valid", "%s is not valid dd-mm-yyyy");
				return FALSE;
		} else {
				$arr = explode("-", $date);
					$dd = $arr[0];
					$mm = $arr[1];
					$yyyy = $arr[2];
					if(checkdate($mm, $dd, $yyyy)) {
						if($fdate>$date) {
							$this->form_validation->set_message("todate_valid", "%s must be greater than From Date");
							return FALSE;
						} else {
							return TRUE;
						}
					} else {
						$this->form_validation->set_message("todate_valid", "%s is not valid dd-mm-yyyy");
						return FALSE;
					}
			}
	}

	public function print_preview() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->holiday_m->get_holiday($id);
			if($this->data['notice']) {

				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('panel_title');
				$html = $this->load->view('holiday/print_preview', $this->data, true);
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
				$this->data['notice'] = $this->holiday_m->get_holiday($id);
				if($this->data['notice']) {

					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('holiday/print_preview', $this->data, true);
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

/* End of file holiday.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/holiday.php */

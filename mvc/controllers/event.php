<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Admin_Controller {
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
		$this->load->model("event_m");
		$this->load->model("eventcounter_m");
		$this->load->model("student_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('event', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$this->data['events'] = $this->event_m->get_order_by_event();
			$this->data["subview"] = "event/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "event/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'title',
					'label' => $this->lang->line("event_title"),
					'rules' => 'trim|required|xss_clean|max_length[75]|min_length[3]'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("event_fdate"),
					'rules' => 'trim|required|xss_clean|max_length[41]'
				),
				array(
					'field' => 'photo',
					'label' => $this->lang->line("event_photo"),
					'rules' => 'trim|max_length[200]|xss_clean'
				),
				array(
					'field' => 'event_details',
					'label' => $this->lang->line("event_details"),
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
					$this->data["subview"] = "event/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array["title"] = $this->input->post("title");
					$explode = explode('-', $this->input->post("date"));
					$array["fdate"] = date("Y-m-d", strtotime($explode[0]));
					$array['ftime'] = date("H:i:s", strtotime($explode[0]));
					$array["tdate"] = date("Y-m-d", strtotime($explode[1]));
					$array["ttime"] = date("H:i:s", strtotime($explode[1]));
					$array["details"] = $this->input->post("event_details");

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
								$this->data["subview"] = "event/add";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->event_m->insert_event($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("event/index"));
							}
						} else {
							$this->data["image"] = "Invalid file";
							$this->data["subview"] = "event/add";
							$this->load->view('_layout_main', $this->data);
						}
					} else {
						$array["photo"] = $new_file;
						$this->event_m->insert_event($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("event/index"));
					}
				}
			} else {
				$this->data["subview"] = "event/add";
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
				$this->data['event'] = $this->event_m->get_event($id);
				if($this->data['event']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "event/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$explode = explode('-', $this->input->post("date"));
							$fdate = date("Y-m-d", strtotime($explode[0]));
							$ftime = date("H:i:s", strtotime($explode[0]));
							$tdate = date("Y-m-d", strtotime($explode[1]));
							$ttime = date("H:i:s", strtotime($explode[1]));
							$array = array(
								"title" => $this->input->post("title"),
								"details" => $this->input->post("event_details"),
								"fdate" => $fdate,
								"ftime" => $ftime,
								"tdate" => $tdate,
								"ttime" => $ttime
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
										$this->data["subview"] = "event/add";
										$this->load->view('_layout_main', $this->data);
									} else {
										$data = array("upload_data" => $this->upload->data());
										$this->event_m->update_event($array,$id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("event/index"));
									}
								} else {
									$this->data["image"] = "Invalid file";
									$this->data["subview"] = "event/add";
									$this->load->view('_layout_main', $this->data);
								}
							} else {
								$this->event_m->update_event($array,$id);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("event/index"));
							}
						}
					} else {
						$this->data["subview"] = "event/edit";
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
			$this->data['event'] = $this->event_m->get_event($id);
			$this->data['id'] = $id;
			$this->data['goings'] = $this->eventcounter_m->get_order_by_eventcounter(array('status' => 1));
			$this->data['ignores'] = $this->eventcounter_m->get_order_by_eventcounter(array('status' => 0));

			if($this->data['event']) {
				$this->data["subview"] = "event/view";
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
				$this->event_m->delete_event($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("event/index"));
			} else {
				redirect(base_url("event/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function print_preview() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['event'] = $this->event_m->get_event($id);
			if($this->data['event']) {

				$this->load->library('html2pdf');
		    $this->html2pdf->folder('./assets/pdfs/');
		    $this->html2pdf->filename('Report.pdf');
		    $this->html2pdf->paper('a4', 'portrait');
		    $this->data['panel_title'] = $this->lang->line('panel_title');
				$html = $this->load->view('event/print_preview', $this->data, true);
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
				$this->data['event'] = $this->event_m->get_event($id);
				// dump($this->data['event']);
				if($this->data['event']) {
					$this->load->library('html2pdf');
					$this->html2pdf->folder('./assets/pdfs/');
					$this->html2pdf->filename('Report.pdf');
					$this->html2pdf->paper('a4', 'portrait');
					$this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('event/print_preview', $this->data, true);
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

	public function eventcounter() {
		$username = $this->session->userdata("username");
		$usertype = $this->session->userdata("usertype");
		$photo = $this->session->userdata("photo");
		$name = $this->session->userdata("name");
		$eventID = $this->input->post('id');
		$status = $this->input->post('status');

		if($eventID) {
			$have = $this->eventcounter_m->get_order_by_eventcounter(array("eventID" => $eventID, "username" => $username, "type" => $usertype),TRUE);
			if(count($have)) {
				$array = array('status' => $status);
				$this->eventcounter_m->update($array,$have[0]->eventcounterID);
			} else {
				$array = array('eventID' => $eventID,
									'username' => $username,
									'type' => $usertype,
									'photo' => $photo,
									'name' => $name,
									'status' => $status
									);
				$this->eventcounter_m->insert($array);
			}
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
		}

	}
}

/* End of file event.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/event.php */

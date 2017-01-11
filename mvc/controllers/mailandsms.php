<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailandsms extends Admin_Controller {
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
		$this->load->model("smssettings_m");
		$this->load->model('student_m');
		$this->load->model('classes_m');
		$this->load->model('section_m');
		$this->load->model("mark_m");
		$this->load->model("grade_m");
		$this->load->model("exam_m");
		$this->load->model('mailandsms_m');
		$this->load->model('mailandsmstemplate_m');
		$this->load->library("email");
		$this->load->library("clickatell");
		$this->load->library("twilio");
		$this->load->library("bulk");
		$language = $this->session->userdata('lang');
		$this->lang->load('mailandsms', $language);

	}

	protected function rules_mail() {
		$rules = array(
			array(
				'field' => 'email_user', 
				'label' => $this->lang->line("mailandsms_users"), 
				'rules' => 'trim|required|xss_clean|max_length[15]|callback_check_email_users'
			),
			array(
				'field' => 'email_template', 
				'label' => $this->lang->line("mailandsms_template"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'email_subject', 
				'label' => $this->lang->line("mailandsms_subject"), 
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'email_message', 
				'label' => $this->lang->line("mailandsms_message"), 
				'rules' => 'trim|required|xss_clean|max_length[20000]'
			),
		);
		return $rules;
	}

	protected function rules_sms() {
		$rules = array(
			array(
				'field' => 'sms_user', 
				'label' => $this->lang->line("mailandsms_users"), 
				'rules' => 'trim|required|xss_clean|max_length[15]|callback_check_sms_users'
			), 
			array(
				'field' => 'sms_template', 
				'label' => $this->lang->line("mailandsms_template"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'sms_getway', 
				'label' => $this->lang->line("mailandsms_getway"), 
				'rules' => 'trim|required|xss_clean|max_length[15]|callback_check_getway'
			),
			array(
				'field' => 'sms_message', 
				'label' => $this->lang->line("mailandsms_message"), 
				'rules' => 'trim|required|xss_clean|max_length[20000]'
			),
		);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['mailandsmss'] = $this->mailandsms_m->get_mailandsms();
			$this->data["subview"] = "mailandsms/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function add() {

		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			/* Start For Email */
			$email_user = $this->input->post("email_user");
			if($email_user != 'select') {
				$this->data['email_templates'] = $this->mailandsmstemplate_m->get_order_by_mailandsmstemplate(array('user' => $email_user, 'type' => 'email'));
				$this->data['email_user'] = $this->input->post("email_user");
			} else {
				$this->data['email_templates'] = 'empty';
				$this->data['email_user'] = 'select';
			}
			$this->data['email_templateID'] = 'select';
			/* End For Email */


			/* Start For SMS */
			$sms_user = $this->input->post("sms_user");
			if($sms_user != 'select') {
				$this->data['sms_templates'] = $this->mailandsmstemplate_m->get_order_by_mailandsmstemplate(array('user' => $sms_user, 'type' => 'sms'));
				$this->data['sms_user'] = $this->input->post("sms_user");
			} else {
				$this->data['sms_templates'] = 'empty';
				$this->data['sms_user'] = 'select';
			}
			$this->data['sms_templateID'] = 'select';
			/* End For SMS */

			if($_POST) {
				if($this->input->post('type') == "email") {
					$this->data['email_templateID'] = $this->input->post('email_template');
					$rules = $this->rules_mail();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) { 
						$this->data["email"] = 1;
						$this->data["sms"] = 0;
						$this->data["subview"] = "mailandsms/add";
						$this->load->view('_layout_main', $this->data);			
					} else {
						$table = '';
						$user = $this->input->post('email_user');
						$subject = $this->input->post('email_subject');
		
						$allusers = array();
						if($user == 'librarian' || $user == 'accountant') {
							$table = 'user';
							$usertype = ucfirst($user);
							$allusers = $this->student_m->get_username($table, array('usertype' => $usertype));
						} elseif($user == 'parents') {
							$table = 'parent';
							$usertype = 'Parent';
							$allusers = $this->student_m->get_username($table, array('usertype' => $usertype));
						}else {
							$table = $user;
							$allusers = $this->student_m->get_username($table);
						}

						if($user == "student") {
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('email_message');
								$classes = $this->classes_m->get_classes($users->classesID);
								if(count($classes)) {
									$message = str_replace('[student_class]', $classes->classes, $message);
								}

								$section = $this->section_m->get_section($users->sectionID);
								if(count($section)) {
									$message = str_replace('[student_section]', $section->section, $message);
								} else {
									$message = str_replace('[student_section]', $users->section, $message);
								}

								$message = str_replace('[student_name]', $users->name, $message);
								$message = str_replace('[student_roll]', $users->roll, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[student_dob]', $dob, $message);
								$message = str_replace('[student_gender]', $users->sex, $message);
								$message = str_replace('[student_religion]', $users->religion, $message);
								$message = str_replace('[student_email]', $users->email, $message);
								$message = str_replace('[student_phone]', $users->phone, $message);
								$message = str_replace('[student_username]', $users->username, $message);

								$studentID = $users->studentID;
								$classesID = $users->classesID;
								$message = str_replace('[student_result_table]', $this->result_table_email($studentID, $classesID), $message);

								if($users->email) {
									/* Start Student Email */
									$email = $users->email;
									$this->email->set_mailtype("html");
									$this->email->from($this->data['siteinfos']->email, $this->data['siteinfos']->sname);
									$this->email->to($email);
									$this->email->subject($subject);
									$this->email->message($message);
									/* End Student Email */
									if($this->email->send()) {
										$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						    		} else {
						    			$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						    		}
						    	}

								$message = "";
							}

					    	$array = array(
								'users' => $this->lang->line('mailandsms_students'),
								'type' => ucfirst($this->input->post('type')),
								'message' => $this->input->post('email_message'),
								'year' => date('Y')
							); 
							$this->mailandsms_m->insert_mailandsms($array);
							redirect(base_url("mailandsms/index"));
						} elseif($user == "parents") {
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('email_message');

								$message = str_replace('[guardian_name]', $users->name, $message);
								$message = str_replace("[father's_name]", $users->father_name, $message);
								$message = str_replace("[mother's_name]", $users->mother_name, $message);
								$message = str_replace("[father's_profession]", $users->father_profession, $message);
								$message = str_replace("[mother's_profession]", $users->mother_profession, $message);
								$message = str_replace('[parents_email]', $users->email, $message);
								$message = str_replace('[parents_phone]', $users->phone, $message);
								$message = str_replace('[parents_address]', $users->address, $message);
								$message = str_replace('[parents_username]', $users->username, $message);

								if($users->email) {
									/* Start Parents Email */
									$email = $users->email;
									$this->email->set_mailtype("html");
									$this->email->from($this->data['siteinfos']->email, $this->data['siteinfos']->sname);
									$this->email->to($email);
									$this->email->subject($subject);
									$this->email->message($message);
									/* End Parents Email */ 
									if($this->email->send()) {
										$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						    		} else {
						    			$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						    		}
						    	}
								$message = "";
							}

							$array = array(
								'users' => $this->lang->line('mailandsms_parents'),
								'type' => ucfirst($this->input->post('type')),
								'message' => $this->input->post('email_message'),
								'year' => date('Y')
							); 
							$this->mailandsms_m->insert_mailandsms($array);
							redirect(base_url("mailandsms/index"));
						} elseif($user == "teacher") {
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('email_message');
						
								$message = str_replace('[teacher_name]', $users->name, $message);
								$message = str_replace('[teacher_designation]', $users->designation, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[teacher_dob]', $dob, $message);
								$message = str_replace('[teacher_gender]', $users->sex, $message);
								$message = str_replace('[teacher_religion]', $users->religion, $message);
								$message = str_replace('[teacher_email]', $users->email, $message);
								$message = str_replace('[teacher_phone]', $users->phone, $message);
								$message = str_replace('[teacher_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[teacher_jod]', $jod, $message);
								$message = str_replace('[teacher_username]', $users->username, $message);

								if($users->email) {
									/* Start Parents Email */
									$email = $users->email;
									$this->email->set_mailtype("html");
									$this->email->from($this->data['siteinfos']->email, $this->data['siteinfos']->sname);
									$this->email->to($email);
									$this->email->subject($subject);
									$this->email->message($message);
									/* End Parents Email */ 
									if($this->email->send()) {
										$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						    		} else {
						    			$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						    		}
						    	}
								$message = "";
							}
					
							$array = array(
								'users' => $this->lang->line('mailandsms_teachers'),
								'type' => ucfirst($this->input->post('type')),
								'message' => $this->input->post('email_message'),
								'year' => date('Y')
							); 
							$this->mailandsms_m->insert_mailandsms($array);
							redirect(base_url("mailandsms/index"));
						} elseif($user == 'librarian') {
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('email_message');

								$message = str_replace('[librarian_name]', $users->name, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[librarian_dob]', $dob, $message);
								$message = str_replace('[librarian_gender]', $users->sex, $message);
								$message = str_replace('[librarian_religion]', $users->religion, $message);
								$message = str_replace('[librarian_email]', $users->email, $message);
								$message = str_replace('[librarian_phone]', $users->phone, $message);
								$message = str_replace('[librarian_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[librarian_jod]', $jod, $message);
								$message = str_replace('[librarian_username]', $users->username, $message);

								if($users->email) {
									/* Start Parents Email */
									$email = $users->email;
									$this->email->set_mailtype("html");
									$this->email->from($this->data['siteinfos']->email, $this->data['siteinfos']->sname);
									$this->email->to($email);
									$this->email->subject($subject);
									$this->email->message($message);
									/* End Parents Email */ 
									if($this->email->send()) {
										$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						    		} else {
						    			$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						    		}
						    	}
								$message = "";
							}

							$array = array(
								'users' => $this->lang->line('mailandsms_librarians'),
								'type' => ucfirst($this->input->post('type')),
								'message' => $this->input->post('email_message'),
								'year' => date('Y')
							); 
							$this->mailandsms_m->insert_mailandsms($array);
							redirect(base_url("mailandsms/index"));
						} elseif($user == 'accountant') {
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('email_message');

								$message = str_replace('[accountant_name]', $users->name, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[accountant_dob]', $dob, $message);
								$message = str_replace('[accountant_gender]', $users->sex, $message);
								$message = str_replace('[accountant_religion]', $users->religion, $message);
								$message = str_replace('[accountant_email]', $users->email, $message);
								$message = str_replace('[accountant_phone]', $users->phone, $message);
								$message = str_replace('[accountant_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[accountant_jod]', $jod, $message);
								$message = str_replace('[accountant_username]', $users->username, $message);

								if($users->email) {
									/* Start Parents Email */
									$email = $users->email;
									$this->email->set_mailtype("html");
									$this->email->from($this->data['siteinfos']->email, $this->data['siteinfos']->sname);
									$this->email->to($email);
									$this->email->subject($subject);
									$this->email->message($message);
									/* End Parents Email */ 
									if($this->email->send()) {
										$this->session->set_flashdata('success', $this->lang->line('mail_success'));
						    		} else {
						    			$this->session->set_flashdata('error', $this->lang->line('mail_error'));
						    		}
						    	}
								$message = "";
							}

							$array = array(
								'users' => $this->lang->line('mailandsms_accountants'),
								'type' => ucfirst($this->input->post('type')),
								'message' => $this->input->post('email_message'),
								'year' => date('Y')
							); 
							$this->mailandsms_m->insert_mailandsms($array);
							redirect(base_url("mailandsms/index"));
						}
					}

				} elseif($this->input->post('type') == "sms") {
					$this->data['sms_templateID'] = $this->input->post('sms_template');
					$rules = $this->rules_sms();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) { 
						$this->data["email"] = 0;
						$this->data["sms"] = 1;
						$this->data["subview"] = "mailandsms/add";
						$this->load->view('_layout_main', $this->data);	
					} else {

						$table = '';
						$user = $this->input->post('sms_user');
						$getway = $this->input->post('sms_getway');
		
						$allusers = array();
						if($user == 'librarian' || $user == 'accountant') {
							$table = 'user';
							$usertype = ucfirst($user);
							$allusers = $this->student_m->get_username($table, array('usertype' => $usertype));
						} elseif($user == 'parents') {
							$table = 'parent';
							$usertype = 'Parent';
							$allusers = $this->student_m->get_username($table, array('usertype' => $usertype));
						}else {
							$table = $user;
							$allusers = $this->student_m->get_username($table);
						}


						if($user == "student") {
							$retval = 0;
							$retmess = '';
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('sms_message');
								$classes = $this->classes_m->get_classes($users->classesID);
								if(count($classes)) {
									$message = str_replace('[student_class]', $classes->classes, $message);
								}

								$section = $this->section_m->get_section($users->sectionID);
								if(count($section)) {
									$message = str_replace('[student_section]', $section->section, $message);
								} else {
									$message = str_replace('[student_section]', $users->section, $message);
								}

								$message = str_replace('[student_name]', $users->name, $message);
								$message = str_replace('[student_roll]', $users->roll, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[student_dob]', $dob, $message);
								$message = str_replace('[student_gender]', $users->sex, $message);
								$message = str_replace('[student_religion]', $users->religion, $message);
								$message = str_replace('[student_email]', $users->email, $message);
								$message = str_replace('[student_phone]', $users->phone, $message);
								$message = str_replace('[student_username]', $users->username, $message);

								$studentID = $users->studentID;
								$classesID = $users->classesID;
								$message = str_replace('[student_result_table]', $this->result_table_sms($studentID, $classesID), $message);

								$phone = $users->phone;
								$send = $this->allgetway_send_message($getway, $phone, $message);
								if($send['check'] == FALSE) {
									$retval = 1; 
									$retmess = $send['message'];
									break;
								}
								$message = "";
							}

							if($retval == 0) {
								$array = array(
									'users' => $this->lang->line('mailandsms_students'),
									'type' => ucfirst($this->input->post('type')),
									'message' => $this->input->post('sms_message'),
									'year' => date('Y')
								); 
								$this->mailandsms_m->insert_mailandsms($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("mailandsms/index"));
							} else {
								$this->session->set_flashdata('error', $retmess);
								redirect(base_url("mailandsms/index"));
							}

						} elseif($user == "parents") {
							$retval = 0;
							$retmess = '';
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('sms_message');

								$message = str_replace('[guardian_name]', $users->name, $message);
								$message = str_replace("[father's_name]", $users->father_name, $message);
								$message = str_replace("[mother's_name]", $users->mother_name, $message);
								$message = str_replace("[father's_profession]", $users->father_profession, $message);
								$message = str_replace("[mother's_profession]", $users->mother_profession, $message);
								$message = str_replace('[parents_email]', $users->email, $message);
								$message = str_replace('[parents_phone]', $users->phone, $message);
								$message = str_replace('[parents_address]', $users->address, $message);
								$message = str_replace('[parents_username]', $users->username, $message);

								
								$phone = $users->phone;
								$send = $this->allgetway_send_message($getway, $phone, $message);
								if($send['check'] == FALSE) {
									$retval = 1; 
									$retmess = $send['message'];
									break;
								}
								$message = "";
							}

							if($retval == 0) {
								$array = array(
									'users' => $this->lang->line('mailandsms_parents'),
									'type' => ucfirst($this->input->post('type')),
									'message' => $this->input->post('sms_message'),
									'year' => date('Y')
								); 
								$this->mailandsms_m->insert_mailandsms($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("mailandsms/index"));
							} else {
								$this->session->set_flashdata('error', $retmess);
								redirect(base_url("mailandsms/index"));
							}

						} elseif($user == "teacher") {
							$retval = 0;
							$retmess = '';
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('sms_message');
						
								$message = str_replace('[teacher_name]', $users->name, $message);
								$message = str_replace('[teacher_designation]', $users->designation, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[teacher_dob]', $dob, $message);
								$message = str_replace('[teacher_gender]', $users->sex, $message);
								$message = str_replace('[teacher_religion]', $users->religion, $message);
								$message = str_replace('[teacher_email]', $users->email, $message);
								$message = str_replace('[teacher_phone]', $users->phone, $message);
								$message = str_replace('[teacher_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[teacher_jod]', $jod, $message);
								$message = str_replace('[teacher_username]', $users->username, $message);

								$phone = $users->phone;
								$send = $this->allgetway_send_message($getway, $phone, $message);
								if($send['check'] == FALSE) {
									$retval = 1; 
									$retmess = $send['message'];
									break;
								}
								$message = "";
							}

							if($retval == 0) {
								$array = array(
									'users' => $this->lang->line('mailandsms_teachers'),
									'type' => ucfirst($this->input->post('type')),
									'message' => $this->input->post('sms_message'),
									'year' => date('Y')
								); 
								$this->mailandsms_m->insert_mailandsms($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("mailandsms/index"));
							} else {
								$this->session->set_flashdata('error', $retmess);
								redirect(base_url("mailandsms/index"));
							}
						} elseif($user == 'librarian') {
							$retval = 0;
							$retmess = '';
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('sms_message');

								$message = str_replace('[librarian_name]', $users->name, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[librarian_dob]', $dob, $message);
								$message = str_replace('[librarian_gender]', $users->sex, $message);
								$message = str_replace('[librarian_religion]', $users->religion, $message);
								$message = str_replace('[librarian_email]', $users->email, $message);
								$message = str_replace('[librarian_phone]', $users->phone, $message);
								$message = str_replace('[librarian_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[librarian_jod]', $jod, $message);
								$message = str_replace('[librarian_username]', $users->username, $message);

								$phone = $users->phone;
								$send = $this->allgetway_send_message($getway, $phone, $message);
								if($send['check'] == FALSE) {
									$retval = 1; 
									$retmess = $send['message'];
									break;
								}
								$message = "";
							}

							if($retval == 0) {
								$array = array(
									'users' => $this->lang->line('mailandsms_librarians'),
									'type' => ucfirst($this->input->post('type')),
									'message' => $this->input->post('sms_message'),
									'year' => date('Y')
								); 
								$this->mailandsms_m->insert_mailandsms($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("mailandsms/index"));
							} else {
								$this->session->set_flashdata('error', $retmess);
								redirect(base_url("mailandsms/index"));
							}
						} elseif($user == 'accountant') {
							$retval = 0;
							$retmess = '';
							foreach ($allusers as $key => $users) {
								$message = $this->input->post('sms_message');

								$message = str_replace('[accountant_name]', $users->name, $message);
								$dob =  date("d M Y", strtotime($users->dob));
								$message = str_replace('[accountant_dob]', $dob, $message);
								$message = str_replace('[accountant_gender]', $users->sex, $message);
								$message = str_replace('[accountant_religion]', $users->religion, $message);
								$message = str_replace('[accountant_email]', $users->email, $message);
								$message = str_replace('[accountant_phone]', $users->phone, $message);
								$message = str_replace('[accountant_address]', $users->address, $message);
								$jod =  date("d M Y", strtotime($users->jod));
								$message = str_replace('[accountant_jod]', $jod, $message);
								$message = str_replace('[accountant_username]', $users->username, $message);

								$phone = $users->phone;
								$send = $this->allgetway_send_message($getway, $phone, $message);
								if($send['check'] == FALSE) {
									$retval = 1; 
									$retmess = $send['message'];
									break;
								}
								$message = "";
							}

							if($retval == 0) {
								$array = array(
									'users' => $this->lang->line('mailandsms_accountants'),
									'type' => ucfirst($this->input->post('type')),
									'message' => $this->input->post('sms_message'),
									'year' => date('Y')
								); 
								$this->mailandsms_m->insert_mailandsms($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("mailandsms/index"));
							} else {
								$this->session->set_flashdata('error', $retmess);
								redirect(base_url("mailandsms/index"));
							}
						}

					}

				}
			} else {
				$this->data["email"] = 1;
				$this->data["sms"] = 0;
				$this->data["subview"] = "mailandsms/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function alltemplate() {
		if($this->input->post('user') == 'select') {
			echo '<option value="select">'.$this->lang->line('mailandsms_select_template').'</option>';
		} else {
			$user = $this->input->post('user');
			$type = $this->input->post('type');
			$templates = $this->mailandsmstemplate_m->get_order_by_mailandsmstemplate(array('user' => $user, 'type' => $type));
			echo '<option value="select">'.$this->lang->line('mailandsms_select_template').'</option>';
			if(count($templates)) {
				foreach ($templates as $key => $template) {
					echo '<option value="'.$template->mailandsmstemplateID.'">'. $template->name  .'</option>';
				}
			}
		}
	}

	function check_email_users() {
		if($this->input->post('email_user') == 'select') {
			$this->form_validation->set_message("check_email_users", "The %s field is required");
	     	return FALSE;
		} else {
			return TRUE;
		}
	}

	function alltemplatedesign() {
		if((int)$this->input->post('templateID')) {
			$templateID = $this->input->post('templateID');
			$templates = $this->mailandsmstemplate_m->get_mailandsmstemplate($templateID);
			if(count($templates)) {
				echo $templates->template;
			}	
		} else {
			echo '';
		}
	}

	function check_sms_users() {
		if($this->input->post('sms_user') == 'select') {
			$this->form_validation->set_message("check_sms_users", "The %s field is required");
	     	return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_getway() {
		if($this->input->post('sms_getway') == 'select') {
			$this->form_validation->set_message("check_getway", "The %s field is required");
	     	return FALSE;
		} else {

			$getway = $this->input->post('sms_getway');
			$arrgetway = array('clickatell', 'twilio', 'bulk');
			if(in_array($getway, $arrgetway)) {
				if($getway == "clickatell") {
					if($this->clickatell->ping() == TRUE) {
						return TRUE;
					} else {
						$this->form_validation->set_message("check_getway", 'Setup Your clickatell Account');
	     				return FALSE;
					}
				} elseif($getway == 'twilio') {
					$get = $this->twilio->get_twilio();
					$ApiVersion = $get['version'];
					$AccountSid = $get['accountSID'];
					$check = $this->twilio->request("/$ApiVersion/Accounts/$AccountSid/Calls");

					if($check->IsError) {
						$this->form_validation->set_message("check_getway", $check->ErrorMessage);
	     				return FALSE;
					}
					return TRUE;
				} elseif($getway == 'bulk') {
					if($this->bulk->ping() == TRUE) {
						return TRUE;
					} else {
						$this->form_validation->set_message("check_getway", 'Invalid Username or Password');
	     				return FALSE;
					
					}
				}
			} else {
				$this->form_validation->set_message("check_getway", "The %s field is required");
	     		return FALSE;
			}
			
			
		}
	}

	private function allgetway_send_message($getway, $to, $message) {
		$result = array();
		if($getway == "clickatell") {
			if($to) {
				$this->clickatell->send_message($to, $message);
				$result['check'] = TRUE;
				return $result;
			}
		} elseif($getway == 'twilio') {
			$get = $this->twilio->get_twilio();
			$from = $get['number'];
			if($to) {
				$response = $this->twilio->sms($from, $to, $message);
				if($response->IsError) {
					$result['check'] = FALSE;
					$result['message'] = $response->ErrorMessage;
					return $result;
				} else {
					$result['check'] = TRUE;
					return $result;
				}
				
			}
		} elseif($getway == 'bulk') {
			if($to) {
				if($this->bulk->send($to, $message) == TRUE)  {
					$result['check'] = TRUE;
					return $result; 
				} else {
					$result['check'] = FALSE;
					$result['message'] = "Check your bulk account";
					return $result;
				}
			}
		}
	}

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['mailandsms'] = $this->mailandsms_m->get_mailandsms($id);
				if($this->data['mailandsms']) {
					$this->data["subview"] = "mailandsms/view";
					$this->load->view('_layout_main', $this->data);
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

	//Result Table Start
	function result_table_email($studentID,$classID) {
		$result_string="";
		$language = $this->session->userdata('lang');
		$this->lang->load('mark', $language);
		$exams = $this->exam_m->get_exam();
		$grades = $this->grade_m->get_grade();
		$marks = $this->mark_m->get_order_by_mark(array("studentID" => $studentID, "classesID" => $classID));

		if($marks) {
			$map1 = function($r) { return intval($r->examID);};
	        $marks_examsID = array_map($map1, $marks);
	        $max_semester = max($marks_examsID);

	        $map2 = function($r) { return intval($r->examID);};
	        $examsID = array_map($map2, $exams);

	        $map3 = function($r) { return array("mark" => intval($r->mark), "semester"=>$r->examID);};
	        $all_marks = array_map($map3, $marks);

	        $map4 = function($r) { return array("gradefrom" => $r->gradefrom, "gradeupto" => $r->gradeupto);};
	        $grades_check = array_map($map4, $grades);  


	        $result_string.="<br>";
	        foreach ($exams as $exam) {
	            $result_string.= "<table class=\"table table-striped table-bordered\" style=\"border: 1px solid black\">";
	                if($exam->examID <= $max_semester) {

	                    $check = array_search($exam->examID, $marks_examsID);

	                    if($check>=0) {
	                        $f = 0;
	                        foreach ($grades_check as $key => $range) {
	                            foreach ($all_marks as $value) {
	                                if($value['semester'] == $exam->examID ) {
	                                    if($value['mark']>=$range['gradefrom'] && $value['mark']<=$range['gradeupto']) {
	                                        $f=1;
	                                    }
	                                }
	                            }
	                            if($f==1) {
	                                break;
	                            }
	                        }

	                        $result_string.= "<caption>";
	                            $result_string.= "<h3>". $exam->exam."</h3>";
	                        $result_string.= "</caption>";
	                    
	                        $result_string.= "<thead style=\"border: 1px solid black\">"; 
	                            $result_string.= "<tr style=\"border: 1px solid black\">";
	                                $result_string.= "<th style=\"border: 1px solid black\">";
	                                    $result_string.= $this->lang->line("mark_subject");
	                                $result_string.= "</th>";
	                                $result_string.= "<th style=\"border: 1px solid black\">";
	                                    $result_string.= $this->lang->line("mark_mark");
	                                $result_string.= "</th>";
	                                if(count($grades) && $f == 1) {
	                                    $result_string.= "<th style=\"border: 1px solid black\">";
	                                        $result_string.= $this->lang->line("mark_point");
	                                    $result_string.= "</th>";
	                                    $result_string.= "<th style=\"border: 1px solid black\">";
	                                        $result_string.= $this->lang->line("mark_grade");
	                                    $result_string.= "</th>";
	                                }
	                            $result_string.= "</tr>";
	                        $result_string.= "</thead>";
	                    }
	                }

	                $result_string.= "<tbody>";
	                    

	            foreach ($marks as $mark) {
	                if($exam->examID == $mark->examID) {
	                    $result_string.= "<tr style=\"border: 1px solid black\">";
	                        $result_string.= "<td data-title='".$this->lang->line('mark_subject')."' style=\"border: 1px solid black\">";
	                            $result_string.= $mark->subject;
	                        $result_string.= "</td>";
	                        $result_string.= "<td data-title='".$this->lang->line('mark_mark')."' style=\"border: 1px solid black\">";
	                            $result_string.= $mark->mark;
	                        $result_string.= "</td>";
	                        if(count($grades)) {
	                            foreach ($grades as $grade) {
	                                if($grade->gradefrom <= $mark->mark && $grade->gradeupto >= $mark->mark) {
	                                    $result_string.= "<td data-title='".$this->lang->line('mark_point')."' style=\"border: 1px solid black\">";
	                                        $result_string.= $grade->point;
	                                    $result_string.= "</td>";
	                                    $result_string.= "<td data-title='".$this->lang->line('mark_grade')."' style=\"border: 1px solid black\">";
	                                        $result_string.= $grade->grade;
	                                    $result_string.= "</td>";
	                                    break;
	                                }
	                            }
	                        }
	                    $result_string.= "</tr>";
	                }
	            }
	                $result_string.= "</tbody>";
	            $result_string.= "</table>";
	        }
	    }

	    $result_string.="<br>";
        return $result_string;
	}
	//Result Table End

	function result_table_sms($studentID,$classID) {
		$result_string="";
		$language = $this->session->userdata('lang');
		$this->lang->load('mark', $language);
		$exams = $this->exam_m->get_exam();
		$grades = $this->grade_m->get_grade();
		$marks = $this->mark_m->get_order_by_mark(array("studentID" => $studentID, "classesID" => $classID));

		if($marks) {
			$map1 = function($r) { return intval($r->examID);};
	        $marks_examsID = array_map($map1, $marks);
	        $max_semester = max($marks_examsID);

	        $map2 = function($r) { return intval($r->examID);};
	        $examsID = array_map($map2, $exams);

	        $map3 = function($r) { return array("mark" => intval($r->mark), "semester"=>$r->examID);};
	        $all_marks = array_map($map3, $marks);

	        $map4 = function($r) { return array("gradefrom" => $r->gradefrom, "gradeupto" => $r->gradeupto);};
	        $grades_check = array_map($map4, $grades);  

	        foreach ($exams as $exam) {
	        	if($exam->examID <= $max_semester) {
                    $check = array_search($exam->examID, $marks_examsID);
                    if($check>=0) {
                        $f = 0;
                        foreach ($grades_check as $key => $range) {
                            foreach ($all_marks as $value) {
                                if($value['semester'] == $exam->examID ) {
                                    if($value['mark']>=$range['gradefrom'] && $value['mark']<=$range['gradeupto']) {
                                        $f=1;
                                    }
                                }
                            }
                            if($f==1) {
                                break;
                            }
                        }
                        
                        $result_string.= $exam->exam.' : ';
                    }
                }


	            foreach ($marks as $mark) {
	                if($exam->examID == $mark->examID) {
                        $result_string.= $mark->subject.' : ';
                        if(count($grades)) {
                            foreach ($grades as $grade) {
                                if($grade->gradefrom <= $mark->mark && $grade->gradeupto >= $mark->mark) {
                                    $result_string.= $grade->point.', ';
                                    $result_string.= $grade->grade.', ';
                                    break;
                                }
                            }
                        }
	                    
	                }
	            }   
	            
	        }
	    }

        return strip_tags($result_string);
	}
}

/* End of file student.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/student.php */
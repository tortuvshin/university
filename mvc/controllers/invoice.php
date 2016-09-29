<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Omnipay\Omnipay;
class Invoice extends Admin_Controller {
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
		$this->load->model("invoice_m");
		$this->load->model("feetype_m");
		$this->load->model('payment_m');
		$this->load->model("classes_m");
		$this->load->model("student_m");
		$this->load->model("parentes_m");
		$this->load->model("section_m");
		$this->load->model('user_m');
		$this->load->model("payment_settings_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('invoice', $language);
		require_once(APPPATH."libraries/Omnipay/vendor/autoload.php");
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$this->data['invoices'] = $this->invoice_m->get_invoice();
			$this->data["subview"] = "invoice/index";
			$this->load->view('_layout_main', $this->data);
		} elseif($usertype == "Student") {
			$username = $this->session->userdata("username");
			$student = $this->student_m->get_single_student(array("username" => $username));
			$this->data['invoices'] = $this->invoice_m->get_order_by_invoice(array('studentID' => $student->studentID));
			$this->data["subview"] = "invoice/index";
			$this->load->view('_layout_main', $this->data);
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['students'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					if($checkstudent->parentID == $parent->parentID) {
						$classesID = $checkstudent->classesID;
						$this->data['set'] = $id;
						$this->data['invoices'] = $this->invoice_m->get_order_by_invoice(array('studentID' => $id));
						$this->data["subview"] = "invoice/index_parent";
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
				$this->data["subview"] = "invoice/search_parent";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'classesID',
					'label' => $this->lang->line("invoice_classesID"),
					'rules' => 'trim|required|xss_clean|max_length[11]|numeric|callback_unique_classID'
				),
				array(
					'field' => 'studentID',
					'label' => $this->lang->line("invoice_studentID"),
					'rules' => 'trim|required|xss_clean|max_length[11]|numeric|callback_unique_studentID'
				),
				array(
					'field' => 'feetype',
					'label' => $this->lang->line("invoice_feetype"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'amount',
					'label' => $this->lang->line("invoice_amount"),
					'rules' => 'trim|required|xss_clean|max_length[20]|numeric|callback_valid_number'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("invoice_date"),
					'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid'
				),

			);
		return $rules;
	}

	protected function payment_rules() {
		$rules = array(
				array(
					'field' => 'amount',
					'label' => $this->lang->line("invoice_amount"),
					'rules' => 'trim|required|xss_clean|max_length[11]|numeric|callback_valid_number'
				),
				array(
					'field' => 'payment_method',
					'label' => $this->lang->line("invoice_paymentmethod"),
					'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_paymentmethod'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$this->data['classes'] = $this->classes_m->get_classes();
			$this->data['feetypes'] = $this->feetype_m->get_feetype();
			$classesID = $this->input->post("classesID");
			if($classesID != 0) {
				$this->data['students'] = $this->student_m->get_order_by_student(array("classesID" => $classesID));
			} else {
				$this->data['students'] = "empty";
			}
			$this->data['studentID'] = 0;
			if($_POST) {
				$this->data['studentID'] = $this->input->post('studentID');
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "invoice/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					if($this->input->post('studentID')) {
						$classesID = $this->input->post('classesID');
						$getclasses = $this->classes_m->get_classes($classesID);
						$studentID = $this->input->post('studentID');
						$getstudent = $this->student_m->get_student($studentID);
						$amount = $this->input->post("amount");
						$array = array(
							'classesID' => $classesID,
							'classes' => $getclasses->classes,
							'studentID' => $studentID,
							'student' => $getstudent->name,
							'roll' => $getstudent->roll,
							'feetype' => $this->input->post("feetype"),
							'amount' => $amount,
							'status' => 0,
							'date' => date("Y-m-d", strtotime($this->input->post("date"))),
							'year' => date('Y')
						);
						$oldamount = $getstudent->totalamount;
						$nowamount = $oldamount+$amount;
						$this->student_m->update_student(array('totalamount' => $nowamount), $getstudent->studentID);
						$returnID = $this->invoice_m->insert_invoice($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					 	redirect(base_url("invoice/view/$returnID"));
					} else {
						$classesID = $this->input->post('classesID');
						$getclasses = $this->classes_m->get_classes($classesID);
						$getstudents = $this->student_m->get_order_by_student(array("classesID" => $classesID));
						$amount = $this->input->post("amount");
						foreach ($getstudents as $key => $getstudent) {
							$array = array(
								'classesID' => $classesID,
								'classes' => $getclasses->classes,
								'studentID' => $getstudent->studentID,
								'student' => $getstudent->name,
								'roll' => $getstudent->roll,
								'feetype' => $this->input->post("feetype"),
								'amount' => $amount,
								'status' => 0,
								'date' => date("Y-m-d", strtotime($this->input->post("date"))),
								'year' => date('Y')
							);
							$oldamount = $getstudent->totalamount;
							$nowamount = $oldamount+$amount;
							$this->student_m->update_student(array('totalamount' => $nowamount), $getstudent->studentID);
							$this->invoice_m->insert_invoice($array);
						}
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					 	redirect(base_url("invoice/index"));
					}
				}
			} else {
				$this->data["subview"] = "invoice/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['invoice'] = $this->invoice_m->get_invoice($id);
				$this->data['classes'] = $this->classes_m->get_classes();

				if($this->data['invoice']) {

					if($this->data['invoice']->classesID != 0) {
						$this->data['students'] = $this->student_m->get_order_by_student(array("classesID" => $this->data['invoice']->classesID));
					} else {
						$this->data['students'] = "empty";
					}
					$this->data['studentID'] = $this->data['invoice']->studentID;

					if($_POST) {
						$this->data['studentID'] = $this->input->post('studentID');
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "invoice/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$status = 0;
							$oldstudent = $this->student_m->get_student($this->data['invoice']->studentID);
							$osoldamount = $oldstudent->totalamount;
							$oldnowamount = ($osoldamount)-($this->data['invoice']->amount);
							$this->student_m->update_student(array('totalamount' => $oldnowamount), $oldstudent->studentID);

							$classesID = $this->input->post('classesID');
							$getclasses = $this->classes_m->get_classes($classesID);
							$studentID = $this->input->post('studentID');
							$getstudent = $this->student_m->get_student($studentID);
							$amount = $this->input->post("amount");

							if(empty($this->data['invoice']->paidamount)) {
								$status = 0;
							} elseif($this->data['invoice']->paidamount == $amount) {
								$status = 2;
							} else {
								$status = 1;
							}

							$array = array(
								'classesID' => $classesID,
								'classes' => $getclasses->classes,
								'studentID' => $studentID,
								'student' => $getstudent->name,
								'roll' => $getstudent->roll,
								'feetype' => $this->input->post("feetype"),
								'amount' => $amount,
								'status' => $status,
							);
							$oldamount = $getstudent->totalamount;
							$nowamount = $oldamount+$amount;

							$this->student_m->update_student(array('totalamount' => $nowamount), $getstudent->studentID);
							$this->invoice_m->update_invoice($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						 	redirect(base_url("invoice/index"));

						}
					} else {
						$this->data["subview"] = "invoice/edit";
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

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['invoice'] = $this->invoice_m->get_invoice($id);
				if($this->data['invoice']) {
					$oldstudent = $this->student_m->get_student($this->data['invoice']->studentID);
					$osoldamount = $oldstudent->totalamount;
					$oldnowamount = ($osoldamount)-($this->data['invoice']->amount);
					$this->student_m->update_student(array('totalamount' => $oldnowamount), $oldstudent->studentID);
					$this->invoice_m->delete_invoice($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url('invoice/index'));
				} else {
					redirect(base_url('invoice/index'));
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
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);
				if($this->data["invoice"]) {
					$this->data["student"] = $this->student_m->get_student($this->data["invoice"]->studentID);
					$this->data["subview"] = "invoice/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Student") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$username = $this->session->userdata("username");
				$getstudent = $this->student_m->get_single_student(array("username" => $username));
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);
				if($this->data['invoice'] && ($this->data['invoice']->studentID == $getstudent->studentID)) {
					$this->data["student"] = $this->student_m->get_student($this->data["invoice"]->studentID);
					$this->data["subview"] = "invoice/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Parent") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$username = $this->session->userdata("username");
				$parent = $this->student_m->get_parent_info($username);
				$this->data["invoice"] = $this->invoice_m->get_single_invoice(array('invoiceID' => $id));
				if($this->data['invoice']) {
					$getstudent = $this->student_m->get_single_student(array("studentID" => $this->data['invoice']->studentID));
					if($this->data['invoice'] && ($parent->parentID == $getstudent->parentID)) {
						$this->data["student"] = $this->student_m->get_student($this->data["invoice"]->studentID);
						$this->data["subview"] = "invoice/view";
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
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);
				if($this->data["invoice"]) {
					$this->data["student"] = $this->student_m->get_student($this->data["invoice"]->studentID);

					$this->load->library('html2pdf');
				    $this->html2pdf->folder('./assets/pdfs/');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');

				    $html = $this->load->view('invoice/print_preview', $this->data, true);
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
	}

	public function send_mail() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = $this->input->post('id');
			if ((int)$id) {
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);
				if($this->data["invoice"]) {
					$this->data["student"] = $this->student_m->get_student($this->data["invoice"]->studentID);

					$this->load->library('html2pdf');
				    $this->html2pdf->folder('./assets/pdfs/');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
				    $html = $this->load->view('invoice/print_preview', $this->data, true);
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

	public function payment() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['invoice'] = $this->invoice_m->get_invoice($id);
				if($this->data['invoice']) {
					if(($this->data['invoice']->paidamount != $this->data['invoice']->amount) && ($this->data['invoice']->status == 0 || $this->data['invoice']->status == 1)) {
						if($_POST) {
							$rules = $this->payment_rules();
							$this->form_validation->set_rules($rules);
							if ($this->form_validation->run() == FALSE) {
								$this->data["subview"] = "invoice/payment";
								$this->load->view('_layout_main', $this->data);
							} else {

								$payable_amount = $this->input->post('amount')+$this->data['invoice']->paidamount;
								if ($payable_amount > $this->data['invoice']->amount) {
									$this->session->set_flashdata('error', 'Payment amount is much than invoice amount');
									redirect(base_url("invoice/payment/$id"));
								} else {
									$this->post_data = $this->input->post();
									if ($this->input->post('payment_method') == 'Paypal') {
										$get_configs = $this->payment_settings_m->get_order_by_config();
										$this->post_data['id'] = $this->uri->segment(3);
										$this->invoice_data = $this->invoice_m->get_invoice($this->post_data['id']);
										$this->Paypal();
									} elseif($this->input->post('payment_method') == 'Cash') {
										$status = 0;
										if($payable_amount == $this->data['invoice']->amount) {
											$status = 2;
										} else {
											$status = 1;
										}

										$username = $this->session->userdata('username');
										$dbuserID = 0;
										$dbusertype = '';
										$dbuname = '';
										if($usertype == "Admin") {
											$user = $this->user_m->get_username_row("systemadmin", array("username" => $username));
											$dbuserID = $user->systemadminID;
											$dbusertype = $user->usertype;
											$dbuname = $user->name;
										} elseif($usertype == "Accountant") {
											$user = $this->user_m->get_username_row("user", array("username" => $username));
											$dbuserID = $user->userID;
											$dbusertype = $user->usertype;
											$dbuname = $user->name;
										}

										$nowpaymenttype = '';
										if(empty($this->data['invoice']->paymenttype)) {
											$nowpaymenttype = 'Cash';
										} else {
											if($this->data['invoice']->paymenttype == 'Cash') {
												$nowpaymenttype = 'Cash';
											} else {
												$exp = explode(',', $this->data['invoice']->paymenttype);
												if(!in_array('Cash', $exp)) {
													$nowpaymenttype =  $this->data['invoice']->paymenttype.','.'Cash';
												} else {
													$nowpaymenttype =  $this->data['invoice']->paymenttype;
												}
											}
										}

										$array = array(
											"paidamount" => $payable_amount,
											"status" => $status,
											"paymenttype" => $nowpaymenttype,
											"paiddate" => date('Y-m-d'),
											"userID" => $dbuserID,
											"usertype" => $dbusertype,
											'uname' => $dbuname
										);

										$payment_array = array(
											"invoiceID" => $id,
											"studentID"	=> $this->data['invoice']->studentID,
											"paymentamount" => $this->input->post('amount'),
											"paymenttype" => $this->input->post('payment_method'),
											"paymentdate" => date('Y-m-d'),
											"paymentmonth" => date('M'),
											"paymentyear" => date('Y')
										);

										$this->payment_m->insert_payment($payment_array);

										$studentID = $this->data['invoice']->studentID;
										$getstudent = $this->student_m->get_student($studentID);
										$nowamount = ($getstudent->paidamount)+($this->input->post('amount'));
										$this->student_m->update_student(array('paidamount' => $nowamount), $studentID);

										$this->invoice_m->update_invoice($array, $id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("invoice/view/$id"));
									} elseif($this->input->post('payment_method') == 'Cheque') {
										$status = 0;
										if($payable_amount == $this->data['invoice']->amount) {
											$status = 2;
										} else {
											$status = 1;
										}

										$username = $this->session->userdata('username');
										$dbuserID = 0;
										$dbusertype = '';
										$dbuname = '';
										if($usertype == "Admin") {
											$user = $this->user_m->get_username_row("systemadmin", array("username" => $username));
											$dbuserID = $user->systemadminID;
											$dbusertype = $user->usertype;
											$dbuname = $user->name;
										} elseif($usertype == "Accountant") {
											$user = $this->user_m->get_username_row("user", array("username" => $username));
											$dbuserID = $user->userID;
											$dbusertype = $user->usertype;
											$dbuname = $user->name;
										}

										$nowpaymenttype = '';
										if(empty($this->data['invoice']->paymenttype)) {
											$nowpaymenttype = 'Cheque';
										} else {
											if($this->data['invoice']->paymenttype == 'Cheque') {
												$nowpaymenttype = 'Cheque';
											} else {
												$exp = explode(',', $this->data['invoice']->paymenttype);
												if(!in_array('Cheque', $exp)) {
													$nowpaymenttype =  $this->data['invoice']->paymenttype.','.'Cheque';
												} else {
													$nowpaymenttype =  $this->data['invoice']->paymenttype;
												}
											}
										}

										$array = array(
											"paidamount" => $payable_amount,
											"status" => $status,
											"paymenttype" => $nowpaymenttype,
											"paiddate" => date('Y-m-d'),
											"userID" => $dbuserID,
											"usertype" => $dbusertype,
											'uname' => $dbuname
										);

										$payment_array = array(
											"invoiceID" => $id,
											"studentID"	=> $this->data['invoice']->studentID,
											"paymentamount" => $this->input->post('amount'),
											"paymenttype" => $this->input->post('payment_method'),
											"paymentdate" => date('Y-m-d'),
											"paymentmonth" => date('M'),
											"paymentyear" => date('Y')
										);

										$this->payment_m->insert_payment($payment_array);

										$studentID = $this->data['invoice']->studentID;
										$getstudent = $this->student_m->get_student($studentID);
										$nowamount = ($getstudent->paidamount)+($this->input->post('amount'));
										$this->student_m->update_student(array('paidamount' => $nowamount), $studentID);

										$this->invoice_m->update_invoice($array, $id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("invoice/view/$id"));
									} else {
										$this->data["subview"] = "invoice/payment";
										$this->load->view('_layout_main', $this->data);
									}
								}
							}
						} else {
							$this->data["subview"] = "invoice/payment";
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
		} elseif($usertype == "Student") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['invoice'] = $this->invoice_m->get_invoice($id);
				$username = $this->session->userdata("username");
				$getstudent = $this->student_m->get_single_student(array("username" => $username));
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);

				if($this->data['invoice'] && ($this->data['invoice']->studentID == $getstudent->studentID)) {
					if(($this->data['invoice']->paidamount != $this->data['invoice']->amount) && ($this->data['invoice']->status == 0 || $this->data['invoice']->status == 1)) {
						if($_POST) {
							$rules = $this->payment_rules();
							unset($rules[1]);
							$this->form_validation->set_rules($rules);
							if ($this->form_validation->run() == FALSE) {
								$this->data["subview"] = "invoice/payment";
								$this->load->view('_layout_main', $this->data);
							} else {
								$payable_amount = $this->input->post('amount')+$this->data['invoice']->paidamount;
								if ($payable_amount > $this->data['invoice']->amount) {
									$this->session->set_flashdata('error', 'Payment amount is much than invoice amount');
									redirect(base_url("invoice/payment/$id"));
								} else {
									$this->post_data = $this->input->post();
									$this->post_data['id'] = $id;
									$this->invoice_data = $this->invoice_m->get_invoice($id);
									$this->Paypal();
								}
							}
						} else {
							$this->data["subview"] = "invoice/payment";
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
		} elseif($usertype == "Parent") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['invoice'] = $this->invoice_m->get_invoice($id);
				$username = $this->session->userdata("username");
				$this->data["invoice"] = $this->invoice_m->get_invoice($id);

				if($this->data["invoice"]) {
					$getstudent = $this->student_m->get_single_student(array("studentID" => $this->data['invoice']->studentID));
					if($this->data['invoice'] && ($this->data['invoice']->studentID == $getstudent->studentID)) {
						if(($this->data['invoice']->paidamount != $this->data['invoice']->amount) && ($this->data['invoice']->status == 0 || $this->data['invoice']->status == 1)) {
							if($_POST) {
								$rules = $this->payment_rules();
								unset($rules[1]);
								$this->form_validation->set_rules($rules);
								if ($this->form_validation->run() == FALSE) {
									$this->data["subview"] = "invoice/payment";
									$this->load->view('_layout_main', $this->data);
								} else {
									$payable_amount = $this->input->post('amount')+$this->data['invoice']->paidamount;
									if ($payable_amount > $this->data['invoice']->amount) {
										$this->session->set_flashdata('error', 'Payment amount is much than invoice amount');
										redirect(base_url("invoice/payment/$id"));
									} else {
										$this->post_data = $this->input->post();
										$this->post_data['id'] = $id;
										$this->invoice_data = $this->invoice_m->get_invoice($id);
										$this->Paypal();
									}
								}
							} else {
								$this->data["subview"] = "invoice/payment";
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
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	/* Paypal payment start*/
	public function Paypal() {
		$api_config = array();
		$get_configs = $this->payment_settings_m->get_order_by_config();
		foreach ($get_configs as $key => $get_key) {
			$api_config[$get_key->config_key] = $get_key->value;
		}
		$this->data['set_key'] = $api_config;
		if($api_config['paypal_api_username'] =="" || $api_config['paypal_api_password'] =="" || $api_config['paypal_api_signature']==""){
			$this->session->set_flashdata('error', 'Paypal settings not available');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->item_data = $this->post_data;
			$this->invoice_info = (array) $this->invoice_data;

			$params = array(
	  		'cancelUrl' 	=> base_url('invoice/getSuccessPayment'),
	  		'returnUrl' 	=> base_url('invoice/getSuccessPayment'),
	  		'invoice_id'	=> $this->item_data['id'],
	    	'name'		=> $this->invoice_info['student'],
	    	'description' 	=> $this->invoice_info['feetype'],
	    	'amount' 	=> number_format(floatval($this->item_data['amount']),2),
	    	'currency' 	=> $this->data["siteinfos"]->currency_code,
			);
			$this->session->set_userdata("params", $params);
			$gateway = Omnipay::create('PayPal_Express');
			$gateway->setUsername($api_config['paypal_api_username']);
			$gateway->setPassword($api_config['paypal_api_password']);
			$gateway->setSignature($api_config['paypal_api_signature']);

			$gateway->setTestMode($api_config['paypal_demo']);

			$response = $gateway->purchase($params)->send();

			if ($response->isSuccessful()) {
				// payment was successful: update database
			} elseif ($response->isRedirect()) {
				$response->redirect();
			} else {
			  // payment failed: display message to customer
			  echo $response->getMessage();
			}
		}
		/*omnipay Paypal end*/
	}

	public function getSuccessPayment() {
  		$userID = $this->userID();
  		$api_config = array();
		$get_configs = $this->payment_settings_m->get_order_by_config();
		foreach ($get_configs as $key => $get_key) {
			$api_config[$get_key->config_key] = $get_key->value;
		}
		$this->data['set_key'] = $api_config;

   		$gateway = Omnipay::create('PayPal_Express');
		$gateway->setUsername($api_config['paypal_api_username']);
		$gateway->setPassword($api_config['paypal_api_password']);
		$gateway->setSignature($api_config['paypal_api_signature']);

		$gateway->setTestMode($api_config['paypal_demo']);

		$params = $this->session->userdata('params');
  		$response = $gateway->completePurchase($params)->send();
  		$paypalResponse = $response->getData(); // this is the raw response object
  		$purchaseId = $_GET['PayerID'];
  		$this->data['invoice'] = $this->invoice_m->get_invoice($params['invoice_id']);
  		$recent_paidamount = $params['amount']+$this->data['invoice']->paidamount;
  		if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
  			// Response
  			if ($purchaseId) {

				$status = 0;
				if($recent_paidamount == $this->data['invoice']->amount) {
					$status = 2;
				} else {
					$status = 1;
				}

				$usertype = $this->session->userdata("usertype");
				$username = $this->session->userdata('username');
				$dbuserID = 0;
				$dbusertype = '';
				$dbuname = '';
				if($usertype == "Admin") {
					$user = $this->user_m->get_username_row("systemadmin", array("username" => $username));
					$dbuserID = $user->systemadminID;
					$dbusertype = $user->usertype;
					$dbuname = $user->name;
				} elseif($usertype == "Accountant") {
					$user = $this->user_m->get_username_row("user", array("username" => $username));
					$dbuserID = $user->userID;
					$dbusertype = $user->usertype;
					$dbuname = $user->name;
				} elseif($usertype == "Student") {
					$user = $this->user_m->get_username_row("student", array("username" => $username));
					$dbuserID = $user->studentID;
					$dbusertype = $user->usertype;
					$dbuname = $user->name;
				} elseif($usertype == "Parent") {
					$user = $this->user_m->get_username_row("parent", array("username" => $username));
					$dbuserID = $user->parentID;
					$dbusertype = $user->usertype;
					$dbuname = $user->name;
				}

				$nowpaymenttype = '';
				if(empty($this->data['invoice']->paymenttype)) {
					$nowpaymenttype = 'Paypal';
				} else {
					if($this->data['invoice']->paymenttype == 'Paypal') {
						$nowpaymenttype = 'Paypal';
					} else {
						$exp = explode(',', $this->data['invoice']->paymenttype);
						if(!in_array('Paypal', $exp)) {
							$nowpaymenttype =  $this->data['invoice']->paymenttype.','.'Paypal';
						} else {
							$nowpaymenttype =  $this->data['invoice']->paymenttype;
						}
					}
				}

				$array = array(
					"paidamount" => $recent_paidamount,
					"status" => $status,
					"paymenttype" => $nowpaymenttype,
					"paiddate" => date('Y-m-d'),
					"userID" => $dbuserID,
					"usertype" => $dbusertype,
					'uname' => $dbuname
				);

				$payment_array = array(
					"invoiceID" => $params['invoice_id'],
					"studentID"	=> $this->data['invoice']->studentID,
					"paymentamount" => $params['amount'],
					"paymenttype" => 'Paypal',
					"paymentdate" => date('Y-m-d'),
					"paymentmonth" => date('M'),
					"paymentyear" => date('Y')
				);

				$this->payment_m->insert_payment($payment_array);

				$studentID = $this->data['invoice']->studentID;
				$getstudent = $this->student_m->get_student($studentID);
				$nowamount = ($getstudent->paidamount)+($params['amount']);
				$this->student_m->update_student(array('paidamount' => $nowamount), $studentID);

				$this->invoice_m->update_invoice($array, $params['invoice_id']);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));

  			} else {
  				$this->session->set_flashdata('error', 'Payer id not found!');
  			}
  			redirect(base_url("invoice/view/".$params['invoice_id']));
  		} else {

      		//Failed transaction
      		$this->session->set_flashdata('error', 'Payment not success!');
  			redirect(base_url("invoice/view/".$params['invoice_id']));

  		}
  	}
	/* Paypal payment end*/

	function call_all_student() {
		$classesID = $this->input->post('id');
		if((int)$classesID) {
			echo "<option value='". 0 ."'>". $this->lang->line('invoice_select_student') ."</option>";
			$students = $this->student_m->get_order_by_student(array('classesID' => $classesID));
			foreach ($students as $key => $student) {
				echo "<option value='". $student->studentID ."'>". $student->name ."</option>";
			}
		} else {
			echo "<option value='". 0 ."'>". $this->lang->line('invoice_select_student') ."</option>";
		}
	}

	function feetypecall() {
		$feetype = $this->input->post('feetype');
		if($feetype) {
			$allfeetypes = $this->feetype_m->allfeetype($feetype);

			foreach ($allfeetypes as $allfeetype) {
				echo "<li id='". $allfeetype->feetypeID ."'>".$allfeetype->feetype."</li>";
			}
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

	function unique_classID() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("unique_classID", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function valid_number() {
		if($this->input->post('amount') && $this->input->post('amount') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

	function unique_paymentmethod() {
		if($this->input->post('payment_method') === '0') {
			$this->form_validation->set_message("unique_paymentmethod", "The %s field is required");
	     	return FALSE;
		} elseif($this->input->post('payment_method') === 'Paypal') {
			$api_config = array();
			$get_configs = $this->payment_settings_m->get_order_by_config();
			foreach ($get_configs as $key => $get_key) {
				$api_config[$get_key->config_key] = $get_key->value;
			}
			if($api_config['paypal_api_username'] =="" || $api_config['paypal_api_password'] =="" || $api_config['paypal_api_signature']==""){
				$this->form_validation->set_message("unique_paymentmethod", "Paypal settings required");
				return FALSE;
			}
		}
		return TRUE;
	}

	public function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("invoice/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("invoice/index"));
		}
	}

	public function userID() {
		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		return $userID;
	}
}

/* End of file invoice.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/invoice.php */

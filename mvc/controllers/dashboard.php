<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
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
		$this->load->model('systemadmin_m');
		$this->load->model("dashboard_m");
		$this->load->model("automation_shudulu_m");
		$this->load->model("automation_rec_m");
		$this->load->model("setting_m");
		$this->load->model("notice_m");
		$this->load->model("user_m");
		$this->load->model("student_m");
		$this->load->model("classes_m");
		$this->load->model("teacher_m");
		$this->load->model("parentes_m");
		$this->load->model("sattendance_m");
		$this->load->model("subject_m");
		$this->load->model("feetype_m");
		$this->load->model("invoice_m");
		$this->load->model("expense_m");
		$this->load->model("payment_m");
		$this->load->model("lmember_m");
		$this->load->model("book_m");
		$this->load->model("issue_m");
		$this->load->model("student_info_m");
		$this->load->model("parentes_m");
		$this->load->model('hmember_m');
		$this->load->model('tmember_m');
		$this->load->model('event_m');
		$this->load->model('holiday_m');
		$this->load->model('visitorinfo_m');
		$language = $this->session->userdata('lang');
		$this->lang->load('dashboard', $language);

		/* Automation Start */
		$cnt = 0;
		$date = date('Y-m-d');
		$day = date('d');
		$month = date('m');
		$year = date('Y');
		$setting = $this->setting_m->get_setting(1);

		if($day >= $setting->automation) {
			$automation_shudulus = $this->automation_shudulu_m->get_automation_shudulu();
			if(count($automation_shudulus)) {
				foreach ($automation_shudulus as $automation_shudulu) {
					if($automation_shudulu->month == $month && $automation_shudulu->year == $year) {
						$cnt = 1;
					}
				}


				if($cnt === 0) {
					$alltotalamount = 0;
					$alltotalamounttransport = 0;
					$alltotalamounthostel = 0;

					/* Library Start */
					$student_librarys = $this->student_m->get_order_by_student(array('library' => 1));
					foreach ($student_librarys as $student_library) {
						$db_lmember = $this->lmember_m->get_single_lmember(array('studentID' => $student_library->studentID));
						if(count($db_lmember)) {
							if($db_lmember->lbalance > 0) {
								$automation_rec_library = $this->automation_rec_m->get_order_by_automation_rec(array(
									'studentID' => $student_library->studentID,
									'month' => $month,
									'year' => $year,
									'nofmodule' => 5427279
								));
								if(!count($automation_rec_library)) {
									$alltotalamount = ($student_library->totalamount)+($db_lmember->lbalance);
									$array_library = array(
										'totalamount' => $alltotalamount
									);

									$dbclasses = $this->classes_m->get_classes($student_library->classesID);
									$array_library_invoice = array(
										'classesID' => $student_library->classesID,
										'classes' => $dbclasses->classes,
										'studentID' => $student_library->studentID,
										'student' => $student_library->name,
										'roll' => $student_library->roll,
										'feetype' => $this->lang->line('dashboard_libraryfee'),
										'amount' => $db_lmember->lbalance,
										'status' => 0,
										'date' => $date,
										'year' => $year
									);

									$this->invoice_m->insert_invoice($array_library_invoice);
									$this->student_m->update_student($array_library, $student_library->studentID);
									$this->automation_rec_m->insert_automation_rec(array(
										'studentID' => $student_library->studentID,
										'date' => $date,
										'day' => $day,
										'month' => $month,
										'year' => $year,
										'nofmodule' => 5427279
									));
									$alltotalamount = 0;
								}
							}
						}
					}
					/* Library Close */

					/* Transport Start */
					$student_transports = $this->student_m->get_order_by_student(array('transport' => 1));
					foreach ($student_transports as $student_transport) {
						$db_tmember = $this->tmember_m->get_single_tmember(array('studentID' => $student_transport->studentID));

						if(count($db_tmember)) {
							if($db_tmember->tbalance > 0) {
								$automation_rec_transport = $this->automation_rec_m->get_order_by_automation_rec(array(
									'studentID' => $student_transport->studentID,
									'month' => $month,
									'year' => $year,
									'nofmodule' => 872677678
								));

								if(!count($automation_rec_transport)) {
									$alltotalamounttransport = ($student_transport->totalamount)+($db_tmember->tbalance);
									$array_transport = array(
										'totalamount' => $alltotalamounttransport
									);

									$dbclasses = $this->classes_m->get_classes($student_transport->classesID);
									$array_transport_invoice = array(
										'classesID' => $student_transport->classesID,
										'classes' => $dbclasses->classes,
										'studentID' => $student_transport->studentID,
										'student' => $student_transport->name,
										'roll' => $student_transport->roll,
										'feetype' => $this->lang->line('dashboard_transportfee'),
										'amount' => $db_tmember->tbalance,
										'status' => 0,
										'date' => $date,
										'year' => $year
									);

									$this->invoice_m->insert_invoice($array_transport_invoice);
									$this->student_m->update_student($array_transport, $student_transport->studentID);
									$this->automation_rec_m->insert_automation_rec(array(
										'studentID' => $student_transport->studentID,
										'date' => $date,
										'day' => $day,
										'month' => $month,
										'year' => $year,
										'nofmodule' => 872677678
									));
									$alltotalamounttransport = 0;
								}
							}
						}
					}
					/* Transport Close */

					/* Hostel Start */
					$student_hostels = $this->student_m->get_order_by_student(array('hostel' => 1));
					foreach ($student_hostels as $student_hostel) {
						$db_hmember = $this->hmember_m->get_single_hmember(array('studentID' => $student_hostel->studentID));
						if(count($db_hmember)) {
							if($db_hmember->hbalance > 0) {
								$automation_rec_hostel = $this->automation_rec_m->get_order_by_automation_rec(array(
									'studentID' => $student_hostel->studentID,
									'month' => $month,
									'year' => $year,
									'nofmodule' => 467835
								));

								if(!count($automation_rec_hostel)) {
									$alltotalamounthostel = ($student_hostel->totalamount)+($db_hmember->hbalance);
									$array_hostel = array(
										'totalamount' => $alltotalamounthostel
									);

									$dbclasses = $this->classes_m->get_classes($student_hostel->classesID);
									$array_hostel_invoice = array(
										'classesID' => $student_hostel->classesID,
										'classes' => $dbclasses->classes,
										'studentID' => $student_hostel->studentID,
										'student' => $student_hostel->name,
										'roll' => $student_hostel->roll,
										'feetype' => $this->lang->line('dashboard_hostelfee'),
										'amount' => $db_hmember->hbalance,
										'status' => 0,
										'date' => $date,
										'year' => $year
									);

									$this->invoice_m->insert_invoice($array_hostel_invoice);
									$this->student_m->update_student($array_hostel, $student_hostel->studentID);
									$this->automation_rec_m->insert_automation_rec(array(
										'studentID' => $student_hostel->studentID,
										'date' => $date,
										'day' => $day,
										'month' => $month,
										'year' => $year,
										'nofmodule' => 467835
									));
									$alltotalamounthostel = 0;
								}
							}
						}
					}
					/* Hostel Close */

					$this->automation_shudulu_m->insert_automation_shudulu(array(
						'date' => $date,
						'day' => $day,
						'month' => $month,
						'year' => $year
					));
				}
			} else {
				$this->automation_shudulu_m->insert_automation_shudulu(array(
					'date' => $date,
					'day' => $day,
					'month' => $month,
					'year' => $year
				));
			}
		}
		/* Automation Close */
	}

	public function index() {
		$usertype = $this->session->userdata('usertype');
		$day = abs(date('d'));
		$monthyear = date('m-Y');
		$this->data['event'] = $this->event_m->get_event();
		$this->data['holiday'] = $this->holiday_m->get_holiday();

		// dump($this->data['event']);
		// dump($this->data['holiday']);
		// die;

		if($usertype == "Admin") {

			$username = $this->session->userdata('username');
			$this->data['user'] = $this->systemadmin_m->get_single_systemadmin(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['student'] = $this->student_m->get_student();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['parents'] = $this->parentes_m->get_parentes();
			$this->data['attendance'] = $this->sattendance_m->get_order_by_attendance(array('monthyear' => $monthyear, 'a'.$day => 'P'));
			$this->data['setting'] = $this->setting_m->get_setting(1);
			$this->data['update_site_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		} elseif($usertype == "Teacher") {
			$username = $this->session->userdata('username');
			$this->data['user'] = $this->teacher_m->get_single_teacher(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['student'] = $this->student_m->get_student();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['subject'] = $this->subject_m->get_subject();
			$this->data['attendance'] = $this->sattendance_m->get_order_by_attendance(array('monthyear' => $monthyear, 'a'.$day => 'P'));
		} elseif($usertype == "Accountant") {
			$username = $this->session->userdata('username');
			$this->data['user'] = $this->user_m->get_single_user(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['invoice'] = $this->invoice_m->get_invoice();
			$this->data['feetype'] = $this->feetype_m->get_feetype();
			$this->data['expense'] = $this->expense_m->get_expense();
		} elseif($usertype == "Librarian") {
			$username = $this->session->userdata('username');
			$this->data['user'] = $this->user_m->get_single_user(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['lmember'] = $this->lmember_m->get_lmember();
			$this->data['book'] = $this->book_m->get_book();
			$this->data['issue'] = $this->issue_m->get_order_by_issue(array('return_date' => NULL));
		} elseif($usertype == "Student") {
			$username = $this->session->userdata('username');
			$this->data['user'] = $this->student_m->get_single_student(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['subject'] = $this->student_info_m->get_join_where_subject($this->data['user']->classesID);
			$lmember = $this->lmember_m->get_single_lmember(array('studentID' => $this->data['user']->studentID));
			if($lmember) {
				$this->data['issue'] = $this->issue_m->get_order_by_issue(array("lID" => $lmember->lID, 'return_date' => NULL));
			} else {
				$this->data['issue'] = NULL;
			}
			$this->data['invoice'] = $this->invoice_m->get_order_by_invoice(array("studentID" => $this->data['user']->studentID));
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata('username');
			$this->data['user'] = $this->parentes_m->get_single_parentes(array('username'  => $username));
			$this->data['notices'] = $this->notice_m->get_notice();
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$students = $this->student_m->get_order_by_student(array('parentID'  => $this->data['user']->parentID));
			$issue = 0;
			$invoice = 0;
			foreach ($students as $student) {
				$lmember = $this->lmember_m->get_single_lmember(array('studentID' => $student->studentID));
				if($lmember) {
					$getissue = $this->issue_m->get_order_by_issue(array("lID" => $lmember->lID, 'return_date' => NULL));
					$issue+=count($getissue);
				}

				$getinvoice = $this->invoice_m->get_order_by_invoice(array('studentID' => $student->studentID));
				if($getinvoice) {
					$invoice+=count($getinvoice);
				}
			}
			$this->data['issue'] = $issue;
			$this->data['invoice'] = $invoice;
			$this->data['books'] = $this->book_m->get_book();
		} elseif($usertype == "Receptionist") {

			$username = $this->session->userdata('username');
			$this->data['user'] = $this->user_m->get_single_user(array('username'  => $username));
			$this->data['teacher'] = $this->teacher_m->get_teacher();
			$this->data['visitorinfo'] = $this->visitorinfo_m->get_visitorinfo();
			$this->data['notices'] = $this->notice_m->get_notice();
		}
		$this->data["subview"] = "dashboard/index";
		$this->load->view('_layout_main', $this->data);
	}

	function paymentscall() {
		$usertype = $this->session->userdata('usertype');
		if($usertype == "Admin") {
			$payments = $this->payment_m->get_payment();
			$invoices = $this->invoice_m->get_invoice();
			$npaid = 0;
			$ppaid = 0;
			$fpaid = 0;
			$cash = 0;
			$cheque = 0;
			$paypal = 0;

			if(count($invoices)) {
				foreach ($invoices as $invoice) {
					if($invoice->status == 0) {
						$npaid++;
					} elseif($invoice->status == 1) {
						$ppaid++;
					} elseif($invoice->status == 2) {
						$fpaid++;
					}
				}
			}

			if(count($payments)) {
				foreach ($payments as $payment) {
					if('Cash' == $payment->paymenttype) {
						$cash++;
					} elseif('Cheque' == $payment->paymenttype) {
						$cheque++;
					} elseif('Paypal' == $payment->paymenttype) {
						$paypal++;
					}
				}
			}

			if(count($invoices)) {
				$json = array("npaid" => $npaid, "ppaid" => $ppaid, "fpaid" => $fpaid, "cash" => $cash, "cheque" => $cheque, "paypal" => $paypal, "st" => 1);
				header("Content-Type: application/json", true);
				echo json_encode($json);
				exit;
			} else {
				$json = array("npaid" => $npaid, "ppaid" => $ppaid, "fpaid" => $fpaid, "cash" => $cash, "cheque" => $cheque, "paypal" => $paypal, "st" => 0);
				header("Content-Type: application/json", true);
				echo json_encode($json);
				exit;
			}
		}
	}

	function graphcall() {
		$usertype = $this->session->userdata('usertype');
		if($usertype == "Admin") {
			$payments = $this->payment_m->get_order_by_payment(array("paymentyear" => date("Y")));
	      	$lastEarn = 0;
	      	$percent = 0;
	      	$monthBalances = array();
	      	$hightEarn['hight'] = 0;
	      	$dataarr = array();
	      	$allMonths = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

			if(count($payments)) {
				foreach ($allMonths as $key => $allMonth) {
					foreach ($payments as $key => $payment) {
					    $paymentMonth = date("M", strtotime($payment->paymentdate));
					    if($allMonth == $paymentMonth) {
					      	$lastEarn+=$payment->paymentamount;
					      	$monthBalances[$allMonth] = $lastEarn;
					    } else {
					      	if(!array_key_exists($allMonth, $monthBalances)) {
					        	$monthBalances[$allMonth] = 0;
					      	}
					    }
					 }

				  	if($lastEarn > $hightEarn['hight']) {
				    	$hightEarn['hight'] = $lastEarn;
				  	}
				  	$lastEarn = 0;
				}

				foreach ($monthBalances as $monthBalancekey => $monthBalance) {
					$dataarr[] = $monthBalance;
				}


				$json = array("balance" => $dataarr);
				header("Content-Type: application/json", true);
				echo json_encode($json);
				exit;
			} else {
				foreach ($allMonths as $allMonth) {
					$dataarr[] = 0;
				}
				$json = array("balance" => $dataarr);
				header("Content-Type: application/json", true);
				echo json_encode($json);
				exit;

			}
		}
	}

}

/* End of file dashboard.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/dashboard.php */

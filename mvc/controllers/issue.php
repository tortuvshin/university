<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Issue extends Admin_Controller {
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
		$this->load->model("lmember_m");
		$this->load->model("book_m");
		$this->load->model("issue_m");
		$this->load->model("student_m");
		$this->load->model("parentes_m");
		
		$language = $this->session->userdata('lang');
		$this->lang->load('issue', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$ulID = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$lID = htmlentities(mysql_real_escape_string($this->input->post("lid")));
			if($lID != "" || !empty($lID)) {
				$this->data['issues'] = $this->issue_m->get_order_by_issue(array("lID" => $lID));
				$this->data["subview"] = "issue/index";
				$this->load->view('_layout_main', $this->data);
			} elseif($ulID) {
				$this->data['issues'] = $this->issue_m->get_order_by_issue(array("lID" => $ulID));
				$this->data["subview"] = "issue/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "issue/search";
				$this->load->view('_layout_main', $this->data);
			}

		} elseif($usertype == "Student") {
			$username = $this->session->userdata("username");			
			$student = $this->student_m->get_single_student(array("username" => $username));
			if($student->library === '1') {
				$lmember = $this->lmember_m->get_single_lmember(array('studentID' => $student->studentID));
				$lID = $lmember->lID;

				$this->data['issues'] = $this->issue_m->get_order_by_issue(array("lID" => $lID));
				$this->data["subview"] = "issue/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "issue/message";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['students'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$classesID = $checkstudent->classesID;
					$this->data['set'] = $id;

					if($checkstudent->library === '1') {
						$lmember = $this->lmember_m->get_single_lmember(array('studentID' => $checkstudent->studentID));
						$lID = $lmember->lID;

						$this->data['issues'] = $this->issue_m->get_order_by_issue(array("lID" => $lID));
						$this->data["subview"] = "issue/index_parent";
						$this->load->view('_layout_main', $this->data);
					} else {
						$this->data["subview"] = "issue/message_parent";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "issue/search_parent";
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
				'field' => 'lid', 
				'label' => $this->lang->line("issue_lid"), 
				'rules' => 'trim|required|xss_clean|max_length[40]|callback_unique_lID'
			), 
			array(
				'field' => 'bookID', 
				'label' => $this->lang->line("issue_bookID"),
				'rules' => 'trim|required|xss_clean|numeric'
			), 
			array(
				'field' => 'book', 
				'label' => $this->lang->line("issue_book"),
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_quantity|callback_unique_book'
			), 
			array(
				'field' => 'author', 
				'label' => $this->lang->line("issue_author"),
				'rules' => 'trim|required|xss_clean|max_length[100]|callback_match_bookauthor'
			),
			array(
				'field' => 'subject_code', 
				'label' => $this->lang->line("issue_subject_code"),
				'rules' => 'trim|required|xss_clean|max_length[20]'
			),
			array(
				'field' => 'serial_no', 
				'label' => $this->lang->line("issue_serial_no"),
				'rules' => 'trim|required|xss_clean|max_length[40]'
			),
			array(
				'field' => 'due_date', 
				'label' => $this->lang->line("issue_due_date"),
				'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid|callback_wrong_date'
			),
			array(
				'field' => 'fine', 
				'label' => $this->lang->line("issue_fine"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_valid_number'
			),
			array(
				'field' => 'note', 
				'label' => $this->lang->line("issue_note"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "issue/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"lID" => $this->input->post("lid"),
						"bookID" => $this->input->post("bookID"),
						"book" => $this->input->post("book"),
						"author" => $this->input->post("author"),
						"serial_no" => $this->input->post("serial_no"),
						"issue_date" => date("Y-m-d"),
						"due_date" => date("Y-m-d", strtotime($this->input->post("due_date"))),
						"fine" => $this->input->post("fine"),
						"note" => $this->input->post("note")
					);

					$quantity = $this->book_m->get_single_book(array("bookID" => $this->input->post("bookID")));
					$all_due_quantity = ($quantity->due_quantity)+1;

					$this->book_m->update_book(array("due_quantity" => $all_due_quantity), $this->input->post("bookID"));
					$this->issue_m->insert_issue($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("issue/index"));
				}
			} else {
				$this->data["subview"] = "issue/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$lID = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && $lID) {
				$this->data['issue'] = $this->issue_m->get_issue($id);
				$dbGet_bookID = $this->data['issue']->bookID;
				$this->data['bookinfo'] = $this->book_m->get_book($dbGet_bookID);

				if($this->data['issue']) {
					$this->data['set'] = $lID;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "issue/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"lID" => $this->input->post("lid"),
								"bookID" => $this->input->post("bookID"),
								"book" => $this->input->post("book"),
								"author" => $this->input->post("author"),
								"serial_no" => $this->input->post("serial_no"),
								"due_date" => date("Y-m-d", strtotime($this->input->post("due_date"))),
								"fine" => $this->input->post("fine"),
								"note" => $this->input->post("note")
							);

							$this->issue_m->update_issue($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("issue/index/$lID"));
						}
					} else {
						$this->data["subview"] = "issue/edit";
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
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian" || $usertype == "Student" || $usertype == "Parent") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['book'] = $this->issue_m->get_issue($id);
				if($this->data['book']) {
					$this->data["subview"] = "issue/view";
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

	public function fine() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			if($_POST) {
				$day = htmlentities(mysql_real_escape_string($this->input->post("day")));
				$month = htmlentities(mysql_real_escape_string($this->input->post("month")));
				$year = htmlentities(mysql_real_escape_string($this->input->post("year")));

				if($day !=0 && $month !=0 && $year !=0) {
					$date = $year."-".sprintf("%02s", $month)."-".sprintf("%02s", $day);
					$this->data["fines"] = $this->issue_m->get_order_by_issue(array("return_date" => $date));

					$this->data['day'] = $day;
					$this->data['month'] = $month;
					$this->data['year'] = $year;

					$this->data['url'] = $year."/".sprintf("%02s", $month)."/".sprintf("%02s", $day);
					$this->data["subview"] = "issue/fine";
					$this->load->view('_layout_main', $this->data);

				} elseif($month !=0 && $year !=0) {
					$likes = "";
					$array = array();
					$month = sprintf("%02s", $month);
					$data = $this->issue_m->get_issue();

					foreach ($data as $value) {
						if($value->return_date != "") {
							$likes = explode('-', $value->return_date);
							if($likes[1] == $month && $likes[0] == $year) {
								$array[] = $this->issue_m->get_issue($value->issueID);
							}
						}
					}
					$this->data["fines"] = $array;
					$this->data['url'] = $year."/".sprintf("%02s", $month)."/0";

					$this->data['day'] = 0;
					$this->data['month'] = $month;
					$this->data['year'] = $year;

					$this->data["subview"] = "issue/fine";
					$this->load->view('_layout_main', $this->data);
				} elseif($year !=0) {
					$likes = "";
					$array = array();
					$data = $this->issue_m->get_issue();

					foreach ($data as $value) {
						if($value->return_date != "") {
							$likes = explode('-', $value->return_date);
							if($likes[0] == $year) {
								$array[] = $this->issue_m->get_issue($value->issueID);
							}
						}
					}
					$this->data["fines"] = $array;
					$this->data['url'] = $year."/0/0";

					$this->data['day'] = 0;
					$this->data['month'] = 0;
					$this->data['year'] = $year;

					$this->data["subview"] = "issue/fine";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "issue/fine_select";
					$this->load->view('_layout_main', $this->data);
				}
			} else {

				$this->data["subview"] = "issue/fine_select";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
		
	}

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {

			$day = htmlentities(mysql_real_escape_string($this->uri->segment(5)));
			$month = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			$year = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			if((int)$year && $year !=0 && $month == 0 && $day == 0 ) {
				$likes = "";
				$array = array();
				$data = $this->issue_m->get_issue();

				foreach ($data as $value) {
					if($value->return_date != "") {
						$likes = explode('-', $value->return_date);
						if($likes[0] == $year) {
							$array[] = $this->issue_m->get_issue($value->issueID);
						}
					}
				}
				$this->data['fines'] = $array;
				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('issue_fine');
				$html = $this->load->view('issue/print_preview', $this->data, true);
				$this->html2pdf->html($html);
				$this->html2pdf->create();
			} elseif((int)$year && $year !=0 && (int)$month && $month != 0 && $day == 0) {
				$likes = "";
				$array = array();
				$month = sprintf("%02s", $month);
				$data = $this->issue_m->get_issue();

				foreach ($data as $value) {
					if($value->return_date != "") {
						$likes = explode('-', $value->return_date);
						if($likes[1] == $month && $likes[0] == $year) {
							$array[] = $this->issue_m->get_issue($value->issueID);
						}
					}
				}
				$this->data['fines'] = $array;
				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('issue_fine');
				$html = $this->load->view('issue/print_preview', $this->data, true);
				$this->html2pdf->html($html);
				$this->html2pdf->create();

			} elseif((int)$year && $year !=0 && (int)$month && $month != 0 && (int)$day && $day != 0) {
				$likes = "";
				$array = array();
				$data = $this->issue_m->get_issue();

				foreach ($data as $value) {
					if($value->return_date != "") {
						$likes = explode('-', $value->return_date);
						if($likes[0] == $year) {
							$array[] = $this->issue_m->get_issue($value->issueID);
						}
					}
				}
				$this->data['fines'] = $array;
			   	$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('issue_fine');
				$html = $this->load->view('issue/print_preview', $this->data, true);
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

	public function returnbook() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$lID = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && $lID) {
				$date = date("Y-m-d");
				$issue = $this->issue_m->get_issue($id);
				if($issue) {
					$dbGet_bookID = $issue->bookID;
					$book = $this->book_m->get_book($dbGet_bookID);
					$due_quantity = ($book->due_quantity-1);

					$this->book_m->update_book(array("due_quantity" => $due_quantity), $dbGet_bookID);
					$this->issue_m->update_issue(array("return_date" => $date), $id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("issue/index/$lID"));
				} else {
					redirect(base_url("issue/index/$lID"));
				}
			} else {
				redirect(base_url("issue/index/$lID"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function unique_quantity() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$bookID = $this->input->post("bookID");
		$author = $this->input->post("author");

		if($id) {
			if((int)$bookID) {
				$bookandauthor = $this->issue_m->get_single_issue(array("bookID" => $bookID, "issueID" => $id));

				if(count($bookandauthor)) {
					return TRUE;
				}
			} else {
				$this->form_validation->set_message("unique_quantity", "%s are not available.");
				return FALSE;
			}

		} else {
			if((int)$bookID) {
				$bookandauthor = $this->book_m->get_single_book(array("bookID" => $bookID));

				if(count($bookandauthor)) {
					if($bookandauthor->due_quantity >= $bookandauthor->quantity) {
						$this->form_validation->set_message("unique_quantity", "%s are not available.");
						return FALSE;
					}
					return TRUE;
				}
			} else {
				$this->form_validation->set_message("unique_quantity", "%s are not available.");
				return FALSE;
			}
		}	
	}

	function unique_lID() {
		$lID = $this->lmember_m->get_single_lmember(array("lID" => $this->input->post("lid")));
		if(!count($lID)) {
			$this->form_validation->set_message("unique_lID", "%s  is wrong.");
			return FALSE;	
		}
		return TRUE;
	}

	function unique_book() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if($id) {
			$book = $this->issue_m->get_single_issue(array("bookID" => $this->input->post("bookID"), "return_date" => NULL, "issueID" => $id));
			if(count($book)) {
				return TRUE;
			} else {
				$this->form_validation->set_message("unique_book", "%s already issue.");
				return FALSE;
			}
		} else {
			$book = $this->issue_m->get_single_issue(array("bookID" => $this->input->post("bookID"), "return_date" => NULL, "lID" => $this->input->post("lid")));
			if(count($book)) {
				$this->form_validation->set_message("unique_book", "%s already issue.");
				return FALSE;	
			}
			return TRUE;
		}
	}

	function wrong_date() {
		$due_date = date("Y-m-d", strtotime($this->input->post("due_date")));
		$date = date("Y-m-d");
		if($due_date < $date) {
			$this->form_validation->set_message("wrong_date", "%s is smaller of present date");
	     	return FALSE;
		} else {
			return TRUE;
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


	function bookcall() {
		$book = $this->input->post('book');
		if($book) {
			$allbook = $this->book_m->allbook($book);
			
			foreach ($allbook as $value) {
				echo "<li id='". $value->bookID ."'>".$value->book."</li>";
			}
		}
	}

	function bookIDcall() {
		$bookID = $this->input->post('bookID');
		if($bookID) {
			$bookinfo = $this->book_m->get_book($bookID);
			$author = $bookinfo->author;
			$subject_code = $bookinfo->subject_code;

			$json = array("author" => $author, "subject_code" => $subject_code);

			header("Content-Type: application/json", true);
			echo json_encode($json);
			exit;

		}
	}

	function authorcall() {
		$author = $this->input->post('author');
		if($author) {
			$allauthor = $this->book_m->allauthor($author);
			foreach ($allauthor as $value) {
				echo "<li>".$value->author."</li>";
				// echo $value->author;
			}
		}
	}

	function match_bookauthor() {
		$bookID = $this->input->post("bookID");
		$author = $this->input->post("author");

		if((int)$bookID && $bookID != "") {
			$bookandauthor = $this->book_m->get_single_book(array("bookID" => $bookID));
			if($bookandauthor) {
				if($bookandauthor->author == $author) {
					return TRUE;
				} else {
					$this->form_validation->set_message("match_bookauthor", "%s author dose not match.");
					return FALSE;
				}
			} else {
				$this->form_validation->set_message("match_bookauthor", "%s author dose not match.");
				return FALSE;
			}
		} else {
			$this->form_validation->set_message("match_bookauthor", "%s author dose not match.");
			return FALSE;
		}
	}

	function valid_number () {
		if($this->input->post('fine') && $this->input->post('fine') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

	public function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("issue/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("issue/index"));
		}
	}
}

/* End of file issue.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/issue.php */
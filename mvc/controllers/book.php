<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends Admin_Controller {
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
		$this->load->model("book_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('book', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian" || $usertype == "Student" || $usertype == "Parent" || $usertype == "Teacher") {
			$this->data['books'] = $this->book_m->get_order_by_book();
			$this->data["subview"] = "book/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'book', 
					'label' => $this->lang->line("book_name"), 
					'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_book'
				), 
				array(
					'field' => 'author', 
					'label' => $this->lang->line("book_author"),
					'rules' => 'trim|required|max_length[100]|xss_clean|callback_unique_book'
				), 
				array(
					'field' => 'subject_code', 
					'label' => $this->lang->line("book_subject_code"),
					'rules' => 'trim|required|max_length[20]|xss_clean|callback_unique_book'
				),
				array(
					'field' => 'price', 
					'label' => $this->lang->line("book_price"),
					'rules' => 'trim|required|numeric|max_length[10]|xss_clean|callback_valid_number'
				), 
				array(
					'field' => 'quantity', 
					'label' => $this->lang->line("book_quantity"), 
					'rules' => 'trim|required|numeric|max_length[10]|xss_clean|callback_valid_number_for_quantity'
				),
				array(
					'field' => 'rack', 
					'label' => $this->lang->line("book_rack_no"), 
					'rules' => 'trim|required|max_length[60]|xss_clean'
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
					$this->data["subview"] = "book/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"book" => $this->input->post("book"),
						"author" => $this->input->post("author"),
						"subject_code" => $this->input->post("subject_code"),
						"price" => $this->input->post("price"),
						"quantity" => $this->input->post("quantity"),
						"due_quantity" => 0,
						"rack" => $this->input->post("rack")
					);
					$this->book_m->insert_book($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("book/index"));
				}
			} else {
				$this->data["subview"] = "book/add";
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
				$this->data['book'] = $this->book_m->get_book($id);
				if($this->data['book']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data['form_validation'] = validation_errors(); 
							$this->data["subview"] = "book/add";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"book" => $this->input->post("book"),
								"author" => $this->input->post("author"),
								"subject_code" => $this->input->post("subject_code"),
								"price" => $this->input->post("price"),
								"quantity" => $this->input->post("quantity"),
								"rack" => $this->input->post("rack")
							);
							$this->book_m->update_book($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("book/index"));
						}
					} else {
						$this->data["subview"] = "book/edit";
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
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->book_m->delete_book($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("book/index"));
			} else {
				redirect(base_url("book/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function unique_book() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student = $this->book_m->get_order_by_book(array("book" => $this->input->post("book"), "bookID !=" => $id, "author" => $this->input->post('author'), "subject_code" => $this->input->post('subject_code')));
			if(count($student)) {
				$this->form_validation->set_message("unique_book", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$student = $this->book_m->get_order_by_book(array("book" => $this->input->post("book"), "author" => $this->input->post('author'), "subject_code" => $this->input->post('subject_code')));

			if(count($student)) {
				$this->form_validation->set_message("unique_book", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function valid_number() {
		if($this->input->post('price') && $this->input->post('price') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

	function valid_number_for_quantity() {
		if($this->input->post('quantity') && $this->input->post('quantity') < 0) {
			$this->form_validation->set_message("valid_number_for_quantity", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file book.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/book.php */
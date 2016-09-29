<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends Admin_Controller {
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
		$this->load->model("media_m");
		$this->load->model("media_category_m");
		$this->load->model("classes_m");
		$this->load->model("student_m");
		$this->load->model("media_share_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('media', $language);
		$this->load->helper("file");
	}

	public function index() {
		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		$this->data['userID'] = $userID;
		$share_table = $this->media_share_m->get_media_share();
		$this->data['folders'] = [];
		$this->data['files'] = [];
		if ($usertype=="Admin") {
			$this->data['folders'] = $this->media_category_m->get_media_category();
			$this->data['files'] = $this->media_m->get_order_by_media(array('mcategoryID'=>0));
			foreach ($share_table as $key => $item) {
				if ($item->public) {
					if (!$item->file_or_folder) {
						array_push($this->data['files'], $this->media_m->get_media($item->item_id));
					} else {
						array_push($this->data['folders'], $this->media_category_m->get_media_category($item->item_id));

					}
				}
			}
		} elseif($usertype=="Teacher") {
			$this->data['folders'] = $this->media_category_m->get_order_by_mcategory(array('userID'=> $userID, 'usertype'=>$usertype));
			$this->data['files'] = $this->media_m->get_order_by_media(array('userID'=> $userID, 'usertype'=>$usertype, 'mcategoryID'=>0));
			foreach ($share_table as $key => $item) {
				if ($item->public) {
					if (!$item->file_or_folder) {
						array_push($this->data['files'], $this->media_m->get_media($item->item_id));
					} else {
						array_push($this->data['folders'], $this->media_category_m->get_media_category($item->item_id));

					}
				}
			}
		} else {
			$classID = 0;
			if ($usertype=="Student") {
				$student = $this->student_m->get_student($userID);
				$classID = $student->classesID;
			}
			$file = [];
			$folder = [];
			foreach ($share_table as $key => $item) {
				if ($item->public) {
					if (!$item->file_or_folder) {
						array_push($file, $this->media_m->get_media($item->item_id));
					} else {
						array_push($folder, $this->media_category_m->get_media_category($item->item_id));

					}
				} elseif($item->classesID==$classID) {
					if (!$item->file_or_folder) {
						array_push($file, $this->media_m->get_media($item->item_id));
					} else {
						array_push($folder, $this->media_category_m->get_media_category($item->item_id));
					}
				}
			}
			$this->data['files'] = $file;
			$this->data['folders'] = $folder;

		}

		foreach ($this->data['files'] as $key => $share) {
			if ($share->usertype == "Admin") {
				$table = "systemadmin";
			} elseif($share->usertype == "Teacher") {
				$table = "teacher";
			}
			$query = $this->db->get_where($table, array($table.'ID' => $share->userID));
			$this->data['files'][$key] = (object) array_merge( (array)$share, array( 'shared_by' => $query->row()->name));
		}
		foreach ($this->data['folders'] as $key => $share_folder) {
			if ($share_folder->usertype == "Admin") {
				$table = "systemadmin";
			} elseif($share_folder->usertype == "Teacher") {
				$table = "teacher";
			}
			$query = $this->db->get_where($table, array($table.'ID' => $share_folder->userID));
			$this->data['folders'][$key] = (object) array_merge( (array)$share_folder, array( 'shared_by' => $query->row()->name));
		}

		$this->data['folders'] = array_map("unserialize", array_unique(array_map("serialize", $this->data['folders'])));
		$this->data['files'] = array_map("unserialize", array_unique(array_map("serialize", $this->data['files'])));

		$this->data["subview"] = "media/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function create_folder() {

		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		if ($usertype == "Admin" || $usertype == "Teacher") {
			$array = array();
			$array['userID'] = $userID;
			$array['usertype'] = $usertype;
			$array['folder_name'] = $this->input->post('folder_name');
			$this->form_validation->set_rules('folder_name', 'Folder name', 'required|trim|xss_clean|max_length[128]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', 'Some error occurred!');
			} else {
				if($this->media_category_m->insert_mcategory($array)) {
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				} else {
					$this->session->set_flashdata('error', 'Some error occurred!');
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Sorry! Folder not created.');
		}
	}

	public function view() {
		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		$this->data['userID'] = $userID;
		$folderID = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$folder_name = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
		$folder_info = $this->media_category_m->get_media_category($folderID);
		$this->data['f'] = $this->media_category_m->get_media_category($folderID);
		if ((int)$folderID) {
			if ($usertype=="Admin" || $usertype=="Teacher") {
				$this->data['files'] = $this->media_m->get_order_by_media(array("mcategoryID"=>$folderID));
				if(isset($_POST['upload_file'])) {
					if ($folder_info->userID == $userID && $folder_info->usertype == $usertype) {
						if(isset($_FILES['file']['name'])=="") {
						} else {
							$array = array();
							$array['userID'] = $userID;
							$array['usertype'] = $usertype;
							$array['mcategoryID'] = $folderID;
							$file_name = $_FILES["file"]['name'];
							$file_name_display = $_FILES["file"]['name'];
							$file_name_rename = rand(1, 100000000000);
				            $explode = explode('.', $file_name);
				            if(count($explode) >= 2) {
					            $new_file = $file_name_rename.'.'.$explode[1];
								$config['upload_path'] = "./uploads/media";
								$config['allowed_types'] = "gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx";
								$config['file_name'] = $new_file;
								$config['max_size'] = '1024';
								$config['max_width'] = '3000';
								$config['max_height'] = '3000';
								$array['file_name'] = $new_file;
								$array['file_name_display'] = $file_name_display;
								$this->load->library('upload', $config);
								if(!$this->upload->do_upload("file")) {
									$this->data["attachment_error"] = $this->upload->display_errors();
									$this->session->set_flashdata('error', 'invalid file format! please upload only gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx files');
									redirect(base_url("media/view/$folderID/$folder_name"));
								} else {
									$data = array("upload_data" => $this->upload->data());
									$this->media_m->insert_media($array);
									$this->session->set_flashdata('success', $this->lang->line('menu_success'));
									redirect(base_url("media/view/$folderID/$folder_name"));
								}
							} else {
								$this->data["attachment_error"] = "Invalid file";
								$this->session->set_flashdata('error', 'invalid file format! please upload only gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx files');
								redirect(base_url("media/view/$folderID/$folder_name"));
							}
						}
					} else {
						$this->session->set_flashdata('error', 'You are not authorized to upload files in this folder!');
						redirect(base_url('media/view/'.$folderID),'refresh');
					}
				}
			} else {
				$this->data['files'] = $this->media_m->get_order_by_media(array("mcategoryID"=>$folderID));
			}
			foreach ($this->data['files'] as $key => $share) {
				if ($share->usertype == "Admin") {
					$table = "systemadmin";
				} elseif($share->usertype == "Accountant" || $share->usertype== "Librarian") {
					$table = "user";
				} else {
					$table = strtolower($share->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $share->userID));
				$this->data['files'][$key] = (object) array_merge( (array)$share, array( 'shared_by' => $query->row()->name));
			}
			$this->data["subview"] = "media/view";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}

	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'file',
					'label' => $this->lang->line("file"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher" ) {
			$userID = $this->userID();

			if($_FILES['file']['name']=="") {
				$this->session->set_flashdata('error', 'Please select file!');
				redirect(base_url('media/index'));
			} else {
				$array = array();
				$array['userID'] = $userID;
				$array['usertype'] = $usertype;
				$file_name = $_FILES["file"]['name'];
				$file_name_display = $_FILES["file"]['name'];
				$file_name_rename = rand(1, 100000000000);
	            $explode = explode('.', $file_name);
	            if(count($explode) >= 2) {
		            $new_file = $file_name_rename.'.'.$explode[1];
					$config['upload_path'] = "./uploads/media";
					$config['allowed_types'] = "gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx";
					$config['file_name'] = $new_file;
					$config['max_size'] = '1024';
					$config['max_width'] = '3000';
					$config['max_height'] = '3000';
					$array['file_name'] = $new_file;
					$array['file_name_display'] = $file_name_display;
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload("file")) {
						$this->data["attachment_error"] = $this->upload->display_errors();
						$this->session->set_flashdata('error', 'invalid file format! please upload only gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx files');
						redirect(base_url("media/index"));
					} else {
						$data = array("upload_data" => $this->upload->data());
						$this->media_m->insert_media($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("media/index"));
					}
			 	} else {
					$this->data["attachment_error"] = "Invalid file";
					$this->session->set_flashdata('error', 'invalid file format! please upload only gif|jpg|png|pdf|docx|doc|csv|txt|ppt|xls|xlsx files');
					redirect(base_url("media/index"));
				}
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function media_share() {
		$usertype = $this->session->userdata('usertype');
		if ($usertype=="Admin" || $usertype=="Teacher") {
			if ($this->input->post('share_with') == "0") {
				$this->session->set_flashdata('error', 'Please select share with!');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$array = array();
				$media_info = $this->input->post('media_info');
				$array['classesID']	= $this->input->post('classesID');
				if (strpos($media_info,'folder') !== false) {
				    $folderID = explode("folder",$this->input->post('media_info'));
				    $array['file_or_folder'] = 1;
				    $array['item_id'] = $folderID['1'];
					$is_shared_media = $this->media_share_m->get_single(array('file_or_folder'=> 1,'item_id' => $array['item_id']));
				} else {
					$array['file_or_folder'] = 0;
					$array['item_id'] = $this->input->post('media_info');
					$is_shared_media = $this->media_share_m->get_single(array('file_or_folder'=> 0,'item_id' => $array['item_id']));
				}

				if ($this->input->post('share_with')=="public") {
					$array['public']	= 1;
				} else {
					$array['public']	= 0;
				}

				if (count($is_shared_media)) {
					if ($this->media_share_m->update_media_share($array, $is_shared_media->shareID)) {
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect($_SERVER['HTTP_REFERER']);
					} else {
						$this->session->set_flashdata('error', 'error occured!');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} else {
					if ($this->media_share_m->insert_media_share($array)) {
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect($_SERVER['HTTP_REFERER']);
					} else {
						$this->session->set_flashdata('error', 'error occured!');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}

	}


	public function deletef() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if($id) {
				$all_files = $this->media_m->get_order_by_media(array("mcategoryID"=>$id));
				if (count($all_files)) {
					foreach ($all_files as $file) {
						$path = "uploads/media/".$file->file_name;
						if(unlink($path)) {
							$this->media_m->delete_media($file->mediaID);
						}
					}
				}
				$this->media_share_m->delete_share_folder($id);
				$this->media_category_m->delete_mcategory($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("media/index"));
			} else {
				redirect(base_url("media/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if($id) {
				$file = $this->media_m->get_media($id);
				$path = "uploads/media/".$file->file_name;
				if (unlink($path)) {
					$this->media_share_m->delete_share_file($id);
					$this->media_m->delete_media($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				}
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	public function userID()
	{
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
	function classcall() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$allclass = $this->classes_m->get_classes();
			echo "<option value='0'>", $this->lang->line("all_class"),"</option>";
			foreach ($allclass as $value) {
				echo "<option value=\"$value->classesID\">",$value->classes,"</option>";
			}
		}
	}
}

/* End of file media.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/media.php */

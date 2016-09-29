<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkimport extends Admin_Controller {
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
		$language = $this->session->userdata('lang');
        $this->load->model("teacher_m");
        $this->load->model("parentes_m");
        $this->load->model("student_m");
        $this->load->model("user_m");
        $this->load->model("book_m");
		$this->lang->load('bulkimport', $language);
        $this->load->library('csvimport');
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data["subview"] = "bulkimport/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
    public function unique_email()
    {
        $this->db->select('email');
        $query = $this->db->get('teacher');
        $teacher_emails = $query->result();
        $this->db->select('email');
        $query1 = $this->db->get('student');
        $std_emails = $query1->result();
        $this->db->select('email');
        $query2 = $this->db->get('parent');
        $parent_emails = $query2->result();
        $this->db->select('email');
        $query3 = $this->db->get('user');
        $user_emails = $query3->result();
        $this->db->select('email');
        $query4 = $this->db->get('systemadmin');
        $systemadmin_emails = $query4->result();
        $emails = array_merge($teacher_emails,$std_emails, $parent_emails,$user_emails, $systemadmin_emails);
        $result = array();
        foreach ($emails as $key => $value) {
            array_push($result, $value->email);
        }
        return $result;
    }
    public function unique_username() {
        $this->db->select('username');
        $query = $this->db->get('teacher');
        $teacher_usernames = $query->result();
        $this->db->select('username');
        $query1 = $this->db->get('student');
        $std_usernames = $query1->result();
        $this->db->select('username');
        $query2 = $this->db->get('parent');
        $parent_usernames = $query2->result();
        $this->db->select('username');
        $query3 = $this->db->get('user');
        $user_usernames = $query3->result();
        $this->db->select('username');
        $query4 = $this->db->get('systemadmin');
        $systemadmin_usernames = $query4->result();
        $usernames = array_merge($teacher_usernames,$std_usernames, $parent_usernames,$user_usernames, $systemadmin_usernames);
        $result = array();
        foreach ($usernames as $key => $value) {
            array_push($result, $value->username);
        }
        return $result;
    }
    public function teacher_bulkimport() {
        if(isset($_FILES["csvFile"])) {
            $all_useremails = $this->unique_email();
            $all_usernames = $this->unique_username();

            $config['upload_path'] = "./uploads/csv/";
            $config['allowed_types'] = 'text/plain|text/csv|csv';
            $config['max_size'] = '2048';
            $config['file_name'] = $_FILES["csvFile"]['name'];
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("csvFile")) {
                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                redirect(base_url("bulkimport/index"));
            } else {
                $file_data = $this->upload->data();
                $file_path =  './uploads/csv/'.$file_data['file_name'];

                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                    foreach ($csv_array as $row) {
                        if (in_array($row['Email'], $all_useremails)) {
                            $this->session->set_flashdata('error', "Some row not added because email already exist");
                        } else {
                            if (in_array($row['Username'], $all_usernames)) {
                                $this->session->set_flashdata('error', "Some row not added because username already exist");
                            } else {
                                $insert_data = array(
                                    'name'=>$row['Name'],
                                    'designation'=>$row['Designation'],
                                    'dob'=>$row['Dob'],
                                    'sex'=>$row['Gender'],
                                    'religion'=>$row['Religion'],
                                    'email'=>$row['Email'],
                                    'phone'=>$row['Phone'],
                                    'address'=>$row['Address'],
                                    'jod'=>$row['Jod'],
                                    'username'=>$row['Username'],
                                    'password'=> $this->teacher_m->hash($row['Password']),
                                    'usertype'=>'Teacher',
																		"create_date" => date("Y-m-d h:i:s"),
																		"modify_date" => date("Y-m-d h:i:s"),
																		"create_userID" => $this->session->userdata('loginuserID'),
																		"create_username" => $this->session->userdata('username'),
																		"create_usertype" => $this->session->userdata('usertype'),
																		"teacheractive" => 1,
                                );
                                $this->teacher_m->insert_teacher($insert_data);
                            }
                        }
                    }
                    $this->session->set_flashdata('success', $this->lang->line('import_success'));
                    redirect(base_url("bulkimport/index"));
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('import_error'));
                    redirect(base_url("bulkimport/index"));
                }

            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('import_error'));
            redirect(base_url("bulkimport/index"));
        }
    }
    public function parent_bulkimport() {
        if(isset($_FILES["csvParent"])) {
            $all_useremails = $this->unique_email();
            $all_usernames = $this->unique_username();

            $config['upload_path'] = "./uploads/csv/";
            $config['allowed_types'] = 'text/plain|text/csv|csv';
            $config['max_size'] = '2048';
            $config['file_name'] = $_FILES["csvParent"]['name'];
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("csvParent")) {
                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                redirect(base_url("bulkimport/index"));
            } else {
                $file_data = $this->upload->data();
                $file_path =  './uploads/csv/'.$file_data['file_name'];

                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                    foreach ($csv_array as $row) {
                        if (in_array($row['Email'], $all_useremails)) {
                            $this->session->set_flashdata('error', "Some row not added because email already exist");
                        } else {
                            if (in_array($row['Username'], $all_usernames)) {
                                $this->session->set_flashdata('error', "Some row not added because username already exist");
                            } else {
                                $insert_data = array(
                                    'name'=>$row['Name'],
                                    'father_name'=>$row['Father Name'],
                                    'mother_name'=>$row['Mother Name'],
                                    'father_profession'=>$row['Father Profession'],
                                    'mother_profession'=>$row['Mother Profession'],
                                    'email'=>$row['Email'],
                                    'phone'=>$row['Phone'],
                                    'address'=>$row['Address'],
                                    'username'=>$row['Username'],
                                    'password'=> $this->parentes_m->hash($row['Password']),
                                    'usertype'=>'Parent',
																		"create_date" => date("Y-m-d h:i:s"),
																		"modify_date" => date("Y-m-d h:i:s"),
																		"create_userID" => $this->session->userdata('loginuserID'),
																		"create_username" => $this->session->userdata('username'),
																		"create_usertype" => $this->session->userdata('usertype'),
																		"parentactive" => 1,
                                );
                                $this->parentes_m->insert_parentes($insert_data);
                            }
                        }
                    }
                    $this->session->set_flashdata('success', $this->lang->line('import_success'));
                    redirect(base_url("bulkimport/index"));
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('import_error'));
                    redirect(base_url("bulkimport/index"));
                }

            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('import_error'));
            redirect(base_url("bulkimport/index"));
        }
    }
    public function student_bulkimport() {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin") {
            if(isset($_FILES["csvStudent"])) {
                $config['upload_path'] = "./uploads/csv/";
                $config['allowed_types'] = 'text/plain|text/csv|csv';
                $config['max_size'] = '2048';
                $config['file_name'] = $_FILES["csvStudent"]['name'];
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload("csvStudent")) {
                    $this->session->set_flashdata('error', $this->lang->line('import_error'));
                    redirect(base_url("bulkimport/index"));
                } else {
                    $file_data = $this->upload->data();
                    $file_path =  './uploads/csv/'.$file_data['file_name'];

                    if ($this->csvimport->get_array($file_path)) {
                        $csv_array = $this->csvimport->get_array($file_path);
                        foreach ($csv_array as $row) {
                            $classID = $this->getClass($row['Class']);
                            $sectionID = $this->getSection($classID, $row['Section']);

                            if ($classID=='error' || $sectionID=='error') {
                                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                            } else {
                                $dbmaxyear = $this->student_m->get_order_by_student_single_max_year($classID);
                                $maxyear = "";
                                if(count($dbmaxyear)) {
                                    $maxyear = $dbmaxyear->year;
                                } else {
                                    $maxyear = date("Y");
                                }
                                $insert_data = array(
                                    'name'=>$row['Name'],
                                    'dob'=>$row['Dob'],
                                    'sex'=>$row['Gender'],
                                    'religion'=>$row['Religion'],
                                    'email'=>$row['Email'],
                                    'phone'=>$row['Phone'],
                                    'address'=>$row['Address'],
                                    'classesID'=>$classID,
                                    'sectionID'=>$sectionID->sectionID,
                                    'section'=>$sectionID->section,
                                    'roll' => $row['Roll'],
                                    'username'=>$row['Username'],
                                    'password'=> $this->student_m->hash($row['Password']),
                                    'usertype'=>'Student',
                                    'library' => 0,
                                    'hostel' => 0,
                                    'transport' => 0,
                                    'year' => $maxyear,
																		"create_date" => date("Y-m-d h:i:s"),
																		"modify_date" => date("Y-m-d h:i:s"),
																		"create_userID" => $this->session->userdata('loginuserID'),
																		"create_username" => $this->session->userdata('username'),
																		"create_usertype" => $this->session->userdata('usertype'),
																		"studentactive" => 1,
                                );
                                // dump($insert_data);
                                $this->student_m->insert_student($insert_data);
                            }
                        }
                        $this->session->set_flashdata('success', $this->lang->line('import_success'));
                        redirect(base_url("bulkimport/index"));
                    } else {
                        $this->session->set_flashdata('error', $this->lang->line('import_error'));
                        redirect(base_url("bulkimport/index"));
                    }

                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                redirect(base_url("bulkimport/index"));
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorised'));
            redirect(base_url("bulkimport/index"));
        }
    }
    public function user_bulkimport() {
        if(isset($_FILES["csvUser"])) {
            $all_useremails = $this->unique_email();
            $all_usernames = $this->unique_username();

            $config['upload_path'] = "./uploads/csv/";
            $config['allowed_types'] = 'text/plain|text/csv|csv';
            $config['max_size'] = '2048';
            $config['file_name'] = $_FILES["csvUser"]['name'];
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("csvUser")) {
                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                redirect(base_url("bulkimport/index"));
            } else {
                $file_data = $this->upload->data();
                $file_path =  './uploads/csv/'.$file_data['file_name'];

                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                    foreach ($csv_array as $row) {
                        if (in_array($row['Email'], $all_useremails)) {
                            $this->session->set_flashdata('error', "Some row not added because email already exist");
                        } else {
                            if (in_array($row['Username'], $all_usernames)) {
                                $this->session->set_flashdata('error', "Some row not added because username already exist");
                            } else {
                                $insert_data = array(
                                    'name'=>$row['Name'],
                                    'dob'=>$row['Dob'],
                                    'sex'=>$row['Gender'],
                                    'religion'=>$row['Religion'],
                                    'email'=>$row['Email'],
                                    'phone'=>$row['Phone'],
                                    'address'=>$row['Address'],
                                    'jod'=>$row['Jod'],
                                    'username'=>$row['Username'],
                                    'password'=> $this->user_m->hash($row['Password']),
                                    'usertype'=> ucfirst($row['Usertype']),
																		"create_date" => date("Y-m-d h:i:s"),
																		"modify_date" => date("Y-m-d h:i:s"),
																		"create_userID" => $this->session->userdata('loginuserID'),
																		"create_username" => $this->session->userdata('username'),
																		"create_usertype" => $this->session->userdata('usertype'),
																		"useractive" => 1,
                                );
                                $this->user_m->insert_user($insert_data);
                            }
                        }
                    }
                    $this->session->set_flashdata('success', $this->lang->line('import_success'));
                    redirect(base_url("bulkimport/index"));
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('import_error'));
                    redirect(base_url("bulkimport/index"));
                }

            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('import_error'));
            redirect(base_url("bulkimport/index"));
        }
    }
    public function book_bulkimport() {
        if(isset($_FILES["csvBook"])) {
            $config['upload_path'] = "./uploads/csv/";
            $config['allowed_types'] = 'text/plain|text/csv|csv';
            $config['max_size'] = '2048';
            $config['file_name'] = $_FILES["csvBook"]['name'];
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("csvBook")) {
                $this->session->set_flashdata('error', $this->lang->line('import_error'));
                redirect(base_url("bulkimport/index"));
            } else {
                $file_data = $this->upload->data();
                $file_path =  './uploads/csv/'.$file_data['file_name'];

                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                    foreach ($csv_array as $row) {
                        $insert_data = array(
                            'book'=>$row['Book'],
                            'subject_code'=>$row['Subject code'],
                            'author'=>$row['Author'],
                            'price'=>$row['Price'],
                            'quantity'=>$row['Quantity'],
                            'due_quantity'=>0,
                            'rack'=>$row['Rack']
                        );
                        $this->book_m->insert_book($insert_data);
                    }
                    $this->session->set_flashdata('success', $this->lang->line('import_success'));
                    redirect(base_url("bulkimport/index"));
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('import_error'));
                    redirect(base_url("bulkimport/index"));
                }

            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('import_error'));
            redirect(base_url("bulkimport/index"));
        }
    }
    public function getClass($className)
    {
        $usertype = $this->session->userdata("usertype");
        if ($className) {
            $query = $this->db->query("SELECT classesID FROM `classes` WHERE `classes_numeric` = '$className' OR `classes` = '$className'");
            if (empty($query)) {
                return 'error';
            } else {
                return $query->row('classesID');
            }

        } else {
            return "error";
        }
    }
    public function getSection($className, $section)
    {

        if ($className) {
            $query = $this->db->query("SELECT sectionID, section FROM `section` WHERE `classesID` = '$className' AND `section` = '$section'");
            if (empty($query)) {
                return 'error';
            } else {
                return $query->row();
            }

        } else {
            return "error";
        }
    }


}

/* End of file bulkimport.php */
/* Location: .//var/www/html/schoolv2/mvc/controllers/bulkimport.php */

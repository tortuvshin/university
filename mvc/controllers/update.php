<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends Admin_Controller {
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
		$this->load->model("update_m");
		$this->load->model("setting_m");
		$this->lang->load('update', $language);
	}

	// public function index() {
	// 	$usertype = $this->session->userdata("usertype");
 // 		if($usertype == "Admin") {
	// 		$this->data["subview"] = "update/index";
	// 		$this->load->view('_layout_main', $this->data);
	// 	} else {
	// 		$this->data["subview"] = "error";
	// 		$this->load->view('_layout_main', $this->data);
	// 	}
	// }
	public function index()
	{
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin") {
			if ($_POST) {
				$setting = $this->setting_m->get_setting();
				$setting = $setting[0];

				// dump($this->update_m->update_data('classes', 'create_date', '2016-03-05 02:03:52'));
				// die;

				$now = date('Y-m-d H:m:i');

				$systemadmin = [
					'name' => $setting->name,
					'phone' => $setting->phone,
					'address' => $setting->address,
					'email' => $setting->email,
					'username' => $setting->username,
					'password' => $setting->password,
					'usertype' => $setting->usertype,
					'dob' => $now,
					'jod' => $now,
					'sex' => 'Male',
					'create_date' => $now,
					'modify_date' => $now,
					'create_userID' => 1,
					'create_username' => $setting->username,
					'create_usertype' => $setting->usertype,
					'systemadminactive' => 1
				];



				$modify = array();
		        $modify['classes'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ]
		        ];

				$modify['section'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'extra',
						'action' => 'delete',
		            ]
		        ];

				$modify['student'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'studentactive',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['subject'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'subjectactive',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['teacher'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'teacheractive',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['parent'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'parentactive',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['user'] = [
		            [
		                'field_name' => 'create_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'modify_date',
						'value' => $now,
						'type' => 'datetime',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_userID',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_username',
						'value' => $setting->username,
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'create_usertype',
						'value' => 'Admin',
						'type' => 'varchar(20)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'useractive',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['message'] = [
		            [
		                'field_name' => 'attach_file_name',
						'value' => NULL,
						'type' => 'text',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'useremail',
						'value' => NULL,
						'type' => 'varchar(40)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'reply_status',
						'value' => 0,
						'type' => 'INT(11)',
						'action' => 'add',
		            ]
		        ];

				$modify['setting'] = [
		            [
		                'field_name' => 'language',
						'value' => 'english',
						'type' => 'varchar(50)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'theme',
						'value' => 'Basic',
						'type' => 'varchar(255)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'fontorbackend',
						'value' => 1,
						'type' => 'INT(11)',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'updateversion',
						'value' => 1,
						'type' => 'text',
						'action' => 'add',
		            ],
		            [
						'field_name' => 'name',
						'action' => 'delete',
		            ],
		            [
						'field_name' => 'username',
						'action' => 'delete',
		            ],
		            [
						'field_name' => 'password',
						'action' => 'delete',
		            ],
		            [
						'field_name' => 'usertype',
						'action' => 'delete',
		            ]
		        ];

				$new = array();
				$new = [
					'event' => "
						CREATE TABLE IF NOT EXISTS event (
						 eventID int(11) unsigned NOT NULL AUTO_INCREMENT,
						 fdate date NOT NULL,
						 ftime time NOT NULL,
						 tdate date NOT NULL,
						 ttime time NOT NULL,
						 title varchar(128) NOT NULL,
						 details text NULL,
						 photo varchar(200) DEFAULT NULL,
						 create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						 PRIMARY KEY (eventID)
						)",
					'eventcounter' => "
						CREATE TABLE IF NOT EXISTS eventcounter (
						  eventcounterID int(11) unsigned NOT NULL AUTO_INCREMENT,
						  eventID int(11) NOT NULL,
						  username varchar(40) NOT NULL,
						  type varchar(20) NOT NULL,
						  name varchar(128) NOT NULL,
						  photo varchar(200) DEFAULT NULL,
						  status int(11) NOT NULL,
						  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (eventcounterID)
						 )",
					'holiday' => "
						CREATE TABLE IF NOT EXISTS holiday (
						  holidayID int(11) unsigned NOT NULL AUTO_INCREMENT,
						  fdate date NOT NULL,
						  tdate date NOT NULL,
						  title varchar(128) NOT NULL,
						  details text NOT NULL,
						  photo varchar(200) DEFAULT NULL,
						  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (holidayID)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ",
					'leaveapp' => "
						CREATE TABLE IF NOT EXISTS leaveapp (
						  leaveID int(11) unsigned NOT NULL AUTO_INCREMENT,
						  fdate date NOT NULL,
						  tdate date NOT NULL,
						  title varchar(128) NOT NULL,
						  details text NOT NULL,
						  tousername varchar(40) NOT NULL,
						  fromusername varchar(40) NOT NULL,
						  status int(11) NOT NULL DEFAULT '0',
						  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (leaveID)
						)",
					'systemadmin' => "
						CREATE TABLE IF NOT EXISTS systemadmin (
						  systemadminID int(11) unsigned NOT NULL AUTO_INCREMENT,
						  name varchar(60) NOT NULL,
						  dob date NOT NULL,
						  sex varchar(10) NOT NULL,
						  religion varchar(25) DEFAULT NULL,
						  email varchar(40) DEFAULT NULL,
						  phone tinytext,
						  address text,
						  jod date NOT NULL,
						  photo varchar(200) DEFAULT NULL,
						  username varchar(40) NOT NULL,
						  password varchar(128) NOT NULL,
						  usertype varchar(20) NOT NULL,
						  create_date datetime NOT NULL,
						  modify_date datetime NOT NULL,
						  create_userID int(11) NOT NULL,
						  create_username varchar(40) NOT NULL,
						  create_usertype varchar(20) NOT NULL,
						  systemadminactive int(11) NOT NULL,
						  systemadminextra1 varchar(128) DEFAULT NULL,
						  systemadminextra2 varchar(128) DEFAULT NULL,
						  PRIMARY KEY (systemadminID)
						)",
					'visitorinfo' => "
						CREATE TABLE IF NOT EXISTS visitorinfo (
						  visitorID bigint(12) unsigned NOT NULL AUTO_INCREMENT,
						  name varchar(60) DEFAULT NULL,
						  email_id varchar(128) DEFAULT NULL,
						  phone text NOT NULL,
						  photo varchar(128) DEFAULT NULL,
						  company_name varchar(128) DEFAULT NULL,
						  coming_from varchar(128) DEFAULT NULL,
						  to_meet varchar(128) DEFAULT NULL,
						  representing varchar(128) DEFAULT NULL,
						  to_meet_personID int(11) NOT NULL,
						  to_meet_person_usertype varchar(40) NOT NULL,
						  check_in timestamp NULL DEFAULT NULL,
						  check_out timestamp NULL DEFAULT NULL,
						  status int(11) NOT NULL,
						  PRIMARY KEY (visitorID)
						)",
					'sub_attendance' => "
						CREATE TABLE IF NOT EXISTS sub_attendance (
						  attendanceID int(200) unsigned NOT NULL AUTO_INCREMENT,
						  studentID int(11) NOT NULL,
						  classesID int(11) NOT NULL,
						  subjectID int(11) NOT NULL,
						  userID int(11) NOT NULL,
						  usertype varchar(20) NOT NULL,
						  monthyear varchar(10) NOT NULL,
						  a1 varchar(3) DEFAULT NULL,
						  a2 varchar(3) DEFAULT NULL,
						  a3 varchar(3) DEFAULT NULL,
						  a4 varchar(3) DEFAULT NULL,
						  a5 varchar(3) DEFAULT NULL,
						  a6 varchar(3) DEFAULT NULL,
						  a7 varchar(3) DEFAULT NULL,
						  a8 varchar(3) DEFAULT NULL,
						  a9 varchar(3) DEFAULT NULL,
						  a10 varchar(3) DEFAULT NULL,
						  a11 varchar(3) DEFAULT NULL,
						  a12 varchar(3) DEFAULT NULL,
						  a13 varchar(3) DEFAULT NULL,
						  a14 varchar(3) DEFAULT NULL,
						  a15 varchar(3) DEFAULT NULL,
						  a16 varchar(3) DEFAULT NULL,
						  a17 varchar(3) DEFAULT NULL,
						  a18 varchar(3) DEFAULT NULL,
						  a19 varchar(3) DEFAULT NULL,
						  a20 varchar(3) DEFAULT NULL,
						  a21 varchar(3) DEFAULT NULL,
						  a22 varchar(3) DEFAULT NULL,
						  a23 varchar(3) DEFAULT NULL,
						  a24 varchar(3) DEFAULT NULL,
						  a25 varchar(3) DEFAULT NULL,
						  a26 varchar(3) DEFAULT NULL,
						  a27 varchar(3) DEFAULT NULL,
						  a28 varchar(3) DEFAULT NULL,
						  a29 varchar(3) DEFAULT NULL,
						  a30 varchar(3) DEFAULT NULL,
						  a31 varchar(3) DEFAULT NULL,
						  PRIMARY KEY (attendanceID)
						)"
				];


				foreach ($new as $value) {
					$this->update_m->create_table($value);
				}

				// add columns
				foreach ($modify as $key => $changes) {
					$table_name = $key;
					foreach ($changes as $value) {
						if($value['action']=='add') {
							$this->update_m->add_field($table_name, $value['field_name'], $value['type']);
						} elseif ($value['action']=='delete') {
							$this->update_m->delete_field($table_name, $value['field_name']);
						}
					}
				}

				// update new columns after adding all new colums and optimize time complexity
				foreach ($modify as $key => $changes) {
					$table_name = $key;
					foreach ($changes as $value) {
						if($value['action']=='add' && $value['value']!=NULL) {
							$this->update_m->update_data($table_name, $value['field_name'], $value['value']);
						}
					}
				}

		        // dump($this->update_m->update_data('classes', 'create_date', '2016-03-05 02:03:52'));
		        echo base_url('signin/signout');

			} else {
				$this->data["subview"] = "update/index";
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
				'field' => 'classes',
				'label' => $this->lang->line("classes_name"),
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_classes'
			),
			array(
				'field' => 'classes_numeric',
				'label' => $this->lang->line("classes_numeric"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_unique_classes_numeric|callback_valid_number'
			),
			array(
				'field' => 'teacherID',
				'label' => $this->lang->line("teacher_name"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_allteacher'
			),
			array(
				'field' => 'note',
				'label' => $this->lang->line("classes_note"),
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function upload() {
		if($_FILES["file"]['name'] !="") {
			$filename = $_FILES['file']['name'];

			$config['upload_path'] = "./uploads/images";
			$config['allowed_types'] = "zip";
			$config['file_name'] = $filename;
			$config['max_size'] = '1102400';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("file")) {
				$error = $this->upload->display_errors();
				echo $error;
			} else {
				$data = array("upload_data" => $this->upload->data());
				$file_path = $config['upload_path'].'/'.$filename;
				if (file_exists($file_path)) {
				    $zip = new ZipArchive;
					if ($zip->open($file_path) === TRUE) {
					    $zip->extractTo($config['upload_path']);
					    $zip->close();

					    $explode = explode('.', $file_path);
					    $path = '.'.$explode[1].'/';
					    exec('chmod -R 777 '.$path);


					    $destination = FCPATH;
					    $this->smartCopy($path , $destination);
					    $string = file_get_contents($path.'inilabs.json');
						$json_a = json_decode($string, true);

						echo $json_a['database']['status'];


					} else {
					    echo 'failed';
					    echo "Extract zip files failed.";
					}
				} else {
					echo "File not found.";
				}

			}
		} else {
			echo 'File missing or check your upload file MB permission of php.ini file';
		}
	}


    function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) {
        $result=false;

        if (is_file($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result=copy($source, $__dest);
            //chmod($__dest,$options['filePermission']);

        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                   // chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                     if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    //echo "$source/$file ||| $__dest<br />";
                    $result=$this->smartCopy($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);

        } else {
            $result=false;
        }
        return $result;
    }

}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */

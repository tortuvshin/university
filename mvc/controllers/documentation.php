<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentation extends Admin_Controller {

	public function index() {
			$this->load->view('documentation/index', $this->data);
	}
}

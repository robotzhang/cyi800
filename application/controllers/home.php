<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->view('home/index.php');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->layout->setLayout(array('css'=>array(base_url().'static/stylesheets/home.css')));
	}
	
	public function index()
	{		
		$this->layout->view('home/index.php');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
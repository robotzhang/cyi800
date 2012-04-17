<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->layout->setLayout(array('name' => 'layout/admin', 'css'=>array(base_url().'static/stylesheets/admin.css')));
		$this->load->model('productmodel', 'product');
	}
	
	public function index()
	{			
		$records = $this->product->records(array(), is_numeric($this->input->get('page')) ? $this->input->get('page') : 1);
		$this->load->library('page', array('total' => $this->product->last_query_number));
		
		$this->layout->view('admin/list', array('records' => $records, 'pagination' => $this->page->create()));
	}
	
	public function modify($id = 0)
	{
		$record = $this->product->getById($id);
		if (empty($_POST)) {
			$this->layout->view('admin/modify.php', array('record' => $record));
			return;
		}
		
		$data = $this->product->renderData($this->input->post());		
		if (is_numeric($data->id) && $this->product->isExist($data->id)) {
			$result =$this->product->update($data);
		} else {
			unset($data->id);
			$result =$this->product->add($data);
		}

		$result === TRUE ? redirect('admin') : $this->layout->view('admin/modify.php', array('record' => $data));
	}
	
	public function delete()
	{
		
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/admin.php */
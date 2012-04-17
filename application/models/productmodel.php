<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productmodel extends MY_Model
{
	var $table = 'products';
	var $validation = array(
		array('field' => 'name', 'label' => '文章标题', 'rules' => 'required|max_length[255]|min_length[4]'),
		array('field' => 'brief', 'label' => '简短描述', 'rules' => 'required|max_length[100]|min_length[4]'),
		array('field' => 'description', 'label' => '文章内容', 'rules' => 'required'),
		array('field' => 'buy_url', 'label' => '购买链接'),
		array('field' => 'category', 'label' => '产品分类', 'rules' => 'required')
	);
}

/* End of file productmodel.php */
/* Location: ./application/models/productmodel.php */
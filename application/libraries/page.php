<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 系统分页类
 * @author 黑暗人魔
 * @date 2011-6-15
 * */
class Page
{
    var $CI;//CI系统库
	
	var $now = null;//当前页数
    var $pages = 0;//总页数
    var $base_url = '';//分页基本链接
    var $total = 0;//总记录数
    var $offset = 20; //每页显示条数
	var $template = 'comm/page.php'; //分页模板所在位置
    
    function Page($config)
    {
		foreach ($config as $key => $value) {
			if (isset($this->{$key})) {
				$this->{$key} = $value;
			}
		}
        $this->CI = & get_instance();//不是在controller中可以通过这种方法获取CI的实例
		if (empty($this->base_url)) {
			$this->base_url = $this->subStr(current_url(), '?') .'/?'. $this->subStr($_SERVER['QUERY_STRING'], '&page=');
		}
		//计算总页数
		$this->pages = ceil($this->total / $this->offset);
		
		//计算当前页码
		if (!is_numeric($this->now)) {
			$this->now = is_numeric($this->CI->input->get('page')) ? $this->CI->input->get('page') : 1;
		}
    }
    
    function create()
	{
		return $this->CI->load->view($this->template, array(
			'base_url' => $this->base_url,
			'pages' => $this->pages,
			'now_page' => $this->now
		), true);
	}
	
	function subStr($str, $flag)
	{
		$pos = mb_strpos($str, $flag);
		return $pos !== FALSE ? mb_substr($str, 0, $pos) : $str;
	}
}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */
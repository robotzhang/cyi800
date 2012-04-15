<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*----------------------------------------------------
 | 自定义表单验证类，比如唯一验证，是否存在验证，扩展了ci系统的表单验证
 | @author robot(黑暗人魔)
 | @date 2011/07/04
 | @use 和ci中使用form_validation一样
 ----------------------------------------------------*/
 
class MY_Form_validation extends CI_Form_validation 
{
	function __construct($rules = array()){
		parent::__construct($rules);
	}
	
	/**
	 * 验证是否存在
	 * @param $value 要验证的值
	 * @param $params 参数列表例如：unique[User.email] [表名.属性名]
	 * @return 存在则返回TRUE  不存在则返回FALSE
	 */
 	public function exist($value, $params)
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->form_validation->set_message('exist', '%s不存在.');
		
		list($table, $field) = explode(".", $params, 2);
		$query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();
		
		return $query->row() ? TRUE : FALSE;
	}
	
	/**
	 * 验证是否唯一
	 * @param $value 要验证的值
	 * @param $params 参数列表例如：unique[User.email] [表名.属性名]
	 * @return 存在则返回FALSE  不存在则返回TRUE
	 */
	function unique($value, $params) {
        $CI =& get_instance();  
        $CI->load->database();  
        $CI->form_validation->set_message('unique', '%s已被使用.');  

        list($table, $field) = explode(".", $params, 2);
        $query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();  

        if ($query->row()) {  
            return FALSE;  
        } else {  
            return TRUE;  
        }  
	}
 }

/* End of file MY_Form_validation.php */
/* Location: ./application/core/MY_Form_validation.php */
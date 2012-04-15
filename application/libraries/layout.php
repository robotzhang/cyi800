<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 系统模板类
 * @author 黑暗人魔
 * @date 2010-9-25
 * */
class Layout
{
    var $CI;//CI系统库
    var $layout = array(//包含模板名称、描述、加载css,js列表路径等等
        'name' => 'layout/default',
        'title' => '创意八佰伴——用创意点亮生活',
        'css' => array(),//需要加载的自定义css文件，这里设计成了全路径
        'javascript' => array(),
        'content' => '创意八佰伴',
        'keywords' => '创意 有意思 创意产品 创意礼物',
        'description' => '创意 用创意点亮生活 创意八佰伴'
    );
    
    function Layout($layout = "layout/default")
    {
        $this->CI = & get_instance();//不是在controller中可以通过这种方法获取CI的实例
        $this->setLayout($layout);
    }
    
    /**
     * 设置模板参数，如果传入的参数是字符串则设置名称，否则设置键对应的值
     * @param $layout string or array 要设置模板的参数
     * @return 无返回 
     */
    function setLayout($layout)
    {
        if (is_array($layout)) {
            foreach ($layout as $key => $value) {
                if (array_key_exists($key, $this->layout)) {//键存在则设置
                    $this->layout[$key] = $value;
                }
            }
        } else {
            $this->layout['name'] = $layout;
        }
    }
    
    /**
     * 显示模板,为了兼容ci的$this->load->view()方法所以命名为function view
     * @param $view string 要显示的内容
     * @param $data array 显示内容中要传递的参数，例如keyword description 用户自定义参数等等
     * @param $return 是否以字符串的方式返回
     * @return 串或显示
     */
	function view($view, $data = null, $return = false)
    {
        $this->layout['content'] = $this->CI->load->view($view, $data, true).'<p style="display:none;">Power By 黑暗人魔 QQ:445679586 Email:cqurobot@163.com</p>';//加载内容不输出而作为字符串返回
        $loadedData = array(
            'layout' => $this->layout
        );
        
        if ($return) {//将view作为字符串返回
            return $this->CI->load->view($this->layout['name'], $loadedData, true);
        } else {
            $this->CI->load->view($this->layout['name'], $loadedData, false);
        }
    }
}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */
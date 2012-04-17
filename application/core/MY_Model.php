<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*----------------------------------------------------
 | ORM封装了基本的添加，删除，更新，查询，是否存在等基本需求，当然没DataMapper等ORM强大，但是适合当前的业务需求
 | CI2.0中对model的拓展必须放在core下，而对form_validation的拓展则要放在libraries下^_^
 | @author robot(黑暗人魔)
 | @date 2011/07/03
 | @use 在ci的model中继承MY_Model即可
 ----------------------------------------------------*/
class MY_Model extends CI_Model
{
	var $table = '';//表名
	var $last_query_number = 0;//上次查询的结果总数
	var $validation = array();//验证
	var $error = array();//出错信息
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 添加记录
	 * @param $data array 要添加入数据库的数据集
	 * @return 添加成功返回TRUE 否则返回FALSE 
	 */
	public function add($data)
	{
		if (!isset($data->created) && $this->db->field_exists('created', $this->table)) {
			$data->created = date('Y-m-d H:i:s');
		}
		return $this->validation($data, 'add') === TRUE ? $this->db->insert($this->table, $data) : FALSE;
	}
	
	/**
	 * 更新记录
	 * @param $data array 待更新的数据
	 * @return 更新成功返回TRUE 否则返回FALSE 
	 */
	public function update($data)
	{
		if (!isset($data->updated) && $this->db->field_exists('updated', $this->table)) {
			$data->updated = date('Y-m-d H:i:s');
		}
		return $this->validation($data, 'update') === TRUE ? $this->db->where('id', $data->id)->update($this->table, $data) : FALSE;
	}
	
	/**
	 * 删除记录
	 * @param $id 要删除记录的主键id
	 * @return 删除成功返回TRUE 否则返回FALSE
	 */
	public function delete($id)
	{
		return $this->db->where(array('id' => $id))->delete($this->table);
	}
	
	/**
	 * 加载记录
	 * @param $where 查询条件
	 * @param $page 第几页
	 * @param $offset 条数
	 * @return 返回符合条件的结果集
	 */
	public function records($where = array(), $page = 1, $offset = 20)
	{
		if (!empty($where)) {
			$this->db->where($where);
		}
		
		$db_count = clone $this->db;
		$this->last_query_number = $db_count->count_all_results($this->table);
		
		$this->db->limit($offset, ($page - 1) * $offset);
		$this->db->order_by('id', 'desc');//默认按id降序排
		
		return $this->db->get($this->table)->result();
	}
	
	/**
	 * 通过唯一主键id获取单条记录
	 * @param $id 记录的id
	 * @return 返回结果集
	 */
	public function getById($id)
	{
		$records = $this->db->where(array('id' => $id))->get($this->table)->result();
		return count($records) > 0 ? $records[0]: array();
	}
	
	/**
	 * 通过属性获取符合的记录数 
	 * @param $value 值
	 * @param $key 属性
	 * @param $oper 操作方法默认为=，可以是(=, LIKE)
	 * @return 返回符合条件的结果集
	 */
	public function getByKey($value, $key, $oper = '=', $page = 1, $offset = 20)
	{
		$where = array();
		switch ($oper) {
			case '=':
				$where[$key] = $value;
			break;
			case 'LIKE':
				$where[$key.' LIKE'] = '%'.$value.'%';
			break;
		}
		
		return $this->records($where, $page, $offset);
	}
	
	/**
	 * 绑定数据，表单过来的数据如果很多的话手动绑定会很烦，所以自动绑定。
	 * @param $data 要绑定的数据
	 * @return 返回绑定好的数据
	 */
	public function renderData($data)
	{
		$obj = new StdClass;
		foreach ($data as $key => $value) {
			if ($this->db->field_exists($key, $this->table)) {
				$obj->$key = $value;
			}
		}
		return $obj;
	}
	
	/**
	 * 测试某个属性是否存在
	 * @param $value 值 
	 * @param $key 属性
	 * @return 如果记录存在则返回TRUE 不存在则返回FALSE
	 */
	public function isExist($value = 0, $key = 'id')
	{
		$counts = $this->db->where(array($key => $value))->count_all_results($this->table);
		return $counts > 0 ? TRUE : FALSE;
	}

	/**
	 * 验证数据有效性，集成codeigniter原生的form验证
	 * @param $data 待验证的数据
	 * @param $type update:表示只验证待更新的数据
	 * 				add或其他:表示全验证
	 * @return 验证成功则返回TRUE
	 * 		   验证失败返回出错的信息
	 */
	public function validation($data, $type = 'update')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$rules = array();
		foreach ($this->validation as $item) {
			if ($type == 'update') {
				if (in_array($item['field'], array_keys((array)$data))) {
					$rules[] = $item;
				}
			} else {
				$rules[] = $item;
			}
		}
	
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === FALSE) {
			foreach($this->validation as $item) {//将验证的错误绑定上去
				$error = form_error($item['field']);
				if (!empty($error)) {
					$this->error[$item['field']] = $error;
				}
			}
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
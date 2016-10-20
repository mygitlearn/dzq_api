<?php 
namespace Home\Model;
use Think\Model;


class BaseModel extends Model{

	protected $tableName = 'node_info'; 

	/*
		得到主导航
	 */
	public function get_top_menu(){
		$where['status'] = 0;
		$where['depth'] = 1;
		$rlt = $this->table('node_info')->where($where)->order('sort')->select();
//		$rlt = $this->table('user')->where($where)->order('sort')->select();
		return $rlt;

	}

	/*
	 	得到子导航
	 */
	
	public function get_child_menu($parent_id){

		$rlt = $this->table('node_info')->where(array('depth' => array('gt',1), 'LEFT(id,2)' => $parent_id, 'status' => 0))->select();
		return $rlt;
	} 	


}
 ?>
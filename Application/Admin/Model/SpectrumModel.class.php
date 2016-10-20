<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/2/23
 * Time: 11:22
 */
namespace Admin\Model;
use Think\Model;

class SpectrumModel extends BaseModel{

    //查询全部信息
	public function music($nickname){
        $map["m_name"] = $nickname;
        isset($_GET['p'])? $p=$_GET['p'] : $p=1;
        $music = M("music");
        $res_sql = $music->alias("m")
            ->field(" m.*,c.ca_type")
            ->join("left join category as c on m.m_type=ca_id")
            ->where("m.m_name like '%".$map["m_name"]."%'")
            ->page($p.',10')
            ->select();
        $count      = $music->where("m_name like '%".$map["m_name"]."%'")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
//分页跳转的时候保证查询条件
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        $list["music_list"] = $res_sql;
        $list["page"] = $show;
        return $list;

    }

    public function music_list(){
        $res_sql = M("music as m")
            ->field(" m.*,c.ca_type")
            ->join("left join category as c on m.m_type=ca_id")
            ->select();
        return $res_sql;
    }

    //获取某一首乐谱的详细信息
    public function show_music(){
        $id = $_GET["uid"];
        $res_sql = $this->music_list();
        for($i=0;$i<count($res_sql);$i++){
            if($res_sql[$i]["m_id"]==$id){
                $info = $res_sql[$i];
            }
        }

        return $info;
    }


}
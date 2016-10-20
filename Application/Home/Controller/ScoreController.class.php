<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/2/28
 * Time: 9:14
 *
 * 乐谱操作类
 */
namespace Home\Controller;
use Think\Controller\RestController;

class ScoreController extends RestController{

    //得到乐谱类别相关信息
    public function music_type(){
        isset($_GET['p'])? $p = $_GET['p'] : $p=1;              //判断分页是否被设置
        $type_list = M("category")->page($p .',10')->select();
        $count      = M("category")->count();
        $Page       = new \Home\Common\Page($count,10);
        $show       = $Page->show();

        if($type_list){                                 //查询成功,并返回查询信息
            $detail["code"] = 1;
            $detail["msg"] = "success";
            $detail["num"] = count($type_list);
            $detail["list"] = $type_list;
        }else{
            $detail["code"] = 0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }

    //推荐曲子，按点击量由高到低获取二十条
    public function recommend(){
        $recommend_list = M("music")
            ->field("music.*,c.ca_type")
            ->join("join category as c on music.m_type=c.ca_id")
            ->order("m_viewer_count desc")
            ->limit(20)
            ->select();
        if(count($recommend_list)){
            $detail["code"]=1;
            $detail["msg"] = "success";
            $detail["list"] = $recommend_list;
        }else{
            $detail["code"]=1;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }

    //根据乐谱id，获取该乐谱类下所有的乐谱
    public function type_music(){
        $type_id = I("id");
        $order_type=I("order_type");

        empty( $order_type)? $order_type=1:$order_type = I("id");
        isset($_GET['p'])? $p = $_GET['p'] : $p = 1;
        isset($_GET["n"])? $n = $_GET["num"] : $n = 10;
//        $order_type==1?$list_order="create_time desc":$list_order="m_viewer_count desc";
        if($order_type==1) $list_order="m_good_count desc";                  //如果得到的排序值为 1，则按赞量降序查询
        if($order_type==2) $list_order="create_time desc";                  //如果得到的排序值为 2，则按上传时间降序查询
        if($order_type==3) $list_order="update_time desc";               //如果得到的排序值为 3，则按更新时间降序查询

        $type_music_list = M("music")->where("music.m_type=".$type_id)->order($list_order)->page($p.','.$n) ->select();
//        $count      = M("music")->where("music.m_type=".$type_id)->count();
//        $Page       = new \Home\Common\Page($count,2);
//        $show       = $Page->show();

        if(count($type_music_list)){
            $detail["code"]=1;
            $detail["msg"]="success";
            $detail["num"]=count($type_music_list);
            $detail["list"] = $type_music_list;
//            $detail["page"] = $show;
        }else{
            $detail["code"]=0;
            $detail["msg"]="fail";
        }
        $this->response($detail,"json");
    }

    //获取音乐的曲谱
    public function music(){
        $where["m_id"] = I("m_id");
        $music=M("music")->field("m_score,m_file")->where($where)->select();
        if(count($music)){
            $detail["code"]=1;
            $detail["msg"] = "success";
            $detail["list"] = $music;
        }else{
            $detail["code"]=0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }

    //用户收藏曲子
    public function collection_status(){
        $data["user_token"] = I("token");
        $data["music_id"] = I("m_id");
        $data["music_type"] = I("m_type");
        $where["user_token"] = I("token");
        $where["music_id"] = I("m_id");
        $status = I("status");          //id==1收藏曲子，id==2取消收藏
        if($status==1){
            $delId = M("user_collect")->field("id")->where($where)->find();
            if($delId) {
                $detail["code"] = 3;
                $detail["msg"] = "曲子不可重复收藏";
                $this->response($detail, "json");
            }
            $res = M("user_collect")->data($data)->add();
        }else if($status==2){
            $delId = M("user_collect")->field("id")->where($where)->find();
            if($delId==false) {
                $detail["code"] = 2;
                $detail["msg"] = "取消条件有误";
                $this->response($detail, "json");
            }
            $res = M("user_collect")->where($where)->delete();
        }
        if($res){                                    //收藏成功
            $detail["code"]=1;
            $detail["msg"] = "success";
        }else{
            $detail["code"]=0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }


}
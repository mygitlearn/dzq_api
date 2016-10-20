<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/3/26
 * Time: 11:50
 */

namespace Home\Controller;
use Think\Controller\RestController;
//关于评论信息
class DescussController extends  RestController{

    //获取某一首音乐的所有评论
    public function show(){
        $tb_name = M("comment");
        $user = M("user");
        $where["com_music_id"] = I("id");
        $user_info = $user->field("token,name")->select();
//        $descuss_msg = $tb_name->field('com_id, com_music_id, com_root_id, com_parent_id, com_time')->where($where)
//                                ->order('com_root_id, com_parent_id, com_id')
//                                ->select();
        $descuss_msg = $tb_name->where($where)->order('com_root_id, com_parent_id, com_id')->select();

        for($i=0;$i<count($descuss_msg);$i++){
            $descuss_msg[$i]["com_user_name"]="";
            $descuss_msg[$i]["replyed_user_name"]="";
            for($j=0;$j<count($user_info);$j++){
                if($descuss_msg[$i]["com_user_name"]!=""&&$descuss_msg[$i]["replyed_user_name"]!=""){       //如果已经匹配到相应的用户名，则停止二层for循环
//                    $descuss_msg[$i]["replyed_user"]=$j;
                    break;
                }
                if($descuss_msg[$i]["com_user_token"]==$user_info[$j]["token"]){
                    $descuss_msg[$i]["com_user_name"] = $user_info[$j]["name"];
                }
                if($descuss_msg[$i]["replyed_user_token"]==$user_info[$j]["token"]){
                    $descuss_msg[$i]["replyed_user_name"] = $user_info[$j]["name"];
                }
            }
            if($descuss_msg[$i]["com_time"]){
                $descuss_msg[$i]["com_time"] = date("Y-m-d",$descuss_msg[$i]["com_time"]);
            }
        }
//实施分组
//当com_parent_id==0为真时，表示一级评论，位于分组的第一个
//当com_root_id被设置时，表示为评论
        $des_list = [];
        foreach ($descuss_msg as $key => $msg) {
            if (0 == $msg['com_parent_id']) {
//                $des_list[$msg['com_id']][$msg['com_id']] = $msg;
                $des_list[$msg['com_id']][] = $msg;
            } else {
                if (isset($des_list[$msg['com_root_id']])) {
//                    $des_list[$msg['com_root_id']][$msg['com_id']] = $msg;
                    $des_list[$msg['com_root_id']][] = $msg;
                }
            }
        }
        $des_list=array_values($des_list);
        if($des_list){
            $data["code"] = 1;
            $data["msg"] = "success";
            $data["detail"] = $des_list;
        }else{
            $data["code"] = 0;
            $data["msg"] = "fail";
        }
        $this->response($data,"json");
    }

    //发表评论
    public function send_comment(){
        $data["com_music_id"] = I("id");
        $data["com_user_token"] = I("com_token");
        $data["com_content"] = I("content");
        $data["com_time"] = time();
        $addinfo = M("comment")->data($data)->add();
        if($addinfo){
            $detail["code"] = 1;
            $detail["msg"] = "success";
        }else{
            $detail["code"] = 0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }

//id=222&com_token=e10adc3949ba59abbe56e057f20f883e&rep_token=e10adc3949ba59abbe56e057f20f883e&root=33333&parent=3333333&content=测试仪
    //回复评论
    public function reply_comment(){
        $data["com_music_id"] = I("id");            //评论音乐的id
        $data["replyed_user_token"] = I("com_token");    //被评论的用户token
        $data["com_user_token"] = I("rep_token");        //回复评论的用户token
        $data["com_root_id"] = I("root");           //对音乐发表评论的id（发表评论的目标是音乐）
        $data["com_parent_id"] = I("parent");       //对评论回复的id
        $data["com_content"] = I("content");        //对发表评论的用户进行回复的用户token
        $data["com_time"] = time();
        $map["token"] = array("in",$data['com_user_token'].",".$data["replyed_user_token"]);
        $user = M("user")->field("id")->where($map)->select();
        if(count($user)< 1){
            $detail["code"] = 2;
            $detail["msg"] = "发表评论用户不存在";
            $this->response($detail,"json");
        }
        $reply = M("comment")->data($data)->add();
        if($reply){
            $detail["code"] = 1;
            $detail["msg"] = "success";
        }else{
            $detail["code"] = 0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }

    //删除评论或回复
    public function del_info(){
        $tab_name = M("comment");
        $where["com_id"] = I("id");                   //发表或回复的信息id
//        $where["com_music_id"] = I("m_id");     //音乐的id
        $where["com_user_token"] = I("token");  //发表或回复评论的token
        $exists = $tab_name->field("com_music_id,replyed_user_token")->where($where)->find();

        if(!$exists){
            $detail["code"] = 2;
            $detail["msg"] = "删除信息条件有误";
            $this->response($detail,"json");
        }

        if($exists["replyed_user_token"]){            //判断是否有回复，如果有回复用户则是二级评论，如果无回用户复则是一级评论
            $map["com_id"] = $where["com_id"];
            $delStatus = $tab_name->where($map)->delete();
        }else{
            $map["com_id"] = $where["com_id"];
            $map["com_root_id"] = $where["com_id"];
            $map["_logic"] = "or";
            $delStatus = $tab_name->where($map)->delete();
        }
        if($delStatus){
            $detail["code"] = 1;
            $detail["msg"] = "success";
        }else{
            $detail["code"] = 0;
            $detail["msg"] = "fail";
        }
        $this->response($detail,"json");
    }



}
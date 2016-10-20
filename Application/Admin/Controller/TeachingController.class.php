<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/4/11
 * Time: 17:23
 */
namespace Admin\Controller;

class TeachingController extends BaseController{

    //教学资料管理
    public function index(){
        if(__FUNCTION__!="index"){
            session("searchCondition","");
        }
        session("searchCondition",$_GET["nickname"]);
        !empty($_GET["nickname"])? $map["title"] = array("like","%".$_GET["nickname"]."%") : $map["title"]=array("like","%%");
        $list = $this->dataPage('teach',$map,"id desc");
        for($i=0; $i<count($list); $i++){
            $list[$i]["title"] = mb_strimwidth($list[$i]["title"], 0,35,"","utf-8");
            $list[$i]["content"] = strip_tags($list[$i]["content"],"img");          //去除img
            $list[$i]["content"] =  mb_strimwidth($list[$i]["content"], 0,80,"...","utf-8");
        }
        $this->assign('_list', $list);
        $this->display();
    }

    //展示某一节授课内容的详细信息
    public function showCourse(){
        $where["id"] = $_GET["id"];
        $resList = M("teach")->where($where)->find();
        $this->assign("list",$resList);
        $this->display();
    }

    //编辑授课信息
    public function editCourse(){
        $where["id"] = $_GET["id"];
        $resList = M("teach")->where($where)->find();
        $this->assign("list",$resList);
        $this->display();
    }

    //保存授课信息
    public function saveCourse(){
        $data["title"] = $_POST["title"];
        $data["content"] = $_POST["news_content"];
        if(I("id")){
            $where["id"]=$_POST["id"];
            $res = M("teach")->where($where)->data($data)->save();
        }else{
            $res = M("teach")->data($data)->add();
        }
        $this->redirect("Teaching/index");
    }

    //删除
    public function delCourse(){
        $where["id"] = $_GET["id"];
        $res = M("teach")->where($where)->delete();
        $this->redirect("Teaching/index");
    }


}
<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends BaseController{

    //管理员列表
    public function manager(){
        if($_GET["nickname"]){
            $where['name']=array('like','%'.$_GET["nickname"].'%');
            $where['account']=array('like','%'.$_GET["nickname"].'%');
            $where["_logic"] = "or";
            $map["_complex"] = $where;
        }
        $map["status"]=1;
        session("searchCondition",$_GET["nickname"]);
        $list = $this->dataPage("admin",$map);
        int_to_string($list);
        for($i=0;$i<count($list);$i++){
            $list[$i]["avatar"] = __ROOT__."/Uploads/".$list[$i]["avatar"];
            $list[$i]["logo_time"] = $list[$i]["logo_time"]?date("Y/m/d H:i:s", $list[$i]["logo_time"]):"";
        }
        $this->assign("_list",$list);
        $this->display();
    }

    //用户列表
    public function personal(){
        $tableName = M("user");
        $limit = 10;
        empty($_GET['p'])? $p=0 : $p = $_GET['p'];
        if($_GET["nickname"]){
            $where['name']=array('like','%'.$_GET["nickname"].'%');
            $where['account']=array('like','%'.$_GET["nickname"].'%');
            $where["_logic"] = "or";
            $map["_complex"] = $where;
        }
        $map["status"]=1;
        session("searchCondition",$_GET["nickname"]);
        $list = $tableName->where($map)->page($p.','.$limit)->select();

        for($i=0;$i<count($list);$i++){
            $list[$i]["logo_time"] = date("Y/m/d H:i:s", $list[$i]["logo_time"]);
            empty($list[$i]["avatar"])?$list[$i]["avatar"]= __ROOT__."/Uploads/avatar/logo.png":$list[$i]["avatar"] = __ROOT__."/Uploads/".$list[$i]["avatar"];
        }
        $count = $tableName->where($map)->count();// 查询满足要求的总记录数
        $Page  = new  \Admin\Common\Page($count,$limit);// 实例化分页类 传入总记录数和每页显示的记录数
        $show  = $Page->show();                            // 分页显示输出

        $this->assign('page',$show);// 赋值分页输出
        $this->assign('_list', $list);
        $this->display();
    }

    //修改个人信息
    public function myInfo(){
        $where["account"] = session("userId");
        $list = M("admin")->field("name,age,sex,phone,email,avatar")->where($where)->find();
        $list["avatar"] = __ROOT__."/Uploads/".$list["avatar"];
        if($_GET["msg"]==1){
            $error = "<div id='error_child'>密码有误</div>";
        }else if($_GET["msg"]==2){
            $error = "<div id='error_child'>修改失败</div>";
        }
        $this->assign("error",$error);
        $this->assign("list",$list);
        $this->display();
    }

    //管理员删除用户,或管理员删除管理员
    public function changeStatus(){
        $where["token"]=I("id");
        $data["status"] = 0;
        if(I("choice")==1){
            $tableName=M("user");
            $url="User/personal";
        }else if(I("choice")==2){
            $tableName=M("user");
            $url="User/manager";
        }else{
            $this->redirect("User/personal");
        }
        $delInfo = $tableName->where($where)->data($data)->save();
        $this->redirect($url);
    }

    //用户修改个人信息
    public function changeInfo(){
        $where["account"] = session("userId");
        $data = $this->getInfo();
        if($data["password"]!= $data["confirmPassword"]){
            $this->redirect("User/myInfo?msg=1");
        }
        $info   =  $this->upLoads("avatar/");
        $data["avatar"] = $info["upFile"]["savepath"].$info["upFile"]["savename"];
        $doSave = M("admin")->where($where)->data($data)->save();
        if($doSave){
            $this->redirect("User/myInfo");
        }else{
            $this->redirect("User/myInfo?msg=2");
        }
    }

    //添加新管理员
    public function addUser(){
        if(IS_POST){
            $res_id = M("admin")->where("account=".$_POST["id"])->find();
            if($res_id){
                $error = "<div id='error_child'>此账号已存在</div>";
                $this->assign("error",$error);
            }else{
                $data = $this->getInfo();
                $data["account"] = $_POST["id"];
                $data["token"] = md5(time()+"dzq");
                $data["logo_time"] = time();
                if($_FILES["upFile"]["size"]!=0){
                    $info   =  $this->upLoads("avatar/");
                    $data["avatar"] = $info["upFile"]["savepath"].$info["upFile"]["savename"];
                }
                M("admin")->data($data)->add();
                $this->redirect("User/manager");
            }
        }
        $this->display();
    }

    //获取用户编辑信息
    public function getInfo(){
        $data["name"] = $_POST["name"];
        $data["phone"] = $_POST["tel"];
        $data["email"] = $_POST["email"];
        $data["age"] = $_POST["age"];
        $data["sex"] = $_POST["sex"];
        $data["password"] = $_POST["password"];
        $data["confirmPassword"] = $_POST["confirmPassword"];
        return $data;
    }

    //删除管理员
    public function delManager(){
        $where["token"] = $_GET["id"];
        M("admin")->where($where)->delete();
        $this->redirect("User/manager");
    }

}
?>
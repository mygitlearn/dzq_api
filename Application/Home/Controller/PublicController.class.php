<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/2/28
 * Time: 8:19
 */
namespace Home\Controller;
use Think\Controller\RestController;

class PublicController extends RestController{

    //用户登录
    public  function user_login(){
        $username = I("account");
        $password = I("password");

//$aa = sha1(md5(123456));
//        var_dump($aa."    长度为：  ".strlen($aa));
//        var_dump(hash("SHA256",123456)."    长度为：    ".strlen(hash("SHA256",123456)));
//        var_dump(sha1(123456)."    长度为：   ".strlen(sha1(123456)));
//return;
        $user = M('user')->where(array('account'=>$username))->find();
        if($user==false){
            $data['code'] = 2;
            $data['msg'] = "该用户不存在";
            $this->response($data, 'json');
        }
        if ($user['password'] == md5($password)) {
            unset($user['password']);
            $data['code'] = 1;
            $data['msg'] = 'success';
            $data['detail'] = $user;
            $where["account"] =$username;
            $time['logo_time'] = time();
            M("user")->where($where)->data($time)->save(); // 根据条件更新记录
//            session_destroy();
//            session("user", $data);
        } else {
            $data['code'] = 0;
            $data['msg'] = '密码有误';
        }
        $this->response($data, 'json');
    }

//用户注册
    public function user_regist(){
        $phone = I("account");            //获取信息
        //$verify_code = I('verify_code');
        $password = I('password');
        $user = M('user')->field('token')->where(array('account'=>$phone))->find();
        if($user){
            $data['code'] = '2';
            $data['msg'] = '该账号已存在';
            $this->response($data,'json');
        }
        $detail["account"]=$phone;
        $detail["password"]=md5($password);
        $detail["phone"] = $phone;
        $detail["token"] = md5(time()+"dzq");
        $detail["logo_time"] = time();
        $res = M("user")->data($detail)->add();
        if($res){
            $data['code'] = '1';
            $data['msg'] = 'success';
            $data['token'] = $detail["token"];
        }else{
            $data['code'] = '0';
            $data['msg'] = 'fail';
        }
        $this->response($data,'json');
    }

    //产品介绍信息
    public function introduce(){
        $tablName = M("introduce");
        $content = $tablName->select();
        if($content){
            $detail["code"]=1;
            $detail["msg"] ="success";
            $detail["result"] = $content[0]["content"];
        }else{
            $detail["code"]=0;
            $detail["msg"] ="fail";
        }
        $this->response($detail,"json");
    }


}
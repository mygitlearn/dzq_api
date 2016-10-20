<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/4/11
 * Time: 17:15
 */
class PublicController extends Controller {

    //登录
    public function login(){
        if(IS_POST){
            if(I("username")==false || I("password")==false || I('post.verify')==false){
                $this->assign("msg","信息不能为空");
            }else{
                $where["account"] = I("username");
                $where["status"] = 1;
                $password = md5(I("password"));
                $verify = I('post.verify');
                $res_passw = M("admin")->field("password")->where($where)->find();
                $result = $this->check_verify($verify,'');
                if($result==false){
                    $this->assign("msg","验证吗码有误");
                }else{
                    if($res_passw["password"]==$password){
                        session("userId",$where["account"]);
//                        session_unset();
                        $this->redirect("Public/home");
                    }else{
                        $this->assign("msg","请确认账号或密码是否输入有误");
                    }

                }

            }

        }

        $this->display();
    }

    public function register(){
        $this->show("这里是注册");
        return;
    }

    /**
     * 验证码处理
     */
    public function verify(){
        $config = array(
            'length'   => 5  //字数
            //'useNoise'=> false,//是否显示背景图片
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * 检验验证码
     */
    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    //表单令牌验证
    public function addit(){
        $User = M("user");
        if (!$User->autoCheckToken($_POST)){// 令牌验证错误
            return 0;
        }
    }

    //退出
    Public function logo_out(){
        unset ($_SESSION["dzq_admin"]['userId']);
        if(session("userId")==false){
            $this->redirect("Public/login");
        }
    }

    //home首页
    public function home(){
        if(IS_POST){
            $data["content"] = $_POST["news_content"];
            $res = M("introduce")->where("id=1")->data($data)->save();
        }
        $text = M("introduce")->find();
        htmlspecialchars($text["content"]);
        $this->assign("list",$text);
        $this->display();
    }

}
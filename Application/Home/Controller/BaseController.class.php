<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/2/27
 * Time: 10:35
 */
namespace Home\Controller;
use Think\Controller\RestController;

class BaseController extends RestController{

    public function _initialize(){

        session("use.detail","8cc498ff21304b57013bb9ffde5cedf0");
        if(!session("user.detail")){
            $this->redirect("Public/user_login");
        }
    }
    //空方法
    public function _empty(){
        $error = "<div style='width: auto;height: auto;margin-top:100px;text-align: center;color: red;'><h1>404 error</h1></div>";
        echo $error;
        return;
    }

}
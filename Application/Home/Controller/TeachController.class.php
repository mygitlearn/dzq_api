<?php
/**
 * Created by PhpStorm.
 * User: chentianyu
 * Date: 16/2/24
 * Time: 上午11:50
 */
namespace Home\Controller;
use Think\Controller;
use Think\Controller\RestController;


class TeachController extends RestController
{
    //查询教学信息
    public  function  get_data(){

        isset($_GET['p'])? $p = $_GET['p'] : $p=1;
        $Teach = M("teach");
        $result = $Teach->page($p .',10')->select();
        $count      = $Teach->count();
        $Page       = new \Home\Common\Page($count,10);
        $show       = $Page->show();
        if($result){
            $data['code'] = '1';
            $data['msg'] = 'success';
            $data['result'] = $result;
            $data["page"] = $show;
        }else{
            $data['code'] = '0';
            $data['msg'] = 'fail';
        }
        $this->response($data,'json');
    }
}
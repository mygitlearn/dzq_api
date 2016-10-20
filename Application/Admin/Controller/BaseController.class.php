<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller{

    public function _initialize(){
        if(!session("userId")){
            $this->redirect("Public/login");
        }
    }

    public function dataPage($model,$where=array(),$order='',$field=true){
        $options    =   array();
        $REQUEST    =   (array)I('request.');       //接收了 $_GET $_POST $_COOKIE 三个的集合

        if(is_string($model)){
            $model  =   M($model);
        }
        $OPT        =   new \ReflectionProperty($model,'options');
        $OPT->setAccessible(true);

        $pk         =   $model->getPk();
        if($order===null){
            //order置空
        }else if ( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ) {
            $options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
        }elseif( $order==='' && empty($options['order']) && !empty($pk) ){
            $options['order'] = $pk.' asc';
        }elseif($order){
            $options['order'] = $order;
        }
        unset($REQUEST['_order'],$REQUEST['_field']);
        if(empty($where)){
            $where  =   array('status'=>array('egt',0));
        }

        if( !empty($where)){
            $options['where']   =   $where;
        }

        $options      =   array_merge( (array)$OPT->getValue($model), $options );
        $total        =   $model->where($options['where'])->count();
        if( isset($REQUEST['r']) ){
            $listRows = (int)$REQUEST['r'];
        }else{
            $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        }
        $page = new \Admin\Common\Page($total, $listRows, $REQUEST);
        if($total>$listRows){
            $page->setConfig('theme','%UP_PAGE% %FIRST% %LINK_PAGE% %END% %DOWN_PAGE%');
        }
        $p =$page->show();
        $this->assign('_page', $p? $p: '');
        $this->assign('_total',$total);
        $options['limit'] = $page->firstRow.','.$page->listRows;
        $model->setProperty('options',$options);
        return $model->field($field)->select();

    }

//    文件上传
    public function upLoads($savePath){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'mxl', 'pdf', 'xml');// 设置附件上传类型
        $upload->rootPath  =     ROOT_PATH.'/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     $savePath; // 设置附件上传（子）目录
        $upload->saveName = array('uniqid',"");
        $info   =   $upload->upload();//         上传文件
        return $info;
    }

//不存在路径
    public function _empty($name){
        $error = "<div style='width: auto;height: auto;margin-top:100px;text-align: center;color: red;'><h1>404 error</h1></div>";
        echo $error;
        return;
    }

}
?>
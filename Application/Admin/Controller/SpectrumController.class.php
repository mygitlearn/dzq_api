<?php
/**
 * Created by PhpStorm.
 * User: loner
 * Date: 2016/4/11
 * Time: 17:23
 */
namespace Admin\Controller;
use Think\Controller;

class SpectrumController extends BaseController{

    //谱库类别
    public function index(){
        if(__FUNCTION__!="index"){          //清除其他方法中的session查询条件
            session("searchCondition","");
        }
        empty($_GET["nickname"])? $where = "" : $where["ca_type"]=array("like","%". $_GET["nickname"]."%");
        session("searchCondition",$_GET["nickname"]);
        $typeList = $this->dataPage("category",$where);
        for($i=0;$i<count($typeList);$i++){
            $typeList[$i][ca_cover_img] = __ROOT__."/Uploads/".$typeList[$i][ca_cover_img];
        }
        $img = __ROOT__."/Public/Admin/images/default.jpg";
        $this->assign("imgUrl",$img);

        $this->assign("list",$typeList);
        $this->display();
    }

    //谱库乐谱信息
    public function music(){
        if(__FUNCTION__!="music"){
            session("searchCondition","");
        }
        empty($_GET['p'])? $p=0 : $p=$_GET['p'];
        empty($_GET["nickname"])? $where = "" : $where["c.ca_type"]= array("like","%". $_GET["nickname"]."%");
        session("searchCondition",$_GET["nickname"]);
        $tabName = M("music");
        $music = $tabName->alias("m")
            ->join("category as c on m.m_type=c.ca_id")
            ->field("m.m_id,m_name,m_avatar,m_author,m_player,m_viewer_count,m_good_count,m_file,ca_type")
            ->where($where)
            ->order("m.m_id desc")
            ->page($p.',5')
            ->select();

        $count = $tabName->alias("m")->join("category as c on m.m_type=c.ca_id")
            ->field("m.m_id,m_name,m_avatar,m_author,m_player,m_viewer_count,m_good_count,m_file,ca_type")
            ->where($where)
            ->count();

        for($i=0;$i<count($music);$i++){
            $music[$i]["m_avatar"] = __ROOT__."/Uploads/".$music[$i]["m_avatar"];
            empty($music[$i]["m_file"])?$music[$i]["m_file"]="否":$music[$i]["m_file"]="是";
        }
        $Page       = new \Admin\Common\Page($count,5);
        $show       = $Page->show();

        $this->assign("list",$music);
        $this->assign("_page",$show);
        $this->display();
    }

    //显示详细信息
    public function show(){
        $where["m_id"] = $_GET["id"];
        $info = M("music")->alias("m")
            ->join("category as c on m.m_type=c.ca_id")
            ->field("m.m_id,m_name,m_avatar,m_intro,m_author,m_player,m_type,m_viewer_count,m_good_count,m.m_score,ca_type")
            ->where($where)
            ->find();
        $info["m_avatar"] = __ROOT__."/Uploads/".$info["m_avatar"];
        $this->assign("list",$info);
        if($_GET["i"]==1){
            $type = M("category")->field("ca_id,ca_type")->select();
            $this->assign("type",$type);
            if($_GET["k"]) $this->assign("error","<div id='error_child'>修改失败，请检测文档及图片信息</div>");
            $this->display("edit");
        }else{
            $this->display();
        }
    }

    //编辑乐谱
    public function saveMusic(){
        $where["m_id"] = $_POST["id"];

        $data = $this->getData($_POST["id"]);
        $data["update"] = time();
        if(!$data["m_file"]) unset($data["m_file"]);
        if(!$data["m_avatar"])unset($data["m_avatar"],$data["m_md5"]);
        $suffix = substr($data["m_file"],-3);
        M("music")->data($data)->where($where)->save();
        $this->redirect("Spectrum/music");
    }

    //添加乐谱
    public function addMusic(){
        if(IS_POST){
            $data = $this->getData(null);
            if($data["m_file"]!="" && $data["m_avatar"]!=""){
                $user = M("user")->field("token")->where("account=".session("userId"))->find();
                $data["m_uploader"] = $user["token"];
                $data["create_time"] = time();
                $data["update_time"] = time();
                $resId = M("music")->data($data)->add();
                if($resId){
                    $oldNum = M("category")->field("ca_count")->where("ca_id=".$data["m_type"])->find();
                    $num = (int)$oldNum["ca_count"]+1;
                    M("category")->data("ca_count=".$num)->where("ca_id=".$data["m_type"])->save();
                    $this->redirect("Spectrum/music");
                }
            }
            $this->assign("error","<div id='error_child'>添加失败，请检测文档及图片信息</div>");
        }
        $type = M("category")->field("ca_id,ca_type")->select();
        $img = __ROOT__."/Public/Admin/images/default.jpg";
        $this->assign("imgUrl",$img);
        $this->assign("type",$type);
        $this->display();
    }

    //获取编辑或添加的表单内容
    public function getData($id){
        $data["m_name"] = $_POST["musicName"];
        $data["m_author"] = $_POST["author"];
        $data["m_player"] = $_POST["player"];
        $data["m_type"] = $_POST["m_type"];
        $data["m_intro"] = $_POST["introduce"];
        $data["m_score"] = $_POST["news_content"];

        $flag=false;
        $suffix = substr($_FILES["upImg"]["name"][0], -3);
        if($suffix=="mxl" || $suffix=="xml" || $suffix=="pdf") $flag=true;
        if($id){
            $info   =  $this->upLoads("music/");
            $data["m_file"] = $info[0]["savepath"].$info[0]["savename"];    //文档
            $data["m_avatar"] = $info[1]["savepath"].$info[1]["savename"];  //封面图片
            $data["m_md5"] = $info[1]["md5"];
        }else if($_FILES["upImg"]["size"][0]!=0 && $_FILES["upImg"]["size"][1]!=0 && $flag==true){
            $info   =  $this->upLoads("music/");
            $data["m_file"] = $info[0]["savepath"].$info[0]["savename"];    //文档
            $data["m_avatar"] = $info[1]["savepath"].$info[1]["savename"];  //封面图片
            $data["m_md5"] = $info[1]["md5"];
        }

        return $data;
    }

    //添加谱库类别
    public function addType(){
        $data["ca_type"] = $_POST["typeName"];
        if($_FILES["upImg"]["size"]!=0){
            $info   =  $this->upLoads("cover/");
            $data["ca_cover_img"] = $info["upImg"]["savepath"].$info["upImg"]["savename"];
        }
        //如果$_POST["code"]为空则表示添加，否则表示编辑
        if($_POST["code"]){
            $where["ca_id"] = $_POST["code"];
            M("category")->where($where)->data($data)->save();
        }else{
            M("category")->data($data)->add();
        }
        $this->redirect("Spectrum/index");
    }

    public function changeStatus(){
        if($_GET["i"]==1){
            $where["ca_id"] = $_GET["id"];
            M("category")->where($where)->delete();
            $this->redirect("Spectrum/index");
        }else if($_GET["i"]==2){
            $where["m_id"] = $_GET["id"];
            $type = M("music")->field("m_type")->where($where)->find();
            $oldNum = M("category")->field("ca_count")->where("ca_id=".$type["m_type"])->find();
            $num = (int)$oldNum["ca_count"]-1;
            M("category")->data("ca_count=".$num)->where("ca_id=".$type["m_type"])->save();
            M("music")->where($where)->delete();
            $this->redirect("Spectrum/music");
        }
    }
}
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="/dzq_api/Public/static/mstp/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="/dzq_api/Public/static/mstp/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="/dzq_api/Public/static/mstp/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="/dzq_api/Public/static/mstp/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/dzq_api/Public/static/mstp/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="/dzq_api/Public/static/mstp/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="/dzq_api/Public/static/mstp/css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="/dzq_api/Public/static/mstp/css/compiled/index.css" type="text/css" media="screen" />
    <link type="text/css" rel="stylesheet" href="/dzq_api/Public/static/mstp/css/lib/font-awesome.css" />
    <link rel="stylesheet" href="/dzq_api/Public/static/mstp/css/compiled/user-list.css" type="text/css" media="screen" />

    <script src="/dzq_api/Public/static/mstp/js/jquery-latest.js"></script>
    <script src="/dzq_api/Public/static/mstp/js/bootstrap.min.js"></script>
    <script src="/dzq_api/Public/static/mstp/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="/dzq_api/Public/static/mstp/js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="/dzq_api/Public/static/mstp/js/jquery.flot.js"></script>
    <script src="/dzq_api/Public/static/mstp/js/jquery.flot.stack.js"></script>
    <script src="/dzq_api/Public/static/mstp/js/jquery.flot.resize.js"></script>
    <script src="/dzq_api/Public/static/mstp/js/theme.js"></script>
    <script src="/dzq_api/Public/static/ueditor/ueditor.parse.js"></script>
    <script src="/dzq_api/Public/static/ueditor/ueditor.config.js"></script>
    <script src="/dzq_api/Public/static/ueditor/ueditor.all.js"></script>
    <script src="/dzq_api/Public/static/ueditor/lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        .pointer{
            display: none;
        }
        .navLi{
            cursor: pointer;
        }
    </style>
    
    <style type="text/css">
        #text{
            width: 100%;
            height: 450px;
            margin: 100px auto 0;
            overflow: auto;
            overflow-x: hidden;
        }
        #editUe{
            width: 100%;
            height: 500px;
            margin-top: 100px;
            display: none;
        }
        #ok{
            display: none;
        }
    </style>

</head>
<body>
<!--头部-->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="brand" href="#" style="display: initial;float: none"><img src="/dzq_api/Public/Admin/images/dzqlogo.png" style="height: 45px"/></a>
        <ul class="nav pull-right">
            <li class="dropdown " >
                <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown" style="font-size: 20px">
                    <i class="icon-user"></i>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo U('User/myInfo');?>">个人资料</a></li>
                    <li><a href="<?php echo U('Public/logo_out');?>">退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!--//左导航-->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li class="navLi">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="#">
                <i class="icon-home"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="navLi">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a class="dropdown-toggle" >
                <i class="icon-group"></i>
                <span>用户</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo U('User/manager');?>">管理员</a></li>
                <li><a href="<?php echo U('User/personal');?>">用户列表</a></li>
            </ul>
        </li>
        <li class="navLi">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a class="dropdown-toggle" >
                <i class="icon-edit"></i>
                <span>教学</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo U('Teaching/index');?>">资料管理</a></li>
            </ul>
        </li>
        <li class="navLi">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a class="dropdown-toggle">
                <i class="icon-th-large"></i>
                <span>谱库</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo U('Spectrum/index');?>">类别</a></li>
                <li><a href="<?php echo U('Spectrum/music');?>">乐谱</a></li>
            </ul>
        </li>
        <li class="navLi">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="<?php echo U('User/myInfo');?>">
                <i class="icon-cog"></i>
                <span>我的信息</span>
            </a>
        </li>
    </ul>
</div>
<!--内容区域-->
<div class="content" >
    


    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <button class="btn-flat success pull-right" id="edit"><span>&#43;</span>编辑</button>
            <input type="submit" form="ueForm" class="btn-flat success pull-right" id="ok" value="&#43;完成提交">
        </div>
        <div id="text">
            <?php echo ($list["content"]); ?>
        </div>
        <form action="<?php echo U();?>" method="post" id="ueForm">
        <div id="editUe">
            <textarea id="myEditor" name="news_content" style="width:100%;min-height:80%;float:left;"><?php echo ($list["content"]); ?></textarea>
        </div>
        </form>
    </div>


</div>
</body>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>


    <script type="text/javascript">
        $("#edit").click(function(){
            status();
        });
        $("#ok").click(function(){
            var text = UE.getEditor('myEditor').getContent();
            if(text==""){
                alert("信息不能为空");
                $("form").submit(function(e){e.preventDefault();})
                return;
            }
            setTimout(status(),500);
        });
        function status(){
            $("#text").toggle();
            $("#editUe").toggle();
            $("#edit").toggle();
            $("#ok").toggle();
        }
    </script>
    <script type="text/javascript" src="/dzq_api/Public/Admin/js/admin/Public.js"></script>


</html>
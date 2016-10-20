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
    
    <link type="text/css" rel="stylesheet" href="/dzq_api/Public/Admin/css/editCourse.css" />

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
        <li class="active">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="#">
                <i class="icon-home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>

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
        <li>

            <a class="dropdown-toggle" >
                <i class="icon-edit"></i>
                <span>教学</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo U('Teaching/index');?>">资料管理</a></li>
            </ul>
        </li>
        <li>

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
        <li>

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
            <div class="row-fluid header"><h3>添加授课</h3></div>
            <input type="submit" form="editForm" class="btn-flat success pull-right" value="确定提交" />
            <input type="hidden" form="editForm" name="id" value="<?php echo ($list["id"]); ?>" />
            <form action="<?php echo U('saveCourse');?>" method="post" id="editForm">
                <div class="field-box">
                    <label style="float: left">授课标题:</label>
                    <input type="text" name="title" id="title" value="<?php echo ($list["title"]); ?>"/>
                </div>
                <div id="editUe">
                    <textarea id="myEditor" name="news_content" style="width:100%;min-height:80%;float:left;"><?php echo ($list["content"]); ?></textarea>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>

</body>

    <script type="text/javascript" src="/dzq_api/Public/Admin/js/admin/editCourse.js"></script>


</html>
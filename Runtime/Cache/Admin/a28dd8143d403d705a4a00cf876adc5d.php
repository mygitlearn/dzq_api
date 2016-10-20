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
    
    <link type="text/css" rel="stylesheet" href="/dzq_api/Public/Admin/css/spectrumShow.css" />


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
            <div class="row-fluid header"><h3>乐谱信息：</h3><h5><?php echo ($list["m_name"]); ?></h5></div>
        </div>
        <div id="text">
            <div id="left">
                <p style="margin-top: 3px"> <label>乐谱名称：</label><span ><?php echo ($list["m_name"]); ?></span> </p>
                <p> <label>作曲者：</label><span ><?php echo ($list["m_author"]); ?></span> </p>
                <p> <label>演奏者：</label><span ><?php echo ($list["m_player"]); ?></span> </p>
                <p> <label>类别：</label><span ><?php echo ($list["ca_type"]); ?></span> </p>
                <p> <label>浏览量：</label><span ><?php echo ($list["m_viewer_count"]); ?></span> </p>
                <p> <label>支持量：</label><span ><?php echo ($list["m_good_count"]); ?></span> </p>
                <p> <label>乐谱简介：</label><span ><?php echo ($list["m_name"]); ?></span> </p>
            </div>
            <div id="right">
                <img src="<?php echo ($list["m_avatar"]); ?>">
            </div>
            <div id="down"><?php echo ($list["m_score"]); ?></div>
        </div>
    </div>

</div>
</body>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>



</html>
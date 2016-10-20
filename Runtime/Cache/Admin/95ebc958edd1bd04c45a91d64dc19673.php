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
    
    <link rel="stylesheet" href="/dzq_api/Public/static/mstp/css/compiled/personal-info.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/dzq_api/Public/Admin/css/myInfo.css" type="text/css" media="screen" />

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
    
    <!-- edit form column -->
    <!-- main container .wide-content is used for this layout without sidebar :)  -->
    <div class="content wide-content">
        <div class="container-fluid">
            <div class="settings-wrapper" id="pad-wrapper" style="margin-top: 0">
                <div id="error"><?php echo ($error); ?></div>
                <!-- avatar column -->
                <div class="span3 avatar-box" style="width: 150px;">
                    <div class="personal-image" >
                        <div id="fileBox">
                            <img src="/dzq_api/Public/static/mstp/img/personal-info.png" class="avatar img-circle" />
                            <input type="file" name="upFile" form="addFrom" id="upFile"/>
                        </div>
                        <p style="margin-top: 10px;">&emsp;选 择 更 换 头 像</p>
                        <!--<input class="span5 inline-input" type="text" name="aaaa" form="addFrom" value="<?php echo ($list["name"]); ?>" />-->
                    </div>
                </div>

                <!-- edit form column -->
                <div class="span7 personal-info">
                    <h5 class="personal-title">个 人 信 息</h5>

                    <form action="<?php echo U('User/changeInfo');?>" method="post" enctype="multipart/form-data" id="addFrom">
                        <div class="field-box">
                            <label>我的用户名:</label>
                            <input class="span5 inline-input" type="text" name="name" value="<?php echo ($list["name"]); ?>" />
                        </div>
                        <div class="field-box">
                            <label>联系方式:</label>
                            <input class="span5 inline-input" type="text" name="tel" value="<?php echo ($list["phone"]); ?>" />
                        </div>
                        <div class="field-box">
                            <label>电子邮箱:</label>
                            <input class="span5 inline-input" id="email" type="email" name="email" value="<?php echo ($list["email"]); ?>" autocomplete="off"/>
                        </div>
                        <div class="field-box">
                            <label> 年&emsp;龄:</label>
                            <input class="span5 inline-input" type="text" name="age" value="<?php echo ($list["age"]); ?>" />
                        </div>
                        <div class="field-box">
                            <label> 性&emsp;别:</label>
                            <?php if(($list["sex"]) == "1"): ?><label for="nan" style="width: 20px">男：</label><input id="nan" type="radio" name="sex" value="1" attr="男" style="float: left;" checked/>
                                <label for="nv" style="width: 20px;margin-left: 30px;">女：</label><input id="nv" type="radio" name="sex" value="1" attr="女" style="float: left;"/>
                            <?php else: ?>
                                <label for="nan" style="width: 20px">男：</label><input id="nan" type="radio" name="sex" value="1" attr="男" style="float: left;"/>
                                <label for="nv" style="width: 20px;margin-left: 30px;">女：</label><input id="nv" type="radio" name="sex" value="1" attr="女" style="float: left;" /><?php endif; ?>
                            <br/>
                        </div>
                        <div class="field-box">
                            <label>新密码:</label>
                            <input class="span5 inline-input" type="password" name="password" value="" />
                        </div>
                        <div class="field-box">
                            <label>确认密码:</label>
                            <input class="span5 inline-input" type="password" name="confirmPassword" value="" />
                        </div>
                        <div class="span6 field-box actions">
                            <input type="submit" class="btn-glow primary" value="保存更改" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>


    <script src="/dzq_api/Public/Admin/js/admin/myInfo.js"></script>


</html>
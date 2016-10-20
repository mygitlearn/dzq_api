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
        <div id="error"><?php echo ($error); ?></div>
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>乐谱信息：</h3><h5><?php echo ($list["m_name"]); ?></h5>
                <input type="submit" form="fileForm" class="btn-flat success pull-right" value="&#43;确定提交">
            </div>
        </div>
        <div id="text">
            <form action="<?php echo U('Spectrum/saveMusic');?>" method="post" name="text" id="fileForm" enctype="multipart/form-data">
                <div id="left">
                    <input type="hidden" name="id" value="<?php echo ($list["m_id"]); ?>" />
                    <p style="margin-top: 3px"> <label>乐谱名称：</label><input type="text" name="musicName" value="<?php echo ($list["m_name"]); ?>"></p>
                    <p> <label>作曲者：</label><input type="text" name="author" value="<?php echo ($list["m_author"]); ?>"></p>
                    <p> <label>演奏者：</label><input type="text" name="player" value="<?php echo ($list["m_player"]); ?>"></p>
                    <p> <label>类别：</label>
                        <select id="musicType" name="m_type">
                            <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; if(($list["m_type"]) == $t["ca_id"]): ?><option selected="selected" value="<?php echo ($t["ca_id"]); ?>"><?php echo ($t["ca_type"]); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo ($t["ca_id"]); ?>"><?php echo ($t["ca_type"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </p>
                    <p> <label>乐谱文档：</label><input type="file" name="upImg[]"></p>
                    <p style="width:100%"> <label>乐谱简介：</label><textarea name="introduce" style="width: 85%;height: 45px"><?php echo ($list["m_intro"]); ?></textarea></p>
                </div>
                <div id="right">
                    <img id="showImg" src="<?php echo ($list["m_avatar"]); ?>">
                    <input id="upImg" name="upImg[]" type="file" />
                </div>
                <div id="down" style="height: 700px">
                    <textarea id="myEditor" name="news_content" style="width:100%;height:88%;float:left;"><?php echo ($list["m_score"]); ?></textarea>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>


    <script type="text/javascript" src="/dzq_api/Public/Admin/js/admin/Public.js"></script>


</html>
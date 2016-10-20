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
    
    <link rel="stylesheet" type="text/css" href="/dzq_api/Public/Admin/css/spectrumIndex.css" />

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
    
    <div id="demo">
        <form action="<?php echo U('addType');?>" method="post" enctype="multipart/form-data">
        <div id="left">
            <input type="file" name="upImg" id="upImg">
            <div id="img">
                <img id="showImg" src="<?php echo ($imgUrl); ?>">
                <input type="hidden" id="default_img" value="<?php echo ($imgUrl); ?>"/>
            </div>
        </div>
        <div id="right">
            <span class="icon-remove close_demo"></span><br/>
            <input id="inp" type="text" name="typeName" placeholder="类名称" value=""><br/>
            <div id="tijiao">提交</div>
            <input type="submit" id="sub" style="display: none" />
            <input type="hidden" id="code" name="code" value="" />
        </div>
        </form>
    </div>

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>谱库类别</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="请输入类别名" value="<?php echo session('searchCondition')?>"/>

                    <button class="btn-flat success pull-right"><span>&#43;</span>添加类别</button>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span4 sortable">类名</th>
                        <th class="span3 sortable"><span class="line"></span>音乐/首</th>
                        <th class="span2 sortable align-right"><span class="line"></span>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td>
                                <img src="<?php echo ($vo["ca_cover_img"]); ?>" class="img-circle avatar hidden-phone" style="width: 45px;height: 45px;"/>
                                <span style="line-height: 3"> <?php echo ($vo["ca_type"]); ?></span>
                            </td>
                            <td><?php echo ($vo["ca_count"]); ?></td>
                            <td class="align-right">
                                <a href="#" class="revise" value="<?php echo ($vo["ca_id"]); ?>" style="color: green">编辑</a> |
                                <a href="<?php echo U('Spectrum/changeStatus?i=1&id='.$vo['ca_id']);?>" style="color: red">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="url" value="<?php echo U();?>" />
            <div class="pagination pull-right">
                <?php echo ($_page); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>

</div>
</body>
<script src="/dzq_api/Public/static/mstp/js/layout.js"></script>


    <script type="text/javascript" src="/dzq_api/Public/Admin/js/admin/Spectrum.js"></script>


</html>
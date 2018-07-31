<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo C('site_name');?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="/Public/admin/js/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css">
    <link rel="stylesheet" href="/Public/admin/js/font-awesome/css/font-awesome.css">

    <script src="/Public/admin/js/jquery-1.7.2.min.js" type="text/javascript"></script>

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
  
  </head>


  <body class=""> 
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo ($admin_name); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                          
                            <li><a tabindex="-1" href="<?php echo U('/admin/login/loginOut');?>">登出</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="/"><span class="first">My</span> <span class="second">Tuer</span></a>
        </div>
    </div>
    
    <div class="sidebar-nav">
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="<?php echo U('/admin/index');?>">首页</a></li>
            <li ><a href="<?php echo U('/admin/index/lists');?>">文章列表</a></li>
            <li ><a href="<?php echo U('/admin/index/article');?>">新增文章</a></li>
            <li ><a href="<?php echo U('/admin/index/typemanager');?>">分类管理</a></li>
            <li ><a href="<?php echo U('/admin/index/keywordlists');?>">文章标签</a></li>
             <li ><a href="<?php echo U('/admin/index/clearCache');?>">清空缓存</a></li>
             <li ><a href="<?php echo U('/admin/index/synchroData');?>">同步数据</a></li>
        </ul>
    </div>

    

    

    
    <div class="content">
        
        <div class="header">
            <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
</div>

            <h1 class="page-title">Dashboard</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo U('/admin/index');?>">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    

            </div>
        </div>
    </div>
    


    <script src="/Public/admin/js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>
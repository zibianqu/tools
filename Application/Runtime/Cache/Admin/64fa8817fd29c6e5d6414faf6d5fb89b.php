<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>清除缓存-<?php echo C('site_name');?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" href="/Public/admin/js/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/elements.css">
<link rel="stylesheet" href="/Public/admin/js/font-awesome/css/font-awesome.css">
<script src="/Public/admin/js/jquery-1.7.2.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="/Public/kindeditor-4.1.4/kindeditor-min.js"></script>
    <script type="text/javascript" src="/Public/kindeditor-4.1.4/lang/zh_CN.js"></script>
<style type="text/css">
#line-chart {
	height: 300px;
	width: 800px;
	margin: 0px auto;
	margin-top: 1em;
}

.brand {
	font-family: georgia, serif;
}

.brand .first {
	color: #ccc;
	font-style: italic;
}

.brand .second {
	color: #fff;
	font-weight: bold;
}
</style>
<script type="text/javascript">
KindEditor.ready(function(K) {
	var editor = K.create('textarea[name="content"]', {
		cssPath : '/Public/kindeditor-4.1.4/plugins/code/prettify.css',
		uploadJson : '/Public/kindeditor-4.1.4/php/upload_json.php',
		fileManagerJson : '/Public/kindeditor-4.1.4/php/file_manager_json.php',
		allowFileManager : true
	});
});
</script>

</head>


<body class="">
	<!--<![endif]-->

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
            <li ><a href="<?php echo U('/admin/index/keywordlists');?>">文章标签</a></li>
             <li ><a href="<?php echo U('/admin/index/clearCache');?>">清空缓存</a></li>
             <li ><a href="<?php echo U('/admin/index/synchroData');?>">同步数据</a></li>
        </ul>
    </div>

	<div class="content">
		<div class="header">
			<h1 class="page-title">清除缓存</h1>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo U('/admin/index');?>">Home</a> <span class="divider">/</span></li>
			<li class="active">清除缓存</li>
		</ul>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="well">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active in" id="home">
							<form id="tabs" action="<?php echo U('/admin/index/clearCache');?>" method="post">
								<label>缓存类型：</label> 
								<input type="checkbox" value="0" name="default" id="default" onclick="if($(this).is(':checked')){$(this).val(1);}else{$(this).val(0);} "/>默认，
								<input type="checkbox" value="0" name="redis" id="redis" onclick="if($(this).is(':checked')){$(this).val(1);}else{$(this).val(0);} "/>redis
								<input type="hidden" name="clear" value="1" />
								<div class="btn-toolbar">
									<a href="#myModal" data-toggle="modal" class="btn">清除</a>
									<div class="btn-group"></div>
								</div>
							</form>
						</div>
						
					</div>
				</div>
				<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">清除缓存</h3>
					</div>
					<div class="modal-body">
						<p class="error-text">
							<i class="icon-warning-sign modal-icon"></i>确定清除缓存？
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button class="btn btn-danger" data-dismiss="modal" onclick="if($('#default').val()!=1 && $('#redis').val()!=1){alert('请选择清除类型');}else{$('#tabs').submit();}">确定</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="/Public/admin/js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>编辑文章-<?php echo C('site_name');?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" href="/Public/admin/js/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/elements.css">
<link rel="stylesheet" href="/Public/admin/js/font-awesome/css/font-awesome.css">
<script src="/Public/admin/js/jquery-1.7.2.min.js" type="text/javascript"></script>

    
      <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
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
            <li ><a href="<?php echo U('/admin/index/typemanager');?>">分类管理</a></li>
            <li ><a href="<?php echo U('/admin/index/keywordlists');?>">文章标签</a></li>
             <li ><a href="<?php echo U('/admin/index/clearCache');?>">清空缓存</a></li>
             <li ><a href="<?php echo U('/admin/index/synchroData');?>">同步数据</a></li>
        </ul>
    </div>

	<div class="content">

		<div class="header">
			<h1 class="page-title">编辑文章</h1>
		</div>

		<ul class="breadcrumb">
			<li><a href="<?php echo U('/admin/index');?>">Home</a> <span class="divider">/</span></li>
			<li><a href="<?php echo U('/admin/index/lists');?>">文章列表</a> <span class="divider">/</span></li>
			<li class="active">文章</li>
		</ul>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="well">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active in" id="home">
							<form id="tab" action="<?php echo U('/admin/index/SaveArticle');?>" method="post" enctype="multipart/form-data">
								<label>分类：</label> 
								<select id="type" name="type" >
									<option value="0" >暂无分类</option>
									<?php if(is_array($tlist)): foreach($tlist as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if(($a["type"]) == $val["id"]): ?>selected<?php endif; ?> ><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
								</select>
								<label>标题：</label> 
								<input type="text" value="<?php echo ($a["title"]); ?>" name="title" id="title" class="input-xxlarge">
								<label>关键字：</label> 
								<input type="text" value="<?php echo ($a["keyword"]); ?>" name="keyword" id="keyword" class="input-xxlarge" placeholder="多个用逗号隔开"> 
								<label>作者：</label> 
								<input type="text" value="<?php echo ($a["author"]); ?>" id="author" name="author" class="input-xxlarge" > 
								<label>图片：</label> 
								<div class="img_div">
									<label onclick="$('#img').trigger('click');" class="img_upload">上传</label>
									<input type="file" id="img" name="img" class="img_value">
								</div>
								<br/><br/>
								<label>内容：</label>
								<textarea rows="10" id="content" name="content" class="input-xxlarge"><?php echo ($a["content"]); ?></textarea>
								<input type="hidden" id="id" name="id" value="<?php echo ($a["id"]); ?>">
								<div class="btn-toolbar">
									<button class="btn btn-primary">
										<i class="icon-save"></i> Save
									</button>
									<a href="#myModal" data-toggle="modal" class="btn">Delete</a>
									<div class="btn-group"></div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="profile">
							<form id="tab2">
								<label>New Password</label> <input type="password"
									class="input-xlarge">
								<div>
									<button class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Delete Confirmation</h3>
					</div>
					<div class="modal-body">

						<p class="error-text">
							<i class="icon-warning-sign modal-icon"></i>Are you sure you want
							to delete the user?
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<button class="btn btn-danger" data-dismiss="modal">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>



  <script src="/Public/admin/js/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">
		$("[rel=tooltip]").tooltip();
		$(function() {
			$('.demo-cancel-click').click(function() {
				return false;
			});
		});
		
	
		var ue = UE.getEditor('content');
		ue.ready(function(){
			ue.setContent(content);
		})


	</script>

</body>
</html>
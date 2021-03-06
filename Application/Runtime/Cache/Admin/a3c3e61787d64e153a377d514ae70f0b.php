<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>编辑分类-<?php echo C('site_name');?></title>
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
		allowFileManager : true,
		afterCreate : function () {
			this.loadPlugin('autoheight');
			var self=this;
			var __doc = this.edit.doc;
			//KindEditor.ctrl(__doc, 'V', function () {
			    //alert('123');
			//});
			$(__doc).bind('paste', null, function () { //右键粘贴, 包括 ctrl+v
				//alert(self.html());
				 setTimeout(function () {  
					  parent.uploadWebImg(editor);  
                 }, 200);
			});
		},
	});

});

function uploadWebImg(editor) {
	  var relaceSrc = []; //图片地址对象容器  
	    var imgs = $(editor.html()).find('img'); 
	    imgs.map(function () {  
	        var _src = $(this).attr('src');  
	        //if ((_src.indexOf('http://') >= 0 || _src.indexOf('https://') >= 0) && checkimgok(_src)) {  
	        if (_src.indexOf('http://') >= 0 || _src.indexOf('https://') >= 0) { //考虑可能有动态生成的图片  
	            relaceSrc.push({ k: _src });  
	        };  
	    });  
	    if (relaceSrc.length == 0) return;
	    editor.readonly(true);
	    $.ajax({
            url:'/Public/kindeditor-4.1.4/php/http_upload.php',    //请求的url地址
            dataType:"json",   //返回格式为json
            async:true,//请求是否异步，默认为异步，这也是ajax重要特性
            data:{srcs:relaceSrc},    //参数值
            type:"POST",   //请求方式
            timeout:500000, //超时时间，考虑到网络问题，5秒还是比较合理的
            //beforeSend:function(){
                //请求前的处理
            //},
            success:function(result){
                //请求成功时处理
            	 var _content = editor.html();  
                 $(relaceSrc).each(function (idx, dom) {  
                     _content = _content.replace(dom.k, result.data[idx].value);  
                 });  
                 editor.html(_content); 
                 editor.readonly(false);
            },
            complete:function(XHR,TextStatus){
                //请求完成的处理
            	if(TextStatus=='timeout'){ //超时啦，干点什么呗
            		//page_content_obj.html("请求超时！！！");
            	}
            	 editor.readonly(false);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                //请求出错处理
				//page_content_obj.html("请求超时！！！");
            	 editor.readonly(false);
            }
        });
	   
}

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
            <li ><a href="<?php echo U('/admin/index/typemanager');?>">分类管理</a></li>
            <li ><a href="<?php echo U('/admin/index/keywordlists');?>">文章标签</a></li>
             <li ><a href="<?php echo U('/admin/index/clearCache');?>">清空缓存</a></li>
             <li ><a href="<?php echo U('/admin/index/synchroData');?>">同步数据</a></li>
        </ul>
    </div>

	<div class="content">

		<div class="header">
			<h1 class="page-title">编辑类</h1>
		</div>

		<ul class="breadcrumb">
			<li><a href="<?php echo U('/admin/index');?>">Home</a> <span class="divider">/</span></li>
			<li><a href="<?php echo U('/admin/index/typemanager');?>">分类列表</a> <span class="divider">/</span></li>
			<li class="active">文章</li>
		</ul>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="well">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active in" id="home">
							<form id="tab" action="<?php echo U('/admin/index/savetype');?>" method="post" enctype="multipart/form-data">
								<label>父级分类：</label> 
								<select id="parent_id" name="parent_id" >
									<option value="0" >请选择父级分类</option>
									<?php if(is_array($tlist)): foreach($tlist as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if(($t["parent_id"]) == $val["id"]): ?>selected<?php endif; ?> ><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
								</select>
								<label>名称：</label> 
								<input type="text" value="<?php echo ($t["name"]); ?>" name="name" id="name" class="input-xxlarge">
							 
								<label>排序：</label> 
								<input type="text" value="<?php echo ($t["order"]); ?>" id="order" name="order" class="input-xxlarge" > 
								
							
								<input type="hidden" id="id" name="id" value="<?php echo ($t["id"]); ?>">
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
	</script>

</body>
</html>
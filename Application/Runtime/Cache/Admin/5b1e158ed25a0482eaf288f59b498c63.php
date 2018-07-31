<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>文章标签列表-<?php echo C('site_name');?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" type="text/css"
	href="/Public/admin/js/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/css/elements.css">
<link rel="stylesheet" href="/Public/admin/js/font-awesome/css/font-awesome.css">
<script src="/Public/admin/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript"
	src="/Public/kindeditor-4.1.4/kindeditor-min.js"></script>
<script type="text/javascript"
	src="/Public/kindeditor-4.1.4/lang/zh_CN.js"></script>

<!-- Demo page code -->

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

			<h1 class="page-title">文章标签</h1>
		</div>

		<ul class="breadcrumb">
			<li><a href="<?php echo U('/admin/index');?>">Home</a> <span
				class="divider">/</span></li>
			<li class="active">文章标签</li>
		</ul>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="btn-toolbar">
					<a href="#addKeyWord" data-toggle="modal" class="btn btn-primary addbtn"><i class="icon-plus"></i>新增标签</a>
					<div class="querytitle">
						<form action="<?php echo U('/admin/index/keywordlists');?>" method="post">
							<p>
							<span>名称：</span> 
							<input type="text" name="t" id="t" value="<?php echo ($t); ?>" class="input-xlarge" />
							<span>数量：</span>
							<input type="text" name="num1" id="num1" value="<?php echo ($num1); ?>" class="input1" />
							<input type="text" name="num2" id="num2" value="<?php echo ($num2); ?>" class="input1" />
							<button class="btn">查询</button>
							</p>
						</form>
					</div>
				</div>
				<div class="well">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>标签名称</th>
								<th>查询数量</th>
								<th>排序</th>
								<th>更新时间</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($lists)): foreach($lists as $key=>$val): ?><tr id="rows_<?php echo ($val["id"]); ?>">
								<td><?php echo ($val["id"]); ?></td>
								<td><?php echo ($val["name"]); ?></td>
								<td><?php echo ($val["num"]); ?></td>
								<td><?php echo ($val["order"]); ?></td>
								<td><?php echo (date("Y-m-d H:i:s",$val["recordtime"])); ?></td>
								<td>
									<a href="#addKeyWord" role="button" data-toggle="modal" onclick="$('#keyid').val(<?php echo ($val["id"]); ?>);$('#name').val('<?php echo ($val["name"]); ?>');$('#num').val(<?php echo ($val["num"]); ?>);$('#order').val(<?php echo ($val["order"]); ?>);"  title="修改" alt="修改">
										<i class="icon-pencil"></i>
									</a> 
									<a href="#myModal" role="button" data-toggle="modal" onclick="$('#delid').val(<?php echo ($val["id"]); ?>)" title="删除" alt="删除">
										<i class="icon-remove"></i>
									</a>
								</td>
							</tr><?php endforeach; endif; ?>
						</tbody>
					</table>
				</div>
				<div class="dellotsize">
					<span>数量：</span>
					<input type="text" name="num1" id="del_num1" value="0" class="input1" />
					<input type="text" name="num2" id="del_num2" value="0" class="input1" />
					<a href="#delLotSizeModal" data-toggle="modal" class="btn" onclick="$('#delnum1').val($('#del_num1').val());$('#delnum2').val($('#del_num2').val());">批量删除</a>
				</div>
				<div class="page">
					<?php echo ($page); ?>
				</div>
				
				<div class="modal small hide fade" id="addKeyWord" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">×</button>
						<h3 id="myModalLabel">新增标签</h3>
					</div>
					<div class="modal-body">
						<p><span>名称：</span><input type="text" name="name" id="name"></p>
						<p><span>数量：</span><input type="text" name="num" id="num" value="1"></p>
						<p><span>排序：</span><input type="text" name="order" id="order" value="20"> <br>注：小于20则需要排序</p>
						<input type="hidden" name="keyid" id="keyid" />
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button class="btn btn-danger" data-dismiss="modal" onclick="doKeyWord()">操作</button>
					</div>
				</div>
				
				<div class="modal small hide fade" id="myModal" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">×</button>
						<h3 id="myModalLabel">Delete Confirmation</h3>
					</div>
					<div class="modal-body">
						<p class="error-text">
							<i class="icon-warning-sign modal-icon"></i>确定要删除吗?
							<input type="hidden" id="delid" />
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button class="btn btn-danger" data-dismiss="modal" onclick="deleteKeyWord()">删除</button>
					</div>
				</div>
				
				<div class="modal small hide fade" id="delLotSizeModal" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">×</button>
						<h3 id="myModalLabel">Delete Confirmation</h3>
					</div>
					<div class="modal-body">
						<p class="error-text">
							<i class="icon-warning-sign modal-icon"></i>确定要批量删除吗?
							<input type="hidden" id="delnum1" />
							<input type="hidden" id="delnum2" />
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button class="btn btn-danger" data-dismiss="modal" onclick="delLotSize()">删除</button>
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
		function deleteKeyWord(){
			var id=$('#delid').val();
			$.post("<?php echo U('/admin/index/deleteKeyWord');?>",{id:id},function(data){
				if(data.status){
					alert(data.msg);
					$('#rows_'+id).remove();
				}else{
					alert(data.msg);
				}
			},'json')
		}
		
		function delLotSize(){
			var num1=$('#delnum1').val();
			var num2=$('#delnum2').val();
			$.post("<?php echo U('/admin/index/deleteLotSizeKeyWord');?>",{num1:num1,num2:num2},function(data){
				if(data.status){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
				}
			},'json')
		}
		function doKeyWord(){
			var name=$('#name').val();
			var num=$('#num').val();
			var order=$('#order').val();
			var keyid=$('#keyid').val();
			$.post("<?php echo U('/admin/index/doKeyWord');?>",{keyid:keyid,name:name,num:num,order:order},function(data){
				if(data.status){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
				}
			},'json')
		}
	</script>

</body>
</html>
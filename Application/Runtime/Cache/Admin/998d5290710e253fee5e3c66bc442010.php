<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>分类管理-<?php echo C('site_name');?></title>
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
.oneclass{background-color:#FFFAFA}
.twoclass td span{margin-right:20px;}

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

			<h1 class="page-title">分类管理</h1>
		</div>

		<ul class="breadcrumb">
			<li><a href="<?php echo U('/admin/index');?>">Home</a> <span
				class="divider">/</span></li>
			<li class="active">分类列表</li>
		</ul>

		<div class="container-fluid">
			<div class="row-fluid">

				<div class="btn-toolbar">
					<button class="btn btn-primary addbtn"
						onclick="location.href='<?php echo U('/admin/index/type');?>';">
						<i class="icon-plus"></i> 新增分类
					</button>
					<div class="querytitle">
						<form action="<?php echo U('/admin/index/lists');?>" method="post">
							<p>
							<span>名称：</span> <input type="text" name="t" id="t" value="<?php echo ($title); ?>"
								class="input-xlarge" />
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
								<th>分类名称</th>
								<th>排序</th>
								
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($onetypes)): foreach($onetypes as $key=>$val): ?><tr id="one_<?php echo ($val["id"]); ?>" class="oneclass">
									<td><?php echo ($val["id"]); ?></td>
									<td><?php echo ($val["name"]); ?></td>
									<td><?php echo ($val["order"]); ?></td>
									<td>
										<a href="<?php echo U('/admin/index/type',array('id'=>$val['id']));?>" title="修改" alt="修改">
											<i class="icon-pencil"></i>
										</a> 
										
										<a href="#myModal" role="button" data-toggle="modal" onclick="$('#delid').val(<?php echo ($val["id"]); ?>);$('#num').val('one');" title="删除" alt="删除">
											<i class="icon-remove"></i>
										</a>
									</td>
								</tr>
								<?php if(is_array($twotypes)): foreach($twotypes as $k=>$aval): if($val["id"] == $k): if(is_array($aval)): foreach($aval as $key=>$bval): ?><tr id="two_<?php echo ($bval["id"]); ?>" class="twoclass">
											<td><span></span><?php echo ($bval["id"]); ?></td>
											<td><span></span><?php echo ($bval["name"]); ?></td>
											<td><span></span><?php echo ($bval["order"]); ?></td>
											<td>
												<a href="<?php echo U('/admin/index/type',array('id'=>$bval['id']));?>" title="修改" alt="修改">
													<i class="icon-pencil"></i>
												</a> 
												<a href="#myModal" role="button" data-toggle="modal" onclick="$('#delid').val(<?php echo ($bval["id"]); ?>);$('#num').val('two');" title="删除" alt="删除">
													<i class="icon-remove"></i>
												</a>
											</td>
										</tr><?php endforeach; endif; endif; endforeach; endif; endforeach; endif; ?>
						</tbody>
					</table>
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
							<input type="hidden" id="num" />
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
						<button class="btn btn-danger" data-dismiss="modal" onclick="deltype()">删除</button>
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
		function deltype(){
			var id=$('#delid').val();
			var num=$('#num').val();
			$.post("<?php echo U('/admin/index/deletetype');?>",{id:id},function(data){
				if(data.status){
					alert(data.msg);
					$('#'+num+'_'+id).remove();
				}else{
					alert(data.msg);
				}
			},'json')
		}
		
		function eye(id,status){
			$.post("<?php echo U('/admin/index/status');?>",{id:id,status:status},function(data){
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
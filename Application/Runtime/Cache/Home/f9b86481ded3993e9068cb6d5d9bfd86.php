<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>在线图片剪裁工具- <?php echo C('site_name');?></title>
	<meta name="keywords" content="在线图片剪裁工具"/>
	<meta name="description" content="在线图片剪裁工具"/>
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="/Public/css/zerogrid.css">
	<link rel="stylesheet" href="/Public/css/style.css">
    <link rel="stylesheet" href="/Public/css/responsive.css">
	<link rel="stylesheet" href="/Public/css/responsiveslides.css" />
	<link rel="stylesheet" href="/Public/css/newstyle.css">
	<link rel="stylesheet" href="/Public/css/jquery-linedtextarea.css">
    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/imgcrop/jquery-pack.js"></script>
    <script src="/Public/js/imgcrop/jquery.imgareaselect.min.js"></script>
    <script src="/Public/js/imgcrop.js"></script>
</head>
<body>
<!--------------Header--------------->

<script src="/Public/js/public.js"></script>
<header>
	<div class="wrap-header zerogrid">
		<div id="logo"><a href="/"><img src="/Public/images/logo.png" class=""/></a></div>
		<nav>
			<div class="wrap-nav">
				<div class="menu">
					<ul>
						<li <?php if($nav == 1): ?>class="current"<?php endif; ?>><a href="/">首页</a></li>
						<li <?php if($nav == 2): ?>class="current"<?php endif; ?>>
							<a href="<?php echo U('/art/lists');?>">文章</a>
							<div class="menu-article-type">
									<?php if(is_array($tlist)): foreach($tlist as $key=>$val): ?><p><a href="<?php echo U('/art/lists',array('ty'=>$val['id']));?>"><?php echo ($val["name"]); ?></a></p><?php endforeach; endif; ?>
							</div>
							
						</li>
						
					</ul>
				</div>
				<div class="search">
						<input type="text" name="t" id="t" value="<?php echo ($title); ?>" placeholder="请输入你要搜索的关键词" url="<?php echo U('/art/lists');?>"/>
					</div>
				<div class="minimenu"><div>MENU</div>
					<select onChange="location=this.value">
						<option></option>
						<option value="/">首页</option>
						<option value="<?php echo U('/art/lists');?>">文章</option>
					</select>
				</div>
			</div>
		</nav>
		
	</div>

</header>
<div id='rtt'></div>

<!--------------Content--------------->
<div class="new_content zerogrid">
	<div class="new_br"></div>
		<div class="new_menu">
			<?php echo ($menu_html); ?>
		</div>
	<div class="new_br"></div>
	<div class="new_line"></div>
	<div class="new_br"></div>
	<div class="new_tool imgcrop">
		<h1><?php echo ($menu_name); ?></h1>
		<div class="new_br"></div>
		<div class="new_tool_ imgcrop">
			<div class="upload">
				<form name="photo" enctype="multipart/form-data" action="<?php echo U('/tools/imgcrop#img_left');?>" method="post">
					<input type="file" name="image" size="30" class="button1"/> <input type="submit" name="upload" value="Upload" class="button1"/>
				</form>
			</div>
			<?php if($filename != ''): ?><div class="crop ">
				<h2>请拖动鼠标选择裁切区域：</h2>
					<div class="img_left" id="img_left">
						<img src="/Public/files/images/<?php echo ($filename); ?>" alt="图片已过期" style="float: left;" id="thumbnail"  />
					</div>
					<div class="clearfix"></div>
					<div class="img_center">
						<form name="thumbnail" action="<?php echo U('/tools/imgcrop#img_right');?>" method="post">
							<b>x1:</b><input type="text" name="x1" value="" id="x1" class="input2" />
							<b>y1:</b><input type="text" name="y1" value="" id="y1" class="input2"  />
							<b>x2:</b><input type="text" name="x2" value="" id="x2" class="input2"  />
							<b>y2:</b><input type="text" name="y2" value="" id="y2" class="input2"  />
							<b>宽:</b><input type="text" name="w" value="" id="w" class="input2"  />
							<b>高:</b><input type="text" name="h" value="" id="h" class="input2"  />
							<input type="submit" name="upload_thumbnail" value="剪裁" id="save_thumb" class="button1"/>
						</form>
					</div>
					<div class="clearfix"></div>
					<?php if($cropname != ''): ?><div class="img_right" id="img_right">
							<a href="<?php echo U('/do/download',array('t'=>'img','fn'=>$cropname));?>"  alt="点击下载" title="点击下载"><img src="/Public/files/images/<?php echo ($cropname); ?>" alt="图片已过期"></a>
						</div><?php endif; ?>
				</div><?php endif; ?>
			<div class="clearfix"></div>
			<div class="new_br"></div>
			<div class="new_br"></div>
		</div>
	</div>
</div>



<!--------------Footer--------------->


<footer>
	<div class="copyright">
		<p>Copyright &copy; 2016&nbsp;&nbsp;<a target="_blank" href="/">mytuer</a>,All Rights Reserved &nbsp;&nbsp;&nbsp;<a href="<?php echo U('/index/contact');?>">联系我</a></p>
	</div>
</footer>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"123.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

<script>
//var _hmt = _hmt || [];
//(function() {
//  var hm = document.createElement("script");
//  hm.src = "//hm.baidu.com/hm.js?f6fb0d05eeee1dee777aa23b3fea0552";
//  var s = document.getElementsByTagName("script")[0]; 
//  s.parentNode.insertBefore(hm, s);
//})();
</script>

</body>
</html>
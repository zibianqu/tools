<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Unix时间戳(Unix timestamp)转换工具 - <?php echo C('site_name');?></title>
	<meta name="keywords" content="Unix时间戳转换,时间戳转换工具"/>
	<meta name="description" content="Unix时间戳转换可以把Unix时间转成北京时间。"/>
	
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

    <script src="/Public/js/jquery.min.js"></script>
	<script src="/Public/js/unixtime.js"></script>
	
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
	<div class="new_tool">
		<h1><?php echo ($menu_name); ?></h1>
		<div class="new_br"></div>
		<div class="new_tool_ unixtime">
			<p>
				现在的Unix时间戳（Unix timestamp）<input type="text" class="input1" name="unix1" id="unix1" value=""/>
				<button class="button1" id="start">开始</button><button class="button1" id="stop">停止</button>
				<button class="button1" id="refresh">刷新</button><button class="button1" id="clear">清空</button>
			</p>
			<p>
				Unix时间戳（Unix timestamp）<input type="text" class="input1" name="unix2" id="unix2" value=""/>
				<button class="button1" id="change1">转换成北京时间</button><input type="text" class="input1" name="time1" id="time1" value=""/>
			</p>
			<p>
				北京时间（年/月/日 时:分:秒）<input type="text" class="input1" name="time2" id="time2"/>
				<button class="button1" id="change2">转换成Unix时间戳</button><input type="text" class="input1" name="unix3" id="unix3"/>
			</p>
			<p>
				北京时间<input type="text" class="input2" name="year" id="year"/>年<input type="text" class="input2" name="month" id="month"/>月
				<input type="text" class="input2" name="day" id="day"/>日<input type="text" class="input2" name="hour" id="hour"/>时
				<input type="text" class="input2" name="minute" id="minute"/>分<input type="text" class="input2" name="second" id="second"/>秒
				<button class="button1" id="change3">转换Unix时间戳</button><input type="text" class="input1" name="unix4" id="unix4">
			</p>
			 
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
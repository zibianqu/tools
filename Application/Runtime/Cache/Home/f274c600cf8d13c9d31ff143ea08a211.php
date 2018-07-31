<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo ($art["title"]); ?>- <?php echo C('site_name');?></title>
	<meta name="keywords" content="<?php echo ($art["keyword"]); ?>"/>
	<meta name="description" content="<?php echo ($art["keyword"]); ?>"/>
	
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
	<link rel="stylesheet" href="/Public/ueditor/themes/default/css/ueditor.css">
	<link rel="stylesheet" href="/Public/ueditor/themes/default/dialogbase.css?cache=0.6068784751091556">
	<link rel="stylesheet" href="/Public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">

    <script src="/Public/js/jquery.min.js"></script>
	<script src="/Public/js/unixtime.js"></script>
	<script type="text/javascript" src="/Public/ueditor/dialogs/internal.js"></script>
    <script type="text/javascript" src="/Public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
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
<div class="c_basic zerogrid">
	<div class="c_left art">
		<div class="art_body">
			<div class="art_content">
				<h1><?php echo ($art["title"]); ?></h1>
				<p class="art_content_1"><span>作者：<?php echo ($art["author"]); ?></span><span>阅读：<?php echo ($art["readnum"]); ?></span><span>时间：<?php echo (date('Y-m-d',$art["createtime"])); ?></span></p>
				<div class="c_l_border"></div>
				<div class="art_content_2">
					<?php echo (htmlspecialchars_decode($art["content"])); ?>
				</div>
			</div>
		</div>
		<div class="art_related">
			<div class="art_related_1">
					<?php if($prev["id"] > 0): ?>&lt;&lt;&nbsp;&nbsp;<a href="<?php echo U('/art/article',array('id'=>$prev['id']));?>"><?php echo (msubstr($prev["title"],0,40)); ?></a><?php endif; ?>
			<?php if($next["id"] > 0): ?><br/>
				&gt;&gt;&nbsp;&nbsp;<a href="<?php echo U('/art/article',array('id'=>$next['id']));?>"><?php echo (msubstr($next["title"],0,40)); ?></a><?php endif; ?>
			</div>	
		</div>
	</div>
	<div class="c_right">
		<div class="c_r_tags">
			<div class="c_r_tags_1">
				<p><span>推荐</span></p>
				<div class="c_r_tags_2">
					<?php if(is_array($recomtool)): foreach($recomtool as $key=>$val): ?><a href="<?php echo U('/tools/'.$val['function']);?>" class="button- button--wayra"><?php echo ($val["name"]); ?></a><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
		
		<div class="c_r_tags">
			<div class="c_r_tags_1">
				<p><span>标签</span></p>
				<div class="c_r_tags_2">
					<embed type="application/x-shockwave-flash" src="/Public/images/tagcloud.swf" width="260" height="250" id="tagcloudflash" name="tagcloudflash" bgcolor="#ffffff" quality="high" wmode="transparent" allowscriptaccess="always" flashvars="<?php echo hook('keyWords');?>">
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
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
<script type="text/javascript">      
 
SyntaxHighlighter.all();       
 
</script>
</html>
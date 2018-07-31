<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>列表- <?php echo C('site_name');?></title>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	
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
	<div class="c_left list_art">
		<ul>
		<?php if($lists == null): ?><li>
				<div class="l_a_div">
					<p class="l_a_title">
						暂无记录！！！
					</p>
				</div>
			</li><?php endif; ?>
		
		<?php if(is_array($lists)): foreach($lists as $key=>$val): ?><li>
				<div class="l_a_div">
					<p class="l_a_title"><?php echo (msubstr($val["title"],0,40)); ?></p>
					<p class="l_a_time"><?php echo (date('Y-m-d',$val["createtime"])); ?></p>
					<p class="l_a_content">
						<?php echo (strip_html_tags($val["content"])); ?>
					</p>
					<p class="l_a_read"><a href="<?php echo U('/art/article',array('id'=>$val['id']));?>">阅读全文</a></p>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
		<div class="page_2 loading hide">
			<img src="/Public/images/loading.gif" title="正在加载..."/>
		</div>
		
		<div class="page_2 hide">
			<input type="hidden" name="p" id="p" value="1" title="当前页数" />
			<input type="hidden" name="loadurl" id="loadurl" value="<?php echo U('/art/async_lists');?>" title="加载链接" />
			<?php echo ($page); ?>
		</div>
	</div>
	<div class="c_right">
		<div class="c_r_tags">
			<div class="c_r_tags_1">
				<p><span>标签</span></p>
				<div class="c_r_tags_2">
					<?php if(is_array($keyword)): foreach($keyword as $key=>$val): ?><a href="<?php echo U('/art/lists',array('t'=>$val['name']));?>" class="button- button--wayra"><?php echo ($val["name"]); ?></a><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>



<!--------------Footer--------------->
<script src="/Public/js/async_lists.js"></script>

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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo C('site_name');?></title>
	<meta name="keywords" content="<?php echo C('site_name');?>，在线工具，站长工具，便民工具,在线json格式化，json格式化，Unicode编码转换，在线时间戳转换，时间戳转换，在线js格式化，js格式化,HTML格式化，在线二维码生成，二维码生成，在线正则，在线正则表达式测试，ip地址查询"/>
	<meta name="description" content="<?php echo C('site_name');?>，在线工具，站长工具，便民工具在线json格式化，json格式化，Unicode编码转换，在线时间戳转换，时间戳转换，在线js格式化，js格式化，HTML格式化，在线二维码生成，二维码生成，在线正则，在线正则表达式测试，ip地址查询"/>
	
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
	<script src="/Public/js/responsiveslides.js"></script>
	<script src="/Public/js/swfobject.js"></script>
	<script>
		$(function () {
		  $("#slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: true,
			speed: 500,
			maxwidth: 962,
			namespace: "centered-btns"
		  });
		});
	</script>
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
	<div class="c_left index">
		<div class="c_l_tools">
			<div class="c_l_tools_1">
				<p ><span id="kfzgj">开发者工具</span></p>
				<div class="c_l_border"></div>
				<div class="c_l_tools_2">
					<?php echo ($kaifa); ?>
				</div>
			</div>
		</div>
		<div class="c_l_tools">
			<div class="c_l_tools_1">
				<p><span>站长工具</span></p>
				<div class="c_l_border"></div>
				<div class="c_l_tools_2">
					<?php echo ($zz); ?>
				</div>
			</div>
		</div>
		<div class="c_l_tools">
			<div class="c_l_tools_1">
				<p><span>便民工具</span></p>
				<div class="c_l_border"></div>
				<div class="c_l_tools_2">
					<?php echo ($bm); ?>
				</div>
			</div>
		</div>
		
		<div class="c_l_tools">
			<div class="c_l_art_1">
				<p><span>热门文章</span><span><a href="<?php echo U('/art/lists');?>">更多>></a></span></p>
				<div class="c_l_border"></div>
				<div class="c_l_art_2">
					<ul>
						<?php if(is_array($hotart)): foreach($hotart as $key=>$val): ?><li><a href="<?php echo U('/art/article',array('id'=>$val['id']));?>"><?php echo ($val["title"]); ?></a><span><?php echo (date('m-d',$val["createtime"])); ?></span></li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="c_l_tools">
			<div class="c_l_art_1">
				<p><span>最新文章</span><span><a href="<?php echo U('/art/lists');?>">更多>></a></span></p>
				<div class="c_l_border"></div>
				<div class="c_l_art_2">
					<ul>
						<?php if(is_array($newart)): foreach($newart as $key=>$val): ?><li><a href="<?php echo U('/art/article',array('id'=>$val['id']));?>"><?php echo ($val["title"]); ?></a><span><?php echo (date('m-d',$val["createtime"])); ?></span></li><?php endforeach; endif; ?>
					</ul>
				</div>
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
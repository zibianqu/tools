<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>JS/HTML格式化- <?php echo C('site_name');?></title>
	<meta name="keywords" content="js在线格式化,html在线格式化,js代码格式化"/>
	<meta name="description" content="可以对JS，HTML进行格式化排版，整齐的进行显示。"/>
	
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
	<script src="/Public/js/jquery-linedtextarea.js"></script>
	<script src="/Public/js/js_html/base.js"></script>
	<script src="/Public/js/js_html/htmlformat.js"></script>
	<script src="/Public/js/js_html/jsformat.js"></script>
	<script src="/Public/js/js_html/jsformat2.js"></script>
	<script src="/Public/js/jshtml.js"></script>
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
		<div class="new_tool_ jshtml">
			<div class="jshtml_content">
                    <div>
                        <textarea id="content" name="content" placeholder="请输入需要处理的javascript/HTML" style=""></textarea>
                    </div>
                    <div class="new_br"></div>
                    <div>
                        <select id="tabsize" class="select1">
                            <option value="1">制表符缩进</option>
                            <option value="2">2个空格缩进</option>
                            <option value="4" selected="selected">4个空格缩进</option>
                            <option value="8">8个空格缩进</option>
                        </select>
                        <input class="button1" value="格式化" onclick="return do_js_beautify()" id="beautify" type="button">
                        <!--<br>-->
                        <input class="button1" value="普通压缩" onclick="pack_js(0)" type="button">
                        <input class="button1" value="* 加密压缩 *" onclick="pack_js(1)" type="button">
                        <input class="button1 hide"value="复制" onclick="copy();" type="button">
                        <input class="button1" value="清空结果" onclick="Empty();" type="button">
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
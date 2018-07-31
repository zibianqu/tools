<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>在线正则- <?php echo C('site_name');?></title>
	<meta name="keywords" content="在线正则"/>
	<meta name="description" content="在线正则"/>
	
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
    <script src="/Public/js/regex.js"></script>
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
		<div class="new_tool_ regex">
			<div class="regex_common">
				<a href="javascript:;" t="zh">中文字符</a>
				<a href="javascript:;" t="szj">双字节符</a>
				<a href="javascript:;" t="kbh">空白行</a>
				<a href="javascript:;" t="email">Email地址</a>
				<a href="javascript:;" t="url">网址URL</a>
				<a href="javascript:;" t="mobile">手机(国内)</a>
				<a href="javascript:;" t="tel">电话号码(国内)</a>
				<a href="javascript:;" t="qq">腾讯QQ</a>
				<a href="javascript:;" t="zip">邮政编码</a>
				<a href="javascript:;" t="ip">IP</a>
				<a href="javascript:;" t="card">身份证号码</a>
				<a href="javascript:;" t="date">格式日期</a>
				<a href="javascript:;" t="zs">整数</a>
				<a href="javascript:;" t="zzs">正整数</a>
				<a href="javascript:;" t="fzs">负整数</a>
				<a href="javascript:;" t="zfds">正浮点数</a>
				<a href="javascript:;" t="ffds">负浮点数</a>
				<a href="javascript:;" t="user">用户名</a>
			</div>
			<p class="input_text">
				<textarea name="input_text" id="input_text" placeholder="输入待匹配文本"></textarea>
			</p>
			<p class="regex_regex">
				<textarea name="regex" id="regex" placeholder="输入正则"></textarea>
				<button class="button2" id="match">匹配</button>
			</p>
			<p class="match_text">
				<span>匹配结果</span>
				<textarea name="match_text" id="match_text"></textarea>
			</p>
			<p class="regex_replace">
				<textarea name="replace_text" id="replace_text" placeholder="输入替换文本"></textarea> 
				<button class="button2" id="replace">替换</button>
			</p>
			<p class="replace_text">
				<span>替换结果</span>
				<textarea name="replace_result" id="replace_result"></textarea>
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
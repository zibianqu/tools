<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>在线banner制作 - <?php echo C('site_name');?></title>
	<meta name="keywords" content="在线banner制作，广告制作，banner制作，广告banner制作"/>
	<meta name="description" content="在线banner制作，广告制作，banner制作，广告banner制作"/>
	
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
	<link rel="stylesheet" href="/Public/css/admake.css">

    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/iColor-min.js"></script>
    <script src="/Public/js/html5_.js"></script>
    <script src="/Public/js/jquery.mousewheel.min.js"></script>
    <script src="/Public/js/admaker.js"></script>
  
	
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
<div class="new_content zerogrid new_width">
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
		<div class="new_tool_ chat_">
				<div id="adMakerWarp">
			    <div class="left">
			        <ul>
			        	<li><label>操作提示：</label><label id="msg" style="color:red;width:100%">请选择图片!!!</label></li>
			            <li><label>图片上传：</label><input type="file" name="file" id="file"/></li>
			            <li class="line"></li>
			            <li>
			                <label>广告宽度：</label><input type="number" id="adWidth"  class="short wheelable" value="670"/>&nbsp;
			                <label>广告高度：</label><input type="number" id="adHeight" class="short wheelable" value="240"/>  px
			            </li>
			            <li class="line"></li>
			            <li><label>图片缩放：</label><input type="text" id="imgScale" class="short wheelable" value="1"/>&nbsp;&nbsp;倍</li>
			            <li>
			                <label>图片左偏移：</label><input type="number" id="iLeft" class="short wheelable" value="0"/>&nbsp;
			                <label>图片顶偏移：</label><input type="number" id="iTop" class="short wheelable" value="0"/>  px
			            </li>
			            <li class="line"></li>
			            <li id="colorWarp">
			                <label class="color">文字背景：</label>
			                <i class="white current" rgb="255,255,255"></i>
			                <i class="gray" rgb="37,37,37"></i>
			                <i class="yellow" rgb="244,179,0"></i>
			                <i class="green" rgb="120,186,0"></i>
			                <i class="blue" rgb="37,115,236"></i>
			                <i class="red" rgb="174,17,61"></i>
			                <i class="litter_coffe" rgb="99,47,0"></i>
			                <i class="coffe" rgb="46,23,0"></i>
			                <i class="orange" rgb="176,30,0"></i>
			                <i class="purple" rgb="114,0,172"></i>
			                <i class="yel" rgb="225,183,0"></i>
			            </li>
			            <li><label>背景透明度：</label><input type="text" id="bgOpacity" class="short backwheelable" value="0.5"/>&nbsp;
			                <label>背景高度：</label><input type="number" id="bgHeight" class="short wheelable" value="60"/>  px
			            </li>
			            <li class="line"></li>
			            <li><label>标题字号：</label><input type="number" id="titleFontSize" class="short wheelable"  value="25"/>&nbsp;
			                <label>标题颜色：</label>
			                <input type="text" id="titleFontColor" class="short" value="#000"/></li>
			            <li><label>标题左偏移：</label><input type="number" id="titleLeft" class="short wheelable" value="10"/>&nbsp;
			                <label>标题顶偏移：</label><input type="number" id="titleTop" class="short wheelable" value="20"/></li>
			            <li>
			            	<label>标题字体：</label>
			            	<select name="titleFontFamily" id="titleFontFamily">
			            		<option value="Microsoft YaHei">微软雅黑体</option>
			            		<option value="SimSun">宋体</option>
			            		<option value="NSimSun">新宋体</option>
			            		<option value="FangSong">仿宋</option>
			            		<option value="KaiTi">楷体</option>
			            		<option value="SimHei">黑体</option>
			            	</select>
			            </li>
			            <li>
			            	<label>标题风格：</label>
			            	<select name="titleFontStyle" id="titleFontStyle">
			            		<option value="normal">正常</option>
			            		<option value="italic">斜体</option>
			            		<option value="oblique">偏斜体</option>
			            	</select>&nbsp;
			            	<label>标题显示：</label>
			            	<select name="titleShow" id="titleShow">
			            		<option value="1">横排</option>
			            		<option value="2">竖排</option>
			            	</select>
			            	
			            </li>
			            <li><label>标题文字：</label><input type="text" id="title" class="long" value="标题文字写这里!!!"/></li>
			             <li class="line"></li>
			            <li><label>描述字号：</label><input type="number" id="desFontSize" class="short wheelable" value="15"/>&nbsp;
			                <label>描述颜色：</label><input type="text" id="desFontColor" class="short" value="#000"/></li>
			            <li><label>描述左偏移：</label><input type="number" id="desLeft" class="short wheelable" value="10"/>&nbsp;
			                <label>描述顶偏移：</label><input type="number" id="desTop" class="short wheelable" value="50"/></li>
			            <li>
			            	<label>描述字体：</label>
			            	<select name="desFontFamily" id="desFontFamily">
			            		<option value="Microsoft YaHei">微软雅黑体</option>
			            		<option value="SimSun">宋体</option>
			            		<option value="NSimSun">新宋体</option>
			            		<option value="FangSong">仿宋</option>
			            		<option value="KaiTi">楷体</option>
			            		<option value="SimHei">黑体</option>
			            	</select>
			            </li>
			            <li>
			            	<label>描述风格：</label>
			            	<select name="desFontStyle" id="desFontStyle">
			            		<option value="normal">正常</option>
			            		<option value="italic">斜体</option>
			            		<option value="oblique">偏斜体</option>
			            	</select>
			            	<label>描述显示：</label>
			            	<select name="desShow" id="desShow">
			            		<option value="1">横排</option>
			            		<option value="2">竖排</option>
			            	</select>
			            </li>
			            <li><label>描述文字：</label><input type="text" id="description" class="long" value="描述性文字写这里，字号较小!!!!!!!!!"/></li>
			            <li><input type="button" value="输出图像格式" id="putOut" class="btn button1"></li>
			        </ul>
			    </div>
			    <div class="right" id="paper"><img src="/Public/images/0.png" id="placeholder"></div>
			    
			</div>
				
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

<div id="mb"></div>
<a href="javascript:;" download="banner" title="点击下载" id="banner">
<img id="MyPix">
</a>
<script type="text/javascript" src="/Public/js/admaker/admake.js"  media="all"></script>
</body>
</html>
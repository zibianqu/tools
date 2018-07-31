<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>在线二维码图片生成器 - 二维码扫描软件下载 - <?php echo C('site_name');?></title>
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
	<link rel="stylesheet" href="/Public/css/jquery.range.css">
    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/qrcode/sdk.js"></script>
    <script src="/Public/js/qrcode/iColorPicker.js"></script>
    <script src="/Public/js/qrcode/index.js"></script>
    <script src="/Public/js/qrcode/basefn.js"></script>
    <script src="/Public/js/qrcode/qrcode.js"></script>
    <script src="/Public/js/qrcode/canvas.js"></script>
    <script type="text/javascript">var _speedMark = new Date();</script>
	<script src="/Public/js/qrcode.js"></script>
	
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
		<div class="new_tool_ qrcode">
			<div class="new_br"></div>
			<div class="qrcode_type">
				<p>
					<span class="now" id="q2">文本</span>
				</p>
			</div>
			<div class="new_br"></div>
			<div class="new_br"></div>
			<div class="qrcode_left">
				<ul>
					
					<li class="qrcode_text">
	                    <textarea  id="text_text" autocomplete="off" maxlength="300">支持文本、网址和电子邮箱</textarea>
	                    <br/>
	                   	 已输入字数：<span id="text_size">0</span>/300
					</li>
				</ul>
			</div>
			
			<div class="qrcode_right">
					<div class="canvas-div">
	                    <div class="canvas-wrap">
	                            <canvas height="230" width="230" id="canvas" style="cursor: default;">
	                                <a id="pic" target="_blank" href="" shorturl="/" rel="nofollow"><img id="qrcodeimg" src=""></a>
	                            </canvas>
	                    </div>
                    </div>
                    <div class="other">
                        <div class="save">
                            <form action="<?php echo U('do/savepng');?>" method="post" target="_blank" id="form">
                                <input type="hidden" name="data" value="" id="pngdata">
                                <input type="hidden" name="format" value="base64">
                                <input type="hidden" name="filename" value="mytuer.png">
                                <a href="javascript:void(0);" id="savepng">保存图片</a>
                            </form>
                        </div>
                    </div>
                    <div class="fnrow">
                        <div class="tab" id="tabset">
                            <a href="javascript:" class="tabelem active">基本</a>
                            <a href="javascript:" class="tabelem">颜色</a>
                            <a href="javascript:" class="tabelem">Logo</a>
                        </div>
                        <div class="fnblock" id="fnblock">
                        	<div class="fnsubv show">
                                <ul class="baseset">
                               		 <li>
                                        <input type="hidden" id="size_" name="size_" value="230"/> 
                                    </li>
                                    <li>
                                        <label>容错</label>
                                        <select id="level">
                                            <option value="H">30%</option>
                                            <option value="Q">25%</option>
                                            <option value="M">15%</option>
                                            <option value="L">7%</option>
                                        </select>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label>大小</label>
                                        <input type="text" id="size" name="size" value="230"/>px
                                    </li>
                                </ul>
                            </div>
                            <div class="fnsubv">
                                <ul class="colors">
                                    <li class="li1">
                                        <label>前景</label>
                                        <div class="color">
                                            <input id="fgcolor" name="mycolor" type="text" value="#000000" class="iColorPicker" style="background: rgb(0, 0, 0);"><div id="icp_fgcolor" class="colorPicker-picker" style="background-color:#000000" onclick="iColorShow(&#39;fgcolor&#39;,&#39;icp_fgcolor&#39;);return false;"></div><div id="icp_fgcolor" class="colorPicker-picker" style="background-color: rgb(0, 0, 0);" onclick="iColorShow(&#39;fgcolor&#39;,&#39;icp_fgcolor&#39;);return false;"></div>
                                        </div>
                                    </li>
                                    <li class="li4">
                                        <label>背景</label>
                                        <div class="color">
                                            <input id="bgcolor" name="mycolor" type="text" value="#ffffff" class="iColorPicker" style="background-color: rgb(255, 255, 255);"><div id="icp_bgcolor" class="colorPicker-picker" style="background-color:#ffffff" onclick="iColorShow(&#39;bgcolor&#39;,&#39;icp_bgcolor&#39;);return false;"></div><div id="icp_bgcolor" class="colorPicker-picker" style="background-color:#ffffff" onclick="iColorShow(&#39;bgcolor&#39;,&#39;icp_bgcolor&#39;);return false;"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="fnsubv">
                                <div class="pic">
                                    <span class="picbtn">
                                        <div class="addpic">
                                            <form  action="javascript:;" method="post" target="oniframe" id="logoform" enctype="multipart/form-data">
                                                <button class="button1" onclick="$('#logoimg').trigger('click')">上传logo</button><input type="file" id="logoimg" class="addlogo" name="logo"/>
                                            </form>
                                            <iframe name="oniframe" class="iframe" id="iframe" height="0" width="0" frameborder="0"></iframe>
                                         </div>
                                         <a href="javascript:" class="del" title="删除" id="resetLogoimg">删除</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                
			</div>
			 <div class="new_br"></div>
		</div>
	</div>
	
</div>

<!--------------Footer--------------->
<script type="text/javascript" src="/Public/js/qrcode/html5.js"></script>
<script type="text/javascript" src="/Public/js/jquery.range.js"></script>

<script type="text/javascript">

     defalutText($('#text_text'), '支持文本、网址和电子邮箱');
     tabfn($('#tabset .tabelem'), $('#fnblock .fnsubv'));
     addpic($('#logoimg'), $('#picelem'), $('#turn'), $('#format'));
     urlselect();
     $(document).ready(function() {
         resetAll();
     });
     $('#size_').jRange({
 		from: 80,
 		to: 800,
 		step: 1,
 		scale: [],
 		format: '%s',
 		width: 220,
 		showLabels: true,
 		showScale: true
 	});
     

 </script>
        

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
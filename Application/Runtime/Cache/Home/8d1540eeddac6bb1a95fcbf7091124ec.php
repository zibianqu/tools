<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>房贷计算器- <?php echo C('site_name');?></title>
	<meta name="keywords" content="房贷计算器"/>
	<meta name="description" content="房贷计算器"/>
	
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
    <script src="/Public/js/fdjsq.js"></script>
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
		<div class="new_tool_ fdjsq">
			<div class="fdjsq_left">
				<p>
					<label class="label1 d_now" id="apjs">根据面积、单价计算</label>
					<label class="label1" id="zejs">根据贷款总额计算</label>
				</p>
				<p id="apin">
					<span>单价：</span>
					<input type="text" name="price" id="price" class="input2" value=""/>元/平米
					<span>面积：</span>
					<input type="text" name="size" id="size" class="input2" value=""/>平方米
					<br/><br/>
					<span>按揭成数：</span>
					<select id="cs" name="cs" class="select1">
						<option value="9">9成</option>
						<option value="8">8成</option>
						<option value="7" selected>7成</option>
						<option value="6">6成</option>
						<option value="5">5成</option>
						<option value="4">4成</option>
						<option value="3">3成</option>
						<option value="2">2成</option>
					</select>
				</p>
				<p class="hide" id="zein">
					<span>贷款总额：</span>
					<input type="text" name="money" id="money" class="input1" value=""/>万元
				</p>
				<p>
					<span>按揭年数：</span>
					<input type="text" name="year" id="year" value="" class="input1"/>年<span></span>
				</p>
				<p>
					<span>贷款利率：</span>
					<input type="text" name="lilv" id="lilv" value="" class="input1" />%
				</p>
				<p>
					<span>还款方式：</span>
					<label><input type="radio" name="hkway" id="hkway" checked value="1" />等额本息</label>
					<label><input type="radio" name="hkway" id="hkway" value="2" />等额本金</label>
				</p>
			</div>
			<div class="fdjsq_center">
				<button id="js">计算</button><br>
				<button id="reset">重置</button>
			</div>
			<div class="fdjsq_right">
				<p><span>房款总额：</span><input type="text" name="fkze" id="fkze" class="input1" />元</p>
				<p><span>贷款总额：</span><input type="text" name="dkze" id="dkze" class="input1"/>元</p>
				<p><span>还款总额：</span><input type="text" name="hkze" id="hkze" class="input1"/>元</p>
				<p><span>支付利息款：</span><input type="text" name="zflx" id="zflx" class="input1"/>元</p>
				<p><span>首期付款：</span><input type="text" name="sqfk" id="sqfk" class="input1"/>元</p>
				<p><span>贷款月数：</span><input type="text" name="dkys" id="dkys" class="input1"/>月</p>
				<p id="yjhkin"><span>月均还款：</span><input type="text" name="yjhk" id="yjhk" class="input1"/>元</p>
				<p id="yjhkin1" class="hide"><span>月均还款：</span><textarea name="yjhk1" id="yjhk1" ></textarea></p>
				<p>*以上结果仅供参考</p>
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
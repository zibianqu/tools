<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>登陆-<?php echo C('site_name');?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="/Public/admin/js/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/elements.css">

    <script src="/Public/admin/js/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
  </head>

  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="/"><span class="first">My</span> <span class="second">Tuer</span></a>
        </div>
    </div>
    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">登陆</p>
            <div class="block-body">
                <form id="form" name="form" action="#">
                    <label>用户名：</label>
                    <input type="text" id="user" class="span12">
                    <label>密码：</label>
                    <input type="password" id="pass" class="span12">
                    <a href="javascript:;" id="login" class="btn btn-primary pull-right">登陆</a>
                    <label class="remember-me hide"><input type="checkbox"> Remember me</label>
                    <label class="remember-me login_msg color_red"></label>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="/" target="blank">mytuer.com</a></p>
        <p class="hide"><a href="#">Forgot your password?</a></p>
    </div>
</div>

    <script src="/Public/admin/js/bootstrap/js/bootstrap.js"></script>
   <script type="text/javascript">
   	$(function(){
   	   $('#pass').bind('keypress',function(event){  
           if(event.keyCode == "13")     
           {  
        	   dologin();
           }  
       });
   		$('#login').click(function(){
   			dologin();
   		})
   		
   		function dologin(){
   			var user=$('#user').val(),pass=$('#pass').val();
   			if(user==""){
   				$('.login_msg').html('用户名不能为空！');
   				return;
   			}
   			if(pass==''){
   				$('.login_msg').html('密码不能为空！');
   				return ;
   			}
   			$('.login_msg').html('');
   			$.post("<?php echo U('/admin/login/dologin');?>",{'user':user,'pass':pass},function(data){
   				if(data.status){
   					location.href="<?php echo U('/admin/index');?>";
   				}else{
   					$('.login_msg').html(data.msg);
   				}
   			},'json');
   		}
   	})
   		
   </script>
    
  </body>
</html>
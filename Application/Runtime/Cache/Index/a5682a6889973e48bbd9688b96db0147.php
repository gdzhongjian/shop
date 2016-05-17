<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 7]><html class="ie7 lt-ie10"><![endif]--><!--[if IE 8]><html class="ie8 lt-ie10"><![endif]--><!--[if IE 9]><html class="ie9 lt-ie10"><![endif]--><!--[if gt IE 9]><!--><html><!--<![endif]-->
<head>	
	<meta charset="utf-8" />	
	<title>登录－网上服饰购物系统</title> 
	 
	<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/base.css" /> <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css?1502021135.8682.0001" /><![endif]-->	 		
	<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/register_new.css"/>
	<script type="text/javascript" src="/shop/Public/index/js/jquery.js"></script> 
	<script type="text/javascript" src="/shop/Public/index/js/user/login.js"></script>
	<script type="text/javascript">
	        var checkEmail="<?php echo U('user/checkemail');?>";
	        var checkNickname="<?php echo U('user/checknickname');?>";
	        var verifyUrl="<?php echo U('user/verify');?>";
	        var checkByVerify="<?php echo U('user/checkbyverify');?>";
	</script>
	</head>
	<body>
		<div class="wrap" style="background-color: #F8F5F5">	
			<div class="reg_wrap" style="background-color: #F8F5F5">					
				<div class="main" style="background-color: #F8F5F5">			
					<div class="reg_form" id="mob_reg" style="margin-right: 35%">				
						<form id="loginForm" method="post" action="<?php echo U('user/checklogin');?>">					
							<h3><a href="<?php echo U('user/register');?>" style="text-decoration: none">注册</a>登录</h3>					
							<div class="reg_list">						
								<p class="reg_box">							
									<input class="reg_txt" id="email" name="email" type="text" placeholder="邮箱" />	
									<span></span>
									<span style="color: red"></span>
								</p>						
							</div>					
							<div class="reg_list">						
								<p class="reg_box">							
									<input class="reg_txt" id="password" name="password" type="password" placeholder="密码"/>					<span></span>
									<span style="color: red"></span>							
								</p>						
							</div>	
							<div class="reg_list">						
								<p class="reg_box">							
									<input class="reg_txt" id="verify" name="verify" type="password" placeholder="验证码"/ style="width: 150px">
									<img src="<?php echo U('user/verify');?>" alt="验证码" width="135px" style="float: right;cursor: pointer" title="点击刷新" id="verifyimage">
									<br>
									<span></span>
									<span style="color: red"></span>							
								</p>						
							</div>
							<div class="reg_list">						
								<p class="reg_box">							
									<input  id="remember" name="remember" type="checkbox" value="1" checked="checked"/>			
									<span>记住密码</span>
								</p>						
							</div>				
							
									
							
												
							<div class="reg_btn_wrap">						
								<input type="button" class="reg_btn" value="立即登录"/>	
							</div>					
						</form>				
					</div>		
				</div>	
			</div>
		</div>	
</body>
</html>
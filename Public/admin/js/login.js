$(document).ready(function() {
	$("#account").blur(function(){
		var account=$("#account").val();
		var url=checkAccount;
		if(account==""){
			$("#error1").html('请输入账号');
			return;
		}
		if(account!=""){
			$("#error1").html('');
			//异步判断账号是否存在
			$.post(
				url,
				{account:account}, 
				function(data){
					if(data==0){
						//账号不存在
						$("#error1").html('账号不存在');
					}
				},
				'text'
			);
		}
	});

	$("#password").blur(function(){
		var password=$("#password").val();
		if(password==""){
			$("#error2").html('请输入密码');
			return;
		}else{
			$("#error2").html('');
		}
	});

	//记住密码
	$("#remember").click(function(){
		var isRemember=$("#remember").attr('checked');
		if(isRemember=="checked"){
			//取消记住密码
			$("#remember").removeAttr('checked')
			$("#remember").val(0);
		}else{
			//记住密码
			$("#remember").attr('checked','checked');
			$("#remember").val(1);
		}
	});
	//登录按钮
	$("#login").click(function(){
		var account=$("#account").val();
		var password=$("#password").val();
		var verify=$("#verify").val();
		var url=checkAccount;
		var verifyurl=checkVerify;
		if(account==""){
			$("#error1").html('请输入账号');
			return false;
		}
		if(password==""){
			$("#error2").html('请输入密码');
			return false;
		}
		if(verify==""){
			$("#error3").html('请输入验证码');
			return false;
		}else{
			$("#error3").html('');
		}

		//判断账号是否存在
		$.post(
				url,
				{account:account}, 
				function(data){
					if(data==0){
						//账号不存在
						$("#error1").html('账号不存在');
					}
				},
				'text'
		);

		//判断验证码是否正确
		$.post(
			verifyurl, 
			{verify:verify}, 
			function(data){
				if(data==0){
					$("#error3").html('验证码错误');
				}else{
					$("#loginform").submit();
				}
			}
		);
	});

	//刷新验证码
	$("#verifyimage").click(function(){
		var url=verifyUrl;
		$("#verifyimage").attr('src',url+"?"+Math.random());
	});
	



});
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
			//异步判断账号是否已被注册
			$.post(
				url,
				{account:account}, 
				function(data){
					if(data==1){
						//账号已被注册
						$("#error1").html('账号已被注册');
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
		}
		if(password.length<6){
			$("#error2").html('密码不能小于6位');
		}else{
			$("#error2").html('');
		}
	});

	$("#level").click(function(){
		$("#error4").html('');
	});

	$("#password1").blur(function(){
		var password=$("#password").val();
		var password1=$("#password1").val();
		if(password1==""){
			$("#error3").html('请确认密码');
			return;
		}
		if(password1.length<6){
			$("#error3").html('确认密码不能小于6位');
			return;
		}
		if(password!=password1){
			$("#error3").html('两次输入的密码不一致');
			return;
		}else{
			$("#error3").html('');
		}
	});


	//注册按钮
	$("#register").click(function(){
		var account=$("#account").val();
		var password=$("#password").val();
		var password1=$("#password1").val();
		var level=$("#level").val();
		var url=checkAccount;
		if(account==""){
			$("#error1").html('请输入账号');
			return false;
		}
		if(password==""){
			$("#error2").html('请输入密码');
			return false;
		}
		if(password.length<6){
			$("#error2").html('密码不能小于6位');
			return false;
		}
		if(password1==""){
			$("#error3").html('请确认密码');
			return false;
		}
		if(password1.length<6){
			$("#error3").html('密码不能小于6位');
			return false;
		}
		if(password!=password1){
			$("#error3").html('两次输入的密码不一致');
			return false;
		}
		if(level==-1){
			$("#error4").html('请选择管理员级别');
			return false;
		}

		//判断账号是否被注册
		$.post(
				url,
				{account:account}, 
				function(data){
					if(data==1){
						//账号已被注册
						$("#error1").html('账号已被注册');
					}else{
						$("#registerform").submit();
					}
				},
				'text'
		);

	});



});
$(document).ready(function(){
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	$("#email").focus(function(){
		$("#email").siblings('span:eq(0)').removeClass('msg_err');
		$("#email").siblings('span:eq(1)').html('');
	}).blur(function(){
		var email=$("#email").val();
		if(email==""){
			$("#email").siblings('span:eq(0)').addClass('msg_err');
		}else{
			if(!reg.test(email)){
				$("#email").siblings('span:eq(1)').html('邮箱格式不正确');
			}else{
				//异步检查邮箱是否已经注册
				var url=checkEmail;
				$.post(
					url, 
					{email:email}, 
					function(data){
						if(data==1){
							$("#email").siblings('span:eq(1)').html('邮箱已被注册');
						}
					});
			}
		}
	});
	$("#nickname").focus(function(){
		$("#nickname").siblings('span:eq(0)').removeClass('msg_err');
		$("#nickname").siblings('span:eq(1)').html('');
	}).blur(function(){
		var nickname=$("#nickname").val();
		if(nickname==""){
			$("#nickname").siblings('span:eq(0)').addClass('msg_err');
		}else{
			//异步检查昵称是否已经存在
			var url=checkNickname;
			$.post(
				url, 
				{nickname:nickname}, 
				function(data){
					if(data==1){
						$("#nickname").siblings('span:eq(1)').html('昵称已被注册');
					}
				});
		}
	});

	$("#password").focus(function(){
			$("#password").siblings("span:eq(0)").removeClass("msg_err");
			$(".confpass").css({display:"block"});
		}).keypress(function(){
			var val=$("#password").val();
			if(val.length>=6){
				$(".pw_safe").css({display:"block"});
			}
		}).keyup(function(){
			var val=$("#password").val();
			if(val.length<=12){
				$(".pw_letter span").removeClass("pw_strength_color");
				$(".strength_l").addClass("pw_strength_color");
				
			}else if(val.length<=18){
				$(".pw_letter span").removeClass("pw_strength_color");
				$(".strength_m").addClass("pw_strength_color");
			}else if(val.length<=32){
				$(".pw_letter span").removeClass("pw_strength_color");
				$(".strength_h").addClass("pw_strength_color");
			}
		});

	$("#conf_password").focus(function(){
		$("#conf_password").siblings('span:eq(0)').removeClass('msg_err');
		$("#conf_password").siblings('span:eq(1)').html('');
	}).blur(function(){
		var conf_password=$("#conf_password").val();
		if(conf_password==""){
			$("#conf_password").siblings('span:eq(0)').addClass('msg_err');
		}else{
			if(conf_password.length<6){
				$("#conf_password").siblings('span:eq(1)').html('确认密码不能小于6位');
			}else{
				var password=$("#password").val();
				if(conf_password!=password){
					$("#conf_password").siblings('span:eq(1)').html('两次输入的密码不一致');
				}
			}
		}
	});

	$(".reg_btn").click(function(){
		var email=$("#email").val();
		var nickname=$("#nickname").val();
		var password=$("#password").val();
		var conf_password=$("#conf_password").val();
		if(email==""){
			$("#email").siblings('span:eq(0)').addClass('msg_err');
			$("#email").css('border-color','#f69');
			return;
		}else{
			if(!reg.test(email)){
				$("#email").siblings('span:eq(1)').html('邮箱格式不正确');
				return;
			}
		}
		if(nickname==""){
			$("#nickname").siblings('span:eq(0)').addClass('msg_err');
			$("#nickname").css('border-color','#f69');
			return;
		}
		if(password==""){
			$("#password").siblings('span:eq(0)').addClass('msg_err');
			$("#password").css('border-color','#f69');
			return;
		}else{
			if(password.length<6){
				$("#password").siblings('span:eq(1)').html('密码不能小于6位');
				$("#password").css('border-color','#f69');
				return;
			}
		}
		if(conf_password==""){
			$("#conf_password").siblings('span:eq(0)').addClass('msg_err');
			$("#conf_password").css('border-color','#f69');
			return;
		}else{
			if(conf_password.length<6){
				$("#conf_password").siblings('span:eq(1)').html('确认密码不能小于6位');
				$("#conf_password").css('border-color','#f69');
				return;
			}else{
				if(conf_password!=password){
					$("#conf_password").siblings('span:eq(1)').html('两次输入的密码不一致');
					$("#conf_password").css('border-color','#f69');
					return;
				}
			}
		}
		$("#registerForm").submit();

	});

});
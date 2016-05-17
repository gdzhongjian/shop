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
			}
		}
	});
	
	//刷新验证码
	$("#verifyimage").click(function(){
		var url=verifyUrl;
		$("#verifyimage").attr('src',url+"?"+Math.random());
	});

	$("#verify").focus(function(){
		$("#verify").siblings('span:eq(0)').removeClass('msg_err');
		$("#verify").siblings('span:eq(1)').html('');
	})

	$(".reg_btn").click(function(){
		var email=$("#email").val();
		var password=$("#password").val();
		var verify=$("#verify").val();
		var url=checkByVerify;
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
		if(password==""){
			$("#password").siblings('span:eq(0)').addClass('msg_err');
			$("#password").css('border-color','#f69');
			return;
		}
		if(verify==""){
			$("#verify").siblings('span:eq(0)').addClass('msg_err');
			$("#verify").css('border-color','#f69');
			return;
		}else{
			//异步检查验证码是否正确
			$.post(
				url, 
				{verify:verify}, 
				function(data){
					if(data==0){
						$("#verify").siblings('span:eq(1)').html('验证码错误');
					}else{
						$("#loginForm").submit();
					}
				})
		}

	});

});
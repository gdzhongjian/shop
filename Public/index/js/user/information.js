$(document).ready(function(){
	$("#xiugailocation").toggle(function(){
		$("#location_p").css('display','block');
		$("#xiugailocation").html('取消');
	},function(){
		$("#location_p").css('display','none');
		$("#xiugailocation").html('修改');
	});

	$("#xiugaibirthday").toggle(function(){
		$("#birthday_p").css('display','block');
		$("#xiugaibirthday").html('取消');
	},function(){
		$("#birthday_p").css('display','none');
		$("#xiugaibirthday").html('修改');
	});

	$("#nickname").focus(function(){
		$("#checknickname").html('');
	}).blur(function(){
		//异步检查昵称是否存在
		var email=$("#email").val();
		var nickname=$("#nickname").val();
		var checknickname=checkNicknameByInfo;
		$.post(
			checknickname, 
			{
				email:email,
				nickname:nickname
			}, 
			function(data){
				if(data==1){
					$("#checknickname").html('昵称已被注册');
				}

			});
	});



	$("#edit").click(function(){
		$("#success").html('');
		var email=$("#email").val();
		var truename=$("#truename").val();
		var nickname=$("#nickname").val();
		var sex=$("input[name='sex']:checked").val();
		var birthday=$("#birthday").val();
		var newbirthday=$("#newbirthday").val();
		var province=$("#province").val();
		var city=$("#city").val();
		var county=$("#county").val();
		var school=$("#school").val();
		var work_unit=$("#work_unit").val();
		var job=$("#job").val();
		var hobby=$("#hobby").val();
		var url=editUserinfo;
		if(nickname==""){
			$("#checknickname").html('昵称不能为空');
			return;
		}
		$.post(
			url, 
			{
				email:email,
				truename:truename,
				nickname:nickname,
				sex:sex,
				birthday:birthday,
				newbirthday:newbirthday,
				province:province,
				city:city,
				county:county,
				school:school,
				work_unit:work_unit,
				job:job,
				hobby:hobby,
			}, 
			function(data){
				if(data==0){
					$("#success").html('修改成功！');
					window.location.reload();
				}else if(data==1){
					$("#success").html('昵称已经存在！');
				}else{
					$("#success").html('没有输入新的信息，无需更新！');
				}
			});

	});

	
	$("#newpassword").focus(function(){
			$("#newpassword_s").html('');
		}).keyup(function(){
			var val=$("#newpassword").val();
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



});
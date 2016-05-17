$(document).ready(function(){
	$("#goodsadd").click(function(){
		var originalprice=$("#originalprice").val();
		var saleprice=$("#saleprice").val();
		var color=$("#color").val();
		var size=$("#size").val();
		var stock=$("#stock").val();
		var address=$("#address").val();
		//正则验证两位小数
		var check1=/^\d*\.\d{2}$/;

		if(color==""){
			$("#error3").html('请输入商品颜色');
			$("#color").focus();
			return false;
		}else{
			$("#error3").html('');
		}
		if(size==""){
			$("#error4").html('请输入商品尺寸');
			$("#size").focus();
			return false;
		}else{
			$("#error4").html('');
		}
		if(stock==""){
			$("#error5").html('请输入商品库存');
			$("#stock").focus();
			return false;
		}else{
			$("#error5").html('');
		}
		if(originalprice==""){
			$("#error1").html('请输入原价格');
			$("#originalprice").focus();
			return false;
		}else{
			if(!check1.test(originalprice)){
				$("#error1").html('请输入正确的原价格');
				$("#originalprice").focus();
				return false;
			}else{
				$("#error1").html('');
			}
		}
		if(saleprice==""){
			$("#error2").html('请输入销售价格');
			$("#saleprice").focus();
			return false;
		}else{
			if(!check1.test(saleprice)){
				$("#error2").html('请输入正确的销售价格');
				$("#saleprice").focus();
				return false;
			}else{
				$("#error2").html('');
			}
		}
		if(address==""){
			$("#error6").html('请输入商品发货地址');
			$("#address").focus();
			return false;
		}else{
			$("#error6").html('');
		}
		$("#signupForm").submit();

	});
});

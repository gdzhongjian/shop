$(document).ready(function(){
	//获取二级分类
	$("#firstcategory").change(function(){
		$("#seconddiv").css('display','none');
		$("#thirddiv").css('display','none');
		var firstcategory=$("#firstcategory").val();
		var url=secondCategoryList;
		if(firstcategory!=-1){
			//输出该一级分类下的二级分类
			$.post(
				url, 
				{pid:firstcategory}, 
				function(data){
					$("#secondcategory").html(data);
					$("#seconddiv").css('display','block');
				}
			);
		}
	});

	//获取三级分类
	$("#secondcategory").change(function(){
		$("#thirddiv").css('display','none');
		var secondcategory=$("#secondcategory").val();
		var url=thirdCategoryList;
		if(secondcategory!=-1){
			//输出该二级分类下的三级分类
			$.post(
				url, 
				{secondpid:secondcategory}, 
				function(data){
					$("#thirdcategory").html(data);
					$("#thirddiv").css('display','block');
				}
			);
		}
	});


	//点击是否包邮单选按钮
	$("input[name='mianyunfei']").click(function(){
		var value=$(this).attr('value');
		if(value=="bumianyunfei"){
			$("#yunfeijiage").css('display','block');
		}else{
			$("#yunfeijiage").css('display','none');
		}
	});	


	//点击商品添加时
	$("#goodsadd").click(function(){
		var firstname=$("#firstname").val();
		var secondname=$("#secondname").val();
		var firstcategory=$("#firstcategory").val();
		var secondcategory=$("#secondcategory").val();
		var thirdcategory=$("#thirdcategory").val();
		var brand=$("#brand").val();
		var mianyunfei=$("input[name='mianyunfei']").attr('value');
		var yunfei=$("#yunfei").val();
		var qianggou_start=$("#qianggou_start").val();
		var qianggou_end=$("#qianggou_end").val();
		var price=$("#price").val();
		// var originalprice=$("#originalprice").val();
		// var saleprice=$("#saleprice").val();
		// var color=$("#color").val();
		// var size=$("#size").val();
		// var stock=$("#stock").val();
		// var color_array=color.split('，');
		// var size_array=size.split('，');
		// var stock_array=stock.split('，');
		//正则验证两位小数
		var check1=/^\d*\.\d{2}$/;
		//正则验证日期xxxx-xx-xx xx:xx:xx
		var check2=/^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-)) (20|21|22|23|[0-1]?\d):[0-5]?\d:[0-5]?\d$/;
		if(firstname==""){
			$("#error1").html('请输入商品名称');
			$("#firstname").focus();
			return false;
		}
		if(firstcategory==-1){
			$("#error2").html('请选择一级分类');
			$("#firstcategory").focus();
			return false;
		}else{
			//当选择了一级分类时
			if(secondcategory==""){
				$("#error3").html('请选择二级分类');
				$("#secondcategory").focus();
				return false;
			}else if(secondcategory==-1){
				$("#error3").html('请选择二级分类');
				$("#secondcategory").focus();
				return false;
			}else{
				if(thirdcategory==""){
					$("#error4").html('请选择三级分类');
					$("#thirdcategory").focus();
					return false;
				}else if(thirdcategory==-1){
					$("#error4").html('请选择三级分类');
					$("#thirdcategory").focus();
					return false;
				}
			}
		}
		if(brand==""){
			$("#error5").html('请选择品牌分类');
			$("#brand").focus();
			return false;
		}

		if(mianyunfei=="bumianyunfei"){
			if(yunfei==""){
				$("#error6").html('请输入运费价格');
				$("#yunfei").focus();
				return false;
			}else{
				if(!check1.test(yunfei)){
					$("#error6").html('请输入正确的运费价格');
					$("#yunfei").focus();
					return false;
				}
			}
		}

		if(qianggou_start==""){
			
		}else{
				if(!check2.test(qianggou_start)){
				$("#error7").html('请输入正确的日期格式');
				$("#qianggou_start").focus();
				return false;
			}
		}

		if(qianggou_end==""){
			
		}else{
			if(!check2.test(qianggou_end)){
				$("#error8").html('请输入正确的日期格式');
				$("#qianggou_end").focus();
				return false;
			}
		}
		if(price==""){
			$("#error10").html('请输入商品价格');
			$("#price").focus();
			return false;
		}else{
			if(!check1.test(price)){
				$("#error10").html('请输入正确的商品价格');
				$("#price").focus();
				return false;
			}
		}
		$("#goodsForm").submit();


		


		// if(!check1.test(originalprice)){
		// 	$("#error6").html('请输入正确的原价格');
		// 	$("#originalprice").focus();
		// 	return false;
		// }

		// if(!check1.test(saleprice)){
		// 	$("#error7").html('请输入正确的销售价格');
		// 	$("#saleprice").focus();
		// 	return false;
		// }

		// //判断颜色，尺码，尺寸是否一致
		// if(color_array.length!=size_array.length){
		// 	$("#error9").html('尺码必须对应颜色');
		// 	$("#size").focus();
		// 	return false;
		// }




	});

});
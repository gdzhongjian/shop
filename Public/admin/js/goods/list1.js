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

	$("#select").click(function(){
		var firstcategory=$("#firstcategory").val();
		var secondcategory=$("#secondcategory").val();
		var thirdcategory=$("#thirdcategory").val();
		if(firstcategory==-1){
			$("#error1").html('请选择一级分类');
			$("#firstcategory").focus();
			return false;
		}
		if(secondcategory==-1){
			$("#error2").html('请选择二级分类');
			$("#secondcategory").focus();
			return false;
		}
		if(thirdcategory==-1){
			$("#error3").html('请选择三级分类');
			$("#thirdcategory").focus();
			return false;
		}
		$("#form").submit();
	});
});
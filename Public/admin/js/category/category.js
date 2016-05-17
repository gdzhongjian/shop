$(document).ready(function(){
	$("#first").click(function(){
		var url=checkCategory;
		var firstCategory=$("#firstname1").val();
		if(firstCategory==""){
			$("#firsterror1").html('请输入一级分类名称');
			return false;
		}
		//判断一级分类是否已经存在
		$.post(
			url, 
			{
				firstname:firstCategory,
				level:1
			}, 
			function(data){
				if(data==1){
					$("#firsterror1").html('分类名称已经存在');
				}else{
					$("#firstForm").submit();
				}
			}
		);

	});

	$("#second").click(function(){
		var url=checkCategory;
		var firstId=$("#secondpid").val();
		var secondCategory=$("#secondname2").val();
		if(firstId==-1){
			$("#seconderror1").html('请选择一级分类');
			return false;
		}else{
			$("#seconderror1").html('');
		}
		if(secondCategory==""){
			$("#seconderror2").html('请输入二级分类名称');
			return false;
		}else{
			$("#seconderror2").html('');
		}
		//判断二级分类是否存在
		$.post(
			url, 
			{
				secondname:secondCategory,
                level:2,
                firstid:firstId
			}, 
			function(data){
				if(data==1){
					$("#seconderror2").html('分类名称已经存在');
				}else{
					$("#secondForm").submit();
				}
			}
		);

	});


	//三级分类添加,获取二级分类
	$("#thirdpid1").change(function(){
		$("#seconddiv").css('display','none');
		var thirdpid1=$("#thirdpid1").val();
		var url=secondCategoryList;
		if(thirdpid1!=-1){
			//输出该一级分类下的二级分类
			// $("#shuchuerji").attr('condition','$category.pid eq '+thirdpid1);
			$.post(
				url, 
				{pid:thirdpid1}, 
				function(data){
					$("#thirdpid2").html(data);
					$("#seconddiv").css('display','block');
				}
			);
		}
	});

	//三级分类添加
	$("#third").click(function(){
		var url=checkCategory;
		var firstId=$("#thirdpid1").val();
		var secondId=$("#thirdpid2").val();
		var thirdCategory=$("#thirdname3").val();
		if(firstId==-1){
			$("#thirderror1").html('请选择一级分类');
			return false;
		}else{
			$("#thirderror1").html('');
		}
		if(secondId==-1){
			$("#thirderror2").html('请选择二级分类');
			return false;
		}else{
			$("#thirderror2").html('');
		}
		if(thirdCategory==""){
			$("#thirderror3").html('请输入三级分类');
			return false;
		}else{
			$("#thirderror3").html('');
		}
		//判断三级分类是否存在
		$.post(
			url, 
			{
				thirdname:thirdCategory,
				level:3,
				secondid:secondId
			}, 
			function(data){
				if(data==1){
					$("#thirderror3").html('分类名称已经存在');
				}else{
					$("#thirdForm").submit();
				}
			}
		);
	});

	//品牌添加
	$("#brand").click(function(){
		var url=checkBrand;
		var brand=$("#brandname").val();
		if(brand==""){
			$("#branderror").html('请输入品牌名称');
			return false;
		}
		//判断品牌是否存在
		$.post(
			url, 
			{brandname:brand}, 
			function(data){
				if(data==1){
					$("#branderror").html('品牌名称已经存在');
				}else{
					$("#brandForm").submit();
				}
			}
		);

	});

});
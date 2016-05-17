$(document).ready(function(){
	$("#select").click(function(){
		var firstname=$("#firstname").val();
		if(firstname==""){
			$("#error1").html('请输入商品名称');
			$("#firstname").focus();
			return false;
		}
		$("#form").submit();
	});
});
<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/shop/Public/index/css/base.css" /> 
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css?1501111218.8529.0001" /><![endif]-->	 

	
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/welcome_new.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/catalog.css"/>	
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/list.css"/>

<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/sale.wide.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/settings.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/cropper/cropper.css" />
<link rel="stylesheet" type="text/css" href="/shop/Public/index/cropper/style.css" />
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/addToCart.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/cart.css"/>



<script type="text/javascript" src="/shop/Public/index/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/order.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/address.css"/>
<script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>
		
		<div class="address_content">
			<div class="address_content_box">			
				<fieldset>				
					<form id="commentForm" method="post" action="">					
						<p>发表评论：</p>
						<p>
							<label for="addressUser">评分：</label>
							<input id="pingfen" type="radio" name="pingfen" value="3" checked="checked" />
							好评
							<input id="pingfen" type="radio" name="pingfen" value="2"/>
							中评
							<input id="pingfen" type="radio" name="pingfen" value="1"/>
							差评
							<strong></strong>
						</p>
						<p>
							<label>评论内容：</label>
							<textarea name="comment"  id="comment" cols="50" rows="5"></textarea>
							<strong></strong> 
						</p>
						<input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>" id="goods_id">
						<div class="submitBox" style="margin-right: 70%"><input class="addressBtn button" type="button" value="发表评论" id="add_comment"/></div>					
					</form>			
				</fieldset>		
			</div>	
		</div>
		
		
	</body>
</html>
<script type="text/javascript">
	$("#add_comment").click(function(){
		var comment=$("#comment").val();
		if(comment==""){
			layer.alert('请输入评论内容！',{title:"提示"});
			return false;
		}
		var pingfen=$("input[name='pingfen']:checked").val();
		var goods_id=$("#goods_id").val();
		$.ajax({
			url:"<?php echo U('detail/checkaddcomment');?>",
			type:"post",
			data:{
				pingfen:pingfen,
				comment:comment,
				goods_id:goods_id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					layer.alert('评论成功！',{title:"提示"});
				}else{
					layer.alert('评论失败!',{title:"提示"});
				}
			}
		})

	});
</script>
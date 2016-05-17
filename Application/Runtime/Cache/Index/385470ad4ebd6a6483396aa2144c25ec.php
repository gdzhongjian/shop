<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><!--[if IE 7]><html class="ie7 lt-ie10"><![endif]--><!--[if IE 8]><html class="ie8 lt-ie10"><![endif]--><!--[if IE 9]><html class="ie9 lt-ie10"><![endif]--><!--[if gt IE 9]><!-->
<html><!--<![endif]-->
	<head>	<meta charset="utf-8" />	
		<title><?php echo ($setting["web_name"]); ?></title>  
		<!-- <title>网上服饰购物系统</title>   -->
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/base.css" /> 
			<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css?1501111218.8529.0001" /><![endif]-->	 
			
				
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/welcome_new.css"/>
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/catalog.css"/>	
			<!-- <link rel="stylesheet" type="text/css" href="/shop/Public/index/css/list.css"/> -->

			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/sale.wide.css"/>
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/settings.css"/>
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/cropper/cropper.css" />
   	 		<link rel="stylesheet" type="text/css" href="/shop/Public/index/cropper/style.css" />
 			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/addToCart.css"/>
			<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/cart.css"/>
			


			<script type="text/javascript" src="/shop/Public/index/js/jquery.js"></script>	
		
			
	</head>	
	

	<body style="background-color:#F2F0F0;">	
	<!--最顶部的导航条开始-->
	<div class="uinfo_bar">	
		<div class="header_top">
			<a href="<?php echo U('index/index');?>">
				<span style="font-size: 30px;color: #ff6497"><?php echo ($setting["web_name"]); ?></span>
				<!-- <span style="font-size: 30px;color: #ff6497">网上服饰购物系统</span> -->
			</a>

			<ul class="menu_leo">
				<?php if($top_is_login == 1): ?><li id="setting">
						<a href="" title="">										
							<span class="s_face">
							<img src="/shop/Public/<?php echo ($top_userinfo["headimage"]); ?>" width="19px" height="19px"/>
							</span><?php echo ($top_user["nickname"]); ?>						
							<em class="redarrow"></em>				
						</a>				
						<ul class="add_menu_leo hw76 none_f">																		
							<li class="b_line">
								<a href="<?php echo U('user/information');?>" target="_blank">个人信息</a>
							</li>					
							<li>
								<a id="headLogoutBtn" href="<?php echo U('user/loginout');?>">退出登录</a>
							</li>
										
						</ul>			
					</li><?php endif; ?>
				<?php if($top_is_login == 0): ?><li id="mylogin">
					<a href="<?php echo U('user/login');?>">登录</a>
				</li>			
				<li>
					<a id="myregister" href="<?php echo U('user/register');?>">注册</a>
				</li><?php endif; ?>
				<?php if($top_is_login == 1): ?><li>
					<a href="<?php echo U('cart/index');?>" target="_blank" class="mycart">
					<em class="i_cart">&nbsp;</em>我的购物车	
					<span style="color:#fff;padding-right:6px;padding-left: 6px;border-radius: 6px;position: relative;margin-left: 3px;background-color: #ff6497">
						<?php if($cart_count > 0): echo ($cart_count); ?>
						<?php else: ?>
							0<?php endif; ?>
					</span>				
					</a>
				</li>
				<li >
					<a href="<?php echo U('order/index');?>" target="_blank">
					<em class="i_order">&nbsp;</em>我的订单</a>
				</li><?php endif; ?>			
			</ul>	
		</div>	
		<div class="clear_f"></div>
			</div>
	<!--最顶部的导航条结束-->
	<script>
		var num="0";
		$(".num_bgc").html(num);
		var total=parseInt($(".num_bgc").html());
		if(total>0){
			$(".num_bgc").removeClass("num_bgc_none");
		}
		$("#setting").mouseover(function(){
			$(".hw76").css({display:"block"});
		}).mouseout(function(){
			$(".hw76").css({display:"none"});
		});
		$("#mylogin").click(function(){
			window.location.href="login.html"
			
		});
		$("#myregister").click(function(){
			window.location.href="register.html"
		});
		
	</script>

	<!--搜索框开始-->
	<div class="header_bg " >	
		<div class="clear_f"></div>	
		<div class="header_top logo_wrap">					
			<div class="ser_n">						
			<form class="searchBox" id="searchForm" action="<?php echo U('search/index');?>" method="post" >				
				<div class="search-table">					
					<span class="cur" id="search_type">宝贝</span>	
					<em class="arrow"></em>	

				</div>				
				<span class="ipt1">
					<em class="i_search"></em>
					<input class="searchKey" name="keyword" id="keyword" type="text" <?php if(empty($keyword)): ?>value=""<?php else: ?>value="<?php echo ($keyword); ?>"<?php endif; ?> placeholder="搜索商品" />
				</span>				
				
				<span class="ipt2">
					<input type="button" class="fm_hd_btm_shbx_bttn" value="搜 索" id="search_goods" />
				</span>			
			</form>			
			<div class="clear_f"></div>			
			<ul class="searchType none_f"></ul>			
			
			</div>		
		</div>
	</div>
	<!--搜索框结束-->

<script type="text/javascript">
	$("#search_goods").click(function(){
		var keyword=$("#keyword").val();
		if(keyword==""){
			return false;
		}
		$("#searchForm").submit();
	});
</script>

<!--导航栏开始-->
		<div id="navbar">	
			<div class="wheader">		
				<div class="header_b">					
					<ul class="nav_new">								
						<li class="home">
							<a class="" href="<?php echo U('index/index');?>">首页
							<!-- <a class="r_d" href="<?php echo U('index/index');?>">首页 -->
							<span class="shining none_f"></span>
							</a>
						</li>				
						<?php if(is_array($banner_first_categorys)): $i = 0; $__LIST__ = $banner_first_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><li>

							<a class="" href="<?php echo U('category/index',array('level'=>1,'cid'=>$category['id']));?>"><?php echo ($category["name"]); ?>
							<em></em></a>
							<div class="header_list">
								<div class="header_lcon"></div>
							</div>	
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li class="dress">
							<a>男装
								<em class="white_arrow"></em>
							</a>
							<div class="header_list">
								<div class="header_lcon">
									<?php if(is_array($banner_first_categorys)): $i = 0; $__LIST__ = $banner_first_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><a href="<?php echo U('category/index',array('level'=>1,'cid'=>$category['id'],'sex'=>1));?>"><?php echo ($category["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</li>

					</ul>		
				</div>	
			</div>	
		</div>	
		<!--导航栏结束-->
		<script type="text/javascript">
		$(document).ready(function() {
			$(".nav_new li").last().mouseover(function(){
				$('div[class="header_list"]',this).css({display:"block"})
			}).mouseout(function(){
				$('div[class="header_list"]',this).css({display:"none"})
			});
		});
	</script>	
<script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>	
	<body>
		<!--状态栏开始-->
		<div class="cart_header">	
			<div class="logo_wrap">  
			</div>	
			<div class="status"> 
				<div class="chart"></div> 
				<div class="text"> 
					<span class="first" style="color:#F95285">我的购物车</span> 
					<span class="middle">填写核对订单信息</span> 
					<span>付款，完成购买</span> 
				</div> 
			</div>
		</div>
		<!--状态栏结束-->
		
		<!--状态顶部开始-->
		<div class="status-top">	
			<span class="tag-item tag-show">
				<a>购物车列表<span id="China_count">(<?php if($count > 0): echo ($count); else: ?>0<?php endif; ?>)</span></a>	
			</span>			
			<span class="right">
				商品总价：<span class="total_price" id="total_price"><?php echo ($count_price); ?></span>元
			</span>
		</div>
		<!--状态顶部结束-->
		
		<!--购物车开始-->
	
				
		<!--购物车没有商品时展示的页面 结束-->
		
		<!--购物车有商品 开始-->
		<div class="container">	
		<div class="cart">		
			<table cellspacing="0" cellpadding="0">		
				<!--商品列表标题头-->
				<thead>				
					<tr>					
						<th width="55px" class="tl first">						
							<input id="select_all1" type="checkbox" name="" value="" class="select_all mls-input-checkbox" checked="checked">						
							<label for="select_all1" class="mls-input-label mls-input-checkbox-label red-check">全选</label>					
						</th>					
						<th width="254px" style="text-align:center">商品信息</th>					
						<th width="100px">&nbsp;&nbsp;&nbsp;</th>					
						<th width="150px">单价（元）</th>					
						<th width="130px">数量</th>					
						<th width="135px">小计（元）</th>					
						<th class="last">操作</th>				
					</tr>			
				</thead>	
				
				<tbody class="shop">					
					<tr class="blank_tr">						
						<td colspan="7">							
						</td>					
					</tr>	
					
					
					<!--循环区开始-->
					
					<tr class="shop_title" id="shop_143211">						
						<td class="first">												
						</td>						
						<td class="tl last" colspan="6">							
													
							<div class="shop_discount clearfix"></div>													
						</td>					
					</tr>	
					
				</tbody>	
				
				<!--商品属性-->
				<tbody>
				<?php if(is_array($goods_message)): $i = 0; $__LIST__ = $goods_message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><tr class="goods last first goods_useless" id="tr_<?php echo ($i); ?>">												
						<td class="tl first">	
							<input id="select_<?php echo ($i); ?>" class="select_goods mls-input-checkbox" type="checkbox" value="672424596" name="shop[1]goods[0]" checked="checked">
							<label class="mls-input-label mls-input-checkbox-label red-check" for="select_<?php echo ($i); ?>"></label>
						</td>						
						<td class="g-content">							
							<a href="<?php echo U('detail/index',array('gid'=>$goods['gid']));?>" target="_blank">
								<img asrc="" src="/shop/Public/<?php echo ($goods["big_picture"]); ?>" width="75px" />
							</a>														
							<span class="name">								
								<a href="<?php echo U('detail/index',array('gid'=>$goods['gid']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
							</span>						
						</td>						
						<td class="order_detail">							
							<div class="order_detail_wrapper">								
								<span class="order_info order_info_useless">
								<span class="order_info_item order_info_item_0 first" id="color_<?php echo ($i); ?>">颜色：<?php echo ($goods["color"]); ?></span>											
								<span class="order_info_item order_info_item_1 " id="size_<?php echo ($i); ?>">尺码：<?php echo ($goods["size"]); ?></span>								
								</span>								
														
							</div>						
						</td>						
						<td class="price_discount">														
							<span class="price" id="price_<?php echo ($i); ?>"><?php echo ($goods["price"]); ?></span>																				
						</td>						
						<td class="mytd">									
						<span class="minus" id="minus_<?php echo ($i); ?>"></span>
							<input class="amount" type="text" value="<?php echo ($goods["nums"]); ?>"   readonly id="nums_<?php echo ($i); ?>" name="nums_<?php echo ($i); ?>">
						<span class="add" id="add_<?php echo ($i); ?>"></span>
						<input type="hidden" name="cart_id_<?php echo ($i); ?>" value="<?php echo ($goods["cid"]); ?>" id="cart_id_<?php echo ($i); ?>">
						</td>						
						<td>							
							<span class="goods_total id1" id="price_all_<?php echo ($i); ?>"><?php echo ($goods["price_all"]); ?></span>						
						</td>						
						<td class="last">
							<a href="javascript:void(0)" id="edit_<?php echo ($i); ?>">修改</a>
							<a href="javascript:void(0)" class="del" id="delete_<?php echo ($i); ?>">删除</a>				
						</td>					
					</tr>
						<script type="text/javascript">
							var url="<?php echo U('cart/danchuan');?>";
                            $("#edit_<?php echo ($i); ?>").click(function(){
                            	var url="<?php echo U('cart/tanchuan',array('cid'=>$goods['cid']));?>";
                            	var index=layer.open({
                            		type:2,
                            		title:'修改商品信息',
                            		area:['500px','300px'],
                            		shadeClose:true,
                            		content:url,
                            		end:function(){
                            			window.location.reload();
                            		}
                            	})
                            });
                            $("#minus_<?php echo ($i); ?>").live("click",function(){
								var cartv=parseInt($(this).next().val());
								cartv--;
								$(this).next().val(cartv);
								if(cartv<1){
									$(this).next().val(1);
									return;
								}

								var price=(parseFloat($("#price_<?php echo ($i); ?>").html())).toFixed(2);
								var cid=$("#cart_id_<?php echo ($i); ?>").val();
								if($("#select_<?php echo ($i); ?>").attr('checked')=="checked"){
									var total_price=(parseFloat($("#total_price").html())).toFixed(2);
									total_price=(Number(total_price-price)).toFixed(2);
									
								}else{
									var total_price=$("#total_price").html();
								}
									$.ajax({
										url:"<?php echo U('cart/editBuyNums');?>",	
										type:"post",		
										data:{
											cid:cid,
											nums:cartv
										},
										async:true,
										dataType:"json",
										success:function(data){	
											if(data==1){
												//保留两位小数
												var price_all=(Number(price*cartv)).toFixed(2);
												$("#price_all_<?php echo ($i); ?>").html(price_all);
												$("#total_price").html(total_price);
												$("#total_price2").html(total_price);

												
											}else{
												cartv++;
												$("#nums_<?php echo ($i); ?>").val(cartv);
												layer.alert('更改购买数量失败！');
											}
											
										}			
									});

							});
						$("#add_<?php echo ($i); ?>").live("click",function(){
							var max="<?php echo ($goods["max_stocks"]); ?>";
							var cartv=parseInt($(this).prev("input").val());
							cartv++;
							$(this).prev("input").val(cartv);
							if(cartv>max){
								$(this).prev().val(max);
								return;
							}
							var price=(parseFloat($("#price_<?php echo ($i); ?>").html())).toFixed(2);
							var cid=$("#cart_id_<?php echo ($i); ?>").val();
							if($("#select_<?php echo ($i); ?>").attr('checked')=="checked"){
								var total_price=(parseFloat($("#total_price").html())).toFixed(2);
								total_price=(parseFloat(total_price)+parseFloat(price)).toFixed(2);
							}else{
								var total_price=$("#total_price").html();
							}
								$.ajax({
									url:"<?php echo U('cart/editBuyNums');?>",	
									type:"post",		
									data:{
										cid:cid,
										nums:cartv
									},
									async:true,
									dataType:"json",
									success:function(data){	
										if(data==1){
											var price_all=(Number(price*cartv)).toFixed(2);
											$("#price_all_<?php echo ($i); ?>").html(price_all);
											$("#total_price").html(total_price);
											$("#total_price2").html(total_price);
										}else{
											cartv--;
											$("#nums_<?php echo ($i); ?>").val(cartv);
											layer.alert('更改购买数量失败！');
										}
										
									}			
								});
						});

						$("#delete_<?php echo ($i); ?>").click(function(){
							var cid="<?php echo ($goods['cid']); ?>";
							var total_price=$("#total_price").html();
							var price_all=$("#price_all_<?php echo ($i); ?>").html();
							layer.confirm('是否确定删除？',{title:'删除'},function(index){
								$.ajax({
									url:"<?php echo U('cart/delete');?>",
									type:"post",
									data:{
										cid:cid
									},
									async:true,
									dataType:"json",
									success:function(data){
										if(data==1){
											//删除成功
											$("#tr_<?php echo ($i); ?>").fadeOut();
											total_price=(parseFloat(total_price)-parseFloat(price_all)).toFixed(2);
											$("#total_price").html(total_price);
											$("#total_price2").html(total_price);	
										}else{
											layer.alert('删除失败！');
										}
									}
								});
								layer.close(index);
							})
						});
						$("#select_<?php echo ($i); ?>").click(function(){
							var total_price=$("#total_price").html();
							var price_all=$("#price_all_<?php echo ($i); ?>").html();
							var value=$("#select_<?php echo ($i); ?>").attr('checked');
							if(value=="checked"){
								//勾选上,商品总价加上去
								
								total_price=(parseFloat(total_price)+parseFloat(price_all)).toFixed(2);
								$("#total_price").html(total_price);
								$("#total_price2").html(total_price);
							}else{
								//取消勾选，商品总价减下去
								total_price=(parseFloat(total_price)-parseFloat(price_all)).toFixed(2);
								$("#total_price").html(total_price);
								$("#total_price2").html(total_price);
							}
						});

						</script><?php endforeach; endif; else: echo "" ;endif; ?>	

			    									
				</tbody>	
				
				<tbody class="empty">				
					<tr><td colspan="7"></td></tr>			
				</tbody>			
				
				<!--循环区结束-->
				
				
				<!--列表底部-->
				<?php if(empty($goods_message)): else: ?>
				<tfoot id="float_ctrl">				
					<tr>					
						<td width="65px" class="tl first">						
							<input id="select_all2" type="checkbox" name="" value="" class="select_all mls-input-checkbox" checked="checked">						
							<label for="select_all2" class="mls-input-label mls-input-checkbox-label red-check">全选</label>					
						</td>					
						
						<td colspan="6" id="noTips" class="last tl clearfix_f">						
							<a href="javascript:;" id="removeSelected" class="link red_f">删除选中的商品</a>												
							<span class="txt">商品总价：</span>						
							
							<span class="red">￥<span class="total_price  totalid" id="total_price2"><?php echo ($count_price); ?></span></span>
							<form method="post" action="<?php echo U('cart/index2');?>" id="add_account">
							<input type="button" value="" class="charge-btn" style="border:none;cursor:pointer" id="account_submit"/>
							</form>
						</td>									
					</tr>			
				</tfoot><?php endif; ?>
			</table>		
		<div>		
		</div>	
		</div>	
		</div>
	
	<!--购物车有商品结束-->	
	
		
	<!--购物车结束-->	
	
		
		
	
	
		
			<!--页脚开始-->
			<div class="footer">
				<div class="foot_con">		
							
					<div class="record" style="width: 50%;margin-left: 30%">
						<ul>
							<li style="float: left;margin-left: 15%"><a href="<?php echo U('index/index');?>" title="">网站首页</a></li>
							<li style="float: left;margin-left: 10%"><a href="javascript:void(0)" title="" id="jishufankui">技术反馈</a></li>
						</ul>	
						<br>
						<?php echo ($setting["web_buttom"]); ?>
						<!-- Copyright ©2016 - 2016 网上服饰购物系统 & 版权所有 -->
					</div>	
				</div>
			</div>
			<!--页脚结束-->
<script type="text/javascript">
	$("#jishufankui").click(function(){
		alert('作者：钟健\n联系邮箱：1104785781@qq.com');
	});
</script>
	
	</body>
</html>
<script type="text/javascript">
	$("#select_all1").click(function(){
		var count="<?php echo ($i); ?>";
		var value=$("#select_all1").attr('checked');
		var total_price=0;
		if(value=="checked"){
			//全选
			$("#select_all2").attr('checked','checked');
			for(var i=1;i<=count;i++){
				$("#select_"+i).attr('checked','checked');
				var price_all=$("#price_all_"+i).html();
				total_price=(parseFloat(total_price)+parseFloat(price_all)).toFixed(2);
			}
			$("#total_price").html(total_price);
			$("#total_price2").html(total_price);
		}else{
			//全部取消,商品总价全部为0
			$("#select_all2").removeAttr('checked');
			for(var i=1;i<=count;i++){
				$("#select_"+i).removeAttr('checked');
			}
			$("#total_price").html(0);
			$("#total_price2").html(0);
		}
	});
	$("#select_all2").click(function(){
		var count="<?php echo ($i); ?>";
		var value=$("#select_all2").attr('checked');
		var total_price=0;
		if(value=="checked"){
			//全选
			$("#select_all1").attr('checked','checked');
			for(var i=1;i<=count;i++){
				$("#select_"+i).attr('checked','checked');
				var price_all=$("#price_all_"+i).html();
				total_price=(parseFloat(total_price)+parseFloat(price_all)).toFixed(2);
			}
			$("#total_price").html(total_price);
			$("#total_price2").html(total_price);
		}else{
			//全部取消,商品总价全部为0
			$("#select_all1").removeAttr('checked');
			for(var i=1;i<=count;i++){
				$("#select_"+i).removeAttr('checked');
			}
			$("#total_price").html(0);
			$("#total_price2").html(0);
		}
	});

	$("#removeSelected").click(function(){
		layer.confirm('是否确定删除？',{title:'删除选中的商品'},function(index){
			var count="<?php echo ($i); ?>";
			for(var i=1;i<=count;i++){
				var value=$("#select_"+i).attr('checked');
				if(value=="checked"){
					//选中的商品，删除
					var cid=$("#cart_id_"+i).val();
					var total_price=$("#total_price").html();
					var price_all=$("#price_all_"+i).html();
					var a=i;
					$.ajax({
						url:"<?php echo U('cart/delete');?>",
						type:"post",
						data:{
							cid:cid
						},
						async:true,
						dataType:"json"
					});
					//删除成功
					$("#tr_"+a).fadeOut();
					total_price=(parseFloat(total_price)-parseFloat(price_all)).toFixed(2);
					$("#total_price").html(total_price);
					$("#total_price2").html(total_price);
				}
			}
			layer.close(index);
		})
		
	});

	$("#account_submit").click(function(){
		var count="<?php echo ($i); ?>";
		var submit=0;	//要提交的隐藏域个数
		var dangqian=1;	//当前编号
		for(var i=1;i<=count;i++){
			var value=$("#select_"+i).attr('checked');
			if(value=="checked"){
				//获取被选中的商品
				var cid=$("#cart_id_"+i).val();
				// var html="<input type='hidden' name='checked_"+cid+"' value='"+cid+"' >";
				$("#add_account").append("<input type='hidden' name='checked_"+dangqian+"' value='"+cid+"' >");
				dangqian++;
				submit++;
			}
		}
		if(submit>0){
			//选中有商品
			$("#add_account").append("<input type='hidden' name='nums' value='"+submit+"'>");
			$("#add_account").submit();
		}else{
			//没有选中商品
			layer.alert('请选择要结算的商品！');
		}
	});
</script>
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
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/detail.css"/>		
	
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
	<div class="clear_f"></div>	
	<div class="order_header"></div>
	<div class="route">
		<div class="route_bread">	
			<a href="<?php echo U('index/index');?>">网上服饰购物系统</a>	
			<samp>&gt;</samp>	
			<span class="red_f">订单详情</span>
		</div>
	</div>
	
	<div class="order_area">
		<div class="order_status_bar">	

			<p>当前状态：
				<?php if($order['status'] == 0): ?>等待付款
				<?php elseif($order['status'] == 1): ?>
				等待发货
				<?php elseif($order['status'] == 2): ?>
				等待收货
				<?php elseif($order['status'] == 3): ?>
				交易成功
				<?php elseif($order['status'] == -1): ?>
				订单已关闭
				<?php else: ?>
				退货/退款<?php endif; ?>

			</p>

			<div class="flowStep" style="width:576px;">	
				<div class="chart" style="margin-left:54px">	
					<div class="line" style="width:456px;left:6px"></div>	
					<div style="margin-left:0px;" <?php if(($order['status'] != -1) AND ($order['status'] != -2)): ?>class="ball"<?php else: ?>class="ball empty"<?php endif; ?> ></div>		
					<div style="margin-left:140px;" <?php if(($order['status'] != -1) AND ($order['status'] != -2) AND ($order['status'] != 0)): ?>class="ball"<?php else: ?>class="ball empty"<?php endif; ?> ></div>	
					<div style="margin-left:140px;" <?php if(($order['status'] == 2) OR ($order['status'] == 3) ): ?>class="ball"<?php else: ?>class="ball empty"<?php endif; ?> ></div>	
					<div style="margin-left:140px;" <?php if($order['status'] == 3): ?>class="ball"<?php else: ?>class="ball empty"<?php endif; ?> ></div>	
				</div>
				<div class="text">					
					<div <?php if(($order['status'] != -1) AND ($order['status'] != -2)): ?>class="active"<?php endif; ?> style="width:120px;">拍下宝贝</div>		
					<div  style="width:120px;margin-left:32px;" <?php if(($order['status'] != -1) AND ($order['status'] != -2) AND ($order['status'] != 0)): ?>class="active"<?php endif; ?> >支付订单</div>		
					<div  style="width:120px;margin-left:32px;" <?php if(($order['status'] == 2) OR ($order['status'] == 3) ): ?>class="active"<?php endif; ?>  >卖家发货</div>			
					<div  style="width:120px;margin-left:32px;" <?php if($order['status'] == 3): ?>class="active"<?php endif; ?> >确认收货</div>
		
					<?php if(($order['status'] != -1) AND ($order['status'] != -2)): ?><div class="active" style="width:120px;"><?php echo (Date("Y-m-d H:i:s",$order["buy_time"])); ?></div><?php endif; ?>
					<?php if(($order['status'] != -1) AND ($order['status'] != -2) AND ($order['status'] != 0)): ?><div  style="width:120px;margin-left:32px;" class="active"><?php echo (Date("Y-m-d H:i:s",$order["pay_time"])); ?></div><?php endif; ?>	
					<?php if(($order['status'] == 2) OR ($order['status'] == 3) ): ?><div  style="width:120px;margin-left:32px;" class="active"><?php echo (Date("Y-m-d H:i:s",$order["send_time"])); ?></div><?php endif; ?>
					<?php if($order['status'] == 3): ?><div  style="width:120px;margin-left:32px;" class="active"><?php echo (Date("Y-m-d H:i:s",$order["finish_time"])); ?></div><?php endif; ?>
				</div>
			</div> 
			<?php if($order['status'] == 0): ?><div class="status_text">   
				<div class="status_text">
					您的订单已经提交，请在<?php echo (Date("Y-m-d H:i:s",$to_pay_time)); ?>
					<span class="red_f"></span>
					前完成支付，超时订单将自动关闭。
				</div>
					<a id="pay_now" class="btn" href="javascript:void(0)">立即支付</a>
					<a id="cancel_order" class="btn gray" href="javascript:void(0);">取消订单</a>	
			</div><?php endif; ?>
			<?php if($order['status'] == 1): ?><div class="status_text">
					您已经付款，请等待商家发货
				</div><?php endif; ?>
			<?php if($order['status'] == 2): ?><div class="status_text">
					商家已发货，请等待收货
					<a id="receive" class="btn" href="javascript:void(0)">确认收货</a>
				</div><?php endif; ?>
			<?php if($order['status'] == 3): ?><div class="status_text">
					交易已完成
				</div><?php endif; ?>
			<?php if($order['status'] == -1): ?><div class="status_text">
					订单已关闭
				</div><?php endif; ?>
			<?php if($order['status'] == -2): ?><div class="status_text">
					退货/退款
				</div><?php endif; ?>
		</div>
		
		
		<div class="order_address">		
			<div id="express">		
				<h4>收货信息</h4>		
				<p>收货人：<?php echo ($user_address["receiver"]); ?></p>		
				<p>收货地址：<?php echo ($user_address["address"]); ?></p>		
				<p>收货邮编：<?php echo ($user_address["postcode"]); ?></p>		
				<p>联系电话：<?php echo ($user_address["phone"]); ?></p>	
				<?php if($order['postcode'] > 0): ?><p>快递单号：<?php echo ($order["postcode"]); ?></p>
					<p>快递类型：<?php echo ($order["post_type"]); ?></p><?php endif; ?>	
			</div>		
		</div>	
		<div class="order_goods">
			<table class="order_list">		
				<colgroup>			
					<col width="360">		
					<col width="120">		
					<col width="80">			
					<col width="100">		
					<col width="130">	
					<col width="120">	
				</colgroup>	
				<thead>		
					<tr>			
						<th>商品信息</th>		
						<th>单价（元）</th>		
						<th>数量</th>		
						<th>合计（元）</th>			
						<th>订单状态</th>		
					</tr>	
				</thead>	
				<tbody class="order_list">
					<tr class="order_goods_list">		
						<td class="order_goods_goods">			
							<a target="_blank" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>">
							<img class="pic" src="/shop/Public/<?php echo ($goods["big_picture"]); ?>"/>						
								<p><?php echo ($goods["first_name"]); ?></p>		
								<p class="prop">																	
									<span class="order_detail_prop">颜色：<?php echo ($stock["color"]); ?></span>	<br>											
									<span class="order_detail_prop">尺码：<?php echo ($stock["size"]); ?></span>						
								</p>			
							</a>			
						</td>			
						<td class=""><?php echo ($stock["sale_price"]); ?></td>	
						<td class=""><?php echo ($order["goods_num"]); ?></td>			
						<td  rowspan="1"><?php echo ($order["total"]); ?></td>		
						<td  rowspan="1">
							<?php if($order['status'] == 0): ?>等待付款
							<?php elseif($order['status'] == 1): ?>
							等待发货
							<?php elseif($order['status'] == 2): ?>
							等待收货
							<?php elseif($order['status'] == 3): ?>
							交易成功
							<?php elseif($order['status'] == -1): ?>
							订单已关闭
							<?php else: ?>
							退款/退货<?php endif; ?>

						</td>			
					</tr>
					<tr class="order_goods_list">
						<td style="text-align: left;width: 300px">
							&nbsp;&nbsp;订单号：<?php echo ($order["order_code"]); ?>
						</td>
						<td style="text-align: left;width: 300px">
							下单时间：<?php echo (Date("Y-m-d H:i:s",$order["buy_time"])); ?>
						</td>
						<?php if($order['pay_time'] > 0): ?><td style="text-align: left;width: 300px">
							支付时间：<?php echo (Date("Y-m-d H:i:s",$order["pay_time"])); ?>
						</td><?php endif; ?>
						<?php if($order['finish_time'] > 0): ?><td style="text-align: left;width: 300px">
							订单完成时间：<?php echo (Date("Y-m-d H:i:s",$order["finish_time"])); ?>
						</td><?php endif; ?>
					</tr>
				</tbody>	
			</table>	
			<ul>	
				<li>		
					<p class="right_f">		
						<span class="last">		
							<span>运费：<em class="red_f f15_f">
							<?php if($goods['shipping_price'] > 0): echo ($goods["shipping_price"]); ?>
							<?php else: ?>0<?php endif; ?>  </em>元</span>		
							<span>实付金额：<strong class="red_f f18_f"><?php echo ($shifujine); ?></strong>元</span>		
						</span>		
					</p>		
				</li>	
			</ul>
		</div>
	</div>	
	

		
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
	$("#receive").click(function(){
		var url="<?php echo U('order/receive');?>";
		var id="<?php echo ($order["id"]); ?>";
		$.ajax({
			url:url,
			type:"post",
			data:{
				id:id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					layer.alert('确认收货成功！',{title:"提示"});
					window.location.href="<?php echo U('order/index');?>";
				}else{
					layer.alert('确认收货失败！',{title:"提示"});
					window.location.href="<?php echo U('order/index');?>";
				}
			}
		});
	});

	$("#pay_now").click(function(){
		var url="<?php echo U('order/pay');?>";
		var id="<?php echo ($order["id"]); ?>";
		$.ajax({
			url:url,
			type:"post",
			data:{
				id:id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					layer.alert('支付成功！',{title:"支付情况"});
					window.location.href="<?php echo U('order/index');?>";
				}
				if(data==0){
					layer.alert('支付失败！',{title:"支付情况"});
					window.location.href="<?php echo U('order/index');?>";
				}
				if(data==-1){
					layer.alert('支付失败，订单已失效，请重新下单！',{title:"支付情况"});
					window.location.href="<?php echo U('order/index');?>";
				}
			}
		});
	});
	$("#cancel_order").click(function(){
		var url="<?php echo U('order/cancelone');?>";
		var id="<?php echo ($order["id"]); ?>";
		$.ajax({
			url:url,
			type:"post",
			data:{
				id,id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					layer.alert('订单取消成功！',{title:"取消订单"});
					window.location.href="<?php echo U('order/index');?>";
				}else{
					layer.alert('订单取消失败！',{title:"取消订单"});
					window.location.href="<?php echo U('order/index');?>";
				}
			}
		});
	});
</script>
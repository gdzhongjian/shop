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

<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/order.css"/>
<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/address.css"/>
<script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>

<div class="clear_f"></div>
	<div class="route">	
		<div class="route_bread">		
			<a href="">网上服饰购物系统</a>		
			<samp>&gt;</samp>		
			<span class="red_f">订单列表</span>	
		</div>
	</div>
	<div class="order_area">	
		<div class="doota_nav">	
			<ul>		
				<li id="mygoods"><a href="javascript:void(0);">已买到的商品</a></li>
				<li id="myaddress"><a href="javascript:void(0);">我的收货地址</a></li>	
			</ul>
		</div>	
		
		
		
		<div class="order_content">		
			<div class="order_content_box">			
				<fieldset>				
					<table class="order_list">						
						<colgroup>							
							<col width="240">							
							<col width="100">							
							<col width="70">							
							<col width="80">							
							<col width="90">							
							<col width="120">							
							<col width="130">						
						</colgroup>						
						<thead>														
							<tr>								
								<th>商品信息</th>								
								<th>单价（元）</th>								
								<th>数量</th>																
								<th>合计（元）</th>								
								<th>
									<form action="<?php echo U('order/index');?>" id="orderStatusForm" method="post">
									<select class="mls-select" id="orderStatus" name="status">										
										<option value="0" <?php if($status == 0): ?>selected<?php endif; ?> >全部订单</option>		
										<option value="1" <?php if($status == 1): ?>selected<?php endif; ?> >等待付款</option>
										<option value="2" <?php if($status == 2): ?>selected<?php endif; ?> >等待发货</option>
										<option value="3" <?php if($status == 3): ?>selected<?php endif; ?> >等待收货</option>	
										<option value="4" <?php if($status == 4): ?>selected<?php endif; ?> >交易成功</option>	
										<option value="5" <?php if($status == 5): ?>selected<?php endif; ?> >已关闭订单</option>		
										<option value="6" <?php if($status == 6): ?>selected<?php endif; ?> >退款/退货</option>								
									</select>	
									</form>							
								</th>
								<th>售后</th>								
								<th width="80">操作</th>							
							</tr>						
						</thead>									
						<tbody class="order_list">  

							<?php if(empty($order_message)): ?><tr class="empty"> 
								<td colspan="8">暂无订单</td> 
							</tr> 
							<?php else: ?>	
							<?php if(is_array($order_message)): $i = 0; $__LIST__ = $order_message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr class="order_info header">								
								<td colspan="8">									
									<span>订单号：<?php echo ($order["order_code"]); ?></span>												
									<span>下单时间：<?php echo (Date("Y-m-d H:i:s",$order["buy_time"])); ?></span>								
								</td>					
							</tr> 								
							<tr class="order_goods_list first last">								
								<td class="order_goods_goods"> 									 
									<a class="goods_detail " target="_blank" href="<?php echo U('detail/index',array('gid'=>$order['gid']));?>">	
										<img class="pic" src="/shop/Public/<?php echo ($order["big_picture"]); ?>"/>
										<p><?php echo ($order["first_name"]); ?></p>										
										<p class="prop">								
											<span>颜色：<?php echo ($order["color"]); ?></span><br>
											<span>尺码：<?php echo ($order["size"]); ?></span>
										</p>									
									</a>								
								</td>								
								<td class="br"><?php echo ($order["price"]); ?></td>								
								<td class="br"><?php echo ($order["nums"]); ?></td>												 
								<td class="br" rowspan="1"><?php echo ($order["price_all"]); ?><br/> 
								<?php if($order['yunfei'] > 0): ?>含运费（<?php echo ($order["yunfei"]); ?>）<?php else: ?>免运费<?php endif; ?>  </td> 
								<td class="br" rowspan="1"> 
									<p><?php echo ($order["status"]); ?></p> 
								</td> 
								<td class="br">
									<a href="javascript:void(0)" class="red_f" id="tuikuan_<?php echo ($i); ?>">
										申请退款/退货
									</a>
									<input type="hidden" name="tuikuan_zhuangtai_<?php echo ($i); ?>" id="tuikuan_zhuangtai_<?php echo ($i); ?>" value="<?php echo ($order["status"]); ?>">
									<input type="hidden" name="tuikuan_id_<?php echo ($i); ?>" id="tuikuan_id_<?php echo ($i); ?>" value="<?php echo ($order["oid"]); ?>">
								</td>
								<td class="br" width="80"  rowspan="1" >
									<p>
										<a class="red_f" target="_blank" href="<?php echo U('order/orderdetail',array('id'=>$order['oid']));?>">订单详情</a>
									</p> 
								</td>															
							</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</tbody>
					</table>
    						
				</fieldset>	

			</div>	
			<link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/page.css">
				<div class="paging_panel c_f " style="margin-top:10px;">
					<div class="pages">
						<?php echo ($page); ?>	
					</div>
				</div>		
			<div class="paging_panel c_f"></div>	
		</div>
		
		<!--地址内容开始-->
		<div class="address_content" style="display:none;">
			<div class="address_content_box">			
				<table class="address_list">				
					<colgroup>					
						<col width="90">					
						<col width="240">					
						<col width="80">					
						<col width="100">					
						<col width="90">					
						<col width="140">				
					</colgroup>				
					<thead>					
						<tr>						
							<th class="adrl_nickname">收货人</th>						
							<th>收货地址</th>						
							<th>邮政编码</th>						
							<th>联系电话</th>						
							<th>默认地址</th>						
							<th class="adrl_control">操作</th>					
						</tr>				
					</thead>				
					<tbody  class="myadd">
					<?php if(is_array($user_address)): $j = 0; $__LIST__ = $user_address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($j % 2 );++$j;?><tr id="tr_address_<?php echo ($j); ?>">						
							<td><?php echo ($address["receiver"]); ?></td>						
							<td><?php echo ($address["address"]); ?></td>						
							<td><?php echo ($address["postcode"]); ?></td>						
							<td><?php echo ($address["phone"]); ?></td>						
							<td>
								<?php if($address['status'] == 1): ?>是
								<?php else: ?>
									否<?php endif; ?>
							</td>						
							<td>
								<a href="javascript:void(0)" style="color: #F66F9B" id="editaddress_<?php echo ($j); ?>">修改</a>&nbsp;
								<a href="javascript:void(0)" style="color: #F66F9B" id="address_delete_<?php echo ($j); ?>">删除</a>
								<input type="hidden" name="address_id_<?php echo ($j); ?>" value="<?php echo ($address["id"]); ?>" id="address_id_<?php echo ($j); ?>">
							</td>						
						</tr>
						<script type="text/javascript">
                               $("#editaddress_<?php echo ($j); ?>").click(function(){
                               	var url="<?php echo U('order/editaddress',array('id'=>$address['id']));?>";
                               	var index=layer.open({
                               		type:2,
                               		title:"修改收货地址",
                               		area:['80%','550px'],
                               		shadeClose:true,
                               		content:url,
                               		end:function(){
                               			window.location.reload();
                               		}

                               	})
                               });
						</script><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>			
				</table>
				<fieldset>				
					<form id="addressForm" method="post" onsubmit="return false" action="">					
						<p>新增收货地址：</p>	
						<p>
							<span>*</span>						
							<label for="addressPid">所在地：</label>
							
					<select id="province" name="province">
                   		<option></option>
                    </select>
                    <select id="city" name="city">
                        <option></option>
                    </select>
                    <select id="county" name="county">
                          <option></option>
                    </select>
	<script type="text/javascript"  src="/shop/Public/index/js/area.js"></script>
	<script type="text/javascript">_init_area();</script> 					
							<strong></strong>					
						</p>	
						<p>
							<span>*</span>
							<label for="addressStreet">详细地址：</label>
							<input class="l_ipt_s mls-input-text" id="addressStreet" type="text" name="street" value=""/>
							<strong></strong>
						</p>			
						<p>
							<span>*</span>
							<label for="addressUser">收件人：</label>
							<input class="l_ipt mls-input-text" id="addreceiver" type="text" name="receiver" value=""/>
							<strong></strong>
						</p>

						<p>
							<span>*</span>
							<label for="validatePhoneOrMobile">手机号码：</label>
							<input class="l_ipt mls-input-text" id="addressPhone" type="text" name="phone" value=""/>
							<strong></strong>
						</p>															
						<div>						
							<p>
								<span>*</span>
								<label for="addressPostcode">邮政编码：</label>
								<input class="l_ipt mls-input-text" id="postcode" type="text" name="postcode" value=""/>
								<strong></strong>
							</p>						
							<p>
								<label>&nbsp;</label>
								<input class="mls-input-checkbox" type="checkbox" name="is_default" id="is_default" value=""/>
								<label class="mls-input-label mls-input-checkbox-label red-check" for="is_default">设为默认</label>
							</p>					
						</div>					

						<div class="submitBox" ><input class="addressBtn button" type="button" value="保存地址" id="add_address"/></div>					
					</form>			
				</fieldset>		
			</div>	
		</div>
		
	</div>
	<script>
		$("#myaddress").click(function(){
			$(".consult_content").css({display:"none"});
			$(".order_content").css({display:"none"});
			$(".address_content").css({display:"block"});	
		});
		$("#mygoods").click(function(){
			$(".address_content").css({display:"none"});
			$(".order_content").css({display:"block"});	
			$(".consult_content").css({display:"none"});
		});
		
	</script>
	
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
	var address_count="<?php echo ($j); ?>";
	var delete_url="<?php echo U('order/deleteaddress');?>";
	for(var i=1;i<=address_count;i++){
		$("#address_delete_"+i).click(function(){
			var index=i;
			var id=$(this).siblings('input[type="hidden"]').val();
			$.ajax({
				url:delete_url,
				type:"post",
				data:{
					id:id
				},
				async:true,
				dataType:"json",
				success:function(data){
					if(data==1){
						//删除成功
						layer.alert('删除成功！',{title:"删除"});
						window.location.reload();
					}else{
						layer.alert('删除失败！',{title:"删除"});
					}
				}
			});
		});
	}

</script>
<script type="text/javascript">
	$("#add_address").click(function(){
		var province=$("#province").val();
		var city=$("#city").val();
		var county=$("#county").val();
		var street=$("#addressStreet").val();
		var receiver=$("#addreceiver").val();
		var phone=$("#addressPhone").val();
		var postcode=$("#postcode").val();
		var is_default=$("#is_default").attr('checked');
		if(is_default=="checked"){
			is_default=1;
		}else{
			is_default=0;
		}
		var rege1=/^1[3|4|5|7|8]\d{9}$/;
		var rege2=/^[1-9][0-9]{5}$/;
		if(province=="省份"){
			layer.alert('请选择省份！',{title:"提示"});
			return;
		}
		if(city=="地级市"){
			layer.alert('请选择地级市！',{title:"提示"});
			return;
		}
		if(county=="市、县级市"){
			layer.alert('请选择县级市！',{title:"提示"});
			return;
		}
		if(street==""){
			layer.alert('请输入详细地址！',{title:"提示"});
			return;
		}
		if(receiver==""){
			layer.alert('请输入收件人！',{title:"提示"});
			return;
		}
		if(phone==""){
			layer.alert('请输入手机号码！',{title:"提示"});
			return;
		}
		if(postcode==""){
			layer.alert('请输入邮政编码！',{title:"提示"});
			return;
		}
		if(!rege1.test(phone)){
			layer.alert('手机号码格式不正确！',{title:"提示"});
			return;
		}
		if(!rege2.test(postcode)){
			layer.alert('邮政编码格式不正确！',{title:"提示"});
			return;
		}
		$.ajax({
			url:"<?php echo U('order/addAddress');?>",
			type:"post",
			data:{
				province:province,
				city:city,
				county:county,
				street:street,
				receiver:receiver,
				phone:phone,
				postcode:postcode,
				status:is_default
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data){
					layer.alert('添加地址成功！',{title:"添加地址"});
					window.location.reload();
				}else{
					alert('添加新的收货地址失败！');
				}
			}
		})

	});
</script>
<script type="text/javascript">
	$("#orderStatus").change(function(){
		$("#orderStatusForm").submit();
	});
</script>
<script type="text/javascript">
	var count="<?php echo ($i); ?>";
	for(var i=1;i<=count;i++){
		$("#tuikuan_"+i).click(function(){
			var zhuangtai=$(this).next().val();
			var id=$(this).next().next().val();
			if(zhuangtai=="等待付款"){
				layer.alert('您还没付款，不能申请退款/退货',{title:"提示"});
				return;
			}
			if(zhuangtai=="订单已关闭"){
				layer.alert('订单已经关闭，不能申请退款/退货',{title:"提示"});
				return;
			}
			if(zhuangtai=="退款/退货"){
				layer.alert('您已经申请过退款/退货',{title:"提示"});
				return;
			}
			var url="<?php echo U('order/refund');?>";
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
						layer.alert('申请退款/退货成功，请等待商家处理',{title:"提示"});
					}
					if(data==2){
						layer.alert('您已经申请过退款/退货，请耐心等待商家处理',{title:"提示"});
					}
					if(data==0){
						layer.alert('申请退款/退货失败',{title:"提示"});
					}
					if(data==-1){
						layer.alert('非法访问',{title:"提示"});
					}
				}
			})
		});
	}
</script>
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

<link rel="stylesheet" type="text/css" href="/shop/Public/index/css/confirm.css"/>
<script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>	
	
		<!--购物车头部开始-->
		<div class="cart_header">	
			<div class="logo_wrap">  
			</div>	
			<div class="status"> 
			</div>
		</div>
		<!--购物车头部结束-->
		
		<form action="<?php echo U('order/addoneorder');?>" method="post" id="order_submit">
		<div class="container">	
			<p class="label">确认收货地址</p>	
			<div class="addr">	
				
				<div class="unit adrl_list" id="address_0" style="display: none">
					<input id="curernt_address_0" class="mls-input-radio" type="radio" value="" name="addr"/>
					<label class="mls-input-label mls-input-radio-label" for="curernt_address_0">
						<span class="adrl_addr" id="span_0"></span>
						<span id="span_1"></span>
						<span id="span_2"></span>
					</label>
				</div>

				<?php if(is_array($all_address)): $i = 0; $__LIST__ = $all_address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($i % 2 );++$i;?><div class="unit adrl_list" id="address_<?php echo ($i); ?>">
					<input id="curernt_address_<?php echo ($i); ?>" class="mls-input-radio" type="radio" value="<?php echo ($address["id"]); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?> name="addr"/>
					<label class="mls-input-label mls-input-radio-label" for="curernt_address_<?php echo ($i); ?>">
						<span class="adrl_addr"><?php echo ($address["address"]); ?></span>
						<span><?php echo ($address["receiver"]); ?></span>
						<span><?php echo ($address["phone"]); ?></span>
					</label>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>


			
				<div class="new_addr" id="new_adder_wrapper">			
					<div class="unit" id="add_new_address">				
						<input value="-1" type="radio" name="addr" id="addr_new" class="mls-input-radio"/>				
						<label style="width:790px" for="addr_new" class="mls-input-label mls-input-radio-label">使用新地址</label>
					</div>	 
					<div class="form" id="addr_form" style="display:none">				
						

						<form id="setAddressForm" method="post"> 
							<div class="infos">						
								<p>							
									<span class="left"> 
										<b class="red_f mr4_f">*</b>
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
								<script type="text/javascript">_init_area();</script>		</span>						
								</p>						
								<p>							
									<b class="red_f mr4_f">*</b>
									<label for="addressStreet">详细地址：</label>							
									<input class="mls-input-text l_ipt_s street" id="addressStreet" type="text" name="street" value=""/>
									
									<strong>&nbsp;</strong>						
								</p>						
								<p>							
									<span class="left">								
										<span>									
											<b class="red_f mr4_f">*</b>
											<label for="addressUser">收件人：</label>									
											<input class="mls-input-text l_ipt reciever" id="addreceiver" type="text" name="receiver" value=""/>
											
											<strong>&nbsp;</strong>								
										</span>						 
									</span>						
								</p>						
								<p>							
									<span class="phone">									
										<b class="red_f mr4_f">*</b>
										<label for="addressPhone">手机号码：</label>									
										<input class="mls-input-text l_ipt contact" id="addressPhone" type="text" name="phone" value=""/>
										
										<strong>&nbsp;</strong>								
									</span>						
								</p>
								<p>							
									<span class="left">									
										<b class="red_f mr4_f">*</b>
										<label for="addressPhone">邮政编码：</label>									
										<input class="mls-input-text l_ipt contact" id="postcode" type="text" name="postcode" value=""/>
										
										<strong>&nbsp;</strong>								
									</span>						
								</p>					
							</div>					
							<div class="buttons">						
								<div class="left_f">							
									<input class="button" type="button" value="保存并使用" id="add_address"/>							
									<input class="cancel" type="button" value="取消" id="add_quxiao" />						
								</div>						
								<span class="set_default_con"> 
									<input class="mls-input-checkbox" type="checkbox" name="is_default" id="is_default" value="" /> 
									<label class="mls-input-label mls-input-checkbox-label" for="is_default">设为默认</label> 	
								</span>					
							</div>	
						</form>

					</div>		
				</div> 
			</div>

			
			<p class="label">选择支付方式</p>	
			<div class="bank">		
				<div class="platform">						
					<div class="list">								
						<div class="b " >					
							<div class="input">			
								<input type="radio" name="pay_id" data-name="货到付款"  value="0" checked="checked" id="pay_id_0" class="mls-input-radio"/>						
								<label for="pay_id_1" class="mls-input-label mls-input-radio-label">					
							</div>
							<div class="image" style="margin-top: 15px">
								<span>货到付款</span>				
							</div>					
						</div>							
						<div class="clear"></div>			
					</div>					
				</div>		
					
				
				
				
			
			<p class="label">商品清单</p>	
			<div class="order">		
				<table cellpadding="0" cellspacing="0">			
					<thead>				
						<tr>					
							<th width="20px" class="first"></th>					
							<th width="390">商品信息</th>					
							<th width="100px">单价（元）</th>					
							<th width="284px">数量</th>					
							<th width="137px">小计（元）</th>					
							<th width="20px" class="last"></th>				
						</tr>			
					</thead> 						
					<tbody class="goods">	
						<tr class="first last">
							<td class="first" style="width:40px;">
								</td> 
							<td class="content"> 
								<a class="content-link" target="_blank" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>"> 
									<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>"/> 
									<b><span><?php echo ($goods["first_name"]); ?></span></b>
									<br><br><br>
									<span class="props">   
									<span>颜色：<?php echo ($stock["color"]); ?></span>    
									<span>尺码：<?php echo ($stock["size"]); ?></span>   
									</span>  
								</a> 
							</td> 
							<td> <div class="u_price"><?php echo ($stock["sale_price"]); ?></div>   </td> 
							<td><?php echo ($nums); ?></td> 
							<td><?php echo ($price_all); ?></td> 
							<td class="last"></td> 
						</tr>
						<tr class="total">					
							<td class="first"></td>					
							<td colspan="2" class="buyer_msg">						
								<label>购买留言：</label>						
								<textarea name="comment[]" value="" class="mls-input-text comment" id="comment_105043">
								</textarea>					
							</td>					
							<td colspan="2" style="vertical-align:top;">						
								<ul class="coupon_freight">																					
									<li>								
										<!-- <div id="freight_show"class="info freight_show_105043">									<label class="lb">运费：</label>	
											<span class="freight_info">免运费</span>	
										</div> -->								
										<div class="price" style="float: right"><span>
											<?php if($yunfei == 0): ?>免运费
											<?php else: ?>
											总运费：<?php echo ($yunfei); ?>元<?php endif; ?>
											</span></div>
									</li>						
								</ul>				 
							</td>					
							<td class="last"></td>				
						</tr>				
						<tr class="total">					
							<td class="first"></td>					
							<td colspan="2"></td>					
							<td colspan="2" class="shop_total">						
								<span>共<?php echo ($nums); ?>件商品，</span>						
								<span>合计：<span id="shop_total_price_105043" class="price"><?php echo ($count_price); ?></span>元</span>					
							</td>					
							<td class="last"></td>				
						</tr>			
					</tbody>									
					
					<tfoot>				
						<tr>					
							<td class="first">&nbsp;</td>					
							<td colspan="5" class="last">						
								<span class="right">														
									<span>商品总价：</span>					
									<span class="price">￥<span id="total_price"><?php echo ($count_price); ?></span></span>
								
									<a href="javascript:void(0)" class="go_charge" id="charge">
									<input type="hidden" name="goods_id" value="<?php echo ($goods["id"]); ?>">
									<input type="hidden" name="stock_id" value="<?php echo ($stock["id"]); ?>">
									<input type="hidden" name="nums" value="<?php echo ($nums); ?>">	
									<input type="hidden" name="total_price" value="<?php echo ($price_all); ?>">							
									
								</span>					
							</td>				
						</tr>				 			
					</tfoot>		
				</table>	
			</div>
		</div>
		</form>
		
		
		<script>
			$("#charge").click(function(){
				var check=$("#addr_new").attr('checked');
				if(check=="checked"){
					layer.alert('请选择收货地址！');
					return;
				}
				$("#order_submit").submit();
				
				
			});
			
			//注意这里的jquery选择符可能会变化
			var count="<?php echo ($i); ?>";
			for(var i=0;i<=count;i++){
				$("label[for='curernt_address_"+i+"']").click(function(){
					$("#addr_form").css({display:"none"});
				});
			}
			
			
			$("label[for='addr_new'],.adrl_edit").click(function(){
				$("#addr_form").css({display:"block"});
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
					$("#curernt_address_0").attr('value',data['id']);
					$("#curernt_address_0").attr('checked','checked');
					$("#address_0").siblings('div').removeAttr('checked');
					$("#span_0").html(data['address']);
					$("#span_1").html(data['receiver']);
					$("#span_2").html(data['phone']);
					$("#addr_form").css({display:"none"});
					$("#address_0").css('display','block');
					$("#add_new_address").css('display','none');
				}else{
					alert('添加新的收货地址失败！');
				}
			}
		})

	});

	$("#add_quxiao").click(function(){
		$("#addr_form").css('display','none');
		$("#curernt_address_1").attr('checked','checked');
	});
</script>
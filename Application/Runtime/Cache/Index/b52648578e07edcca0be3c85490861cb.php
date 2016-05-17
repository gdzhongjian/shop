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
    <link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/page.css">
<script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>

		<div id="navbar">		
			<div class="sec_nav">	</div>	
		</div>	
		<div class="main">
			<div class="item-box" data-tid="3336567491"> 
				<!--商品主图开始-->	
				<div class="content twitter" twitter_id="3336567491">
					<div class="item-sale">
						<h3	 class="item-title">
							<?php echo ($goods["first_name"]); ?>
						</h3> 
						<h4 class="item-sub-title"><?php echo ($goods["second_name"]); ?></h4> 
						<div class="item-price-info">
							<span class="price-now">￥
								<i id="price-now" class="now_price"><?php echo ($goods["price"]); ?></i>
							</span> 
							<span class="price-original">&nbsp;&nbsp;&nbsp;
								<s>￥
								<i id="price-original" class="original_price"><?php echo ($original_price); ?></i>
								</s>
							</span> 
							<?php if($goods['is_free_shipping'] == 0): ?><span class="label-text js-label" style="background-color:#ff9933" data-text="免运费">免运费</span><?php endif; ?>
						</div>

						<ul class="item-promote-infos">  
							<li>
								<i class="label-mark-limit">限</i> 距离恢复原价仅剩
								<span class="countdown">
									<i class="day countdown-time"><?php echo (daoJiShi("d",$goods["discount_end"])); ?></i>天
									<i class="hour countdown-time"><?php echo (daoJiShi("H",$goods["discount_end"])); ?></i>小时
									<i class="minute countdown-time"><?php echo (daoJiShi("i",$goods["discount_end"])); ?></i>分
									<i class="second countdown-time"><?php echo (daoJiShi("s",$goods["discount_end"])); ?></i>秒
								</span>
							</li> 
							<!-- js倒计时 -->
							<script>
							var d=parseInt($(".day").html());
							var h=parseInt($(".hour").html());
							var m=parseInt($(".minute").html());
							var s=parseInt($(".second").html());
							function mytime(){
								s--;
								if(s<0){
									m=m-1;
									s=59;
								}
								if(m<0){
									h=h-1;
									m=59;
								}
								if(h<0){
									d=d-1;
									h=23;
								}
								if(d<1){d=2;}
							$(".day").html(d);
							$(".hour").html(h);
							$(".minute").html(m);
							$(".second").html(s);

							}
							setInterval(mytime,1000);
							</script>
						</ul>
						<div class="item-freight"> 
							<label>发货地址</label> <span class="send_address"><?php echo ($address); ?></span>
							
							


							<?php if($goods['is_free_shipping'] == 0): ?><span id="js-freight-text">&nbsp;&nbsp;&nbsp;免运费</span>
							<?php else: ?>
								<span id="js-freight-text">&nbsp;&nbsp;&nbsp;运费<?php echo ($goods["shipping_price"]); ?>元</span><?php endif; ?>
						</div>
						<ul class="item-data"> 
							<li>销量 <span class="item-data-wrap"> <?php echo ($goods["sales"]); ?> </span> </li> 
							<li class="item-data-middle">好评率 
								<span class="item-data-wrap">
									<a href="#" id="js-comment"><?php echo ($good_percent); ?></a> 
								</span> 
							</li> 
							<li>喜欢 
								<span class="item-data-wrap" ><b id="mylike2"><?php echo ($goods["likes"]); ?></b>人 </span>
							</li>
						</ul> 
						<ul class="sku_meta">   </ul> 
						<div class="sku_info"> 
							<div class="skin">  
								<p class="text none_f"><span class="close_z"></span><span class="msg_ico"></span>请选择您要的商品信息</p> 
								<?php if($goods['is_sale'] == 1): ?><dl class="prop"> 
									<dt> 颜 色<span></span> </dt>
									<dd> 
										<ul id="colorList" class="item-colorlist ">
											<?php if(is_array($colors)): $i = 0; $__LIST__ = $colors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$color): $mod = ($i % 2 );++$i;?><li >
												<a href="javascript:void(0);" class="js-item item-color-text" data-type="color"><?php echo ($color); ?></a>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</dd>
								</dl>  
								<dl class="prop"> 
									<dt> 尺 码<span></span> </dt>
									<dd>
										<ul id="sizeList" class="item-size-types">
										<?php if(is_array($sizes)): $i = 0; $__LIST__ = $sizes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$size): $mod = ($i % 2 );++$i;?><li>
												<a href="javascript:void(0);" class="js-item item-size-type" data-type="size"><?php echo ($size); ?></a>

											</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul> 
									</dd>
								</dl> 
					
								<dl class="amount"> 
									<dt>数 量</dt> 
									<dd> 
										<div class="item-stock js-stock"> 
											<input class="item-stock-num js-stock-num" title="请输入购买数量" id="buy_nums" type="text" value="1" > 
											<span class="item-stock-btns"> 
												<span class="item-stock-plus js-stock-plus ">
													<i class="icon-up"></i>
												</span> 
												<span class="item-stock-minus js-stock-minus ">
													<i class="icon-down"></i>
												</span> 
											</span> 
											<span class="item-stock-reserve js-stock-reserve" id="kucun"></span> 
										</div> 
									</dd> 
								</dl><?php endif; ?>
								 
								<div class="msg_box">
									<p class="msg_limit">
										<span class="msg_ico"></span>请先登录！
									</p> 
									<p class="msg_zero">
										<span class="msg_ico"></span>对不起，这件宝贝已经卖光啦！
									</p> 
									<p class="msg_over">
										<span class="msg_ico"></span>请选择商品信息!
									</p> 
								</div>  
								<div class="btn_box">  
									<a class="define" title="确定">确定</a> 
									<?php if($goods['is_sale'] == 1): ?><div class="same_btn">
										<a class="add_cart" title="加入购物车" id="add_cart" href="javascript:void(0)">
											<em class="cartico">&nbsp;</em>加入购物车
										</a> 
										<a class="buy_btn" title="立即购买" id="buy_now">
											<em class="rmbico">&nbsp;</em>立即购买
										</a> 
									</div> 
									<?php else: ?>
										<a class="buy_btn" title="商品已下架">
											商品已下架
										</a><?php endif; ?>
								</div>
							</div>
						</div>
<script type="text/javascript">

	$("#buy_now").click(function(){
		$(".msg_limit").css("display","none");
		$(".msg_zero").css('display','none');
		$(".msg_over").css('display','none');
		var nums = $("#buy_nums").val();
		var color=$("#colorList .active").html();	//颜色
		var size=$("#sizeList .active").html();		//尺码
		var n=parseInt($("#mynum").html());
		var gid="<?php echo ($goods["id"]); ?>";
		if((size) && (color) && n>0){
			$.ajax({
				url:"<?php echo U('detail/buynow');?>",	//请求地址
				type:"post",		//请求方式
				data:{
					color:color,
					size:size,
					nums:nums,
					shop_goods_id:gid
				},//发送数据
				async:true,			//异步
				dataType:"json",	//响应数据格式
				success:function(data){	//成功回调函数
					if(data==1){
						window.location.href="<?php echo U('detail/buy');?>";
					}
					if(data==-1){
						$(".msg_zero").css("display","block");
					}
					if(data==-2){
						alert('库存不够！');
					}
					if(data==0){
						//未登录
						$(".msg_limit").css("display","block");
					}
				}
			});

			
		}else{
			if((!size)||(!color)){
				$(".msg_over").css("display","block");
				return;
			}
			if((size)&&(color)&&n<=0){
				$(".msg_zero").css("display","block");
				return;
			}
			
		}
	});

	$("#add_cart").click(function(){
		$(".msg_limit").css("display","none");
		$(".msg_zero").css('display','none');
		$(".msg_over").css('display','none');
		var nums = $("#buy_nums").val();
		var color=$("#colorList .active").html();	//颜色
		var size=$("#sizeList .active").html();		//尺码
		var n=parseInt($("#mynum").html());
		var gid="<?php echo ($goods["id"]); ?>";
		if((size) && (color) && n>0){
			$.ajax({
				url:"<?php echo U('detail/addCart');?>",	//请求地址
				type:"post",		//请求方式
				data:{
					color:color,
					size:size,
					nums:nums,
					shop_goods_id:gid
				},//发送数据
				async:true,			//异步情趣
				dataType:"json",	//响应数据格式
				success:function(data){	//成功回调函数
					if(data==0){
						//未登录
						$(".msg_limit").css("display","block");
					}
					if(data==1){
						$(".msg_zero").css("display","block");
					}
					if(data==2){
						window.location.href="<?php echo U('cart/cartpreview',array('gid'=>$goods['id']));?>";
					}
					if(data==-2){
						alert('加入购物车失败！');
					}
					if(data==-3){
						alert('该商品已在购物车中！');
					}
					if(data==-4){
						alert('非法操作！');
					}
					if(data==-5){
						alert('库存不够！');
					}
				}
			});

			
		}else{
			if((!size)||(!color)){
				$(".msg_over").css("display","block");
				return;
			}
			if((size)&&(color)&&n<=0){
				$(".msg_zero").css("display","block");
				return;
			}
			
		}

	});
	

	$("#colorList a").click(
		function(){
		$("#colorList a").removeClass("active");
		$(this).addClass("active");
		var gid="<?php echo ($goods["id"]); ?>";
		var size=$("#sizeList a[class*='active']").html();	//获取被选中的尺码
		var color=$("#colorList a[class*='active']").html();	//获取被选中的颜色
		if(!size){
			return;		//尺寸没有选择，不执行异步操作
		}
		$.ajax({
				url:"<?php echo U('detail/checkstock');?>",	//请求地址
				type:"post",		//请求方式
				data:{
					color:color,
					size:size,
					gid:gid
				},//发送数据
				async:true,			//异步请求
				dataType:"json",	//响应数据格式
				success:function(data){	//成功回调函数
					if(data){
						$(".now_price").html(data[0]);
						$(".original_price").html(data[1]);
						$(".send_address").html(data[2]);
						$("#kucun").html('(库存<span id="mynum"></span>件)');
						$("#mynum").html(data[3]);
					}else{
						$("#kucun").html('(库存<span id="mynum"></span>件)');
						$("#mynum").html('0');
					}
					
				}
			});
		}	
	);
	$("#sizeList a").click(
		function(){
		$("#sizeList a").removeClass("active");
		$(this).addClass("active");
		var gid="<?php echo ($goods["id"]); ?>";
		var size=$("#sizeList a[class*='active']").html();	//获取被选中的尺码
		var color=$("#colorList a[class*='active']").html();	//获取被选中的颜色
		
		if(!color){
			return;		//颜色没有选择，不执行异步操作
		}

		$.ajax({
				url:"<?php echo U('detail/checkstock');?>",	//请求地址
				type:"post",		//请求方式
				data:{
					color:color,
					size:size,
					gid:gid
				},//发送数据
				async:true,			//异步情趣
				dataType:"json",	//响应数据格式
				success:function(data){	//成功回调函数
					if(data){
						$(".now_price").html(data[0]);
						$(".original_price").html(data[1]);
						$(".send_address").html(data[2]);
						$("#kucun").html('(库存<span id="mynum"></span>件)');
						$("#mynum").html(data[3]);
					}else{
						$("#kucun").html('(库存<span id="mynum"></span>件)');
						$("#mynum").html('0');
					}
					
				}
			});

		}
	);
	
	$(".item-stock-plus").click(function(){
		var total=parseInt($(".item-stock-reserve span").html());	//所选类别总数量
		var v=parseInt($("#buy_nums").val());
			v=v+1;
			if(v>=total)v=total;
		$("#buy_nums").val(v);
	});
	$(".item-stock-minus").click(function(){
		var total=parseInt($(".item-stock-reserve span").html());	//所选类别总数量
		var v=parseInt($("#buy_nums").val());
			v=v-1;
			if(v<=1)v=1;
		$("#buy_nums").val(v);
	});
	$("#buy_nums").keyup(function(e){
		var k=parseInt(e.which);
		var v=parseInt($("#buy_nums").val());
		if(v<=1)$("#buy_nums").val(1);
		if(v>=total)$("#buy_nums").val(total);
		if(k<48 || k>57){
			$("#buy_nums").val(1);
		}
	}).keypress(function(e){
		var v=parseInt($("#buy_nums").val());
		var k=parseInt(e.which);
		if(k<48 || k>57){
			$("#buy_nums").val(1);
		}
		if(v<=1)$("#buy_nums").val(1);
		if(v>=total)$("#buy_nums").val(total);
	});
</script>
					
						<div class="item-spread"> 
						<?php if($goods['is_sale'] == 1): ?><div class="item-like-wrap"> 
								<a class="item-like-btn js-like-btn" data-liked="0" isshowlike="1" id="like_add"> 
									<i class="icon-like"></i>喜欢  <i class="item-like-num"></i> 
								</a>
							</div><?php endif; ?>
							
								</div>
<script type="text/javascript">
	$("#like_add").click(function(){
		var goods_id="<?php echo ($goods["id"]); ?>";
		var likes=$("#mylike2").html();
		var like=parseInt(likes)+1;
		$.ajax({
			url:"<?php echo U('detail/like');?>",
			type:"post",
			data:{
				goods_id:goods_id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					layer.msg('喜欢该商品成功！');
					$("#mylike2").html(like);
				}else{
					layer.msg('喜欢该商品失败！');
				}
			}
		})
	});
</script>
					</div>
					<div id="picture" class="item-pic">
						<div class="item-pic-origin" style="max-height:632px;"> 
							<?php if(is_array($goods_pictures)): $i = 0; $__LIST__ = $goods_pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$picture): $mod = ($i % 2 );++$i; if($i == 1): ?><img class="j-big-pic twitter_pic" alt="<?php echo ($goods["first_name"]); ?>" src="/shop/Public/<?php echo ($picture["big_picture"]); ?>" id="big_picture<?php echo ($i); ?>"/>
								<?php else: ?>
									<img class="j-big-pic twitter_pic" alt="<?php echo ($goods["first_name"]); ?>" src="/shop/Public/<?php echo ($picture["big_picture"]); ?>" style="display: none" id="big_picture<?php echo ($i); ?>"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</div> 
						<div class="item-pic-thumb js-pic-thumb"> 
							<?php if(is_array($goods_pictures)): $i = 0; $__LIST__ = $goods_pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$picture): $mod = ($i % 2 );++$i;?><span name="<?php echo ($i); ?>">
									<img src="/shop/Public/<?php echo ($picture["small_picture"]); ?>" width="68">
								</span><?php endforeach; endif; else: echo "" ;endif; ?>					
						</div> 
					</div> 
				</div> 
				<script>
					$(".js-pic-thumb span").click(function(){
						$(".js-pic-thumb span").removeClass("active");
						$(this).addClass("active");
						$(".item-pic-origin img").css('display','none');
						var id=$(this).attr('name');
						$("#big_picture"+id).css('display','block');

					});
				</script>
				<!--商品主图结束-->				
				<!--店铺右边侧边栏-->
				<div class="sidebar" style="background-color: #F2EEEE"> 
						<?php if(!empty($may_likes)): ?><p class="hd" style="width: 180px" align="center">可能喜欢</p><br><?php endif; ?>
						<ul class="rec_sku recommend"> 
							<?php if(is_array($may_likes)): $i = 0; $__LIST__ = $may_likes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><li> 
								<div class="s_picBox">		
									<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$good['id']));?>" target="_blank" title="<?php echo ($good["first_name"]); ?>">		
										<img src="/shop/Public/<?php echo ($good["big_picture"]); ?>" style="width: 180px"/>
									</a>			
								</div>	
								<div style="width: 180px">
									<span  style="color: #F66F9B">
										<big><b>￥<?php echo ($good["price"]); ?></b> </big>
									</span>
									<span style="float: right">销量：
										<big style="color: #F66F9B"><b><?php echo ($good["sales"]); ?></b> </big>
									</span>	
								</div>	
								<p class="txt">
								<a href="<?php echo U('detail/index',array('gid'=>$good['id']));?>" target="_blank"><?php echo ($good["first_name"]); ?></a>
								</p>
								<br>
							</li><?php endforeach; endif; else: echo "" ;endif; ?> 
						</ul>

				</div> 
				<!--店铺右边侧边栏结束-->
			</div> 	
			<br>
			<br>
			<!-- 搭配人气展示 开始--> 
			<div class="auto_wrap">
			<div class="wel_tle">
				<?php if(!empty($popular_clothes)): ?><h2 class="tle tab_top"><span class="ico1"></span>人气推荐单品</h2><?php endif; ?>
			</div>	
			<ul class="rec_sku recommend" style="width:1300px;">		
				<?php if(is_array($popular_clothes)): $i = 0; $__LIST__ = $popular_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><li >		
					<div class="s_picBox">		
						<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$good['id']));?>" target="_blank" title="<?php echo ($good["first_name"]); ?>">		
							<img src="/shop/Public/<?php echo ($good["big_picture"]); ?>"/>
						</a>			
					</div>	
					<div>
						<span  style="color: #F66F9B">
							<big><b>￥<?php echo ($good["price"]); ?></b> </big>
						</span>
						<span style="float: right">销量：
							<big style="color: #F66F9B"><b><?php echo ($good["sales"]); ?></b> </big>
						</span>	
					</div>	
					<p class="txt">
					<a href="<?php echo U('detail/index',array('gid'=>$good['id']));?>" target="_blank"><?php echo ($good["first_name"]); ?></a>
					</p>		
				</li><?php endforeach; endif; else: echo "" ;endif; ?>	
				
				
						
				
			</ul>
			
		</div>
			  
			<!--搭配人气展示 结束-->
			<br><br>
			<div class="box item-detail js-item-detail"> 
				<div class="content wrap js-ceiling-tab" style="width: 100%"> 
				<!--公共详情切换卡开始-->
					<div class="js-tab-wrap">
						<div class="tab_tle"> 
							<h2 class="tab_top"> 
								<a href="javascript:void(0)" class="tabArea cur desc">商品详情</a> 
								<a href="javascript:void(0)" class="tabArea shopping">购买评价（<span class="twitter_comment_num"><?php if($comment_count > 0): echo ($comment_count); else: ?>0<?php endif; ?> </span>）</a><a href="javascript:void(0)" class="tabArea deal">成交记录（<span class="twitter_comment_num"><?php echo ($records_count); ?></span>）</a>
								<!-- 0 
								<!-- 4 -->
								<span class="js-item-price subtab-item-price"></span> 
								<span class="add_cart">
								</span> 
							</h2>
							 
						</div>
					</div> 
				<!--公共详情切换卡结束-->
					<!--商品详情内容区开始-->
					<div class="contentArea describe" align="center"> 
						<link rel="stylesheet" href="/shop/Public/admin/Ueditor/third-party/SyntaxHighlighter/shCore.min.css" ></script>
						 <script type="text/javascript" src="/shop/Public/admin/Ueditor/third-party/SyntaxHighlighter/shCore.min.js" ></script>         
						        <script>  
						        	SyntaxHighlighter.config.clipboardSwf = 'public/clipboard.swf';
									SyntaxHighlighter.all();    
								</script>
								<br><br><br>
						<?php echo ($goods["introduce"]); ?>
					</div> 
					
					<!--商品详情内容结束-->
					
					
					
					<!-- 购物晒单 start -->  
					<div class="contentArea none_f" id="show" align="center">
							<br>
							<ul class="eva_comments_filter_tab">
								<li class="item cur " id="itemall">全部评价 (<?php if($comment_count > 0): echo ($comment_count); else: ?>0<?php endif; ?>)</li>
								<li class="item " status='1' id="item1">好评 (<?php if($good_comment_count > 0): echo ($good_comment_count); else: ?>0<?php endif; ?>)</li>
								<li class="item " status='2' id="item2">中评 (<?php if($middle_comment_count > 0): echo ($middle_comment_count); else: ?>0<?php endif; ?>)</li>
								<li class="item " status='3' id="item3">差评 (<?php if($bad_comment_count > 0): echo ($bad_comment_count); else: ?>0<?php endif; ?>)</li>
								<li class="item " status='4'><a href="javascript:void(0)" id="addcomment">发表我的评论</a></li>
							</ul> <br><br><br> 
						<div class="shoppingshow_null"><?php if(empty($comments)): ?>暂无购物评论<?php endif; ?></div> 

						<div id="shoppingshow_comments" class="shoppingshow_comments item-show">
							<?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><div class="item-show-li">
								<a class="left_f" target="_blank" href="">
									<img class="avatar" width="70" height="70" src="/shop/Public/<?php echo ($comment["headimage"]); ?>">
									<p class="nickname"><?php echo ($comment["username"]); ?></p>
								</a>
								<div class="content_cl item-show-content">
									<div class="hd">
										<span class="time"><?php echo (Date("Y-m-d H:i:s",$comment["time"])); ?></span>
									</div>
									<div class="shop_detail">
										<div class="clearfix_f mb20_f">
											<p class="cnt_r"><?php echo ($comment["content"]); ?></p>
										</div>
									</div>
									
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							<div class="paging_panel c_f " style="margin-top:10px;">
								<div class="pages">
						            <?php echo ($comments_show); ?>    
						        </div> 
						    </div>
						</div>

				
					</div>  
					<!-- 购物晒单 end --> 
					
					<!-- 成交记录开始 -->
					<div class="contentArea none_f" id="record"> 
						<div class="goods-star" id="goods-star">		
						</div>
						<div class="comments twitter" twitter_author_uid="0" twitter_id="3336567491"> 
							<div class="clear_f"></div> 
							<?php if(empty($records)): ?><div id="shop_deal_null">30天内暂无成交记录。</div><?php endif; ?>  
							<table class="deal-all w100"> 
								<thead class="j-deal-comments deal-head">
									<tr> 
										<th class="deal-buyer" style="text-align: center">买家</th> 
										<th class="deal-time" style="text-align: center">成交时间</th> 
										<th class="deal-style" style="text-align: center">颜色</th> 
										<th class="deal-style" style="text-align: center">尺码</th> 
									</tr> 
								</thead>
								<tbody class="deal-comments j-deal-comments" id="j-deal-comments">
								<?php if(is_array($records)): $i = 0; $__LIST__ = $records;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
										<td style="text-align: center"><?php echo ($order["username"]); ?></td>
										<td style="text-align: center"><?php echo (Date("Y-m-d H:i:s",$order["buy_time"])); ?></td>
										<td style="text-align: center"><?php echo ($order["color"]); ?></td>
										<td style="text-align: center"><?php echo ($order["size"]); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
								</tbody> 
							</table> 

						<div class="paging_panel c_f " style="margin-top:10px;">
							<div class="pages">
					            <?php echo ($record_show); ?>    
					        </div> 
					    </div>

						</div> 
					</div>
					<!-- 成交记录结束 -->

				 
					
</div>
<div id="page"></div>


					
				</div> 
				<div class="sidebar"> 
					<div class="js-shop-cover shop-cover"> 
						<h3 class="title"></h3> 
						<a target="_blank"><img width="226" height="226"></a> 
					</div>  
				
					
				</div> 
			</div>
		</div>
		
		
		

<script>
	$(".desc").click(function(){
		$(".tabArea").removeClass("cur");
		$(this).addClass("cur");
		$(".describe,.detail_items").removeClass("none_f");
		$(".shpcmt,#show,#record").addClass("none_f");
		$(".pageNav1").css("display","none")
	});
	
	$(".shopping").click(function(){
		$(".tabArea").removeClass("cur");
		$(this).addClass("cur");
		$("#show").removeClass("none_f");
		$("#record,.shpcmt,.describe,.detail_items").addClass("none_f");
		$(".pageNav1").css("display","block")
	});

	$(".deal").click(function(){
		$(".tabArea").removeClass("cur");
		$(this).addClass("cur");
		$("#record").removeClass("none_f");
		$(".shpcmt,#show,.describe,.detail_items").addClass("none_f");
		$(".pageNav1").css("display","block")
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
	$(".pages a").live('click',function(){
		var pageObj=this;
		var url=pageObj.href;
		$.ajax({
			url:url,
			type:"get",
			success:function(data){
				if(data[1]=="record"){
					$("#record").html(data[0]);
				}
				if(data[1]=="comment"){
					$("#shoppingshow_comments").html(data[0]);
				}
			}
		});
		return false;
	});
</script>
<script type="text/javascript">
	//发表评论
	$("#addcomment").click(function(){
		var goods_id="<?php echo ($goods["id"]); ?>";
		var checkUrl="<?php echo U('detail/checkBuy');?>";
		var commentUrl="<?php echo U('detail/addcomment',array('gid'=>$goods['id']));?>";
		$.ajax({
			url:checkUrl,
			type:"post",
			data:{
				goods_id:goods_id
			},
			async:true,
			dataType:"json",
			success:function(data){
				if(data==1){
					//可以评论
					layer.open({
						type:2,
						title:"发表评论",
						area:['80%','550px'],
						shadeClose:true,
						content:commentUrl,
						end:function(){
                            window.location.reload();
                        }
					})
				}
				if(data==2){
					layer.alert('您还未交易成功，暂时无法进行评论！',{title:"提示"});
				}
				if(data==-1){
					layer.alert('请先登录！',{title:"提示"});
				}
				if(data==-2){
					layer.alert('您没有购买此商品，无法进行评论！',{title:"提示"});
				}
			}
		})
	});
	$("#itemall").click(function(){
		$(this).siblings().removeClass('cur');
		$(this).addClass('cur');
		var url="<?php echo U('detail/index',array('gid'=>$goods['id'],'comment_status'=>'all'));?>";
		$.ajax({
			url:url,
			type:"get",
			success:function(data){
				$("#shoppingshow_comments").html(data);
			}
		});
	})
	$('#item1').click(function(){
		$(this).siblings().removeClass('cur');
		$(this).addClass('cur');
		var url="<?php echo U('detail/index',array('gid'=>$goods['id'],'comment_status'=>'good'));?>";
		$.ajax({
			url:url,
			type:"get",
			success:function(data){
				$("#shoppingshow_comments").html(data);
			}
		});
	});
	$('#item2').click(function(){
		$(this).siblings().removeClass('cur');
		$(this).addClass('cur');
		var url="<?php echo U('detail/index',array('gid'=>$goods['id'],'comment_status'=>'middle'));?>";
		$.ajax({
			url:url,
			type:"get",
			success:function(data){
				$("#shoppingshow_comments").html(data);
			}
		});
	});
	$('#item3').click(function(){
		$(this).siblings().removeClass('cur');
		$(this).addClass('cur');
		var url="<?php echo U('detail/index',array('gid'=>$goods['id'],'comment_status'=>'bad'));?>";
		$.ajax({
			url:url,
			type:"get",
			success:function(data){
				$("#shoppingshow_comments").html(data);
			}
		});
	});
</script>
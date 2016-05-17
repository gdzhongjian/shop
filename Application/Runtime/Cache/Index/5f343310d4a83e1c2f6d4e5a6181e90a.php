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


		<!--大图轮播开始-->
		<div class="top_bnr">	
			<ul class="banner" style="position: absolute; cursor: pointer;">				<?php if(is_array($lunbos)): $i = 0; $__LIST__ = $lunbos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lunbo): $mod = ($i % 2 );++$i;?><li style="position: absolute; top: 0px; left: 10%; z-index: 0; display: list-item;">			
					<a class="pic" href="<?php echo U('category/index',array('level'=>3,'cid'=>$lunbo['shop_goods_category_id']));?>" target="_blank" style="background:url('/shop/Public/<?php echo ($lunbo["picture"]); ?>') repeat center top;">
					</a>		
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		<!--大图轮播结束-->
		

		<div class="top_wrap">	
		<div class="top_box">		
			<div class="bnr_btn_wrap">			
				<span class="bnr_btn bnr_btn_left"></span>		
				<span class="bnr_btn bnr_btn_right"></span>		
			</div>		
		<!--侧边栏导航 开始-->
		<div class="attr_box" style="position: absolute">			
			<ul class="sec_attr">		
				<li class="list">					
					<div class="list_cont">						
						<h3 class="nav_tle">							
							<a href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_cloth['id']));?>" target="_blank">							
								衣服								
							</a>						
						</h3>					
						<p class="listP">
							<?php if(is_array($third_rand_clothes)): $i = 0; $__LIST__ = $third_rand_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cloth): $mod = ($i % 2 );++$i;?><a  href="<?php echo U('category/index',array('level'=>3,'cid'=>$cloth['id']));?>" target="_blank"><?php echo ($cloth["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>		
						</p>						
						<samp class="corner">&gt;</samp>				
					</div>	
					
						
					<ul class="nav_list">	
						<?php if(is_array($second_category_clothes)): $i = 0; $__LIST__ = $second_category_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_cloth): $mod = ($i % 2 );++$i;?><li>
						<h4><a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_cloth['id']));?>" target="_blank"><?php echo ($second_category_cloth["name"]); ?></a></h4>
						<p>
							<?php if(is_array($third_category_clothes)): $j = 0; $__LIST__ = $third_category_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_cloth): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_cloth)): $z = 0; $__LIST__ = $third_category_cloth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cloth): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$cloth['id']));?>" target="_blank"><?php echo ($cloth["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>

						</p>

					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					
						
					</ul>	
						
					
				</li>
				
				
				
				
				
				
				<li class="list">					
					<div class="list_cont">						
						<h3 class="nav_tle">							
							<a href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_shoe['id']));?>" target="_blank">							
								鞋子
							</a>						
						</h3>					
						<p class="listP">													<?php if(is_array($third_rand_shoes)): $i = 0; $__LIST__ = $third_rand_shoes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_rand_shoe): $mod = ($i % 2 );++$i;?><a  href="<?php echo U('category/index',array('level'=>3,'cid'=>$third_category_shoe['id']));?>" target="_blank"><?php echo ($third_rand_shoe["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						</p>						
						<samp class="corner">&gt;</samp>				
					</div>					
					<ul class="nav_list">
						<?php if(is_array($second_category_shoes)): $i = 0; $__LIST__ = $second_category_shoes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_shoe): $mod = ($i % 2 );++$i;?><li>						
							<h4><a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_shoe['id']));?>" target="_blank"><?php echo ($second_category_shoe["name"]); ?></a></h4>							
							<p>															    
								<?php if(is_array($third_category_shoes)): $j = 0; $__LIST__ = $third_category_shoes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_shoe): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_shoe)): $z = 0; $__LIST__ = $third_category_shoe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shoe): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$shoe['id']));?>" target="_blank"><?php echo ($shoe["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
							</p>						
						</li><?php endforeach; endif; else: echo "" ;endif; ?>											
																	
					</ul>				
				</li>
				<li class="list">					
					<div class="list_cont">						
						<h3 class="nav_tle">							
							<a href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_baobao['id']));?>" target="_blank">							
								包包							
							</a>						
						</h3>					
						<p class="listP">													
							<?php if(is_array($third_rand_baobaos)): $i = 0; $__LIST__ = $third_rand_baobaos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_rand_baobao): $mod = ($i % 2 );++$i;?><a  href="<?php echo U('category/index',array('level'=>3,'cid'=>$third_category_baobao['id']));?>" target="_blank"><?php echo ($third_rand_baobao["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>					  
						</p>						
						<samp class="corner">&gt;</samp>				
					</div>					
					<ul class="nav_list">
						<?php if(is_array($second_category_baobaos)): $i = 0; $__LIST__ = $second_category_baobaos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_baobao): $mod = ($i % 2 );++$i;?><li>						
							<h4><a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_baobao['id']));?>" target="_blank"><?php echo ($second_category_baobao["name"]); ?></a></h4>							
								<p>															<?php if(is_array($third_category_baobaos)): $j = 0; $__LIST__ = $third_category_baobaos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_baobao): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_baobao)): $z = 0; $__LIST__ = $third_category_baobao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$baobao): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$baobao['id']));?>" target="_blank"><?php echo ($baobao["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
							</p>						
						</li><?php endforeach; endif; else: echo "" ;endif; ?>											
																
					</ul>				
				</li>
				
				<li class="list">					
					<div class="list_cont">						
						<h3 class="nav_tle">							
							<a href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_peishi['id']));?>" target="_blank">							
								配飾							
							</a>						
						</h3>					
						<p class="listP">													<?php if(is_array($third_rand_peishis)): $i = 0; $__LIST__ = $third_rand_peishis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_rand_peishi): $mod = ($i % 2 );++$i;?><a  href="<?php echo U('category/index',array('level'=>3,'cid'=>$third_category_peishi['id']));?>" target="_blank"><?php echo ($third_rand_peishi["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>				
						</p>						
						<samp class="corner">&gt;</samp>				
					</div>					
					<ul class="nav_list">
						<?php if(is_array($second_category_peishis)): $i = 0; $__LIST__ = $second_category_peishis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_peishi): $mod = ($i % 2 );++$i;?><li>						
							<h4><a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_peishi['id']));?>" target="_blank"><?php echo ($second_category_peishi["name"]); ?></a></h4>							
							<p>																<?php if(is_array($third_category_peishis)): $j = 0; $__LIST__ = $third_category_peishis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_peishi): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_peishi)): $z = 0; $__LIST__ = $third_category_peishi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$peishi): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$peishi['id']));?>" target="_blank"><?php echo ($peishi["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>		
							</p>						
						</li><?php endforeach; endif; else: echo "" ;endif; ?>											
																	
					</ul>				
				</li>


			</ul>	
		</div>		
		
		
			<div class="round">		
				<div class="adType">
					<?php if(is_array($lunbos)): $i = 0; $__LIST__ = $lunbos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lunbo): $mod = ($i % 2 );++$i;?><a></a><?php endforeach; endif; else: echo "" ;endif; ?>				
				</div>		
			</div>		
				
		</div>
		</div>
		<div style="height: 80px;"></div>
		<div class="auto_wrap">
			<div class="wel_tle">	
				<h2 class="tle"><span class="ico1"></span>人气推荐单品</h2>	
			</div>	
			<ul class="rec_sku recommend" style="width:1300px;">		

				<!--循环输出人气推荐单品开始-->
				<?php if(is_array($popular_clothes_goods)): $i = 0; $__LIST__ = $popular_clothes_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li >		
					<div class="s_picBox">		
						<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">		
							<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>"/>
						</a>			
					</div>	
					<div>
						<span  style="color: #F66F9B">
							<big><b>￥<?php echo ($goods["price"]); ?></b> </big>
						</span>
						<span style="float: right">销量：
							<big style="color: #F66F9B"><b><?php echo ($goods["sales"]); ?></b> </big>
						</span>	
					</div>	
					<p class="txt">
					<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
					</p>		
				</li>				
				<!--循环输出人气推荐单品结束--><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</ul>
			
		</div>
		
		
		
		
		<div class="auto_wrap line">	
		
			<div class="wel_tle">		
				<a class="more" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_cloth['id']));?>" target="_blank">查看所有衣服 <samp>&gt;</samp></a>	
				<h2 class="tle"><span class="ico2"></span>衣服</h2><span class="today">最新上架<strong></strong></span>	
			
			</div>
			
			
			<div class="attr_box">		
				<ul  class="rec_sku recommend" style="">
					<!--循环输出衣服开始-->
					<?php if(is_array($new_clothes_goods)): $i = 0; $__LIST__ = $new_clothes_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li style="padding-right: 3%">		
						<div class="s_picBox">		
							<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">		
								<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>" />
							</a>			
						</div>	
						<div>
							<span  style="color: #F66F9B">
								<big><b>￥<?php echo ($goods["price"]); ?></b> </big>
							</span>
							<span style="float: right">销量：
								<big style="color: #F66F9B"><b><?php echo ($goods["sales"]); ?></b> </big>
							</span>	
						</div>	
						<p class="txt">
						<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>				
					<!--循环输出衣服结束-->
				</ul>	


				<ul class="attr_words">		
					<!--衣服分类循环开始-->
					<?php if(is_array($second_category_clothes)): $i = 0; $__LIST__ = $second_category_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_cloth): $mod = ($i % 2 );++$i;?><li>				
						<h3>
							<a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_cloth['id']));?>" target="_blank"><?php echo ($second_category_cloth["name"]); ?></a>
						</h3>	
						<p>		
							<?php if(is_array($third_category_clothes)): $j = 0; $__LIST__ = $third_category_clothes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_cloth): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_cloth)): $z = 0; $__LIST__ = $third_category_cloth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cloth): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$cloth['id']));?>" target="_blank"><?php echo ($cloth["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>						
						</p>			
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--衣服分类循环结束-->
				</ul>	
			
			</div>
			
            <div class="shop">                   
            	<div class="cmn_title">
					<h3 class="f16_f">最热衣服</h3>
				</div> 
				<ul class="list">                        
					<!--最热衣服 右侧列表循环开始-->
					<?php if(is_array($hot_clothes_goods)): $i = 0; $__LIST__ = $hot_clothes_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li >
						<a class="avatar32_f" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">
						<img src="/shop/Public/<?php echo ($goods["small_picture"]); ?>" />
						</a> 
						<p class="name">
							<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>                
						</p>
						<p class="txt">总销量<?php echo ($goods["sales"]); ?></p>                       
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--最热衣服 右侧列表循环结束-->
				</ul>


			</div>
		
		</div>
		
		<div class="auto_wrap line">	
			<div class="wel_tle">		
				<a class="more" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_shoe['id']));?>" target="_blank">查看所有鞋子 <samp>&gt;</samp></a>
				<h2 class="tle"><span class="ico3"></span>鞋子</h2>
				<span class="today">最新上架<strong></strong></span>	
			</div>	
			<div class="attr_box">	
				<ul  class="rec_sku recommend" style="">
					<!--循环输出鞋子开始-->
					<?php if(is_array($new_shoes_goods)): $i = 0; $__LIST__ = $new_shoes_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li style="padding-right: 3%">		
						<div class="s_picBox">		
							<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">		
								<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>" />
							</a>			
						</div>	
						<div>
							<span  style="color: #F66F9B">
								<big><b>￥<?php echo ($goods["price"]); ?></b> </big>
							</span>
							<span style="float: right">销量：
								<big style="color: #F66F9B"><b><?php echo ($goods["sales"]); ?></b> </big>
							</span>	
						</div>	
						<p class="txt">
						<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>			
					<!--循环输出鞋子结束-->
				</ul>	

				<ul class="attr_words">		
					<!--鞋分类列表开始-->
					<?php if(is_array($second_category_shoes)): $i = 0; $__LIST__ = $second_category_shoes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_shoe): $mod = ($i % 2 );++$i;?><li >			
						<h3>
							<a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_shoe['id']));?>" target="_blank"><?php echo ($second_category_shoe["name"]); ?></a>
						</h3>
						<p>	
							<?php if(is_array($third_category_shoes)): $j = 0; $__LIST__ = $third_category_shoes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_shoe): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_shoe)): $z = 0; $__LIST__ = $third_category_shoe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shoe): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$shoe['id']));?>" target="_blank"><?php echo ($shoe["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>		
						</p>			
					</li><?php endforeach; endif; else: echo "" ;endif; ?>	
					<!--鞋分类列表结束-->
				</ul>

			</div>	
			<div class="shop">	
				<div class="cmn_title">		
					<h3 class="f16_f">最热鞋子</h3>	
				</div>		
				<ul class="list">	
					<!--最热鞋子右边列表循环开始-->
					<?php if(is_array($hot_shoes_goods)): $i = 0; $__LIST__ = $hot_shoes_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li >			
						<a class="avatar32_f" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">
							<img src="/shop/Public/<?php echo ($goods["small_picture"]); ?>" />
						</a>			
						<p class="name">
							<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>			
						<p class="txt">总销量<?php echo ($goods["sales"]); ?></p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>				
					<!--最热鞋子右边列表循环结束-->				
				</ul>	
			
			</div>
		</div>
		<div class="auto_wrap line">
			<div class="wel_tle">		
				<a class="more" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_baobao['id']));?>" target="_blank">查看所有包包 <samp>&gt;</samp></a>	
				<h2 class="tle"><span class="ico4"></span>包包</h2>
				<span class="today">最新上架<strong></strong></span>
			</div>	
			<div class="attr_box">	
				<ul  class="rec_sku recommend" style="">
					<!--循环输出包包开始-->
					<?php if(is_array($new_baobaos_goods)): $i = 0; $__LIST__ = $new_baobaos_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li style="padding-right: 3%">		
						<div class="s_picBox">		
							<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">		
								<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>" />
							</a>			
						</div>	
						<div>
							<span  style="color: #F66F9B">
								<big><b>￥<?php echo ($goods["price"]); ?></b> </big>
							</span>
							<span style="float: right">销量：
								<big style="color: #F66F9B"><b><?php echo ($goods["sales"]); ?></b> </big>
							</span>	
						</div>	
						<p class="txt">
						<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>			
					<!--循环输出包包结束-->
				</ul>	

				<ul class="attr_words">	
					<!--包包分类循环开始-->
					<?php if(is_array($second_category_baobaos)): $i = 0; $__LIST__ = $second_category_baobaos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_baobao): $mod = ($i % 2 );++$i;?><li >			
						<h3>
							<a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_baobao['id']));?>" target="_blank"><?php echo ($second_category_baobao["name"]); ?></a>
						</h3>			
						<p>				
							<?php if(is_array($third_category_baobaos)): $j = 0; $__LIST__ = $third_category_baobaos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_baobao): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_baobao)): $z = 0; $__LIST__ = $third_category_baobao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$baobao): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$baobao['id']));?>" target="_blank"><?php echo ($baobao["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>	
						</p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>	
					<!--包包分类循环结束-->	
				</ul>	
			
			</div>
			<div class="shop">	
				<div class="cmn_title">	
					<h3 class="f16_f">最热包包</h3>	
				</div>		
				<ul class="list">	
				<!--包包右边列表开始 -->
					<?php if(is_array($hot_baobaos_goods)): $i = 0; $__LIST__ = $hot_baobaos_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li >			
						<a class="avatar32_f" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">
							<img src="/shop/Public/<?php echo ($goods["small_picture"]); ?>" />
						</a>				
						<p class="name">
							<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>			
						<p class="txt">总销量<?php echo ($goods["sales"]); ?></p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				<!--包包右边列表结束 -->
				</ul>	
			
			</div>
		</div>
		<div class="auto_wrap line">
			<div class="wel_tle">		
				<a class="more" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category_peishi['id']));?>" target="_blank">查看所有配饰 <samp>&gt;</samp></a>	
				<h2 class="tle"><span class="ico5"></span>配饰</h2><span class="today">最新上架<strong></strong></span>	
			</div>	
			<div class="attr_box">		
				<ul  class="rec_sku recommend" style="">
					<!--循环输出配饰开始-->
					<?php if(is_array($new_peishis_goods)): $i = 0; $__LIST__ = $new_peishis_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li style="padding-right: 3%">		
						<div class="s_picBox">		
							<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">		
								<img src="/shop/Public/<?php echo ($goods["big_picture"]); ?>" />
							</a>			
						</div>	
						<div>
							<span style="color: #F66F9B">
								<big><b>￥<?php echo ($goods["price"]); ?></b> </big>
							</span>
							<span style="float: right">销量：
								<big style="color: #F66F9B"><b><?php echo ($goods["sales"]); ?></b> </big>
							</span>	
						</div>	
						<p class="txt">
						<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>		
					</li><?php endforeach; endif; else: echo "" ;endif; ?>			
					<!--循环输出配饰结束-->
				</ul>	

				<ul class="attr_words">	
					<!--配饰分类循环开始-->
					<?php if(is_array($second_category_peishis)): $i = 0; $__LIST__ = $second_category_peishis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category_peishi): $mod = ($i % 2 );++$i;?><li >			
						<h3>
							<a href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category_peishi['id']));?>" target="_blank"><?php echo ($second_category_peishi["name"]); ?></a>
						</h3>			
						<p>						
							<?php if(is_array($third_category_peishis)): $j = 0; $__LIST__ = $third_category_peishis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category_peishi): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category_peishi)): $z = 0; $__LIST__ = $third_category_peishi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$peishi): $mod = ($z % 2 );++$z;?><a href="<?php echo U('category/index',array('level'=>3,'cid'=>$peishi['id']));?>" target="_blank"><?php echo ($peishi["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>							
						</p>			
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--配饰分类循环结束-->
				</ul>
			
		
			</div>
		<div class="shop">	
			<div class="cmn_title">		
				<h3 class="f16_f">最热配饰</h3>	
			</div>	
				<ul class="list">
				<!--最热配饰右边循环开始-->
					<?php if(is_array($hot_peishis_goods)): $i = 0; $__LIST__ = $hot_peishis_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><li >			
						<a class="avatar32_f" href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank" title="<?php echo ($goods["first_name"]); ?>">
							<img src="/shop/Public/<?php echo ($goods["small_picture"]); ?>" />
						</a>			
						<p class="name">
							<a href="<?php echo U('detail/index',array('gid'=>$goods['id']));?>" target="_blank"><?php echo ($goods["first_name"]); ?></a>
						</p>			
						<p class="txt">总销量<?php echo ($goods["sales"]); ?></p>	
					</li><?php endforeach; endif; else: echo "" ;endif; ?>	
				<!--最热配饰右边循环结束-->
				</ul>


		</div>
			</div>
			
	<script>
		var len=$(".top_bnr .banner li").length;
		var j=0;
		var mlktime=null;
		$(".top_bnr,.bnr_btn").mouseover(function(){
			mlktime=clearInterval(mlktime);
			$(".bnr_btn").css({display:"inline"});
		}).mouseout(function(){
			mlktime=null;
			mlktime=setInterval(mytime,4000);
		});
		$(".bnr_btn_left").click(function(){
			
			$(".adType a").removeClass("current");
			$(".top_bnr .banner li").css({zIndex:'0',opacity:"0"});
			var a=j--;
			if(a<=0) a=0;
			$(".adType a:eq("+a+")").addClass("current");
			$(".top_bnr .banner li:eq("+a+")").css({zIndex:'2',opacity:"1"});
			if(j<=0) j=0;
		});
		$(".bnr_btn_right").click(function(){
			
			$(".adType a").removeClass("current");
			$(".top_bnr .banner li").css({zIndex:'0',opacity:"0"});
			var b=j++;
			if(b>=(len-1)) b=(len-1);
			$(".adType a:eq("+b+")").addClass("current");
			$(".top_bnr .banner li:eq("+b+")").css({zIndex:'2',opacity:"1"});
			if(j>=(len-1)) j=(len-1);
		});
		function mytime(){
			for(var i=0;i< len;i++){
				if(i==j){
					$(".adType a:eq("+j+")").addClass("current");
					$(".top_bnr .banner li:eq("+j+")").css({zIndex:'2',opacity:"0"}).animate({opacity:"1"},3000);
				}else{
					$(".top_bnr .banner li:eq("+i+")").css({zIndex:'0',opacity:"0.5"});
					$(".adType a:eq("+i+")").removeClass("current");
				}
			}
			j++;
			if(j>=len) j=0;
		}
		mlktime=setInterval(mytime,3000);
		
		$(".list").mouseover(function(){
			$(this).addClass("active");
			$("ul",this).css({display:"block"});
		}).mouseout(function(){
			$(this).removeClass("active");
			$("ul",this).css({display:"none"})
			});
	</script>		
	<script src="/shop/Public/index/js/linklb.js"></script>
<script src="/shop/Public/index/js/jquery-1.8.3.min.js"></script>
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
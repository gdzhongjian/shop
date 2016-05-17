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
	
	<div class="content_fluid" style="width:1200px;">
		<!--商品墙开始-->
		<div class="goods_wall" style="position: relative;height: auto">
			<!--列表开始左侧-->
			<div class="corner_notic" col="0" coli="0" style="position: absolute; top: 0px; left: 0px;">			
				<div class="rec_nav" style="background-color: #F7F2F2">	

					<h1 class="f18_f mt14_f"><?php echo ($first_category["name"]); ?></h1>	
					<ul class="nav_list">
					<?php if(is_array($second_categorys)): $i = 0; $__LIST__ = $second_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second_category): $mod = ($i % 2 );++$i;?><li>			
							<span>									
								<a class="red_f" href="<?php echo U('category/index',array('level'=>2,'cid'=>$second_category['id'],'sex'=>$sex));?>" target="_blank"><?php echo ($second_category["name"]); ?></a>							
							</span>			
							<p>	
								<?php if(is_array($third_categorys)): $j = 0; $__LIST__ = $third_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third_category): $mod = ($j % 2 );++$j; if($i == $j): if(is_array($third_category)): $z = 0; $__LIST__ = $third_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($z % 2 );++$z;?><a  href="<?php echo U('category/index',array('level'=>3,'cid'=>$category['id'],'sex'=>$sex));?>" target="_blank"><?php echo ($category["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>				
							</p>		
						</li><?php endforeach; endif; else: echo "" ;endif; ?>								
					</ul>
					
					
				</div>

		   		</div>
			<!--列表结束左侧-->


			<div class="corner_nav" style="width: auto; position: absolute; top: 20px; left: 240px;" col="1" coli="0">	
				
				
			
				<!--排序开始-->
				<div class="cata_title">
					<span class="left_f f14_f">排序：</span>	
					
					<ul class="category">	

						<li>
							<a class="<?php if($sort == 1): ?>active<?php endif; ?> first" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>1,'price'=>$_GET['price']));?>">流行</a>
						</li>		
						<li>
							<a class="<?php if($sort == 2): ?>active<?php endif; ?>" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>2,'price'=>$_GET['price']));?>">热销</a>
						</li>	
						<li>
							<a class="<?php if($sort == 3): ?>active<?php endif; ?> last" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>3,'price'=>$_GET['price']));?>">最新</a>
						</li>	
					</ul>
					<span class="left_f f14_f">价格：</span>
					<ul class="category left_f">	
						<li>
							<a class="<?php if($price == 1): ?>active<?php endif; ?> first" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>$_GET['sort'],'price'=>1));?>">全部</a>
						</li>	
						<li>
							<a  class="<?php if($price == 2): ?>active<?php endif; ?>" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>$_GET['sort'],'price'=>2));?>">0~100</a>
						</li>	
						<li>
							<a  class="<?php if($price == 3): ?>active<?php endif; ?>" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>$_GET['sort'],'price'=>3));?>">101~200</a>
						</li>	
						<li>
							<a  class="<?php if($price == 4): ?>active<?php endif; ?>" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>$_GET['sort'],'price'=>4));?>">201~500</a>
						</li>	
						<li>
							<a  class="<?php if($price == 5): ?>active<?php endif; ?> last" href="<?php echo U('category/index',array('level'=>1,'cid'=>$first_category['id'],'sex'=>$sex,'sort'=>$_GET['sort'],'price'=>5));?>">500元以上</a>
						</li>
					</ul>
									
				</div>
		</div>

			
			
			
		<div class="corner_nav" style="width:960px;float:right;top: 235px; left: 240px;margin-top:100px;">

			<!--商品展示开始-->

			<div class="auto_wrap">
				
			<ul class="rec_sku recommend" style="width:1100px;">		

				<!--循环输出一级分类商品开始-->
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><li style="margin-right: 1%">		
					<div class="s_picBox">		
						<a class="s_pic imgBox" href="<?php echo U('detail/index',array('gid'=>$good['id']));?>" target="_blank" title="<?php echo ($good["first_name"]); ?>">		
							<img src="/shop/Public/<?php echo ($good["big_picture"]); ?>" />
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
				<!--循环输出一级分类商品结束-->
				
			</ul>
			
		</div>


			<!--商品展示结束-->
				
			</div>
		
	</div>
	<!--商品墙结束-->


	<div class="clear_f"></div>	
</div>
<!--分页开始-->
    <link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/page.css">
	
	<div class="paging_panel c_f " style="margin-top:10px;">
		<div class="pages">
            <?php echo ($page); ?>    
        </div>	
	</div>
	
	<!--分页开始-->	
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
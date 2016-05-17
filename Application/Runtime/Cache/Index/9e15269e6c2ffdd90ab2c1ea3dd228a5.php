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
	<script type="text/javascript" src="/shop/Public/index/date/WdatePicker.js"></script>
	<script type="text/javascript" src="/shop/Public/index/js/user/information.js"></script>
	<script type="text/javascript">
            var editUserinfo="<?php echo U('user/editUserinfo');?>";
            var checkNicknameByInfo="<?php echo U('user/checkNicknameByInfo');?>";
	</script>
			<div class="settings">	
				<div class="hp_tab">		
					<div class="use-info">	
						<img src="/shop/Public/<?php echo ($userinfo["headimage"]); ?>" alt="" class="use-pic"><p href="" class="use-name">
							<a class="use" href="" title="<?php echo ($user["nickname"]); ?>"><?php echo ($user["nickname"]); ?></a>
						</p>			
						<p class="use-id">性别：<?php if($userinfo['sex'] == 0): ?>女<?php elseif($userinfo['sex'] == 1): ?>男<?php else: ?>保密<?php endif; ?>
						</p>		
					</div>	
					<div class="sub_tab">		
						<ul class="account-manage">				
							<strong>个人信息</strong>				
							<li>
								<a onclick='changeTab(this)' id="info" class="red_f">我的信息</a>
							</li>				
							<li>
								<a onclick='changeTab(this)' id="head">设置头像</a>
							</li>				
							<li>
								<a onclick='changeTab(this)' id="pwd">修改密码</a>
							</li>								
						</ul>		
							
					</div>		
				</div>	

				<div class="settings_box"  id="info_id" style="display:block;">			
					<strong class="title" style="background-color: #F2EEEE">我的信息</strong>
					<fieldset class="setPassword" style="border:none;"> 
						<form id="setPersonForm" method="post"> 
							<p class="form-list"> 
								<label> 注册邮箱 </label> 
								<input id="email" name="email" type="text" value="<?php echo ($user["email"]); ?>" disabled="disabled" /> 
								<strong> </strong> 
							</p> 
							<p class="form-list"> 
								<label> 昵称 </label> 
								<input id="nickname" name="nickname" type="text" value="<?php echo ($user["nickname"]); ?>"/> 
								<strong style="color: red" id="checknickname"></strong> 
							</p> 
							<p class="form-list"> 
								<label> 真实姓名 </label> 
								<input id="truename" name="truename" type="text" value="<?php echo ($userinfo["truename"]); ?>" /> 
								<strong> </strong> 
							</p> 
							
							<p class="passChange"> 
								<label> 性别 </label>
								<input name="sex" type="radio" value="0" class="sex" <?php if($userinfo['sex'] == 0): ?>checked<?php endif; ?> /> 
								<label class="sexChaneg" style="width:15px;float:none;"> 女 </label> 
								<input name="sex" type="radio" value="1" class="sex" <?php if($userinfo['sex'] == 1): ?>checked<?php endif; ?> /> 
								<label class="sexChaneg" style="width:15px;float:none;"> 男 </label> 
								<input name="sex" type="radio" value="2" class="sex" <?php if($userinfo['sex'] == 2): ?>checked<?php endif; ?> /> 
								<label class="sexChaneg" style="width:15px;float:none;"> 保密 </label> 
								<strong> </strong> 
							</p> 
							<p class="form-list"> 
								<label> 生日 </label> 
								<input id="birthday" name="birthday" type="text" value="<?php echo ($userinfo["birthday"]); ?>" disabled="disabled" style="border-radius:6px !important;height:30px;width:173px;"/> 
								<strong> <a href="javascript:void(0)" style="color: #1C9255" id="xiugaibirthday">修改</a></strong> 
							</p> 
							<p class="form-list" style="display: none" id="birthday_p"> 
								<label> 修改生日 </label> 
								<input id="newbirthday" name="newbirthday" type="text"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})" readonly="readonly" style="border-radius:6px !important;height:30px;width:173px;" placeholder="请选择出生日期"/> 
								<strong> </strong> 
							</p> 
							
							<p class="form-list"> 
								<label> 所在地 </label> 
								<input id="location" name="location" type="text" value="<?php echo ($userinfo["location"]); ?>" disabled/> 
								<strong><a href="javascript:void(0)" style="color: #1C9255" id="xiugailocation">修改</a></strong> 
							</p>

							<p class="form-list" style="display: none" id="location_p"> 
								<label> 修改所在地 </label> 
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

								<strong id="address"></strong>
							</p> 
							<p class="form-list"> 
								<label> 学校 </label> 
								<input id="school" name="school" type="text" value="<?php echo ($userinfo["school"]); ?>" /> 
								<strong> </strong> 
							</p> 
							<p class="form-list"> 
								<label> 工作单位 </label> 
								<input id="work_unit" name="work_unit" type="text" value="<?php echo ($userinfo["work_unit"]); ?>" /> 
								<strong> </strong> 
							</p> 
							<p class="form-list"> 
								<label> 从事行业 </label> 
								<select name="job" id="job"> 
									<option value="0"> 请选择你的职业 </option>  	
									<option value="公关" <?php if($userinfo['job'] == '公关'): ?>selected<?php endif; ?> >公关</option>  	
									<option value="媒体" <?php if($userinfo['job'] == '媒体'): ?>selected<?php endif; ?>  >媒体</option>  	
									<option value="模特" <?php if($userinfo['job'] == '模特'): ?>selected<?php endif; ?>  >模特</option>  	
									<option value="设计师" <?php if($userinfo['job'] == '设计师'): ?>selected<?php endif; ?> >设计师</option>  	
									<option value="市场/营销" <?php if($userinfo['job'] == '市场/营销'): ?>selected<?php endif; ?> >市场/营销</option>  	
									<option value="创意/文案" <?php if($userinfo['job'] == '创意/文案'): ?>selected<?php endif; ?> >创意/文案</option>  	
									<option value="广告" <?php if($userinfo['job'] == '广告'): ?>selected<?php endif; ?> >广告</option>  	
									<option value="法律" <?php if($userinfo['job'] == '法律'): ?>selected<?php endif; ?> >法律</option>  	
									<option value="贸易" <?php if($userinfo['job'] == '贸易'): ?>selected<?php endif; ?> >贸易</option>  	
									<option value="公务员" <?php if($userinfo['job'] == '公务员'): ?>selected<?php endif; ?> >公务员</option>  	
									<option value="教育" <?php if($userinfo['job'] == '教育'): ?>selected<?php endif; ?> >教育</option>  	
									<option value="互联网" <?php if($userinfo['job'] == '互联网'): ?>selected<?php endif; ?> >互联网</option>  	
									<option value="计算机" <?php if($userinfo['job'] == '计算机'): ?>selected<?php endif; ?> >计算机</option>  	
									<option value="自由职业" <?php if($userinfo['job'] == '自由职业'): ?>selected<?php endif; ?> >自由职业</option>  	
									<option value="学生" <?php if($userinfo['job'] == '学生'): ?>selected<?php endif; ?> >学生</option>  	
									<option value="非盈利机构" <?php if($userinfo['job'] == '非盈利机构'): ?>selected<?php endif; ?> >非盈利机构</option>
									<option value="保险" <?php if($userinfo['job'] == '保险'): ?>selected<?php endif; ?> >保险</option>
									<option value="财务" <?php if($userinfo['job'] == '财务'): ?>selected<?php endif; ?> >财务</option>
									<option value="餐饮" <?php if($userinfo['job'] == '餐饮'): ?>selected<?php endif; ?> >餐饮</option>
									<option value="电子/微电子" <?php if($userinfo['job'] == '电子/微电子'): ?>selected<?php endif; ?> >电子/微电子</option>
									<option value="翻译" <?php if($userinfo['job'] == '翻译'): ?>selected<?php endif; ?> >翻译</option>  	
									<option value="房地产/建筑" <?php if($userinfo['job'] == '房地产/建筑'): ?>selected<?php endif; ?> >房地产/建筑</option>  	
									<option value="航空航天" <?php if($userinfo['job'] == '航空航天'): ?>selected<?php endif; ?> >航空航天</option>  	
									<option value="家电业" <?php if($userinfo['job'] == '家电业'): ?>selected<?php endif; ?> >家电业</option>  	
									<option value="家居/室内设计" <?php if($userinfo['job'] == '家居/室内设计'): ?>selected<?php endif; ?> >家居/室内设计</option>
									<option value="教育/培训" <?php if($userinfo['job'] == '教育/培训'): ?>selected<?php endif; ?> >教育/培训</option>  	
									<option value="酒店" <?php if($userinfo['job'] == '酒店'): ?>selected<?php endif; ?> >酒店</option>  	
									<option value="会计" <?php if($userinfo['job'] == '会计'): ?>selected<?php endif; ?> >会计</option>  	
									<option value="科研/院校" <?php if($userinfo['job'] == '科研/院校'): ?>selected<?php endif; ?> >科研/院校</option>  	
									<option value="快速消费品" <?php if($userinfo['job'] == '快速消费品'): ?>selected<?php endif; ?> >快速消费品</option>  	
									<option value="零售" <?php if($userinfo['job'] == '零售'): ?>selected<?php endif; ?> >零售</option>  	
									<option value="旅游" <?php if($userinfo['job'] == '旅游'): ?>selected<?php endif; ?> >旅游</option>  	
									<option value="其他" <?php if($userinfo['job'] == '其他'): ?>selected<?php endif; ?> >其他</option>  
								</select> 
								
							</p> 
							<p class="form-list"> 
								<label> 爱好 </label> 
								<input id="hobby" name="hobby" autocomplete="off" class="l_ipt" type="text" value="<?php echo ($userinfo["hobby"]); ?>" /> 
								<strong> </strong> 
							</p> 
							<p class="form-list" style="margin-left: 20%;color: #F44C4C" id="success"></p> 
							<input type="button" value="确 认" class="ext_submit" id="edit" style="cursor: pointer" /> 
						</form> 	
					</fieldset>
					
				</div>	
			
			<div class="settings_box" style="display:none" id="pwd_id">
				<strong class="title" style="background-color: #F2EEEE">修改密码</strong>
				<fieldset class="setPassword">
					<form id="setPasswordForm" method="post" action="<?php echo U('user/changepassword');?>">
						<p class="form-list">
							<label for="email">邮箱</label>
							<input id="oldemail" type="text" name="oldemail" value="<?php echo ($user["email"]); ?>" readonly="readonly" />
							<strong class="good"></strong>
						</p>
						<p class="form-list">
							<label for="new_password">原密码</label>
								<input id="oldpassword" type="password" name="oldpassword">
							<strong class="good" id="oldpassword_p"></strong>
						</p>
						<p class="form-list">
							<label for="new_password">新密码</label>
								<input id="newpassword" type="password" name="newpassword">
							<strong class="good" id="newpassword_p"></strong>
						</p>
						<div class="pw_safe none_f" style="display: block;">
							<span class="txt">安全程度</span>
							<div class="pw_strength pw_weak pw_medium pw_strong">
								<div class="pw_bar"></div>
								<div class="pw_letter">
									<span class="strength_l pw_strength_color">弱</span>
									<span class="strength_m">中</span>
									<span class="strength_h">强</span>
								</div>
							</div>
						</div>
						<p class="form-list">
							<label for="confirm_password">确认密码</label>
							<input id="confirm_password" type="password"  name="confirm_password" />
							<strong class="bad" id="confirm_password_p"></strong>
						</p>
						<input class="ext_submit" type="submit" value="确 认" id="editpassword" style="cursor:pointer" />
					</form>

				</fieldset>
			</div>
			<div class="settings_box" id="head_id" style="display:none">
				<strong class="title" style="background-color: #F2EEEE">修改头像</strong>
				<fieldset class="setHeadimage">
					<form id="setPasswordForm" method="post" action="<?php echo U('user/changeheadimage');?>" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>">
						<br><br><br>
							<label for="email" style="margin-left: 5%">选择新头像</label>
							<input type="file" value="上传" id="newheadimage" style="margin-left: 5%" name="newheadimage"/>
							<strong class="good"></strong>
						<div style="margin-left: 19%" style="display:none" id="newheadimageshow">
							<img id="upload_img" src="/shop/Public/<?php echo ($userinfo["headimage"]); ?>" onerror="this.src='img/a2.jpg'" class="use-pic" />
						</div>
						<br><br><br><br><br><br><br><br><br><br>
						<input class="ext_submit" type="submit" value="确 认" id="editpassword" style="cursor:pointer" />
					</form>

				</fieldset>

				
				
				
				
			</div>
				
		</div>

		<script type="text/javascript" charset="utf-8">
			function changeTab(obj){
				var key = $(obj).attr("id")+"_id";
				$(".settings_box").hide();
				$("#"+key).show();
			}

			$(".sub_tab ul li a").css("cursor","pointer");
			$(".sub_tab ul li a").click(function(){
				$(".sub_tab a").removeClass("red_f");
				$(this).addClass("red_f");

				
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

    $("#newheadimage").change(function(){
    	$("#newheadimageshow").css('display','block');
    var objUrl = getObjectURL(this.files[0]) ;
    console.log("objUrl = "+objUrl) ;
    if (objUrl) {
        $("#upload_img").attr("src", objUrl) ;
    }
});
    //建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null ; 
    if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
}
    </script>
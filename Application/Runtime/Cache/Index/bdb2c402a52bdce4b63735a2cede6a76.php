<?php if (!defined('THINK_PATH')) exit(); if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><div class="item-show-li">
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
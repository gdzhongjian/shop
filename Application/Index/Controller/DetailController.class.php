<?php 
namespace Index\Controller;
use Think\Controller;

/**
* 商品详情控制器
*/
class DetailController extends CommonController
{
	public function index(){
		$id=I('get.gid');
		$Goods=M('Goods');
		$goods=$Goods->where(array('id'=>$id))->find();
		//浏览量加1
		$Goods->views=$goods['views']+1;
		$Goods->where(array('id'=>$id))->save();
		$Goods_picture=M('Goods_picture');
		$goods_pictures=$Goods_picture->where(array('shop_goods_id'=>$goods['id']))->select();
		$Goods_stock=M('stock');
		$stocks=$Goods_stock->where(array('shop_goods_id'=>$goods['id']))->select();
		//随机获取一个商品原价
		$original_price=$stocks[0]['original_price'];
		$address=$stocks[0]['address'];
		//获取商品颜色，尺寸，并且去重
		$colors=array();
		$sizes=array();
		foreach ($stocks as $stock) {
			$colors[]=$stock['color'];
			$sizes[]=$stock['size'];
		}
		$colors=array_unique($colors);
		$sizes=array_unique($sizes);



		//右侧可能喜欢（输出两种商品，同三级分类下的）
		$may_likes=$Goods->where(array('shop_goods_category_id'=>$goods['shop_goods_category_id'],'is_sale'=>1,'sex'=>$goods['sex'],'id'=>array('neq',$goods['id'])))->order('-sales')->limit(2)->select();

		//人气推荐单品（输出六种商品，该三级分类的父级二级分类下的热销商品）
		$popular_clothes=$Goods->where(array('second_category'=>$goods['second_category'],'is_sale'=>1,'sex'=>$goods['sex'],'id'=>array('neq',$goods['id'])))->order('-views')->limit(6)->select();


		$this->goods=$goods;
		$this->goods_pictures=$goods_pictures;
		$this->colors=$colors;
		$this->sizes=$sizes;
		$this->original_price=$original_price;	//商品原价
		$this->address=$address;
		$this->may_likes=$may_likes;
		$this->popular_clothes=$popular_clothes;



		//成交记录，只输出当前状态为已付款，已发货，交易完成的记录，按时间倒序输出
		$Order=M('Order');
		$order_count=$Order->where(array('status'=>array('gt',0),'shop_goods_id'=>$goods['id']))->order('-buy_time')->count();
		//动态配置分页参数
		C('VAR_PAGE','record');
		$Page=getpage($order_count,C('COMMENT_AND_RECORD'));
		$record_show=$Page->show();
		$orders=$Order->where(array('status'=>array('gt',0),'shop_goods_id'=>$goods['id']))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$records=array();
		$User=M('User');
		$Stock=M('Stock');
		$record_i=1;
		foreach ($orders as $order) {
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$records[$record_i]['username']=$user['nickname'];
			$records[$record_i]['buy_time']=$order['buy_time'];
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$records[$record_i]['color']=$stock['color'];
			$records[$record_i]['size']=$stock['size'];
			$record_i++;
		}
		//如果是异步操作
		if(IS_AJAX){
			if(I('get.record')){
				$this->records=$records;
				$this->record_show=$record_show;
				$html=array();
				$html[0]=$this->fetch('ajaxRecord');
				$html[1]="record";
				return $this->ajaxReturn($html);
			}
		}
		$this->records_count=$order_count;
		$this->records=$records;
		$this->record_show=$record_show;

		$comment_status=I('get.comment_status');
		if(!$comment_status){
			$comment_status="all";
		}
		//购买评价输出，默认输出全部评论，根据用户选择好评，中评，差评分类输出
		$Comment=M('Comment');
		//动态分配分页参数
		C('VAR_PAGE','comment');
		if(IS_AJAX){
			if($comment_status=="all"){
				$comment_count=$Comment->where(array('shop_goods_id'=>$goods['id']))->count();
				$Page=getpage($comment_count,C('COMMENT_AND_RECORD'));
				$comments_show=$Page->show();
				$data=$Comment->where(array('shop_goods_id'=>$goods['id']))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
				$comments=array();
				$comment_i=1;
				$Userinfo=M('Userinfo');
				$User=M('User');
				foreach ($data as $comment) {
					$userinfo=$Userinfo->where(array('shop_user_id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['headimage']=$userinfo['headimage'];
					$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['username']=$user['nickname'];
					$comments[$comment_i]['time']=$comment['time'];
					$comments[$comment_i]['content']=$comment['content'];
					$comment_i++;
				}
				$this->comments=$comments;
				$this->comments_show=$comments_show;
				//如果URL参数存在comment，说明是异步分页刷新，没有则是选择标签栏的全部评价，好评，中评，差评
				if(I('get.comment')){
					$html=array();
					$html[0]=$this->fetch('ajaxComment');
					$html[1]="comment";
					return $this->ajaxReturn($html);
				}else{
					$html=$this->fetch('ajaxComment');
					return $this->ajaxReturn($html);
				}
				
			}
			if($comment_status=="good"){
				$comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>3))->count();
				$Page=getpage($comment_count,C('COMMENT_AND_RECORD'));
				$comments_show=$Page->show();
				$data=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>3))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
				$comments=array();
				$comment_i=1;
				$Userinfo=M('Userinfo');
				$User=M('User');
				foreach ($data as $comment) {
					$userinfo=$Userinfo->where(array('shop_user_id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['headimage']=$userinfo['headimage'];
					$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['username']=$user['nickname'];
					$comments[$comment_i]['time']=$comment['time'];
					$comments[$comment_i]['content']=$comment['content'];
					$comment_i++;
				}
				$this->comments=$comments;
				$this->comments_show=$comments_show;
				//如果URL参数存在comment，说明是异步分页刷新，没有则是选择标签栏的全部评价，好评，中评，差评
				if(I('get.comment')){
					$html=array();
					$html[0]=$this->fetch('ajaxComment');
					$html[1]="comment";
					return $this->ajaxReturn($html);
				}else{
					$html=$this->fetch('ajaxComment');
					return $this->ajaxReturn($html);
				}
			}
			if($comment_status=="middle"){
				$comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>2))->count();
				$Page=getpage($comment_count,C('COMMENT_AND_RECORD'));
				$comments_show=$Page->show();
				$data=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>2))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
				$comments=array();
				$comment_i=1;
				$Userinfo=M('Userinfo');
				$User=M('User');
				foreach ($data as $comment) {
					$userinfo=$Userinfo->where(array('shop_user_id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['headimage']=$userinfo['headimage'];
					$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['username']=$user['nickname'];
					$comments[$comment_i]['time']=$comment['time'];
					$comments[$comment_i]['content']=$comment['content'];
					$comment_i++;
				}
				$this->comments=$comments;
				$this->comments_show=$comments_show;
				//如果URL参数存在comment，说明是异步分页刷新，没有则是选择标签栏的全部评价，好评，中评，差评
				if(I('get.comment')){
					$html=array();
					$html[0]=$this->fetch('ajaxComment');
					$html[1]="comment";
					return $this->ajaxReturn($html);
				}else{
					$html=$this->fetch('ajaxComment');
					return $this->ajaxReturn($html);
				}
			}
			if($comment_status=="bad"){
				$comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>1))->count();
				$Page=getpage($comment_count,C('COMMENT_AND_RECORD'));
				$comments_show=$Page->show();
				$data=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>1))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
				$comments=array();
				$comment_i=1;
				$Userinfo=M('Userinfo');
				$User=M('User');
				foreach ($data as $comment) {
					$userinfo=$Userinfo->where(array('shop_user_id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['headimage']=$userinfo['headimage'];
					$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
					$comments[$comment_i]['username']=$user['nickname'];
					$comments[$comment_i]['time']=$comment['time'];
					$comments[$comment_i]['content']=$comment['content'];
					$comment_i++;
				}
				$this->comments=$comments;
				$this->comments_show=$comments_show;
				//如果URL参数存在comment，说明是异步分页刷新，没有则是选择标签栏的全部评价，好评，中评，差评
				if(I('get.comment')){
					$html=array();
					$html[0]=$this->fetch('ajaxComment');
					$html[1]="comment";
					return $this->ajaxReturn($html);
				}else{
					$html=$this->fetch('ajaxComment');
					return $this->ajaxReturn($html);
				}
			}

		}
		//全部评论总数
		$comment_count=$Comment->where(array('shop_goods_id'=>$goods['id']))->count();
		//好评总数
		$good_comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>3))->count();
		//中评总数
		$middle_comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>2))->count();
		//差评总数
		$bad_comment_count=$Comment->where(array('shop_goods_id'=>$goods['id'],'score'=>1))->count();
		//好评率
		if(!$comment_count){
			$good_percent="100.00%";
		}else{
			$good_percent=$good_comment_count/$comment_count*100;
			$good_percent=sprintf('%.2f',$good_percent);
			$good_percent=$good_percent."%";
		}

		$Page=getpage($comment_count,C('COMMENT_AND_RECORD'));
		$comments_show=$Page->show();
		$data=$Comment->where(array('shop_goods_id'=>$goods['id']))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
		$comments=array();
		$comment_i=1;
		$Userinfo=M('Userinfo');
		$User=M('User');
		foreach ($data as $comment) {
			$userinfo=$Userinfo->where(array('shop_user_id'=>$comment['shop_user_id']))->find();
			$comments[$comment_i]['headimage']=$userinfo['headimage'];
			$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
			$comments[$comment_i]['username']=$user['nickname'];
			$comments[$comment_i]['time']=$comment['time'];
			$comments[$comment_i]['content']=$comment['content'];
			$comment_i++;
		}

		$this->comment_count=$comment_count;
		$this->good_comment_count=$good_comment_count;
		$this->middle_comment_count=$middle_comment_count;
		$this->bad_comment_count=$bad_comment_count;
		$this->comments=$comments;
		$this->comments_show=$comments_show;

		$this->good_percent=$good_percent;
		$this->display();
	}

	//商品喜欢加一
	public function like(){
		if(IS_AJAX){
			$goods_id=I('post.goods_id');
			$Goods=M('Goods');
			$goods=$Goods->where(array('id'=>$goods_id))->find();
			$Goods->likes=$goods['likes']+1;
			if($Goods->where(array('id'=>$goods_id))->save()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//发表评论
	public function addComment(){
		$gid=I('get.gid');
		$this->goods_id=$gid;
		$this->display();
	}

	//处理发表评论
	public function checkAddComment(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		if(!IS_AJAX){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		$post=I('post.');
		$Comment=M('Comment');
		$Comment->content=$post['comment'];
		$Comment->score=$post['pingfen'];
		$Comment->shop_user_id=$uid;
		$Comment->shop_goods_id=$post['goods_id'];
		$Comment->time=time();
		if($Comment->add()){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//判断用户是否购买了该商品，购买了才有资格评价
	public function checkBuy(){
		if(IS_AJAX){
			if(!$this->checkIsLegal()){
				//未登录
				return $this->ajaxReturn(-1);
			}
			$uid=session('uid');
			$goods_id=I('post.goods_id');
			$Order=M('Order');
			//查询到该用户在该商品的一系列购买情况
			$orders=$Order->where(array('shop_user_id'=>$uid,'shop_goods_id'=>$goods_id))->select();
			if($orders){
				//购买了,判断是否是交易成功
				foreach ($orders as $order) {
					//只要有一个是交易成功的，就可以评论，否则一个交易成功的都没有，不允许评论
					if($order['status']==3){
						return $this->ajaxReturn(1);
					}
				}
				return $this->ajaxReturn(2);
			}else{
				//压根就没购买
				return $this->ajaxReturn(-2);
			}
		}
	}

	//异步请求商品颜色，尺码类别
	public function checkStock(){
		$post=I('post.');
		$gid=$post['gid'];
		$color=$post['color'];
		$size=$post['size'];
		$Stock=M('Stock');
		$stock=$Stock->where(array('shop_goods_id'=>$gid,'color'=>$color,'size'=>$size))->find();
		if($stock){
			//存在库存
			$data=array();
			$data[0]=$stock['sale_price'];
			$data[1]=$stock['original_price'];
			$data[2]=$stock['address'];
			$data[3]=$stock['stock_sum'];
			return $this->ajaxReturn($data);
		}else{
			$data=false;
			return $this->ajaxReturn($data);
		}
		
		
	}


	//加入到购物车
	public function addCart(){
		if(IS_AJAX){
			$check=$this->checkIsLegal();
			if(!$check){
				//未登录
				return $this->ajaxReturn(0);
			}
			$post=I('post.');
			$Stock=M('Stock');
			$stock=$Stock->where(array('shop_goods_id'=>$post['shop_goods_id'],'color'=>$post['color'],'size'=>$post['size']))->find();
			if(!$stock){
				//库存没有余量
				return $this->ajaxReturn(1);
			}
			if($post['nums']>$stock['stock_sum']){
				//库存不够
				return $this->ajaxReturn(-5);
			}

			//获取用户id
			$uid=session('uid');
			$post['shop_user_id']=$uid;
			//判断是否已经存在该商品在购物车
			$Cart=D('Cart');
			$checkCart=$Cart->where(array('shop_user_id'=>$uid,'shop_goods_id'=>$post['shop_goods_id'],'color'=>$post['color'],'size'=>$post['size']))->find();
			if($checkCart){
				//用户已经添加过该商品到购物车，加上新的购物数量
				$post['nums']+=$checkCart['nums'];
				//判断库存是否足够
				$Stock=M('Stock');
				$stock=$Stock->where(array('shop_goods_id'=>$post['shop_goods_id'],'color'=>$post['color'],'size'=>$post['size']))->find();
				if($stock['stock_sum']<$post['nums']){
					return $this->ajaxReturn(-3); //库存不够
				}

				if($Cart->create($post)){

					if($Cart->where(array('id'=>$checkCart['id']))->save()){
						//修改购物车数据成功
						return $this->ajaxReturn(2);
					}else{
						return $this->ajaxReturn(-2);
					}
				}else{
					return $this->ajaxReturn(-2);
				}

			}else{
				//新的购物车数据
				if($Cart->create($post)){
					if($Cart->add()){
						//新增购物车数据成功
						return $this->ajaxReturn(2);
					}else{
						return $this->ajaxReturn(-2);
					}
				}else{
					return $this->ajaxReturn(-2);
				}
			}
		}else{
			//非法访问
			return $this->ajaxReturn(-4);
		}
	}

	//异步验证立即购买合法性
	public function buyNow(){
		if(IS_AJAX){
			if(!$this->checkIsLegal()){
				//未登录
				return $this->ajaxReturn(0);
			}
			$post=I('post.');
			$Stock=M('Stock');
			$stock=$Stock->where(array('shop_goods_id'=>$post['shop_goods_id'],'color'=>$post['color'],'size'=>$post['size']))->find();
			if(!$stock){
				//库存没有余量
				return $this->ajaxReturn(-1);
			}
			if($post['nums']>$stock['stock_sum']){
				//库存不够
				return $this->ajaxReturn(-2);
			}
			//把立即购买的数据放进session中
			session('buy_now_gid',$post['shop_goods_id']);
			session('buy_now_color',$post['color']);
			session('buy_now_size',$post['size']);
			session('buy_now_nums',$post['nums']);
			return $this->ajaxReturn(1);
		}
	}

	//立即购买
	public function buy(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		//不存在session数据返回首页
		if((!session('buy_now_gid'))&&(!session('buy_now_color'))&&(!session('buy_now_size'))&&(!session('buy_now_nums'))){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		$gid=session('buy_now_gid');
		$color=session('buy_now_color');
		$size=session('buy_now_size');
		$nums=session('buy_now_nums');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User_address=M('User_address');
		//收货地址
		$all_address=$User_address->where(array('shop_user_id'=>$uid))->order(array('status'=>desc,'id'=>desc))->select();
		
		//商品信息
		$goods=$Goods->where(array('id'=>$gid))->find();
		$stock=$Stock->where(array('shop_goods_id'=>$gid,'color'=>$color,'size'=>$size))->find();
		//小计
		$price_all=$stock['sale_price']*$nums;
		//运费
		$yunfei=$goods['shipping_price'];
		if(!$yunfei){
			$yunfei=0;
		}
		//合计
		$count_price=$price_all+$yunfei;

		$this->nums=$nums;
		$this->all_address=$all_address;
		$this->goods=$goods;
		$this->stock=$stock;
		$this->price_all=$price_all;
		$this->yunfei=$yunfei;
		$this->count_price=$count_price;
		$this->display();

	}


}

 ?>
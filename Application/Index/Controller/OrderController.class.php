<?php 
namespace Index\Controller;
use Think\Controller;

/**
* 订单控制器
*/
class OrderController extends CommonController
{
	//添加异步添加收货地址
	public function addAddress(){
		if(IS_AJAX){
			$post=I('post.');
			if(!$this->checkIsLegal()){
				//非法访问
				return $this->ajaxReturn(-2);			}
			$uid=session('uid');
			$address=$post['province'].$post['city'].$post['county'].$post['street'];
			$post['address']=$address;
			$post['shop_user_id']=$uid;
			$User_address=D('User_address');
			if($User_address->create($post)){
				//通过验证
				if($id=$User_address->add()){
					//添加成功
					$address=$User_address->where(array('id'=>$id))->find();
					if($address['status']==1){
						//新添加的为默认，清除以前的默认地址
						$old=$User_address->where(array('shop_user_id'=>$uid,'status'=>1,'id'=>array('neq',$id)))->find();
						if($old){
							$User_address->status=0;
							$User_address->where(array('id'=>$old['id']))->save();
						}
					}
					return $this->ajaxReturn($address);
				}else{
					return $this->ajaxReturn(0);
				}
			}else{
				return $this->ajaxReturn(0);
			}
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//异步删除收货地址
	public function deleteAddress(){
		if(IS_AJAX){
			$id=I('post.id');
			$User_address=M('User_address');
			if($User_address->delete($id)){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//修改收货地址
	public function editAddress(){
		$id=I('get.id');
		$User_address=M('User_address');
		$address=$User_address->where(array('id'=>$id))->find();
		$this->address=$address;
		$this->display('editaddress');
	}

	//修改收货地址处理
	public function checkEditAddress(){
		if(IS_AJAX){
			$post=I('post.');
			if(!$this->checkIsLegal()){
				//非法访问
				return $this->ajaxReturn(-2);
			}
			$uid=session('uid');
			if(($post['province']!="省份")&&($post['city']!="地级市")&&($post['county']!="市、县级市")&&($post['street'])){
				//有新地址
				$address=$post['province'].$post['city'].$post['county'].$post['street'];
				$post['address']=$address;
			}
			$post['shop_user_id']=$uid;
			$User_address=D('User_address');
			if($User_address->create($post)){
				//通过验证
				if($User_address->save()){
					//修改成功
					if($post['status']==1){
						//新修改的为默认，清除以前的默认地址
						$id=$post['id'];
						$old=$User_address->where(array('shop_user_id'=>$uid,'status'=>1,'id'=>array('neq',$id)))->find();
						if($old){
							$User_address->status=0;
							$User_address->where(array('id'=>$old['id']))->save();
						}
					}
					return $this->ajaxReturn(1);
				}else{
					return $this->ajaxReturn(0);
				}
			}else{
				return $this->ajaxReturn(0);
			}
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//提交订单处理
	public function addOrder(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		if(!IS_POST){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		$User=M('User');
		$user=$User->where(array('id'=>$uid))->find();
		$post=I('post.');
		//实例化订单模型
		$Order=M('Order');
		$Cart=M('Cart');
		$Stock=M('Stock');
		$Goods=M('Goods');
		$nums=$post['nums'];
		$order_id=array();
		for($i=1;$i<=$nums;$i++){
			$Order->shop_user_address_id=$post['addr'];
			//查询每一个商品订单的详情
			if(!$post['cart_'.$i]){
				//不存在表单提交的cart_i的购物车数据，即是刷新订单详情页面
				//从session中提取数据
				$post['cart_'.$i]=session('cart_'.$i);
			}else{
				//保存到session中
				session('cart_'.$i,$post['cart_'.$i]);
			}
			$cart=$Cart->where(array('id'=>$post['cart_'.$i]))->find();
			$Order->goods_num=$cart['nums'];
			$stock=$Stock->where(array('shop_goods_id'=>$cart['shop_goods_id'],'color'=>$cart['color'],'size'=>$cart['size']))->find();
			$Order->total=$stock['sale_price']*$cart['nums'];
			$Order->message=$post['comment']['0'];
			if($post['pay_id']==0){
				//货到付款
				$Order->paytype="货到付款";
				$Order->account=$user['nickname'];
			}
			$Order->buy_time=time();
			$Order->shop_user_id=$uid;
			$Order->shop_goods_id=$cart['shop_goods_id'];
			$Order->shop_stock_id=$stock['id'];
			$Order->order_code=makeOrderCode();
			$Order->status=0;
			//新增订单数据
			if($id=$Order->add()){
				//删除购物车数据
				$Cart->delete($cart['id']);
				//商品库存减少,该库存销量增加
				$Stock->stock_sum=$stock['stock_sum']-$cart['nums'];
				$Stock->sales_num=$stock['sales_num']+$cart['nums'];
				$Stock->where(array('id'=>$stock['id']))->save();
				//商品销量增加
				$goods=$Goods->where(array('id'=>$cart['shop_goods_id']))->find();
				$Goods->sales=$goods['sales']+$cart['nums'];
				$Goods->where(array('id'=>$cart['shop_goods_id']))->save();
				$order_id[]=$id;
				$this->cart_count--;
			}
		}
		//获取收货信息
		$User_address=M('User_address');
		$user_address=$User_address->where(array('id'=>$post['addr']))->find();
		//获取订单商品信息
		$goods_message=array();
		$Goods=M('Goods');
		$yunfei="";
		$count_price="";
		for($i=1;$i<=$nums;$i++){
			$oid=$order_id[$i-1];
			//把当前的订单id保存到session中
			session('order_'.$i,$oid);
			$order=$Order->where(array('id'=>$oid))->find();
			//获取商品名称和图片
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$goods_message[$i]['big_picture']=$goods['big_picture'];
			$goods_message[$i]['first_name']=$goods['first_name'];
			$goods_message[$i]['gid']=$goods['id'];
			//获取商品单价颜色尺寸等
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$goods_message[$i]['color']=$stock['color'];
			$goods_message[$i]['size']=$stock['size'];
			$goods_message[$i]['sale_price']=$stock['sale_price'];
			$goods_message[$i]['nums']=$order['goods_num'];
			$goods_message[$i]['total']=$stock['sale_price']*$order['goods_num'];
			if($order['status']==0){
				$goods_message[$i]['status']="等待付款";
			}
			if($order['status']==1){
				$goods_message[$i]['status']="等待发货";
			}
			if($order['status']==2){
				$goods_message[$i]['status']="等待收货";
			}
			if($order['status']==3){
				$goods_message[$i]['status']="交易成功";
			}
			if($order['status']==-1){
				$goods_message[$i]['status']="订单已关闭";
			}
			if($order['status']==-2){
				$goods_message[$i]['status']="退款/退货";
			}
			$goods_message[$i]['order_code']=$order['order_code'];
			$goods_message[$i]['buy_time']=$order['buy_time'];
			$goods_message[$i]['pay_time']=$order['pay_time'];
			$goods_message[$i]['finish_time']=$order['finish_time'];
			$goods_message[$i]['yunfei']=$goods['shipping_price'];
			$yunfei+=$goods['shipping_price'];
			$count_price+=$order['total'];
			$time=$order['buy_time'];
		}

		$count_price=$count_price+$yunfei;
		$this->buy_time=$time;
		$this->to_pay_time=$time+3600;	//默认一小时后订单失效
		$this->yunfei=$yunfei;
		$this->count_price=$count_price;
		$this->goods_message=$goods_message;
		$this->user_address=$user_address;
		$this->display('detail');
	}


	//添加立即购买的提交订单处理
	public function addOneOrder(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		if(!IS_POST){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		$User=M('User');
		$user=$User->where(array('id'=>$uid))->find();
		$post=I('post.');
		$Order=M('Order');
		$Stock=M('Stock');
		$Goods=M('Goods');
		$Order->order_code=makeOrderCode();
		$Order->status=0;
		$Order->goods_num=$post['nums'];
		$Order->total=$post['total_price'];
		$Order->message=$post['comment']['0'];
		if($post['pay_id']==0){
			//货到付款
			$Order->paytype="货到付款";
			$Order->account=$user['nickname'];
		}
		$Order->buy_time=time();
		$Order->shop_user_address_id=$post['addr'];
		$Order->shop_user_id=$uid;
		$Order->shop_goods_id=$post['goods_id'];
		$Order->shop_stock_id=$post['stock_id'];
		//新增订单数据
		if($id=$Order->add()){
			//商品库存减少,该库存销量增加
			$stock=$Stock->where(array('id'=>$post['stock_id']))->find();
			$Stock->stock_sum=$stock['stock_sum']-$post['nums'];
			$Stock->sales_num=$stock['sales_num']+$post['nums'];
			$Stock->where(array('id'=>$post['stock_id']))->save();
			//商品销量增加
			$goods=$Goods->where(array('id'=>$post['goods_id']))->find();
			$Goods->sales=$goods['sales']+$post['nums'];
			$Goods->where(array('id'=>$post['goods_id']))->save();
		}
		$this->redirect('order/orderDetail',array('id'=>$id));

	}

	//在提交购物车生成多个订单的时候的支付，异步调用
	public function payAll(){
		if(IS_AJAX){
			$post=I('post.');
			$nums=$post['nums'];
			$Order=M('Order');
			if(time()>$post['to_pay_time']){
				//超时付款，订单失效，相应的商品库存数量加回去,商品销量减少
				$Stock=M('Stock');
				$Goods=M('Goods');
				for($i=1;$i<=$nums;$i++){
					$Order->status=-1;
					$Order->where(array('id'=>session('order_'.$i)))->save();
					$order=$Order->where(array('id'=>session('order_'.$i)))->find();
					session('order_'.$i,null);
					$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
					$Stock->stock_sum=$stock['stock_sum']+$order['goods_num'];
					$Stock->sales_num=$stock['sales_num']-$order['goods_num'];
					$Stock->where(array('id'=>$stock['id']))->save();	
					$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
					$Goods->sales=$goods['sales']-$order['goods_num'];
					$Goods->where(array('id'=>$order['shop_goods_id']))->save();
				}
				return $this->ajaxReturn(-1);
			}
			for($i=1;$i<=$nums;$i++){
				$Order->status=1;
				$Order->pay_time=time();
				$Order->where(array('id'=>session('order_'.$i)))->save();
				session('order_'.$i,null);
			}
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//在提交购物车生成多个订单的时候的取消订单，异步调用
	public function cancelAll(){
		if(IS_AJAX){
			$post=I('post.');
			$nums=$post['nums'];
			$Order=M('Order');
			$Stock=M('Stock');
			$Goods=M('Goods');
			for($i=1;$i<=$nums;$i++){
				$Order->status=-1;
				$Order->where(array('id'=>session('order_'.$i)))->save();
				$order=$Order->where(array('id'=>session('order_'.$i)))->find();
				session('order_'.$i,null);
				$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
				$Stock->stock_sum=$stock['stock_sum']+$order['goods_num'];
				$Stock->sales_num=$stock['sales_num']-$order['goods_num'];
				$Stock->where(array('id'=>$stock['id']))->save();
				$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
				$Goods->sales=$goods['sales']-$order['goods_num'];
				$Goods->where(array('id'=>$order['shop_goods_id']))->save();
			}
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//在单一商品订单详情里取消订单
	public function cancelOne(){
		if(IS_AJAX){
			$post=I('post.');
			$Order=M('Order');
			$Stock=M('Stock');
			$Goods=M('Goods');
			$Order->status=-1;
			$Order->where(array('id'=>$post['id']))->save();
			$order=$Order->where(array('id'=>$post['id']))->find();
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$Stock->stock_sum=$stock['stock_sum']+$order['goods_num'];
			$Stock->sales_num=$stock['sales_num']-$order['goods_num'];
			$Stock->where(array('id'=>$stock['id']))->save();
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$Goods->sales=$goods['sales']-$order['goods_num'];
			$Goods->where(array('id'=>$order['shop_goods_id']))->save();
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}

	}

	//在订单详情页查看订单时候立即支付
	public function pay(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		$id=I('post.id');
		$Order=M('Order');
		$order=$Order->where(array('id'=>$id))->find();
		if(time()>($order['buy_time']+3600)){
			//超时付款
			$Goods=M('Goods');
			$Stock=M('Stock');
			$Order->status=-1;
			$Order->where(array('id'=>$order['id']))->save();
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$Stock->stock_sum=$stock['stock_sum']+$order['goods_num'];
			$Stock->sales_num=$stock['sales_num']-$order['goods_num'];
			$Stock->where(array('id'=>$stock['id']))->save();	
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$Goods->sales=$goods['sales']-$order['goods_num'];
			$Goods->where(array('id'=>$order['shop_goods_id']))->save();
			return $this->ajaxReturn(-1);
		}
		$Order->status=1;
		$Order->pay_time=time();
		if($Order->where(array('id'=>$order['id']))->save()){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}


	public function index(){
		//订单列表
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		//默认显示全部订单情况
		$post=I('post.');
		if(!$post['status']){
			$status=0;
		}else{
			$status=$post['status'];
		}

		//已买到的商品
		$Order=M('Order');
		$Goods=M('Goods');
		$Stock=M('Stock');
		//查看全部订单，判断等待付款的商品是否已经过期,已过期需设置成过期的
		$all_orders=$Order->where(array('shop_user_id'=>$uid,'status'=>0))->select();
		foreach ($all_orders as $order) {
			if(time()>($order['buy_time']+3600)){
				$Order->status=-1;
				$Order->where(array('id'=>$order['id']))->save();
				$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
				$Stock->stock_sum=$stock['stock_sum']+$order['goods_num'];
				$Stock->sales_num=$stock['sales_num']-$order['goods_num'];
				$Stock->where(array('id'=>$stock['id']))->save();
				$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
				$Goods->sales=$goods['sales']-$order['goods_num'];
				$Goods->where(array('id'=>$order['shop_goods_id']))->save();
			}

		}

		if($status==0){
			//显示全部
			$count=$Order->where(array('shop_user_id'=>$uid))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==1){
			//等待付款
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>0))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>0))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==2){
			//等待发货
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>1))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>1))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==3){
			//等待收货
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>2))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>2))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==4){
			//交易成功
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>3))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>3))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==5){
			//已关闭订单
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>-1))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>-1))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		if($status==6){
			//退款/退货
			$count=$Order->where(array('shop_user_id'=>$uid,'status'=>-2))->order('-buy_time')->count();
			$Page=getpage($count,C('ORDER_SHOW'));
			$show=$Page->show();
			$orders=$Order->where(array('shop_user_id'=>$uid,'status'=>-2))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		}
		
		$order_message=array();
		$i=1;
		foreach ($orders as $order) {
			$order_message[$i]['order_code']=$order['order_code'];
			$order_message[$i]['buy_time']=$order['buy_time'];
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$order_message[$i]['big_picture']=$goods['big_picture'];
			$order_message[$i]['first_name']=$goods['first_name'];
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$order_message[$i]['color']=$stock['color'];
			$order_message[$i]['size']=$stock['size'];
			$order_message[$i]['price']=$stock['sale_price'];
			$order_message[$i]['nums']=$order['goods_num'];
			//邮费
			$order_message[$i]['yunfei']=$goods['shipping_price'];
			//合计（包括邮费）
			$order_message[$i]['price_all']=$order['goods_num']*$stock['sale_price']+$goods['shipping_price'];
			if($order['status']==0){
				$order_message[$i]['status']="等待付款";
			}
			if($order['status']==1){
				$order_message[$i]['status']="等待发货";
			}
			if($order['status']==2){
				$order_message[$i]['status']="等待收货";
			}
			if($order['status']==3){
				$order_message[$i]['status']="交易成功";
			}
			if($order['status']==-1){
				$order_message[$i]['status']="订单已关闭";
			}
			if($order['status']==-2){
				$order_message[$i]['status']="退款/退货";
			}
			$order_message[$i]['oid']=$order['id'];
			$order_message[$i]['gid']=$goods['id'];
			$i++;
		}
		$this->order_message=$order_message;
		$this->page=$show;
		$this->status=$status;


		//收货地址
		$User_address=M('User_address');
		$user_address=$User_address->where(array('shop_user_id'=>$uid))->order('-status')->select();
		$this->user_address=$user_address;
		$this->display();
	}

	//申请退款/退货
	public function refund(){
		if(IS_AJAX){
			$id=I('post.id');
			$Order=M('Order');
			$order=$Order->where(array('id'=>$id))->find();
			if($order['is_refund']==1){
				//已经申请过退款/退货处理
				return $this->ajaxReturn(2);
			}
			$Order->is_refund=1;
			if($Order->where(array('id'=>$id))->save()){
				//申请成功
				return $this->ajaxReturn(1);
			}
			return $this->ajaxReturn(0);
		}
		return $this->ajaxReturn(-1);
	}


	//订单详情
	public function orderDetail(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		$id=I('get.id');
		$Order=M('Order');
		$User_address=M('User_address');
		$Goods=M('Goods');
		$Stock=M('Stock');
		//订单状态
		$order=$Order->where(array('id'=>$id))->find();
		if($order['status']==0){
			$to_pay_time=$order['buy_time']+3600;
		}
		//收货地址
		$user_address=$User_address->where(array('id'=>$order['shop_user_address_id']))->find();
		//商品信息
		$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
		$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();

		$this->shifujine=$order['total']+$goods['shipping_price'];
		$this->order=$order;
		$this->to_pay_time=$to_pay_time;
		$this->goods=$goods;
		$this->stock=$stock;
		$this->user_address=$user_address;
		$this->display();
	}


	//确认收货
	public function receive(){
		if(IS_AJAX){
			$id=I('post.id');
			$Order=M('Order');
			$Order->status=3;
			$Order->finish_time=time();
			if($Order->where(array('id'=>$id))->save()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}


}

 ?>
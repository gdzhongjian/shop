<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 订单管理控制器
*/
class OrderController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if(($this->admin_message['level']!=1)&&($this->admin_message['level']!=4)){
			$this->error('您没有权限访问',U('index/index'));
		}
	}

	//查看订单
	public function index(){
		$Order=M('Order');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$count=$Order->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$all_show=$Page->show();
		$data=$Order->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$all_i=1;
		foreach ($data as $order) {
			$orders[$all_i]['order_code']=$order['order_code'];
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$all_i]['first_name']=$goods['first_name'];
			if($goods['shipping_price']){
				//存在邮费
				$orders[$all_i]['yunfei']=$goods['shipping_price'];	
			}else{
				$orders[$all_i]['yunfei']=0;
			}
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$all_i]['color']=$stock['color'];
			$orders[$all_i]['size']=$stock['size'];
			$orders[$all_i]['nums']=$order['goods_num'];
			$orders[$all_i]['total']=$order['total'];
			$orders[$all_i]['message']=$order['message'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$orders[$all_i]['username']=$user['nickname'];
			$orders[$all_i]['buy_time']=$order['buy_time'];
			$orders[$all_i]['status']=$order['status'];
			$orders[$all_i]['address_id']=$order['shop_user_address_id'];
			$orders[$all_i]['id']=$order['id'];
			$all_i++;
		}
		$this->all_page=$all_show;
		$this->all_count=$count;
		$this->all_orders=$orders;
		$this->display();
	}

	//查看指定日期订单查询视图
	public function list2(){
		$this->display();
	}

	//查看指定日期订单
	public function index2(){
		$date=I('post.date');
		$start_time=strtotime($date);
		$end_time=$start_time+3600*24;
		if(IS_AJAX){
			$date=I('get.date');
			$start_time=strtotime($date);
			$end_time=$start_time+3600*24;
		}

		$Order=M('Order');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$count=$Order->where(array('buy_time'=>array(array('egt',$start_time),array('lt',$end_time))))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$all_show=$Page->show();
		$data=$Order->where(array('buy_time'=>array(array('egt',$start_time),array('lt',$end_time))))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$all_i=1;
		foreach ($data as $order) {
			$orders[$all_i]['order_code']=$order['order_code'];
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$all_i]['first_name']=$goods['first_name'];
			if($goods['shipping_price']){
				//存在邮费
				$orders[$all_i]['yunfei']=$goods['shipping_price'];	
			}else{
				$orders[$all_i]['yunfei']=0;
			}
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$all_i]['color']=$stock['color'];
			$orders[$all_i]['size']=$stock['size'];
			$orders[$all_i]['nums']=$order['goods_num'];
			$orders[$all_i]['total']=$order['total'];
			$orders[$all_i]['message']=$order['message'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$orders[$all_i]['username']=$user['nickname'];
			$orders[$all_i]['buy_time']=$order['buy_time'];
			$orders[$all_i]['status']=$order['status'];
			$orders[$all_i]['address_id']=$order['shop_user_address_id'];
			$orders[$all_i]['id']=$order['id'];
			$all_i++;
		}
		if(IS_AJAX){
			$this->date=$date;
			$this->all_page=$all_show;
			$this->all_count=$count;
			$this->all_orders=$orders;
			$html=$this->fetch('ajax');
			return $this->ajaxReturn($html);
		}
		$this->date=$date;
		$this->all_page=$all_show;
		$this->all_count=$count;
		$this->all_orders=$orders;
		$this->display();
	}


	//搜索指定订单号视图
	public function list3(){
		$this->display();
	}

	//指定订单号视图
	public function index3(){
		if(IS_POST){
			$code=I('order_code');

			$Order=M('Order');
			$Goods=M('Goods');
			$Stock=M('Stock');
			$User=M('User');
			$count=$Order->where(array('order_code'=>$code))->count();
			$data=$Order->where(array('order_code'=>$code))->select();
			$all_i=1;
			foreach ($data as $order) {
				$orders[$all_i]['order_code']=$order['order_code'];
				$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
				$orders[$all_i]['first_name']=$goods['first_name'];
				if($goods['shipping_price']){
					//存在邮费
					$orders[$all_i]['yunfei']=$goods['shipping_price'];	
				}else{
					$orders[$all_i]['yunfei']=0;
				}
				$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
				$orders[$all_i]['color']=$stock['color'];
				$orders[$all_i]['size']=$stock['size'];
				$orders[$all_i]['nums']=$order['goods_num'];
				$orders[$all_i]['total']=$order['total'];
				$orders[$all_i]['message']=$order['message'];
				$user=$User->where(array('id'=>$order['shop_user_id']))->find();
				$orders[$all_i]['username']=$user['nickname'];
				$orders[$all_i]['buy_time']=$order['buy_time'];
				$orders[$all_i]['status']=$order['status'];
				$orders[$all_i]['address_id']=$order['shop_user_address_id'];
				$orders[$all_i]['id']=$order['id'];
				$all_i++;
			}
			$this->all_count=$count;
			$this->all_orders=$orders;
			$this->display();
		}
	}

	//处理订单视图
	public function deal(){
		$id=I('get.id');
		$Order=M("Order");
		$order=$Order->where(array('id'=>$id))->find();
		$this->order=$order;
		$this->display();
	}

	//处理订单
	public function checkDeal(){
		$post=I('post.');
		$Order=M('Order');
		$Order->status=2;
		$Order->postcode=$post['postcode'];
		$Order->post_type=$post['post_type'];
		$Order->send_time=time();
		if($Order->where(array('id'=>$post['id']))->save()){
			$this->success('发货成功！',U('order/index'));
		}else{
			$this->error('发货失败！');
		}
	}

	//成交记录视图
	public function dealRecord(){
		//成交记录，只输出当前状态为已付款，已发货，交易完成的记录，按时间倒序输出
		$Order=M('Order');
		$count=$Order->where(array('status'=>array('gt',0)))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$data=$Order->where(array('status'=>array('gt',0)))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$Userinfo=M('Userinfo');
		$i=1;
		foreach ($data as $order) {
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$i]['first_name']=$goods['first_name'];
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$i]['color']=$stock['color'];
			$orders[$i]['size']=$stock['size'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$userinfo=$Userinfo->where(array('shop_user_id'=>$order['shop_user_id']))->find();
			$orders[$i]['username']=$user['nickname'];
			$orders[$i]['headimage']=$userinfo['headimage'];
			$orders[$i]['buy_time']=$order['buy_time'];
			$orders[$i]['status']=$order['status'];
			$i++;
		}
		$this->page=$show;
		$this->orders=$orders;
		$this->count=$count;
		$this->display();
	}

	//指定日期成交记录
	public function dateRecord(){
		$this->display();
	}

	//查找指定日期成交记录
	public function dealRecord2(){
		$date=I('post.date');
		$start_time=strtotime($date);
		$end_time=$start_time+3600*24;
		if(IS_AJAX){
			$date=I('get.date');
			$start_time=strtotime($date);
			$end_time=$start_time+3600*24;
		}

		//成交记录，只输出当前状态为已付款，已发货，交易完成的记录，按时间倒序输出
		$Order=M('Order');
		$count=$Order->where(array('status'=>array('gt',0),'buy_time'=>array(array('egt',$start_time),array('lt',$end_time))))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$data=$Order->where(array('status'=>array('gt',0),'buy_time'=>array(array('egt',$start_time),array('lt',$end_time))))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$Userinfo=M('Userinfo');
		$i=1;
		foreach ($data as $order) {
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$i]['first_name']=$goods['first_name'];
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$i]['color']=$stock['color'];
			$orders[$i]['size']=$stock['size'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$userinfo=$Userinfo->where(array('shop_user_id'=>$order['shop_user_id']))->find();
			$orders[$i]['username']=$user['nickname'];
			$orders[$i]['headimage']=$userinfo['headimage'];
			$orders[$i]['buy_time']=$order['buy_time'];
			$orders[$i]['status']=$order['status'];
			$i++;
		}
		if(IS_AJAX){
			$this->date=$date;
			$this->page=$show;
			$this->orders=$orders;
			$this->count=$count;
			$html=$this->fetch('ajaxRecord');
			return $this->ajaxReturn($html);
		}
		$this->date=$date;
		$this->page=$show;
		$this->orders=$orders;
		$this->count=$count;
		$this->display();
	}

	//退货退款
	public function refund(){
		$Order=M('Order');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$count=$Order->where(array('is_refund'=>1))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$all_show=$Page->show();
		$data=$Order->where(array('is_refund'=>1))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$all_i=1;
		foreach ($data as $order) {
			$orders[$all_i]['order_code']=$order['order_code'];
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$all_i]['first_name']=$goods['first_name'];
			if($goods['shipping_price']){
				//存在邮费
				$orders[$all_i]['yunfei']=$goods['shipping_price'];	
			}else{
				$orders[$all_i]['yunfei']=0;
			}
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$all_i]['color']=$stock['color'];
			$orders[$all_i]['size']=$stock['size'];
			$orders[$all_i]['nums']=$order['goods_num'];
			$orders[$all_i]['total']=$order['total'];
			$orders[$all_i]['message']=$order['message'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$orders[$all_i]['username']=$user['nickname'];
			$orders[$all_i]['buy_time']=$order['buy_time'];
			$orders[$all_i]['status']=$order['status'];
			$orders[$all_i]['address_id']=$order['shop_user_address_id'];
			$orders[$all_i]['id']=$order['id'];
			$all_i++;
		}
		$this->all_page=$all_show;
		$this->all_count=$count;
		$this->all_orders=$orders;
		$this->display();
	}

	//退货退款同意处理
	public function agreeRefund(){
		$id=I('post.id');
		$Order=M('Order');
		$Order->status=-2;
		$Order->is_refund=0;
		if($Order->where(array('id'=>$id))->save()){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//已退货退款订单
	public function refundAll(){
		$Order=M('Order');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$User=M('User');
		$count=$Order->where(array('status'=>-2))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$all_show=$Page->show();
		$data=$Order->where(array('status'=>-2))->order('-buy_time')->limit($Page->firstRow,$Page->listRows)->select();
		$all_i=1;
		foreach ($data as $order) {
			$orders[$all_i]['order_code']=$order['order_code'];
			$goods=$Goods->where(array('id'=>$order['shop_goods_id']))->find();
			$orders[$all_i]['first_name']=$goods['first_name'];
			if($goods['shipping_price']){
				//存在邮费
				$orders[$all_i]['yunfei']=$goods['shipping_price'];	
			}else{
				$orders[$all_i]['yunfei']=0;
			}
			$stock=$Stock->where(array('id'=>$order['shop_stock_id']))->find();
			$orders[$all_i]['color']=$stock['color'];
			$orders[$all_i]['size']=$stock['size'];
			$orders[$all_i]['nums']=$order['goods_num'];
			$orders[$all_i]['total']=$order['total'];
			$orders[$all_i]['message']=$order['message'];
			$user=$User->where(array('id'=>$order['shop_user_id']))->find();
			$orders[$all_i]['username']=$user['nickname'];
			$orders[$all_i]['buy_time']=$order['buy_time'];
			$orders[$all_i]['status']=$order['status'];
			$orders[$all_i]['address_id']=$order['shop_user_address_id'];
			$orders[$all_i]['id']=$order['id'];
			$all_i++;
		}
		$this->all_page=$all_show;
		$this->all_count=$count;
		$this->all_orders=$orders;
		$this->display();
	}


	//查看收货地址
	public function address(){
		$id=I('get.id');
		$username=I('get.name');
		$User_address=M('User_address');
		$address=$User_address->where(array('id'=>$id))->find();
		if(I('get.oid')){
			$oid=I('get.oid');
			$Order=M('Order');
			$order=$Order->where(array('id'=>$oid))->find();
			$this->order=$order;
		}
		$this->address=$address;
		$this->username=$username;
		$this->display();

	}


}

 ?>
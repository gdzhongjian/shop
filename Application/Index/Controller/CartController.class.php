<?php 
namespace Index\Controller;
use Think\Controller;

/**
* 购物车控制器
*/
class CartController extends CommonController
{
	//加入购物车成功后跳转视图
	public function cartPreview(){
		//可能感兴趣，输出该三级分类对应的一级分类商品
		if(!$this->checkIsLegal()){
			//非法访问
			$this->redirect('index/index');
		}
		$goods_id=I('get.gid');
		$Goods=M('Goods');
		$good=$Goods->where(array('id'=>$goods_id))->find();
		$goods=$Goods->where(array('first_category'=>$good['first_category'],'is_sale'=>1,'sex'=>$good['sex'],'id'=>array('neq',$good['id'])))->order('-views')->limit(C('CART_INTERESTED_SHOW'))->select();

		$this->goods=$goods;
		$this->display();
	}

	//购物车信息
	public function index(){
		//判断是否登录
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		$Cart=M('Cart');
		$Goods=M('Goods');
		$Stock=M('Stock');
		$carts=$Cart->where(array('shop_user_id'=>$uid))->select();
		$goods_message=array();
		$i=1;
		$count_price="";
		foreach ($carts as $cart) {
			$goods_id=$cart['shop_goods_id'];
			$goods=$Goods->where(array('id'=>$goods_id))->find();
			$goods_message[$i]['cid']=$cart['id'];
			$goods_message[$i]['gid']=$cart['shop_goods_id'];
			$goods_message[$i]['big_picture']=$goods['big_picture'];
			$goods_message[$i]['first_name']=$goods['first_name'];
			$stock=$Stock->where(array('shop_goods_id'=>$cart['shop_goods_id'],'color'=>$cart['color'],'size'=>$cart['size']))->find();
			$goods_message[$i]['color']=$stock['color'];
			$goods_message[$i]['size']=$stock['size'];
			$goods_message[$i]['price']=$stock['sale_price'];
			$goods_message[$i]['max_stocks']=$stock['stock_sum'];
			$goods_message[$i]['nums']=$cart['nums'];
			$goods_message[$i]['price_all']=$stock['sale_price']*$cart['nums'];
			$count_price+=$goods_message[$i]['price_all'];
			$i++;
		}

		$this->count=$i-1;
		$this->count_price=$count_price;
		$this->goods_message=$goods_message;
		$this->display();
	}

	//修改购买数量
	public function editBuyNums(){
		if(IS_AJAX){
			$post=I('post.');
			$Cart=M('Cart');
			$Cart->nums=$post['nums'];
			if($Cart->where(array('id'=>$post['cid']))->save()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//修改购买的颜色和尺寸
	public function editColorAndSize(){
		if(IS_AJAX){
			$post=I('post.');
			$Stock=M('Stock');
			$stock=$Stock->where(array('shop_goods_id'=>$post['goods_id'],'color'=>$post['color'],'size'=>$post['size']))->find();
			if($stock['stock_sum']<$post['nums']){
				//购买数量大于库存
				return $this->ajaxReturn(2);
			}
			$Cart=M('Cart');
			$Cart->color=$post['color'];
			$Cart->size=$post['size'];
			if($Cart->where(array('id'=>$post['cid']))->save()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//删除购物车数据
	public function delete(){
		if(IS_AJAX){
			$cid=I('post.cid');
			$Cart=M('Cart');
			if($Cart->where(array('id'=>$cid))->delete()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//弹窗,修改商品颜色和尺寸
	public function tanchuan(){
		//判断是否登录
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		$cid=I('get.cid');
		$Cart=M('Cart');
		$cart=$Cart->where(array('id'=>$cid))->find();
		$goods_id=$cart['shop_goods_id'];
		$Stock=M('Stock');
		$stocks=$Stock->where(array('shop_goods_id'=>$goods_id))->select();
		$colors=array();
		$sizes=array();
		foreach ($stocks as $stock) {
			$colors[]=$stock['color'];
			$sizes[]=$stock['size'];
		}
		$colors=array_unique($colors);
		$sizes=array_unique($sizes);
		$this->colors=$colors;
		$this->sizes=$sizes;
		$this->goods_id=$goods_id;
		$this->cid=$cid;
		$this->nums=$cart['nums'];	//购买数量
		$this->display();
	}


	//填写核对订单信息页面
	public function index2(){
		if(!$this->checkIsLegal()){
			$this->redirect('index/index');
		}
		if(!IS_POST){
			$this->redirect('index/index');
		}
		$uid=session('uid');
		//获取从购物车提交的商品
		$goods_message=array();
		$count_price="";
		$yunfei="";
		$post=I('post.');
		$nums=$post['nums'];
		$Cart=M('Cart');
		$Goods=M('Goods');
		$Stock=M('Stock');
		for($i=1;$i<=$nums;$i++){
			$cart=$Cart->where(array('id'=>$post['checked_'.$i]))->find();
			$goods_id=$cart['shop_goods_id'];
			$goods=$Goods->where(array('id'=>$goods_id))->find();
			$goods_message[$i]['cid']=$cart['id'];
			$goods_message[$i]['gid']=$cart['shop_goods_id'];
			$goods_message[$i]['big_picture']=$goods['big_picture'];
			$goods_message[$i]['first_name']=$goods['first_name'];
			//运费
			if($goods['is_free_shipping']==0){
				//免运费
				$yunfei=$yunfei+0;
			}else{
				$yunfei=$yunfei+$goods['shipping_price'];
			}
			$stock=$Stock->where(array('shop_goods_id'=>$cart['shop_goods_id'],'color'=>$cart['color'],'size'=>$cart['size']))->find();
			$goods_message[$i]['color']=$stock['color'];
			$goods_message[$i]['size']=$stock['size'];
			$goods_message[$i]['price']=$stock['sale_price'];
			$goods_message[$i]['nums']=$cart['nums'];
			$goods_message[$i]['price_all']=$stock['sale_price']*$cart['nums'];
			$count_price+=$goods_message[$i]['price_all'];
			$count_price+=$yunfei;
		}

		//查询输出收货地址,按添加时间和是否默认地址排序
		//正常情况只有一种默认地址，排序后就是第一个
		$User_address=M('User_address');
		$all_address=$User_address->where(array('shop_user_id'=>$uid))->order(array('status'=>desc,'id'=>desc))->select();

		$this->all_address=$all_address;
		$this->goods_message=$goods_message;
		$this->count_price=$count_price;
		$this->yunfei=$yunfei;
		$this->display();
	}
}

 ?>
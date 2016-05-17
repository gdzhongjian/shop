<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 用户管理控制器
*/
class ConsumerController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if(($this->admin_message['level']!=1)&&($this->admin_message['level']!=6)){
			$this->error('您没有权限访问',U('index/index'));
		}
	}

	public function index(){
		$User=D('UserRelation');
		//全部用户
		$count=$User->relation('Userinfo')->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$users=$User->relation('Userinfo')->limit($Page->firstRow,$Page->listRows)->select();
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="all_user"){
				$this->type=$type;
				$this->page=$show;
				$this->users=$users;
				$this->count=$count;
				$html=$this->fetch('ajaxAllUser');
				return $this->ajaxReturn($html);
			}
		}
		$this->page=$show;
		$this->users=$users;
		$this->count=$count;

		//正常用户
		$unlock_count=$User->relation('Userinfo')->where(array('status'=>1))->count();
		$Page=getpage($unlock_count,C('PAGE_SIZE'));
		$unlock_show=$Page->show();
		$unlock_users=$User->relation('Userinfo')->where(array('status'=>1))->limit($Page->firstRow,$Page->listRows)->select();
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="unlock_user"){
				$this->type=$type;
				$this->unlock_page=$unlock_show;
				$this->unlock_users=$unlock_users;
				$this->unlock_count=$unlock_count;
				$html=$this->fetch('ajaxUnlockUser');
				return $this->ajaxReturn($html);
			}
		}
		$this->unlock_page=$unlock_show;
		$this->unlock_users=$unlock_users;
		$this->unlock_count=$unlock_count;

		//锁定用户
		$lock_count=$User->relation('Userinfo')->where(array('status'=>2))->count();
		$Page=getpage($lock_count,C('PAGE_SIZE'));
		$lock_show=$Page->show();
		$lock_users=$User->relation('Userinfo')->where(array('status'=>2))->limit($Page->firstRow,$Page->listRows)->select();
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="lock_user"){
				$this->type=$type;
				$this->lock_users=$lock_users;
				$this->lock_page=$lock_show;
				$this->lock_count=$lock_count;
				$html=$this->fetch('ajaxLockUser');
				return $this->ajaxReturn($html);
			}
		}
		$this->lock_users=$lock_users;
		$this->lock_page=$lock_show;
		$this->lock_count=$lock_count;

		//未激活用户
		$inactive_count=$User->relation('Userinfo')->where(array('status'=>0))->count();
		$Page=getpage($inactive_count,C('PAGE_SIZE'));
		$inactive_show=$Page->show();
		$inactive_users=$User->relation('Userinfo')->where(array('status'=>0))->limit($Page->firstRow,$Page->listRows)->select();
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="inactive_user"){
				$this->type=$type;
				$this->inactive_users=$inactive_users;
				$this->inactive_page=$inactive_page;
				$this->inactive_count=$inactive_count;
				$html=$this->fetch('ajaxInactiveUser');
				return $this->ajaxReturn($html);
			}
		}
		$this->inactive_users=$inactive_users;
		$this->inactive_page=$inactive_page;
		$this->inactive_count=$inactive_count;


		$this->display();
	}

	//锁定用户
	public function lockUser(){
		$id=I('post.id');
		$User=M('User');
		$User->status=2;
		if($User->where(array('id'=>$id))->save()){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//解锁用户
	public function unlockUser(){
		$id=I('post.id');
		$User=M('User');
		$User->status=1;
		if($User->where(array('id'=>$id))->save()){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//查看更多信息
	public function moreInformation(){
		$id=I('get.id');
		$User=D('UserRelation');
		$user=$User->relation(true)->where(array('id'=>$id))->find();
		$this->user=$user;
		$this->display();
	}

	//查看用户购物车
	public function cart(){
		$id=I('get.id');
		$User=M('User');
		$Goods=M('Goods');
		$Cart=M('Cart');
		$Stock=M('Stock');
		$Goods_brand=M('Goods_brand');
		$user=$User->where(array('id'=>$id))->find();
		$count=$Cart->where(array('shop_user_id'=>$id))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$data=$Cart->where(array('shop_user_id'=>$id))->order('-add_time')->limit($Page->firstRow,$Page->listRows)->select();
		$i=1;
		foreach ($data as $cart) {
			$carts[$i]['username']=$user['nickname'];
			$goods=$Goods->where(array('id'=>$cart['shop_goods_id']))->find();
			$carts[$i]['first_name']=$goods['first_name'];
			$carts[$i]['category']=$goods['shop_goods_category_id'];
			$goods_brand=$Goods_brand->where(array('id'=>$goods['shop_goods_brand_id']))->find();
			$carts[$i]['brand']=$goods_brand['name'];
			$carts[$i]['color']=$cart['color'];
			$carts[$i]['size']=$cart['size'];
			$carts[$i]['nums']=$cart['nums'];
			$stock=$Stock->where(array('shop_goods_id'=>$cart['shop_goods_id'],'color'=>$cart['color'],'size'=>$cart['size']))->find();
			$carts[$i]['price']=$stock['sale_price'];
			$carts[$i]['price_all']=$stock['sale_price']*$cart['nums'];
			if($goods['shipping_price']){
				$carts[$i]['yunfei']=$goods['shipping_price'];
			}else{
				$carts[$i]['yunfei']=0;
			}
			$carts[$i]['add_time']=$cart['add_time'];
			$i++;
		}
		$this->carts=$carts;
		$this->page=$show;
		$this->user=$user;
		$this->count=$count;

		$this->display();
	}

	//查看收货地址
	public function address(){
		$id=I('get.id');
		$User=M('User');
		$User_address=M('User_address');
		$user=$User->where(array('id'=>$id))->find();

		$count=$User_address->where(array('shop_user_id'=>$id))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$data=$User_address->where(array('shop_user_id'=>$id))->order('-status')->limit($Page->firstRow,$Page->listRows)->select();
		$i=1;
		foreach ($data as $value) {
			$address[$i]['receiver']=$value['receiver'];
			$address[$i]['address']=$value['address'];
			$address[$i]['phone']=$value['phone'];
			$address[$i]['postcode']=$value['postcode'];
			$address[$i]['status']=$value['status'];
			$i++;
		}

		$this->page=$show;
		$this->count=$count;
		$this->address=$address;
		$this->user=$user;
		$this->display();
	}


	//查找用户
	public function search(){
		$this->display();
	}

	//模糊查找用户
	public function searchUser(){
		$User=D('UserRelation');
		$name=I('post.username');
		if(IS_AJAX){
			$name=I('get.keyword');
		}
		$count=$User->relation('Userinfo')->where(array('nickname'=>array('like','%'.$name.'%')))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$users=$User->relation('Userinfo')->where(array('nickname'=>array('like','%'.$name.'%')))->limit($Page->firstRow,$Page->listRows)->select();
		if(IS_AJAX){
			$this->keyword=$name;
			$this->count=$count;
			$this->page=$show;
			$this->users=$users;
			$html=$this->fetch('ajaxSearchUser');
			return $this->ajaxReturn($html);
		}
		$this->keyword=$name;
		$this->count=$count;
		$this->page=$show;
		$this->users=$users;
		$this->display();
	}

}

 ?>
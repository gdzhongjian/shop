<?php 
namespace Index\Controller;
use Think\Controller;

/**
* 前台公共控制器
*/
class CommonController extends Controller
{
	//初始化
	public function _initialize(){
		//获取导航栏信息
		$Goods_category=M('Goods_category');
		$Goods=M('Goods');
		$first_categorys=$Goods_category->where(array('level'=>1))->select();
		$this->banner_first_categorys=$first_categorys;	

		//获取网站名称和底部
		$Setting=M('Setting');
		$setting=$Setting->find();
		$this->setting=$setting;

		//判断是否登录，判断session是否存在,用户已经登陆改变网站
		//头部显示内容，未登录网站头部显示登陆注册按钮
		if(session('uid')){
			//已经登陆
			$uid=session('uid');
			$User=M('User');
			$user=$User->where(array('id'=>$uid))->find();
			$Userinfo=M('Userinfo');
			$userinfo=$Userinfo->where(array('shop_user_id'=>$uid))->find();
			//购物车数量
			$Cart=M('Cart');
			$count=$Cart->where(array('shop_user_id'=>$uid))->count();
			//自动删除在购物车中已经下架的商品
			$carts=$Cart->where(array('shop_user_id'=>$uid))->select();
				foreach ($carts as $cart) {
					$goods=$Goods->where(array('id'=>$cart['shop_goods_id']))->find();
					if($goods['is_sale']==0){
						$count--;
						$Cart->where(array('id'=>$cart['id']))->delete();						
					}
				}

			$this->top_user=$user;
			$this->top_userinfo=$userinfo;
			$this->top_is_login=1;
			$this->cart_count=$count;
		}else{
			//session不存在,判断cookie是否存在
			//不存在session,判断是否存在cookie
			$shop_uid=cookie('shop_uid');
			if($shop_uid){
				//存在cookie，创建session,首先解密cookie
				$Crypt=new \Think\Crypt;
				$uid=$Crypt->decrypt($shop_uid,C('ENCRYPT_KEY'));
				$User=M('User');
				$user=$User->where(array('id'=>$uid))->find();
				session('uid',$user['id']);
				//模板赋值
				$User=M('User');
				$user=$User->where(array('id'=>$uid))->find();
				$Userinfo=M('Userinfo');
				$userinfo=$Userinfo->where(array('shop_user_id'=>$uid))->find();
				//购物车数量
				$Cart=M('Cart');
				$count=$Cart->where(array('shop_user_id'=>$uid))->count();
				//自动删除在购物车中已经下架的商品
				$carts=$Cart->where(array('shop_user_id'=>$uid))->select();
				foreach ($carts as $cart) {
					$goods=$Goods->where(array('id'=>$cart['shop_goods_id']))->find();
					if($goods['is_sale']==0){
						$count--;
						$Cart->where(array('id'=>$cart['id']))->delete();
					}
				}
				$this->top_user=$user;
				$this->top_userinfo=$userinfo;
				$this->top_is_login=1;
				$this->cart_count=$count;
			}else{
				//不存在session和cookie
				$this->top_is_login=0;
			}
		}
		
	}

	//判断是否合法访问
	public function checkIsLegal(){
		if(!session('uid')){
			//不存在session,判断是否存在cookie
			$shop_uid=cookie('shop_uid');
			if($shop_uid){
				//存在cookie，创建session,首先解密cookie
				$Crypt=new \Think\Crypt;
				$uid=$Crypt->decrypt($shop_uid,C('ENCRYPT_KEY'));
				$User=M('User');
				$user=$User->where(array('id'=>$uid))->find();
				session('uid',$user['id']);
				return true;
			}else{
				//不存在session和cookie
				return false;
			}
		}else{
			return true;
		}
	}
}
?>
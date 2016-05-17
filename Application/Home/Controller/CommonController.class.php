<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 后台公共控制器
*/
class CommonController extends Controller
{
	//登录判断
	public function _initialize(){
		if(!session('aid')){
			//不存在session,判断是否存在cookie
			if($shop_admin=cookie('shop_admin')){
				//存在cookie，创建session,首先解密cookie
				$Crypt=new \Think\Crypt;
				$account=$Crypt->decrypt($shop_admin,C('ENCRYPT_KEY'));
				$Admin=M('Admin');
				$admin=$Admin->where(array('account'=>$account))->find();
				session('aid',$admin['id']);
			}else{
				//不存在cookie,让管理员登录
				$this->redirect('login/index');
			}
		}

		if(session('aid')){
			$Admin=M('Admin');
        	$aid=session('aid');
        	$admin_message=$Admin->where(array('id'=>$aid))->find();
        	$this->admin_message=$admin_message;
		}


	}
}

 ?>
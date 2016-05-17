<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 管理员登录控制器
*/
class LoginController extends Controller
{
	public function index(){
		$this->display();
	}


	//生成验证码
	public function verify(){
		$Verify=new \Think\Verify;
		$Verify->entry();
	}

	//检测验证码的正确性
	public function checkByVerify(){
		$verify=I('post.verify');
		if(checkVerify($verify)){
			//验证码正确
			return  $this->ajaxReturn(1);
		}else{
			//验证码错误
			return $this->ajaxReturn(0);
		}
	}

	//登录检查
	public function checkLogin(){
		//根据账号查询管理员信息
		$post=I('post.');	
		$Admin=M('Admin');
		$admin=$Admin->where(array('account'=>$post['account']))->find();
		if(!$admin){
			$this->error('账号不存在！');
		}
		if($admin['level']==0){
			$this->error('账号还未通过审核！');
		}
		if($admin['status']==1){
			$this->error('账号被锁定！');
		}
		if(!checkVerify($post['verify'])){
			$this->error('验证码不正确！');
		}
		//查询该管理员的随机字符串表数据
		$admin_rand=M('Admin_rand');
		$rand=$admin_rand->where(array('shop_admin_id'=>$admin['id']))->find();
		$rand1=$rand['rand1'];
		$rand2=$rand['rand2'];
		//对表单的密码进行加密，以便判断
		$encrypt_password=Encrypt($post['password'],$rand1,$rand2);
		if($encrypt_password==$admin['password']){
			//密码正确
			//判断是否记住密码
			if($post['remember']){
				//记住密码,需要设置cookie,$key为加密的key值,加密的值
				//为管理员账号由配置文件中的参数给出，调用框架自带的
				//加密方法进行数据的加密和解密,cookie有效期为一个月
				$key=C('ENCRYPT_KEY');
				$Crypt=new \Think\Crypt;
				$encrypt=$Crypt->encrypt($admin['account'],$key);
				cookie('shop_admin',$encrypt,3600*24*30);
			}
			//设置session值
			session('aid',$admin['id']);
			//修改登录信息
			$admin['last_time']=$admin['this_time'];
			$admin['last_ip']=$admin['this_ip'];
			$admin['last_location']=$admin['this_location'];
			$admin['this_time']=time();
			$admin['this_ip']=get_client_ip();
			$admin['this_location']=getIpLocation($admin['this_ip']);
			if(!$Admin->save($admin)){
				$this->error('出现意外错误！');
			}
			//跳转到后台主页面
			$this->redirect('index/index');
		}else{
			$this->error('密码不正确！');
		}

	}
}

 ?>
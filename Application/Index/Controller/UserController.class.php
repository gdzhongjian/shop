<?php 
namespace Index\Controller;
use Think\Controller;

/**
 * 用户控制器
 */
 class UserController extends CommonController
 {
 	
 	public function register(){
 		//判断是否登录
		if(!session('uid')){
			//不存在session,判断是否存在cookie
			$shop_uid=cookie('shop_uid');
			if($shop_uid){
				//存在cookie，创建session,首先解密cookie,然后跳转到商城首页
				$Crypt=new \Think\Crypt;
				$uid=$Crypt->decrypt($shop_uid,C('ENCRYPT_KEY'));
				$User=M('User');
				$user=$User->where(array('id'=>$uid))->find();
				session('uid',$user['id']);
				$this->redirect('index/index');
			}else{
				//不存在session和cookie，让用户注册
				$this->display();
			}
		}else{
			//存在session,直接跳转到商城首页
			$this->redirect('index/index');
		}
 	}

 	//注册处理
 	public function checkRegister(){
 		$post=I('post.');
 		$user=D('user');
 		if($user->create($post)){
			//对密码进行加密，首先产生两次随机数，为后面的加密服务
 			$rand1=RandStrings();
			$rand2=RandStrings();
			$form_password=$post['password'];
			//加密后的密码
			$user->password=Encrypt($form_password,$rand1,$rand2);
			//产生token，（邮箱+昵称的md5加密后的数据）+TOKEN_KEY形成的新字符串再md5加密
			$token=md5(md5($post['email'].$post['nickname']).C('TOKEN_KEY'));
			//激活过期时间
			$token_exptime=time()+3600*24;
			$user->token=$token;
			$user->token_exptime=$token_exptime;
			if($id=$user->add()){
				//用户注册成功,更新用户随机字符串表
				$User_rand=M('User_rand');
				$User_rand->rand1=$rand1;
				$User_rand->rand2=$rand2;
				$User_rand->shop_user_id=$id;
				if($User_rand->add()){
					//用户信息表
					$Userinfo=M('userinfo');
					if($post['sex']==0){
						$Userinfo->headimage="/upload/user/headimage/default/default_girl.jpg";
					}else if($post['sex']==1){
						$Userinfo->headimage="/upload/user/headimage/default/default_boy.jpg";
					}else{
						$Userinfo->headimage="/upload/user/headimage/default/default_baomi.jpg";
					}
					
					$Userinfo->sex=$post['sex'];
					$Userinfo->shop_user_id=$id;
					$Userinfo->add();
					//用户注册成功，待激活
					$to=$post['email'];
					$subject="网上服饰购物系统注册账号激活";
					$url1=U('activate',array('id'=>$id,'token'=>$token));
					if($_SERVER['HTTPS']!='on'){
						$url="http://".$_SERVER['SERVER_NAME'].$url1;
					}else{
						$url="https://".$_SERVER['SERVER_NAME'].$url1;
					}
					$body="亲爱的".$post['nickname'].":<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！欢迎您注册成为网上服饰购物系统网站的会员，请点击链接<a href='".$url."'>".$url."</a>激活您的账号,如果以上链接无法点击，请将它复制到您的浏览器地址栏中进行访问，该链接24小时内有效！";
					if(sendMail($to,$subject,$body)){
						$this->success('注册成功，请到邮箱激活您的账号！','',3);
					}
				}
			}
 		}else{
 			$this->error($user->getError());
 		}
 	}

 	//激活处理
 	public function activate(){
 		$id=I('get.id');
 		$token=I('get.token');
 		$User=M('User');
 		$user=$User->where(array('id'=>$id))->find();
 		if(!$user){
 			$this->error('链接已失效，请重新注册！',U('user/register'),3);
 		}
 		$checkToken=md5(md5($user['email'].$user['nickname']).C('TOKEN_KEY'));
 		if($checkToken==$token){
 			//判断激活是否过期
 			$time=time();
 			$test_time=$time-$user['token_exptime'];
 			if($test_time>0){
 				//过期，删除用户信息，提示重新注册
 				$User_rand=M('User_rand');
 				$User_rand->where(array('shop_user_id'=>$user['id']))->delete();
 				$Userinfo=M('Userinfo');
 				$Userinfo->where(array('shop_user_id'=>$user['id']))->delete();
 				$User->where(array('id'=>$user['id']))->delete();
 				$this->error('账号激活已经过期，请重新注册！',U('user/register'),3);
 				
 			}else{
 				//激活成功，修改用户状态
 				$User->status=1;
 				$User->where(array('id'=>$user['id']))->save();
 				$this->success('账号激活成功，请重新登陆！',U('user/login'),3);
 				
 			}
 		}
 	}


 	//异步检查邮箱是否被注册，已经被注册返回1，否则返回0
 	public function checkEmail(){
 		$email=I('post.email');
 		$User=M('User');
 		$user=$User->where(array('email'=>$email))->find();
 		if($user){
 			return $this->ajaxReturn(1);
 		}else{
 			return $this->ajaxReturn(0);
 		}
 	}
 	//异步检查昵称是否被注册，已经被注册返回1，否则返回0
 	public function checkNickname(){
 		$nickname=I('post.nickname');
 		$User=M('User');
 		$user=$User->where(array('nickname'=>$nickname))->find();
 		if($user){
 			return $this->ajaxReturn(1);
 		}else{
 			return $this->ajaxReturn(0);
 		}
 	}


 	public function login(){
 		//判断是否登录
		if(!session('uid')){
			//不存在session,判断是否存在cookie
			$shop_uid=cookie('shop_uid');
			if($shop_uid){
				//存在cookie，创建session,首先解密cookie,然后跳转到商城首页
				$Crypt=new \Think\Crypt;
				$uid=$Crypt->decrypt($shop_uid,C('ENCRYPT_KEY'));
				$User=M('User');
				$user=$User->where(array('id'=>$uid))->find();
				session('uid',$user['id']);
				$this->redirect('index/index');
			}else{
				//不存在session和cookie，让用户登录
				$this->display();
			}
		}else{
			//存在session,直接跳转到商城首页
			$this->redirect('index/index');
		}
 	}

 	//登录检查
 	public function checkLogin(){
 		//根据邮箱查询用户信息
		$post=I('post.');	
		$User=M('User');
		$user=$User->where(array('email'=>$post['email']))->find();
		if(!$user){
			$this->error('邮箱不存在！','',3);
		}
		if(!checkVerify($post['verify'])){
			$this->error('验证码不正确！');
		}
		//判断用户是否激活
		if($user['status']==0){
			$this->error('请先到邮箱激活账号！','',3);
		}
		//判断用户是否被锁定
		if($user['status']==2){
			$this->error('账号被锁定，无法登陆！','',3);
		}
		//查询该用户的随机字符串表数据
		$User_rand=M('User_rand');
		$rand=$User_rand->where(array('shop_user_id'=>$user['id']))->find();
		$rand1=$rand['rand1'];
		$rand2=$rand['rand2'];
		//对表单的密码进行加密，以便判断
		$encrypt_password=Encrypt($post['password'],$rand1,$rand2);
		if($encrypt_password==$user['password']){
			//密码正确
			//判断是否记住密码
			if($post['remember']){
				//记住密码,需要设置cookie,$key为加密的key值,加密的值
				//为用户ID，由配置文件中的参数给出，调用框架自带的
				//加密方法进行数据的加密和解密,cookie有效期为一个月
				$key=C('ENCRYPT_KEY');
				$Crypt=new \Think\Crypt;
				$encrypt=$Crypt->encrypt($user['id'],$key);
				cookie('shop_uid',$encrypt,3600*24*30);
			}
			//设置session值
			session('uid',$user['id']);
			
			//跳转到商城主页面
			$this->redirect('index/index');
		}else{
			$this->error('密码不正确！','',3);
		}

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


	//退出登录
	public function loginOut(){
		$uid=session('uid');
		//点击退出按钮同时删除session和cookie
		cookie('shop_uid',null);
		session('uid',null);
		$this->redirect('index/index');
	}

	//个人信息
	public function information(){
		if(!$this->checkIsLegal()){
			$this->error('非法访问！');
		}
		$uid=session('uid');
		$User=M('User');
		$user=$User->where(array('id'=>$uid))->find();
		$Userinfo=M('Userinfo');
		$userinfo=$Userinfo->where(array('shop_user_id'=>$uid))->find();
		$this->user=$user;
		$this->userinfo=$userinfo;
		$this->display();
	}

	//异步检查昵称是否被注册，已经被注册返回1，否则返回0
 	public function checkNicknameByInfo(){
 		$nickname=I('post.nickname');
 		$email=I('post.email');
 		$User=M('User');
 		$user=$User->where(array('email'=>$email))->find();
 		if($nickname==$user['nickname']){
 			//昵称没有修改
 			return $this->ajaxReturn(0);
 		}
 		$user=$User->where(array('nickname'=>$nickname))->find();
 		if($user){
 			return $this->ajaxReturn(1);
 		}else{
 			return $this->ajaxReturn(0);
 		}
 	}

	//修改个人信息
	public function editUserinfo(){
		$post=I('post.');
		$User=M('User');
		$user=$User->where(array('email'=>$post['email']))->find();
		$oldnickname=$user['nickname'];
		if($post['nickname']!=$user['nickname']){
			$user1=$User->where(array('nickname'=>$post['nickname']))->find();
			if($user1){
				return $this->ajaxReturn(1);	//昵称已存在
			}
			$User->nickname=$post['nickname'];
			$User->where(array('email'=>$post['email']))->save();
		}
		$Userinfo=M('Userinfo');
		//判断是否输入了所在地
		if(($post['province']!="省份")&&($post['city']!="地级市")&&($post['county']!="市、县级市")){
			$Userinfo->location=$post['province'].$post['city'].$post['county'];
		}
		//判断是否输入了新的出生日期
		if($post['newbirthday']){
			$Userinfo->birthday=$post['newbirthday'];
		}else{
			$Userinfo->birthday=$post['birthday'];
		}
		$Userinfo->truename=$post['truename'];
		$Userinfo->sex=$post['sex'];
		$Userinfo->school=$post['school'];
		$Userinfo->work_unit=$post['work_unit'];
		if($post['job']!="0"){
			$Userinfo->job=$post['job'];
		}
		$Userinfo->hobby=$post['hobby'];
		if($Userinfo->where(array('shop_user_id'=>$user['id']))->save()){
			return $this->ajaxReturn(0);	//修改成功
		}else{
			$user=$User->where(array('email'=>$post['email']))->find();
			if($oldnickname==$user['nickname']){
				//没有改昵称
				return $this->ajaxReturn(2);	//没有修改	
			}else{
				return $this->ajaxReturn(0);	//只修改了昵称
			}
		}
		

	}
	//修改密码
	public function changePassword(){
		if(IS_POST){
			$post=I('post.');
			if($post['oldpassword']==""){
				$this->error('请输入原密码！');
			}
			$User=M('User');
			$user=$User->where(array('email'=>$post['oldemail']))->find();
			//查询该用户的随机字符串表数据
			$User_rand=M('User_rand');
			$rand=$User_rand->where(array('shop_user_id'=>$user['id']))->find();
			$rand1=$rand['rand1'];
			$rand2=$rand['rand2'];
			//对表单的密码进行加密，以便判断
			$encrypt_password=Encrypt($post['oldpassword'],$rand1,$rand2);
			}
			if($encrypt_password!=$user['password']){
				$this->error('原密码不正确！');
			}
			if($post['newpassword']==""){
				$this->error('请输入新的密码！');
			}
			if(strlen($post['newpassword'])<6){
				$this->error('新密码长度不能小于6位！');
			}
			if($post['confirm_password']==""){
				$this->error('请确认密码！');
			}
			if($post['newpassword']!=$post['confirm_password']){
				$this->error('两次输入的密码不一致，修改失败！');
			}
			$User->password=Encrypt($post['newpassword'],$rand1,$rand2);
			if($User->where(array('id'=>$user['id']))->save()){
				$this->success('修改密码成功！','',3);
			}else{
				$this->error('修改密码失败！');
			}

	}

	//修改用户头像
	public function changeHeadimage(){
		$post=I('post.');
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_USER_HEADIMAGE'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=$post['id'];	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if($info){
			//上传成功
			foreach ($info as $file) {
				$file_path=C('UPLOAD_FILE_USER_HEADIMAGE_OUTPUT').$file['savepath'].$file['savename'];
				$Userinfo=M('Userinfo');
				$Userinfo->headimage=$file_path;
				if($Userinfo->where(array('shop_user_id'=>$post['id']))->save()){
					$this->success('头像修改成功！','',3);
				}else{
					$this->error('头像修改失败！');
				}
			}
			
			
		}else{
			$this->error('请上传新的头像！');
		}
	}

 	
 } 

 ?>
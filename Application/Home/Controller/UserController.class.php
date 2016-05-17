<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 后台管理员控制器
*/
class UserController extends CommonController
{
	//退出登录操作
	public function loginOut(){
		cookie('shop_admin',null);
		session('aid',null);
		$this->redirect('login/index');
	}

	//修改密码视图
	public function changePwd(){
		$this->display();
	}

	//修改密码
	public function changePassword(){
		if(IS_AJAX){
			$post=I('post.');
			$aid=session('aid');
			$Admin=M('Admin');
			$Admin_rand=M('Admin_rand');
			$admin=$Admin->where(array('id'=>$aid))->find();
			$rand=$Admin_rand->where(array('shop_admin_id'=>$aid))->find();
			$rand1=$rand['rand1'];
			$rand2=$rand['rand2'];
			//对表单的密码进行加密，以便判断
			$encrypt_password=Encrypt($post['oldpassword'],$rand1,$rand2);
			if($admin['password']!=$encrypt_password){
				//原密码不正确
				return $this->ajaxReturn(-1);
			}
			$Admin->password=Encrypt($post['newpassword'],$rand1,$rand2);
			if($Admin->where(array('id'=>$aid))->save()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}

	}


	//异步检查原密码是否正确
	public function checkPassword(){
		$post=I('post.');
		$aid=session('aid');
		$Admin=M('Admin');
		$admin=$Admin->where(array('id'=>$aid))->find();
		$admin_rand=M('Admin_rand');
		$rand=$admin_rand->where(array('shop_admin_id'=>$aid))->find();
		$rand1=$rand['rand1'];
		$rand2=$rand['rand2'];
		//对表单的密码进行加密，以便判断
		$encrypt_password=Encrypt($post['oldpassword'],$rand1,$rand2);
		if($admin['password']==$encrypt_password){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}

	//个人资料页面
	public function message(){
		$this->display();
	}

	//修改个人资料
	public function changeMessage(){
		$username=I('post.name');
		if(!$username){
			return $this->error('请输入昵称');
		}
		$aid=session('aid');
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_ADMIN_HEADIMAGE'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=$aid;	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if($info){
			//上传成功
			foreach ($info as $file) {
				$file_path=C('UPLOAD_FILE_ADMIN_HEADIMAGE_OUTPUT').$file['savepath'].$file['savename'];
				$Admin=M('Admin');
				$Admin->headimage=$file_path;
				$Admin->username=$username;
				if($Admin->where(array('id'=>$aid))->save()){
					$this->success('个人信息修改成功！','',3);
				}else{
					$this->error('个人信息修改失败！');
				}
			}
		}else{
			//没有上传
			$Admin=M('Admin');
			$Admin->username=$username;
			if($Admin->where(array('id'=>$aid))->save()){
				$this->success('个人信息修改成功！','',3);
			}else{
				$this->error('个人信息修改失败！');
			}
		}

	}


}

 ?>
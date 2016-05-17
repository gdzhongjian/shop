<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 后台管理员注册控制器
*/
class RegisterController extends Controller
{
	public function index(){
		$Setting=M('Setting');
		$setting=$Setting->find();
		if($setting['open']==0){
			return $this->error('网站不允许注册！');
		}
		$this->display();
	}

	//注册处理
	public function checkAdd(){
		$result=I('post.');
		$model=D("Admin");
		if(IS_POST){
			if($model->create($result)){
				//表单数据验证通过
				//对密码进行加密，首先产生两次随机数，为后面的加密服务
				$rand1=RandStrings();
				$rand2=RandStrings();
				$form_password=$result['password'];
				//加密后的密码
				$model->password=Encrypt($form_password,$rand1,$rand2);
				//默认头像
				$model->headimage='upload/admin/headimage/default/1.jpg';
				if($id=$model->add()){
					//管理员注册成功,更新管理员随机字符串表
					$Admin_rand=M('Admin_rand');
					$Admin_rand->rand1=$rand1;
					$Admin_rand->rand2=$rand2;
					$Admin_rand->shop_admin_id=$id;
					if($Admin_rand->add()){
						$this->success('注册成功，请等待审核',U('login/index'));
					}else{
						$this->error('注册失败！');
						//删除掉管理员表的新数据
						$model=M('Admin');
						$model->delete($id);
					}

				}else{
					//注册失败
					$this->error($model->getError());
				}
			}else{
				//验证不通过
				$this->error($model->getError());
			}
		}else{
			//非法操作
			$this->display('Public/404');
		}
	}


	//异步判断账号是否被注册
	public function checkAccount(){
		$account=I('post.account');
		$Admin=M('Admin');
		$check=$Admin->where(array('account'=>$account))->find();
		if($check){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}


}

 ?>
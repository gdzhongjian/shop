<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 权限管理控制器
*/
class AuthController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if($this->admin_message['level']!=1){
			$this->error('您没有权限访问',U('index/index'));
		}
	}

	//添加管理员
	public function add(){
		$this->display();
	}

	//处理添加
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
				//管理员级别
				$model->level=$result['level'];
				if($id=$model->add()){
					//管理员注册成功,更新管理员随机字符串表
					$Admin_rand=M('Admin_rand');
					$Admin_rand->rand1=$rand1;
					$Admin_rand->rand2=$rand2;
					$Admin_rand->shop_admin_id=$id;
					if($Admin_rand->add()){
						$this->success('添加成功！',U('auth/index'));
					}else{
						$this->error('添加失败！');
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

	//管理员列表
	public function index(){
        $Admin=M('Admin');
        $count=$Admin->where(array('level'=>array('neq',0)))->count();
        $admins=$Admin->where(array('level'=>array('neq',0)))->order('id')->select();

        $this->count=$count;
        $this->admins=$admins;
		$this->display();
	}

	//锁定管理员
	public function lock(){
		if(IS_POST){
			$id=I('post.id');
			$Admin=M('Admin');
			$admin=$Admin->where(array('id'=>$id))->find();
			$admin['status']=1;
			if($Admin->save($admin)){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//解锁管理员
	public function unlock(){
		if(IS_POST){
			$id=I('post.id');
			$Admin=M('Admin');
			$admin=$Admin->where(array('id'=>$id))->find();
			$admin['status']=0;
			if($Admin->save($admin)){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	public function delete(){
		if(IS_POST){
			$id=I('post.id');
			$Admin=M('admin');
			if($Admin->delete($id)){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//管理员审核页面
	public function examine(){
		$Admin=M('Admin');
        $count=$Admin->where(array('level'=>array('eq',0)))->count();
        $admins=$Admin->where(array('level'=>array('eq',0)))->order('id')->select();

        $this->count=$count;
        $this->admins=$admins;
		$this->display();
	}

	//处理审核页面
	public function dealExamine(){
		$id=I('get.id');
		$Admin=M('Admin');
		$admin=$Admin->where(array('id'=>$id))->find();
		$this->admin=$admin;
		$this->display();
	}

	//审核处理
	public function checkExamine(){
		$post=I('post.');
		$id=$post['id'];
		$Admin=M('Admin');
		$admin=$Admin->where(array('id'=>$id))->find();
		$admin['level']=$post['level'];
		if($Admin->save($admin)){
			$this->success('审核完成！',U('auth/examine'));
		}else{
			$this->error('审核失败!',U('auth/examine'));
		}
	}


}
?>
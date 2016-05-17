<?php 
namespace Home\Model;
use Think\Model;
/**
* 管理员模型
*/
class AdminModel extends Model
{
	//自动验证
	protected $_validate=array(
			array('account','require','账号不能为空！'),
			array('password','require','密码不能为空！'),
			array('password1','require','确认密码不能为空！'),
			array('account','','账号已经存在！',0,'unique',1),	//新增时验证account字段是否唯一
			array('password','passwordLength','密码长度不能小于6位！',0,'callback'), //验证密码长度
			array('password1','passwordLength','确认密码长度不能小于6位！',0,'callback'),	//验证确认密码长度
			array('password','password1','两次密码不正确！',0,'confirm'),	//验证两次密码是否相同
		);

	//自动完成
	protected $_auto=array(
			array('last_time','time',1,'function'),
			array('last_ip','get_client_ip',1,'function'),
			array('last_location','getIpLocation',1,'function'),
			array('this_time','time',1,'function'),
			array('this_ip','get_client_ip',1,'function'),
			array('this_location','getIpLocation',1,'function'),

		);

	//密码长度大小判断
	public function passwordLength($str){
		if(strlen($str)<6){
			return false;
		}else{
			return true;
		}
	}

}

 ?>
<?php 
namespace Index\Model;
use Think\Model;

/**
* 用户模型
*/
class UserModel extends Model
{
	protected $tableName="user";
	//自动验证
	protected $_validate=array(
			array('email','require','邮箱不能为空！'),
			array('email','email','请输入正确的邮箱！'),
			array('email','email','该邮箱已被注册！',0,'unique',1),		//注册时验证邮箱是否被注册
			array('nickname','require','昵称不能为空！',0,'',1),		//注册时验证昵称是否未空
			array('nickname','require','该昵称已被注册！',0,'unique',1),	//注册时验证昵称是否被注册
			array('password','require','请输入密码！'),
			array('password','passwordLength','密码长度不能小于6位！',0,'callback',1),	//注册时验证密码长度
			array('conf_password','require','请输入确认密码！',0,'',1),		//注册时验证确认密码是否为空
			array('conf_password','password','两次输入的密码不一致',0,'confirm',1),	//注册时验证两次密码是否相同
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
<?php 
namespace Index\Model;
use Think\Model;

/**
* 用户收货地址模型
*/
class AddressModel extends Model
{
	protected $tableName="user_address";
	//自动验证
	protected $_validate=array(
			array('address','require','收获地址必须填写！'),
			array('receiver','require','收件人必须填写！'),
			array('phone','require','联系电话必须填写！'),
			array('postcode','require','邮政编码必须填写！'),
			array('shop_user_id','require',''),
			array('status','require',''),
			array('id','require','',0,'',3),
		);
}


 ?>
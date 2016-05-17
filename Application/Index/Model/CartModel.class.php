<?php 
namespace Index\Model;
use Think\Model;

/**
* 购物车模型
*/
class CartModel extends Model
{
	protected $tableName="cart";

	//自动验证
	protected $_validate=array(
			array('nums','require','购买数量不能为空！'),
			array('color','require','颜色不能为空！'),
			array('size','require','尺寸不能为空！'),
			array('shop_user_id','require','用户ID不能为空！'),
			array('shop_goods_id','require','商品ID不能为空！'),
		);

	//自动完成
	protected $_auto=array(
			array('add_time','time',1,'function'),
		);
}

 ?>
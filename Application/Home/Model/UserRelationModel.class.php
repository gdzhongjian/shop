<?php 
namespace Home\Model;
use Think\Model\RelationModel;

/**
* 用户表和用户信息表关联模型
*/
class UserRelationModel extends RelationModel
{
	
	protected $tableName="User";
	protected $_link=array(
			'Userinfo'=>array(
					'mapping_type'=>self::HAS_ONE,
					'class_name'=>'Userinfo',
					'foreign_key'=>'shop_user_id',
				),
		);
}

 ?>
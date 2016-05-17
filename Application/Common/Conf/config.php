<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',	//数据库类型
	'DB_HOST'=>'localhost',	//服务器地址
	'DB_NAME'=>'shop',	//数据库名称
	'DB_USER'=>'root',	//数据库账号
	'DB_PWD'=>'root',	//数据库密码
	'DB_PORT'=>3306,	//端口
	'DB_PREFIX'=>'shop_',	//数据库表前缀
	'DB_CHARSET'=>'utf8',	//字符集
	'DB_DEBUG'=>TRUE,	//数据库调试模式，开启后可以记录SQL日志

	'ENCRYPT_KEY'=>'wangshangfushixitong',	//cookie加密的key
	'URL_CASE_INSENSITIVE'=>true,	//开启URL不区分大小写

	'PAGE_SIZE'=>10,	//分页大小

	'UPLOAD_FILE_ROOT_PATH'=>'./Public/upload/goods/pictures/',	//上传商品图片的根目录
	'UPLOAD_FILE_ROOT_PATH_OUTPUT'=>'upload/goods/pictures/',	//模板输出商品图片根目录时的路径，用于数据库信息保存
	'UPLOAD_FILE_COVER_PATH'=>'./Public/upload/goods/cover/',	//上传商品封面的根目录
	'UPLOAD_FILE_COVER_PATH_OUTPUT'=>'upload/goods/cover/',		//模板输出商品封面根目录时的路径，用于数据库信息保存
	'UPLOAD_FILE_USER_HEADIMAGE'=>'./Public/upload/user/headimage/',		//用户上传头像根目录
	'UPLOAD_FILE_USER_HEADIMAGE_OUTPUT'=>'upload/user/headimage/',			//模板输出用户头像的根目录时的路径，用于数据库信息保存
	'UPLOAD_FILE_ADMIN_HEADIMAGE'=>'./Public/upload/admin/headimage/',	//上传管理员头像的根目录
	'UPLOAD_FILE_ADMIN_HEADIMAGE_OUTPUT'=>'upload/admin/headimage/',	//模板输出管理员头像的根目录时的路径，用于数据库信息保存
	'UPLOAD_FILE_LUNBO'=>'./Public/upload/admin/lunbo/',		//上传轮播图片的根目录
	'UPLOAD_FILE_LUNBO_OUTPUT'=>'upload/admin/lunbo/',			//模板输出轮播图片的根目录时的路径，用于数据库信息保存

	// 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'wangshangfushi@163.com',//你的邮箱名
    'MAIL_FROM' =>'wangshangfushi@163.com',//发件人地址
    'MAIL_FROMNAME'=>'网上服饰购物系统',//发件人姓名
    'MAIL_PASSWORD' =>'wangshanggouwu01',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

    'TOKEN_KEY'=>'kjhjdfadhjkewhjhdafmnxnbjdfakh',	//发送邮件的token加密的key值
	
	'DEFAULT_MODULE'=>'Index',	//默认模块

);
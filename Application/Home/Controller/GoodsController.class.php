<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 商品管理控制器
*/
class GoodsController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if(($this->admin_message['level']!=1)&&($this->admin_message['level']!=2)){
			$this->error('您没有权限访问',U('index/index'));
		}
	}


	//添加商品视图
	public function add(){
		//显示商品一级分类
		$Category=M('Goods_category');
		$firstcategorys=$Category->where(array('level'=>1))->select();
		//显示商品品牌
		$Brand=M('Goods_brand');
		$brands=$Brand->select();
		$this->firstcategorys=$firstcategorys;
		$this->brands=$brands;
		$this->display();
	}

	//商品添加处理
	public function checkAdd(){
		$post=I('post.');
		$this->validateForm($post);
		//实例化商品模型
		$Goods=M('goods');
		//日期转换成时间戳
		if($post['qianggou_start']){
			$qianggou_start=strtotime($post['qianggou_start']);
		}
		if($post['qianggou_end']){
			$qianggou_end=strtotime($post['qianggou_end']);
		}
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_COVER_PATH'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=array('date','Ymd');	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if($info){
			//上传成功
			foreach ($info as $file) {
			//生成缩略图180*255,32*32
			$image=new \Think\Image;
			$image->open($upload->rootPath.$file['savepath'].$file['savename']);
			//缩略图文件名
			$filename=fileRandNumber();
			$bigname=$filename.'big';
			$smallname=$filename.'small';
			//保存缩略图
			$image->thumb(180,255,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$bigname.'.'.$file['ext']);
			$image->thumb(32,32,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$smallname.'.'.$file['ext']);
			$big_picture_path=C('UPLOAD_FILE_COVER_PATH_OUTPUT').$file['savepath'].$bigname.'.'.$file['ext'];
			$small_picture_path=C('UPLOAD_FILE_COVER_PATH_OUTPUT').$file['savepath'].$smallname.'.'.$file['ext'];
			}
		}
		//模型赋值
		$Goods->first_name=$post['firstname'];
		$Goods->second_name=$post['secondname'];
		$Goods->sex=$post['sex'];
		if($post['mianyunfei']=="bumianyunfei"){
			$Goods->is_free_shipping=1;
			$Goods->shipping_price=$post['yunfei'];
		}
		$Goods->price=$post['price'];
		$Goods->discount_start=$qianggou_start;
		$Goods->discount_end=$qianggou_end;
		$Goods->add_time=time();
		$Goods->edit_time=time();
		$Goods->introduce=$_POST['content']; 	//编辑器的内容不能进行过滤处理
		if($big_picture_path){
			$Goods->big_picture=$big_picture_path;
		}
		if($small_picture_path){
			$Goods->small_picture=$small_picture_path;
		}
		$Goods->shop_goods_brand_id=$post['brand'];
		$Goods->shop_goods_category_id=$post['thirdcategory'];
		$Goods->first_category=$post['firstcategory'];
		$Goods->second_category=$post['secondcategory'];
		if($id=$Goods->add()){
			//成功添加商品,更新商品图片表外码（商品id）
			$Goods_picture=M('Goods_picture');
			$goods_pictures=$Goods_picture->where(array('shop_goods_id'=>0))->select();
			foreach ($goods_pictures as $goods_picture) {
				$Goods_picture->shop_goods_id=$id;
				$Goods_picture->where(array('id'=>$goods_picture['id']))->save();
			}
			//跳转到添加商品详细信息处（尺寸，颜色，库存等等信息）
			$this->redirect('addDetailInfo',array('goods_id'=>$id));
		}else{
			$this->error('添加商品失败！');
			// $this->error($Goods->getError());
			// print_r($Goods->getError());
		}

		
	}


	//商品编辑处理
	public function checkEdit(){
		$post=I('post.');
		$this->validateForm($post);
		//实例化商品模型
		$Goods=M('goods');
		//日期转换成时间戳
		if($post['qianggou_start']){
			$qianggou_start=strtotime($post['qianggou_start']);
		}
		if($post['qianggou_end']){
			$qianggou_end=strtotime($post['qianggou_end']);
		}
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_COVER_PATH'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=array('date','Ymd');	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if($info){
			//上传成功
			foreach ($info as $file) {
			//生成缩略图180*255,32*32
			$image=new \Think\Image;
			$image->open($upload->rootPath.$file['savepath'].$file['savename']);
			//缩略图文件名
			$filename=fileRandNumber();
			$bigname=$filename.'big';
			$smallname=$filename.'small';
			//保存缩略图
			$image->thumb(180,255,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$bigname.'.'.$file['ext']);
			$image->thumb(32,32,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$smallname.'.'.$file['ext']);
			$big_picture_path=C('UPLOAD_FILE_COVER_PATH_OUTPUT').$file['savepath'].$bigname.'.'.$file['ext'];
			$small_picture_path=C('UPLOAD_FILE_COVER_PATH_OUTPUT').$file['savepath'].$smallname.'.'.$file['ext'];
			}
		}
		//模型赋值
		$Goods->first_name=$post['firstname'];
		$Goods->second_name=$post['secondname'];
		$Goods->sex=$post['sex'];
		if($post['mianyunfei']=="bumianyunfei"){
			$Goods->is_free_shipping=1;
			$Goods->shipping_price=$post['yunfei'];
		}
		$Goods->price=$post['price'];
		$Goods->discount_start=$qianggou_start;
		$Goods->discount_end=$qianggou_end;
		$Goods->edit_time=time();
		$Goods->introduce=$_POST['content']; 	//编辑器的内容不能进行过滤处理
		if($big_picture_path){
			$Goods->big_picture=$big_picture_path;
		}
		if($small_picture_path){
			$Goods->small_picture=$small_picture_path;
		}
		$Goods->shop_goods_brand_id=$post['brand'];
		$Goods->shop_goods_category_id=$post['thirdcategory'];
		$Goods->first_category=$post['firstcategory'];
		$Goods->second_category=$post['secondcategory'];
		if($id=$Goods->where(array('id'=>$post['id']))->save()){
			//跳转到添加商品详细信息处（尺寸，颜色，库存等等信息）
			$this->redirect('index');
		}else{
			$this->error('编辑商品失败！');
		}

		
	}


	//添加商品详细信息（尺寸，颜色，库存等等信息）
	public function addDetailInfo(){
		$id=I('get.goods_id');
		//实例化
		$Goods=M('Goods');
		$goods=$Goods->where(array('id'=>$id))->find();
		$Stock=M('Stock');
		$stocks=$Stock->where(array('shop_goods_id'=>$id))->select();
		$this->stocks=$stocks;
		$this->goods_id=$id;
		$this->first_name=$goods['first_name'];
		$this->display();
	}

	//添加商品详细信息（尺寸，颜色，库存等信息）
	public function checkAddDetailInfo(){
		$post=I('post.');
		//实例化
		$Stock=M('Stock');
		$Stock->color=$post['color'];
		$Stock->size=$post['size'];
		$Stock->original_price=$post['originalprice'];
		$Stock->sale_price=$post['saleprice'];
		$Stock->stock_sum=$post['stock'];
		$Stock->address=$post['address'];
		$Stock->shop_goods_id=$post['goods_id'];
		if($Stock->add()){
			$this->redirect('addDetailInfo',array('goods_id'=>$post['goods_id']));
		}
	}

	//修改商品库存信息视图
	public function editDetailInfo(){
		$goods_name=I('get.goods_name');
		$stock_id=I('get.stock_id');
		$goods_id=I('get.goods_id');
		$type=I('get.type');
		//实例化
		$Stock=M('Stock');
		$stock=$Stock->where(array('id'=>$stock_id))->find();
		$this->stock=$stock;
		$this->goods_name=$goods_name;
		$this->goods_id=$goods_id;
		$this->type=$type;
		$this->display();
	}

	//编辑商品详细信息（尺寸，颜色，库存等信息）
	public function checkEditDetailInfo(){
		$post=I('post.');
		//实例化
		$Stock=M('Stock');
		$Stock->original_price=$post['originalprice'];
		$Stock->sale_price=$post['saleprice'];
		$Stock->stock_sum=$post['stock'];
		$Stock->address=$post['address'];
		if($Stock->where(array('id'=>$post['stock_id']))->save()){
			if($post['type']==1){
				$this->redirect('addDetailInfo',array('goods_id'=>$post['goods_id']));
			}
			if($post['type']==2){
				$this->redirect('showStock',array('goods_id'=>$post['goods_id']));
			}
			
		}else{
			$this->error('数据没有更改！');
		}
	}

	//删除商品库存信息
	public function deleteStock(){
		$id=I('post.id');
		//实例化
		$Stock=M('Stock');
		if($Stock->delete($id)){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}

	//添加/编辑商品表单数据验证
	public function validateForm($data){
		if($data['firstname']==""){
			$this->error('商品名称（大标题）不能为空！');
		}
		if($data['firstcategory']==-1){
			$this->error('请选择一级分类！');
		}
		if($data['secondcategory']==-1){
			$this->error('请选择二级分类！');
		}
		if($data['thirdcategory']==-1){
			$this->error('请选择三级分类！');
		}
		if($data['brand']==-1){
			$this->error('请选择品牌分类！');
		}
		if($data['mianyunfei']=="bumianyunfei"){
			if($data['yunfei']==""){
				$this->error('请输入运费价格！');
			}else{
				if(!checkNumber($data['yunfei'])){
					//输入格式不正确
					$this->error('请输入正确的运费价格！');
				}
			}
		}

		if($data['qianggou_start']){
			if(!checkDateByPost($data['qianggou_start'])){
				$this->error('请输入正确的抢购开始时间！');
			}
		}
		if($data['qianggou_end']){
			if(!checkDateByPost($data['qianggou_end'])){
				$this->error('请输入正确的抢购结束时间！');
			}
		}

	}


	//商品图片上传
	public function pictureUpload(){
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_ROOT_PATH'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=array('date','Ymd');	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if(!$info){
			//上传失败
			$status=0;
			$this->ajaxReturn($status);
		}else{
			//上传成功
			// session('upload_file_message',$info['file']);
			foreach ($info as $file) {
			//生成缩略图70*75,450*632
			$image=new \Think\Image;
			$image->open($upload->rootPath.$file['savepath'].$file['savename']);
			//缩略图文件名
			$filename=fileRandNumber();
			$bigname=$filename.'big';
			$smallname=$filename.'small';
			//保存缩略图
			$image->thumb(450,632,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$bigname.'.'.$file['ext']);
			$image->thumb(70,75,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$smallname.'.'.$file['ext']);
			//把图片路径插入数据库中，商品id设为0，当管理员提交表单后再更新商品id
			$Goods_picture=M('Goods_picture');
			$Goods_picture->big_picture=C('UPLOAD_FILE_ROOT_PATH_OUTPUT').$file['savepath'].$bigname.'.'.$file['ext'];
			$Goods_picture->small_picture=C('UPLOAD_FILE_ROOT_PATH_OUTPUT').$file['savepath'].$smallname.'.'.$file['ext'];
			$Goods_picture->shop_goods_id=0;
			$Goods_picture->picture=C('UPLOAD_FILE_ROOT_PATH_OUTPUT').$file['savepath'].$file['savename'];
			$Goods_picture->add();
			}
			$status=1;
			$this->ajaxReturn($status);
		}
	}

	//商品列表视图
	public function index(){
		//实例化商品一级分页
		$Goods=M('Goods');
		$count=$Goods->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$goods=$Goods->limit($Page->firstRow,$Page->listRows)->order('-edit_time')->select();
		//查询商品分类，品牌
		$Category=M('Goods_category');
		$categorys=$Category->where(array('level'=>3))->select();
		$Brand=M('Goods_brand');
		$brands=$Brand->select();

		$this->count=$count;
		$this->goods=$goods;
		$this->page=$show;
		$this->categorys=$categorys;
		$this->brands=$brands;
		$this->display();
	}

	//删除商品
	public function deleteGoods(){
		$goods_id=I('post.id');
		$Stock=M('Stock');
		$stocks=$Stock->where(array('shop_goods_id'=>$goods_id))->select();
		foreach ($stocks as $stock) {
			//删除该商品下的库存表
			$Stock->delete($stock['id']);
		}
		$Goods_picture=M('Goods_picture');
		$goods_pictures=$Goods_picture->where(array('shop_goods_id'=>$goods_id))->select();
		foreach ($goods_pictures as $goods_picture) {
			//删除该商品的图片介绍表
			$Goods_picture->delete($goods_picture['id']);
		}
		//删除商品
		$Goods=M('Goods');
		if($Goods->delete($goods_id)){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}

	//删除商品图片
	public function deleteGoodsPicture(){
		$id=I('get.id');
		$goods_id=I('get.goods_id');
		$Goods_picture=M('Goods_picture');
		$Goods_picture->delete($id);
		$this->redirect('edit',array('goods_id'=>$goods_id));
	}

	//编辑商品视图
	public function edit(){
		$goods_id=I('get.goods_id');
		$Goods=M('Goods');
		$goods=$Goods->where(array('id'=>$goods_id))->find();
		//查找分类信息
		$Category=M('Goods_category');
		$thirdcategorys=$Category->where(array('pid'=>$goods['second_category']))->select();
		$secondcategorys=$Category->where(array('pid'=>$goods['first_category']))->select();
		$firstcategorys=$Category->where(array('level'=>1))->select();
		//查找商品品牌
		$Brand=M('Goods_brand');
		$brands=$Brand->select();

		//查找商品图片
		$Goods_picture=M('Goods_picture');
		$goods_pictures=$Goods_picture->where(array('shop_goods_id'=>$goods_id))->select();

		$this->goods=$goods;
		$this->thirdcategorys=$thirdcategorys;
		$this->secondcategorys=$secondcategorys;
		$this->firstcategorys=$firstcategorys;
		$this->brands=$brands;
		$this->goods_pictures=$goods_pictures;

		$this->display();
	}

	//查看一种商品下的图片列表
	public function showPicture(){
		$goods_id=I('get.goods_id');
		$Goods_picture=M('Goods_picture');
		$count=$Goods_picture->where(array('shop_goods_id'=>$goods_id))->count();
		$goods_pictures=$Goods_picture->where(array('shop_goods_id'=>$goods_id))->select();
		$Goods=M('Goods');
		$goods=$Goods->where(array('id'=>$goods_id))->find();
		$Goods_category=M('Goods_category');
		$category=$Goods_category->where(array('id'=>$goods['shop_goods_category_id']))->find();
		$Goods_brand=M('Goods_brand');
		$brand=$Goods_brand->where(array('id'=>$goods['shop_goods_brand_id']))->find();
		$this->goods_pictures=$goods_pictures;
		$this->count=$count;
		$this->goods_name=$goods['first_name'];
		$this->category=$category['name'];
		$this->brand=$brand['name'];
		$this->display();

	}

	//删除商品图片,通过ajax删除
	public function deleteGoodsPictureByAjax(){
		$id=I('post.id');
		$Goods_picture=M('Goods_picture');
		if($Goods_picture->delete($id)){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}

	//查看一种商品下的库存列表
	public function showStock(){
		$id=I('get.goods_id');
		$Stock=M('Stock');
		$count=$Stock->where(array('shop_goods_id'=>$id))->count();
		$stocks=$Stock->where(array('shop_goods_id'=>$id))->select();
		$Goods=M('Goods');
		$goods=$Goods->where(array('id'=>$id))->find();
		$this->count=$count;
		$this->stocks=$stocks;
		$this->goods_name=$goods['first_name'];
		$this->goods_id=$goods['id'];
		$this->display();
	}

	//分类商品视图列表
	public function list1(){
		$Goods_category=M('Goods_category');
		$firstcategorys=$Goods_category->where(array('level'=>1))->select();
		$this->firstcategorys=$firstcategorys;
		$this->display();
	}

	//分类商品查询
	public function categorySelect(){
		$post=I('post.');
		$category_id=$post['thirdcategory'];
		if(IS_AJAX){
			$category_id=I('get.thirdcategory');
		}
		//分页
		$Goods=M('Goods');
		$count=$Goods->where(array('shop_goods_category_id'=>$category_id))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$goods=$Goods->where(array('shop_goods_category_id'=>$category_id))->limit($Page->firstRow,$Page->listRows)->order('-edit_time')->select();
		//查询商品分类，品牌
		$Category=M('Goods_category');
		$category=$Category->where(array('id'=>$category_id))->find();
		$Brand=M('Goods_brand');
		$brands=$Brand->select();
		if(IS_AJAX){
			$this->count=$count;
			$this->goods=$goods;
			$this->page=$show;
			$this->category=$category;
			$this->brands=$brands;
			$this->thirdcategory=$category_id;
			$html=$this->fetch('ajaxIndex1');
			return $this->ajaxReturn($html);
		}
		$this->count=$count;
		$this->goods=$goods;
		$this->page=$show;
		$this->category=$category;
		$this->brands=$brands;
		$this->thirdcategory=$category_id;
		$this->display('index1');

	}

	//查看指定商品
	public function appointGoods(){
		$this->display('list2');
	}

	//指定商品查询
	public function appointGoodsSelect(){
		$firstname=I('post.firstname');
		$Goods=M('Goods');
		$Category=M('Goods_category');
		$Brand=M('Goods_brand');
		$count=$Goods->where(array('first_name'=>$firstname))->count();
		$goods=$Goods->where(array('first_name'=>$firstname))->select();
		$categorys=array();
		$brands=array();
		$i=1;
		foreach ($goods as $good) {
			$shop_goods_category_id=$good['shop_goods_category_id'];
			$shop_goods_brand_id=$good['shop_goods_brand_id'];
			$categorys[$i]=$Category->where(array('id'=>$shop_goods_category_id))->find();
			$brands[$i]=$Brand->where(array('id'=>$shop_goods_brand_id))->find();
			$i++;
		}

		$this->count=$count;
		$this->goods=$goods;
		$this->categorys=$categorys;
		$this->brands=$brands;
		$this->display('index2');

	}


	//商品下架操作
	public function notSale(){
		if(IS_POST){
			$post=I('post.');
			$id=$post['id'];
			$type=$post['type'];
			$Goods=M('Goods');
			if($type==1){
				//正在出售，申请下架处理
				$Goods->is_sale=0;
				if($Goods->where(array('id'=>$id))->save()){
					return $this->ajaxReturn(1);
				}else{
					return $this->ajaxReturn(-1);
				}
			}else{
				//已经下架，申请重新上架处理
				$Goods->is_sale=1;
				if($Goods->where(array('id'=>$id))->save()){
					return $this->ajaxReturn(2);
				}else{
					return $this->ajaxReturn(-2);
				}
			}
		}
	}
	
}

 ?>
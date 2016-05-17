<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 网站设置控制器
*/
class SettingController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if($this->admin_message['level']!=1){
			$this->error('您没有权限访问',U('index/index'));
		}
	}

	public function index(){
		$Setting=M('Setting');
		$setting=$Setting->find();
		$this->setting=$setting;
		$this->display();
	}

	public function setting(){
		$post=I('post.');
		$Setting=M('Setting');
		if($post['id']){
			$Setting->web_name=$post['web_name'];
			$Setting->web_buttom=$post['web_buttom'];
			if($Setting->where(array('id'=>$post['id']))->save()){
				$this->success('修改网站前台信息成功！');
			}else{
				$this->error('修改网站前台信息失败！');
			}
		}else{
			$Setting->web_name=$post['web_name'];
			$Setting->web_buttom=$post['web_buttom'];
			if($Setting->add()){
				$this->success('设置网站前台信息成功！');
			}else{
				$this->error('设置网站前台信息失败！');
			}
		}
		
	}

	//轮播图片设置
	public function lunbo(){
		$Lunbo=M('Lunbo');
		$count=$Lunbo->count();
		$lunbos=$Lunbo->select();
		$i=1;
		foreach ($lunbos as $lunbo) {
			$Category=M('Goods_category');
			$category=$Category->where(array('id'=>$lunbo['shop_goods_category_id']))->find();
			$categorys[$i]=$category['name'];
			$i++;
		}
		$this->categorys=$categorys;
		$this->count=$count;
		$this->lunbos=$lunbos;
		$this->display();
	}

	//增加轮播图片视图
	public function addLunbo(){
		$Goods_category=M('Goods_category');
		$firstcategorys=$Goods_category->where(array('level'=>1))->select();
		$this->firstcategorys=$firstcategorys;
		$this->display();
	}

	//增加轮播图
	public function checkLunbo(){
		$post=I('post.');
		$Lunbo=M('Lunbo');
		//实例化上传类
		$upload=new \Think\Upload;
		$upload->maxSize=3145728;	//设置附件上传大小
		$upload->exts=array('jpg','gif','png','jpeg');	//设置附件上传类型
		$upload->rootPath=C('UPLOAD_FILE_LUNBO'); //设置附件上传根目录
		$upload->savePath='';	//设置附件上传子目录
		$upload->subName=array('date','Ymd');	//子目录创建方式
		//上传文件
		$info=$upload->upload();
		if($info){
			//上传成功
			foreach ($info as $file) {
				//生成缩略图950*470
				$image=new \Think\Image;
				$image->open($upload->rootPath.$file['savepath'].$file['savename']);
				//缩略图文件名
				$filename=fileRandNumber();
				$bigname=$filename.'big';
				//保存缩略图
				$image->thumb(950,470,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->rootPath.$file['savepath'].$bigname.'.'.$file['ext']);
				$big_picture_path=C('UPLOAD_FILE_LUNBO_OUTPUT').$file['savepath'].$bigname.'.'.$file['ext'];

				$Lunbo->picture=$big_picture_path;
				$Lunbo->shop_goods_category_id=$post['thirdcategory'];
				if($Lunbo->add()){
					$this->success('上传轮播图片成功！',U('setting/lunbo'),3);
				}else{
					$this->error('上传轮播图片失败！');
				}
			}
		}else{
			$this->error('上传轮播图片失败！');
		}
	}

	//删除轮播图片
	public function deleteLunbo(){
		if(IS_AJAX){
			$id=I('post.id');
			$Lunbo=M('Lunbo');
			if($Lunbo->where(array('id'=>$id))->delete()){
				return $this->ajaxReturn(1);
			}else{
				return $this->ajaxReturn(0);
			}
		}
	}

	//后台注册设置
	public function register(){
		$Setting=M('Setting');
		$setting=$Setting->find();
		$this->setting=$setting;
		$this->display();
	}

	//后台注册处理
	public function agree(){
		$Setting=M('Setting');
		$setting=$Setting->find();
		$id=I('post.open');
		if($id==0){
			//要开启允许注册
			$Setting->open=1;
			if($Setting->where(array('id'=>$setting['id']))->save()){
				$this->success('允许注册成功！');
			}else{
				$this->error('允许注册失败！');
			}
		}else{
			//禁止注册
			$Setting->open=0;
			if($Setting->where(array('id'=>$setting['id']))->save()){
				$this->success('禁止注册成功！');
			}else{
				$this->error('禁止注册失败！');
			}
		}
	}
	
}
?>
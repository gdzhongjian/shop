<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 商品分类控制器
*/
class CategoryController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if(!IS_AJAX){
			if(($this->admin_message['level']!=1)&&($this->admin_message['level']!=3)){
				$this->error('您没有权限访问',U('index/index'));
			}
		}
	}

	//添加分类
	public function add(){
		$category=M('Goods_category');
		//查询一级分类
		$firstCategory=$category->where(array('level'=>1))->select();
		//查询二级分类
		$secondCategory=$category->where(array('level'=>2))->select();

		$this->firstCategory=$firstCategory;
		$this->secondCategory=$secondCategory;
		$this->display();
	}

	//检查分类名称是否存在
	public function checkCategory(){
		//实例化shop_goods_category
		$category=M('Goods_category');
		//获取分类级别
		$level=I('post.level');
		//获取分类名称
		if($level==1){
			$name=I('post.firstname');
			$check=$category->where(array('name'=>$name,'level'=>1))->find();
			if($check){
				//分类名称已经存在
				$this->ajaxReturn(1);
			}else{
				//分类名称不存在
				$this->ajaxReturn(0);
			}
		}else if($level==2){
			$firstid=I('post.firstid');
			$secondname=I('post.secondname');
			$check=$category->where(array('name'=>$secondname,'level'=>2,'pid'=>$firstpid))->find();
			if($check){
				//分类名称已经存在
				$this->ajaxReturn(1);
			}else{
				//分类名称不存在
				$this->ajaxReturn(0);
			}		
		}else if($level==3){
			$secondid=I('post.secondid');
			$thirdname=I('post.thirdname');
			$check=$category->where(array('name'=>$thirdname,'level'=>3,'pid'=>$secondid))->find();
			if($check){
				//分类名称已经存在
				$this->ajaxReturn(1);
			}else{
				//分类名称不存在
				$this->ajaxReturn(0);
			}
		}
	}

	//分类添加处理
	public function checkAdd(){
		//实例化
		$category=M('Goods_category');
		//获取添加的分类级别
		$level=I('get.level');
		if($level==1){
			//一级分类
			$name=I('post.firstname1');
			if($name==""){
				$this->error('分类名称不能为空！');
			}
			$check=$category->where(array('name'=>$name,'level'=>$level))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$category->name=$name;
			$category->level=$level;
			$category->addtime=time();
			if($category->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
		}else if($level==2){
			//二级分类
			$secondname=I('post.secondname2');
			$firstid=I('post.secondpid');
			if($firstid==-1){
				$this->error('请选择一级分类！');
			}
			if($secondname==""){
				$this->error('分类名称不能为空！');
			}
			$check=$category->where(array('name'=>$secondname,'level'=>$level,'pid'=>$firstpid))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$category->name=$secondname;
			$category->level=$level;
			$category->pid=$firstid;
			$category->addtime=time();
			if($category->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
		}else if($level==3){
			//三级分类
			$thirdname=I('post.thirdname3');
			$firstid=I('post.thirdpid1');
			$secondid=I('post.thirdpid2');
			if($firstid==-1){
				$this->error('请选择一级分类！');
			}
			if($secondid==-1){
				$this->error('请选择二级分类');
			}
			if($thirdname==""){
				$this->error('分类名称不能为空！');
			}
			$check=$category->where(array('name'=>$thirdname,'level'=>$level,'pid'=>$secondpid))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$category->name=$thirdname;
			$category->level=$level;
			$category->pid=$secondid;
			$category->addtime=time();
			if($category->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
		}
	}


	//输出对应一级分类下的二级分类
	public function secondCategoryList(){
		$pid=I('post.pid');
		$category=M('Goods_category');
		$secondCategory=$category->where(array('pid'=>$pid))->select();
		$str="<option value='-1'>请选择二级分类</option>";
		if($secondCategory){
			foreach ($secondCategory as $category) {
						$str.="<option value=".$category['id'].">".$category['name']."</option>";
					}	
		}
		echo $str;
	}

	//输出对应二级分类下的三级分类
	public function thirdCategoryList(){
		$secondpid=I('post.secondpid');
		$category=M('Goods_category');
		$thirdCategory=$category->where(array('pid'=>$secondpid))->select();
		$str="<option value='-1'>请选择三级分类</option>";
		if($thirdCategory){
			foreach ($thirdCategory as $category) {
						$str.="<option value=".$category['id'].">".$category['name']."</option>";
					}	
		}
		echo $str;
	}


	//检查品牌是否存在
	public function checkBrand(){
		//实例化
		$brand=M('Goods_brand');
		//获取品牌名称
		$brandname=I('post.brandname');
		$check=$brand->where(array('name'=>$brandname))->find();
		if($check){
			//品牌名称已经存在
			$this->ajaxReturn(1);
		}else{
			//品牌名称不存在
			$this->ajaxReturn(0);
		}
	}

	//品牌添加处理
	public function brandAdd(){
		//实例化
		$brand=M('Goods_brand');
		$brandname=I('post.brandname');
		if($brandname==""){
			$this->error('请输入品牌名称！');
		}
		$check=$brand->where(array('name'=>$brandname))->find();
		if($check){
			$this->error('品牌名称已经存在！');
		}
		$brand->name=$brandname;
		$brand->addtime=time();
		if($brand->add()){
			$this->success('添加成功！');
		}else{
			$this->error('添加失败！');
		}

	}

	//查看商品一级分类
	public function index(){
		//分页
		$Category=M('Goods_category');
		$count=$Category->where(array('level'=>1))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$categorys=$Category->where(array('level'=>1))->limit($Page->firstRow,$Page->listRows)->order(array('addtime'=>desc))->select();
		$this->count=$count;
		$this->categorys=$categorys;
		$this->page=$show;
		$this->display();
	}
	//查看商品二级分类
	public function secondList(){
		//分页
		$Category=M('Goods_category');
		$count=$Category->where(array('level'=>2))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$categorys=$Category->where(array('level'=>2))->limit($Page->firstRow,$Page->listRows)->order(array('addtime'=>desc))->select();
		//查询父级名称
		$i=1;
		$parentname=array();
		foreach ($categorys as $category) {
			$find=$Category->where(array('id'=>$category['pid']))->find();
			$parentname[$i]=$find['name'];
			$i++;
		}
		$this->count=$count;
		$this->categorys=$categorys;
		$this->page=$show;
		$this->parentname=$parentname;
		$this->display();
	}
	//查看商品三级分类
	public function thirdList(){
		//分页
		$Category=M('Goods_category');
		$count=$Category->where(array('level'=>3))->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$categorys=$Category->where(array('level'=>3))->limit($Page->firstRow,$Page->listRows)->order('-addtime')->select();
		//查询父级名称
		$i=1;
		$parentname=array();
		foreach ($categorys as $category) {
			$find=$Category->where(array('id'=>$category['pid']))->find();
			$parentname[$i]=$find['name'];
			$i++;
		}
		$this->count=$count;
		$this->categorys=$categorys;
		$this->page=$show;
		$this->parentname=$parentname;
		$this->display();
	}

	//查看商品品牌列表
	public function brandlist(){
		//分页
		$Brand=M('Goods_brand');
		$count=$Brand->count();
		$Page=getpage($count,C('PAGE_SIZE'));
		$show=$Page->show();
		$brands=$Brand->limit($Page->firstRow,$Page->listRows)->order('-addtime')->select();
		$this->count=$count;
		$this->page=$show;
		$this->brands=$brands;
		$this->display();
	}



	//编辑商品分类视图
	public function edit(){
		//实例化
		$Category=M('Goods_category');
		//获取商品的id和level
		$id=I('get.id');
		$level=I('get.level');
		$category=$Category->where(array('id'=>$id))->find();
		if($level==2){
			//编辑二级分类，输出一级分类名称
			$firstCategorys=$Category->where(array('level'=>1))->select();
		}
		if($level==3){
			//编辑三级分类，输出一级和二级分类名称
			//先查找出该三级对应的父级的父级即一级名称
			$second_parent=$Category->where(array('id'=>$category['pid']))->find();
			$first_parent=$Category->where(array('id'=>$second_parent['pid']))->find();
			//输出该一级名称下的二级名称，即跟三级名称的父级同级别的
			$secondCategorys=$Category->where(array('pid'=>$first_parent['id']))->select();
			//查询出全部一级名称
			$firstCategorys=$Category->where(array('level'=>1))->select();

		}
		$this->category=$category;
		$this->level=$level;
		$this->firstCategorys=$firstCategorys;
		//用于编辑三级分类
		$this->second_parent_id=$second_parent['id'];
		$this->first_parent_id=$first_parent['id'];
		$this->secondCategorys=$secondCategorys;

		$this->display();
	}

	//编辑品牌视图
	public function brandEdit(){
		//实例化
		$Brand=M("Goods_brand");
		//获取id和level
		$id=I('get.id');
		$level=I('get.level');
		$brand=$Brand->where(array('id'=>$id))->find();
		$this->level=$level;
		$this->brand=$brand;
		$this->display('edit');
	}


	//编辑商品分类处理
	public function checkEdit(){
		//实例化
		$Category=M('Goods_category');
		//获取编辑商品的级别
		$level=I('get.level');
		$oldname=I('post.oldname');
		$category_id=I('post.id');
		if($level==1){
			//一级分类
			$name=I('post.firstname1');
			if($name==""){
				$this->error('分类名称不能为空！');
			}
			//判断是否更改
			if($oldname==$name){
				$this->error('请输入新的分类名称！');
			}
			//判断名称是否已存在
			$check=$Category->where(array('name'=>$name,'level'=>$level))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$Category->id=$category_id;
			$Category->name=$name;
			if($Category->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！');
			}
		}else if($level==2){
			//二级分类
			$name=I('post.secondname2');
			$firstid=I('post.secondpid');
			if($firstid==-1){
				$this->error('请选择一级分类！');
			}
			if($name==""){
				$this->error('分类名称不能为空！');
			}
			$check=$Category->where(array('name'=>$name,'level'=>$level,'pid'=>$firstid))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$Category->id=$category_id;
			$Category->pid=$firstid;
			$Category->name=$name;
			if($Category->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！');
			}

		}else if($level==3){
			//三级分类
			$name=I('post.thirdname3');
			$firstpid=I("post.thirdpid1");
			$secondpid=I('post.thirdpid2');
			if($firstpid==""){
				$this->error('请选择一级分类！');
			}
			if($secondpid==""){
				$this->error('请选择二级分类');
			}
			if($name==""){
				$this->error('分类名称不能为空！');
			}
			$check=$Category->where(array('name'=>$name,'level'=>$level,'pid'=>$secondpid))->find();
			if($check){
				$this->error('分类名称已经存在！');
			}
			$Category->id=$category_id;
			$Category->pid=$secondpid;
			$Category->name=$name;
			if($Category->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！');
			}
		}
	}

	//编辑品牌处理
	public function checkBrandEdit(){
		//实例化
		$brand=M('Goods_brand');
		$brandname=I('post.brandname');
		$oldname=I('post.oldname');
		$id=I('post.id');
		if($brandname==""){
			$this->error('请输入品牌名称！');
		}
		if($oldname==$brandname){
			$this->error('请输入新的品牌名称！');
		}
		$check=$brand->where(array('name'=>$brandname))->find();
		if($check){
			$this->error('品牌名称已经存在！');
		}
		$brand->id=$id;
		$brand->name=$brandname;
		$brand->addtime=time();
		if($brand->save()){
			$this->success('修改成功！');
		}else{
			$this->error('修改失败！');
		}
	}


	//删除商品分类
	public function delete(){
		//实例化
		$Category=M('Goods_category');
		//获取id和level
		$id=I('post.id');
		$level=I('post.level');
		if($level==3){
			//如果是三级分类，直接删除
			if($Category->delete($id)){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}
		if($level==2){
			//如果是二级分类，删除二级分类及其下面的三级分类
			$thirdcategorys=$Category->where(array('pid'=>$id))->select();
			foreach ($thirdcategorys as $thirdcategory) {
				$Category->delete($thirdcategory['id']);
			}
			if($Category->delete($id)){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}
		if($level==1){
			//如果是一级分类，删除其下的二级分类和三级分类
			$secondcategorys=$Category->where(array('pid'=>$id))->select();
			//删除三级分类和二级分类
			foreach ($secondcategorys as $secondcategory) {
				$thirdcategorys=$Category->where(array('pid'=>$secondcategory['id']))->select();
				foreach ($thirdcategorys as $thirdcategory) {
					$Category->delete($thirdcategory['id']);
				}
				$Category->delete($secondcategory['id']);
			}
			if($Category->delete($id)){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}
	}

	//删除商品品牌
	public function brandDelete(){
		//实例化
		$Brand=M('Goods_brand');
		$id=I('post.id');
		if($Brand->delete($id)){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}
}

 ?>
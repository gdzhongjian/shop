<?php 
namespace Home\Controller;
use Think\Controller;

/**
* 评论管理控制器
*/
class CommentController extends CommonController
{
	public function _initialize(){
		parent::_initialize();
		if(($this->admin_message['level']!=1)&&($this->admin_message['level']!=5)){
			$this->error('您没有权限访问',U('index/index'));
		}
	}
	
	public function index(){
		$Comment=M('Comment');
		$User=M('User');
		$Goods=M('Goods');
		$Goods_category=M('Goods_category');

		//全部评论
		$all_count=$Comment->count();
		$Page=getpage($all_count,C('PAGE_SIZE'));
		$all_show=$Page->show();
		$data=$Comment->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
		$all_i=1;
		foreach ($data as $comment) {
			$goods=$Goods->where(array('id'=>$comment['shop_goods_id']))->find();
			$all_comments[$all_i]['first_name']=$goods['first_name'];
			$category=$Goods_category->where(array('id'=>$goods['shop_goods_category_id']))->find();
			$all_comments[$all_i]['category']=$category['name'];
			$all_comments[$all_i]['content']=$comment['content'];
			$all_comments[$all_i]['score']=$comment['score'];
			$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
			$all_comments[$all_i]['username']=$user['nickname'];
			$all_comments[$all_i]['time']=$comment['time'];
			$all_comments[$all_i]['id']=$comment['id'];
			$all_i++;
		}
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="all_comment"){
				$this->all_page=$all_show;
				$this->all_comments=$all_comments;
				$this->all_count=$all_count;
				$html=$this->fetch('ajaxAllComment');
				return $this->ajaxReturn($html);
			}
		}
		$this->all_page=$all_show;
		$this->all_comments=$all_comments;
		$this->all_count=$all_count;


		//好评
		$good_count=$Comment->where(array('score'=>3))->count();
		$Page=getpage($good_count,C('PAGE_SIZE'));
		$good_show=$Page->show();
		$data=$Comment->where(array('score'=>3))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
		$good_i=1;
		foreach ($data as $comment) {
			$goods=$Goods->where(array('id'=>$comment['shop_goods_id']))->find();
			$good_comments[$good_i]['first_name']=$goods['first_name'];
			$category=$Goods_category->where(array('id'=>$goods['shop_goods_category_id']))->find();
			$good_comments[$good_i]['category']=$category['name'];
			$good_comments[$good_i]['content']=$comment['content'];
			$good_comments[$good_i]['score']=$comment['score'];
			$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
			$good_comments[$good_i]['username']=$user['nickname'];
			$good_comments[$good_i]['time']=$comment['time'];
			$good_comments[$good_i]['id']=$comment['id'];
			$good_i++;
		}
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="good_comment"){
				$this->good_page=$good_show;
				$this->good_comments=$good_comments;
				$this->good_count=$good_count;
				$html=$this->fetch('ajaxGoodComment');
				return $this->ajaxReturn($html);
			}
		}
		$this->good_page=$good_show;
		$this->good_comments=$good_comments;
		$this->good_count=$good_count;


		//中评
		$middle_count=$Comment->where(array('score'=>2))->count();
		$Page=getpage($middle_count,C('PAGE_SIZE'));
		$middle_show=$Page->show();
		$data=$Comment->where(array('score'=>2))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
		$middle_i=1;
		foreach ($data as $comment) {
			$goods=$Goods->where(array('id'=>$comment['shop_goods_id']))->find();
			$middle_comments[$middle_i]['first_name']=$goods['first_name'];
			$category=$Goods_category->where(array('id'=>$goods['shop_goods_category_id']))->find();
			$middle_comments[$middle_i]['category']=$category['name'];
			$middle_comments[$middle_i]['content']=$comment['content'];
			$middle_comments[$middle_i]['score']=$comment['score'];
			$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
			$middle_comments[$middle_i]['username']=$user['nickname'];
			$middle_comments[$middle_i]['time']=$comment['time'];
			$middle_comments[$middle_i]['id']=$comment['id'];
			$middle_i++;
		}
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="middle_comment"){
				$this->middle_page=$middle_show;
				$this->middle_comments=$middle_comments;
				$this->middle_count=$middle_count;
				$html=$this->fetch('ajaxMiddleComment');
				return $this->ajaxReturn($html);
			}
		}
		$this->middle_page=$middle_show;
		$this->middle_comments=$middle_comments;
		$this->middle_count=$middle_count;



		//差评
		$bad_count=$Comment->where(array('score'=>1))->count();
		$Page=getpage($bad_count,C('PAGE_SIZE'));
		$bad_show=$Page->show();
		$data=$Comment->where(array('score'=>1))->order('-time')->limit($Page->firstRow,$Page->listRows)->select();
		$bad_i=1;
		foreach ($data as $comment) {
			$goods=$Goods->where(array('id'=>$comment['shop_goods_id']))->find();
			$bad_comments[$bad_i]['first_name']=$goods['first_name'];
			$category=$Goods_category->where(array('id'=>$goods['shop_goods_category_id']))->find();
			$bad_comments[$bad_i]['category']=$category['name'];
			$bad_comments[$bad_i]['content']=$comment['content'];
			$bad_comments[$bad_i]['score']=$comment['score'];
			$user=$User->where(array('id'=>$comment['shop_user_id']))->find();
			$bad_comments[$bad_i]['username']=$user['nickname'];
			$bad_comments[$bad_i]['time']=$comment['time'];
			$bad_comments[$bad_i]['id']=$comment['id'];
			$bad_i++;
		}
		if(IS_AJAX){
			$type=I('get.type');
			if($type=="bad_comment"){
				$this->bad_page=$bad_show;
				$this->bad_comments=$bad_comments;
				$this->bad_count=$bad_count;
				$html=$this->fetch('ajaxBadComment');
				return $this->ajaxReturn($html);
			}
		}

		$this->bad_page=$bad_show;
		$this->bad_comments=$bad_comments;
		$this->bad_count=$bad_count;	


		$this->display();
	}


	//删除评论
	public function delete(){
		$id=I('post.id');
		$Comment=M('Comment');
		if($Comment->delete($id)){
			return $this->ajaxReturn(1);
		}else{
			return $this->ajaxReturn(0);
		}
	}
	

}
?>
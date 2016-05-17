<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        //轮播图
        $Lunbo=M('Lunbo');
        $lunbos=$Lunbo->select();
        $this->lunbos=$lunbos;

    	$Goods_category=M('Goods_category');
    	//一级分类衣服下的二级分类
    	$first_category_cloth=$Goods_category->where(array('name'=>'衣服'))->find();
    	$second_category_clothes=$Goods_category->where(array('pid'=>$first_category_cloth['id']))->select();
    	//一级分类衣服下的二级分类下的三级分类
    	$i=1;
    	$third_category_clothes=array();
    	foreach ($second_category_clothes as $second_category_cloth) {
    		$third_category_clothes[$i]=$Goods_category->where(array('pid'=>$second_category_cloth['id']))->select();
    		$i++;
    	}
    	//侧边栏导航显示的三级分类衣服
    	$third_rand_clothes=array();		//重组三级分类数组为一个二维数组
    	foreach ($third_category_clothes as $third_category_cloth) {
    		foreach ($third_category_cloth as $cloth) {
    			$third_rand_clothes[]=$cloth;
    		}
    		
    	}
    	//衣服分类赋值到模板
    	$this->first_category_cloth=$first_category_cloth;
    	$this->second_category_clothes=$second_category_clothes;
    	$this->third_category_clothes=$third_category_clothes;
    	$this->third_rand_clothes=$third_rand_clothes;

    	//一级分类鞋子下的二级分类
    	$first_category_shoe=$Goods_category->where(array('name'=>'鞋子'))->find();
    	$second_category_shoes=$Goods_category->where(array('pid'=>$first_category_shoe['id']))->select();
    	//一级分类鞋子下的二级分类下的三级分类
    	$i=1;
    	$third_category_shoes=array();
    	foreach ($second_category_shoes as $second_category_shoe) {
    		$third_category_shoes[$i]=$Goods_category->where(array('pid'=>$second_category_shoe['id']))->select();
    		$i++;
    	}
    	//侧边栏导航栏显示的三级分类鞋子,重组三级分类数组为一个二维数组
    	$third_rand_shoes=array();
    	foreach ($third_category_shoes as $third_category_shoe) {
    		foreach ($third_category_shoe as $shoe) {
    			$third_rand_shoes[]=$shoe;
    		}
    	}
    	//鞋子分类赋值到模板
    	$this->first_category_shoe=$first_category_shoe;
    	$this->second_category_shoes=$second_category_shoes;
    	$this->third_category_shoes=$third_category_shoes;
    	$this->third_rand_shoes=$third_rand_shoes;


    	//一级分类包包下的二级分类
    	$first_category_baobao=$Goods_category->where(array('name'=>'包包'))->find();
    	$second_category_baobaos=$Goods_category->where(array('pid'=>$first_category_baobao['id']))->select();
    	//一级分类包包下的二级分类下的三级分类
    	$i=1;
    	$third_category_baobaos=array();
    	foreach ($second_category_baobaos as $second_category_baobao) {
    		$third_category_baobaos[$i]=$Goods_category->where(array('pid'=>$second_category_baobao['id']))->select();
    		$i++;
    	}
    	//侧边栏导航栏显示的三级分类包包，重组三级分类数组为一个二维数组
    	$third_rand_baobaos=array();
    	foreach ($third_category_baobaos as $third_category_baobao) {
    		foreach ($third_category_baobao as $baobao) {
    			$third_rand_baobaos[]=$baobao;
    		}
    	}
    	//包包分类赋值到模板
    	$this->first_category_baobao=$first_category_baobao;
    	$this->second_category_baobaos=$second_category_baobaos;
    	$this->third_category_baobaos=$third_category_baobaos;
    	$this->third_rand_baobaos=$third_rand_baobaos;


    	//一级分类配饰下的二级分类
    	$first_category_peishi=$Goods_category->where(array('name'=>'配饰'))->find();
    	$second_category_peishis=$Goods_category->where(array('pid'=>$first_category_peishi['id']))->select();
    	//一级分类配饰下的二级分类下的三级分类
    	$i=1;
    	$third_category_peishis=array();
    	foreach ($second_category_peishis as $second_category_peishi) {
    		$third_category_peishis[$i]=$Goods_category->where(array('pid'=>$second_category_peishi['id']))->select();
    		$i++;
    	}
    	//侧边栏导航栏显示的三级分类配饰，重组三级分类数组为一个二维数组
    	$third_rand_peishis=array();
    	foreach ($third_category_peishis as $third_category_peishi) {
    		foreach ($third_category_peishi as $peishi) {
    			$third_rand_peishis[]=$peishi;
    		}
    	}
    	//配饰分类赋值到模板
    	$this->first_category_peishi=$first_category_peishi;
    	$this->second_category_peishis=$second_category_peishis;
    	$this->third_category_peishis=$third_category_peishis;
    	$this->third_rand_peishis=$third_rand_peishis;


    	$Goods=M('Goods');
    	//人气推荐单品（输出浏览量最大的前12件衣服）
    	$popular_clothes_goods=$Goods->where(array('first_category'=>$first_category_cloth['id'],'is_sale'=>1,'sex'=>0))->order('-views')->limit(C('POPULAR_CLOTHES_NUM'))->select();
    	$this->popular_clothes_goods=$popular_clothes_goods;


    	//衣服（输出八件最新上架的衣服），右侧输出最热衣服
    	$new_clothes_goods=$Goods->where(array('first_category'=>$first_category_cloth['id'],'is_sale'=>1,'sex'=>0))->order('-add_time')->limit(C('INDEX_GOODS_SHOW'))->select();
    	$hot_clothes_goods=$Goods->where(array('first_category'=>$first_category_cloth['id'],'is_sale'=>1,'sex'=>0))->order('-sales')->limit(C('INDEX_GOODS_HOT'))->select();
    	$this->new_clothes_goods=$new_clothes_goods;
    	$this->hot_clothes_goods=$hot_clothes_goods;

    	//鞋子（输出八双最新上架的鞋子），右侧输出最热鞋子
    	$new_shoes_goods=$Goods->where(array('first_category'=>$first_category_shoe['id'],'is_sale'=>1,'sex'=>0))->order('-add_time')->limit(C('INDEX_GOODS_SHOW'))->select();
    	$hot_shoes_goods=$Goods->where(array('first_category'=>$first_category_shoe['id'],'is_sale'=>1,'sex'=>0))->order('-sales')->limit(C('INDEX_GOODS_HOT'))->select();
    	$this->new_shoes_goods=$new_shoes_goods;
    	$this->hot_shoes_goods=$hot_shoes_goods;

    	//包包（输出八个最新上架的包包），右侧输出最热包包
    	$new_baobaos_goods=$Goods->where(array('first_category'=>$first_category_baobao['id'],'is_sale'=>1,'sex'=>0))->order('-add_time')->limit(C('INDEX_GOODS_SHOW'))->select();
    	$hot_baobaos_goods=$Goods->where(array('first_category'=>$first_category_baobao['id'],'is_sale'=>1,'sex'=>0))->order('-sales')->limit(C('INDEX_GOODS_HOT'))->select();
    	$this->new_baobaos_goods=$new_baobaos_goods;
    	$this->hot_baobaos_goods=$hot_baobaos_goods;

    	//配饰（输出八件最新上架的配饰），右侧输出最热配饰
    	$new_peishis_goods=$Goods->where(array('first_category'=>$first_category_peishi['id'],'is_sale'=>1,'sex'=>0))->order('-add_time')->limit(C('INDEX_GOODS_SHOW'))->select();
    	$hot_peishis_goods=$Goods->where(array('first_category'=>$first_category_peishi['id'],'is_sale'=>1,'sex'=>0))->order('-sales')->limit(C('INDEX_GOODS_HOT'))->select();
    	$this->new_peishis_goods=$new_peishis_goods;
    	$this->hot_peishis_goods=$hot_peishis_goods;

    	$this->display();
    }
}
<?php
namespace Home\Controller;
use Think\Controller;
/*
后台主界面控制器
 */
class IndexController extends CommonController {
    public function index(){
    	$this->display();
    }

    //首页显示
    public function message(){
    	
    	$this->display();
    }
}
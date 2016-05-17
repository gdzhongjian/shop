<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>网上服饰购物系统</title>
    <meta name="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统后台">

    <link rel="shortcut icon" href="/shop/Public/admin/favicon.ico">
    <link href="/shop/Public/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/shop/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/shop/Public/admin/css/animate.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
           
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <?php if(($level) == "1"): ?><li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">编辑商品一级分类</a>
                            </li><?php endif; ?>
                        <?php if(($level) == "2"): ?><li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="false">编辑商品二级分类</a>
                            </li><?php endif; ?>
                        <?php if(($level) == "3"): ?><li class="active"><a data-toggle="tab" href="#tab-3" aria-expanded="false">编辑商品三级分类</a>
                            </li><?php endif; ?>
                        <?php if(($level) == "4"): ?><li class="active"><a data-toggle="tab" href="#tab-4" aria-expanded="false">编辑商品品牌名称</a>
                            </li><?php endif; ?>
                    </ul>
                    <div class="tab-content">
                        <?php if(($level) == "1"): ?><div id="tab-1" class="tab-pane active">
                        <?php else: ?>
                        <div id="tab-1" class="tab-pane"><?php endif; ?>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>
                                                编辑商品一级分类
                                            </h5>
                                   
                                        </div>
                               
                                    </div>
                                </div>
                                 <form class="form-horizontal m-t" id="firstForm" action="<?php echo U('category/checkedit',array('level'=>1));?>" method="post">
                                <div class="form-group">
                                <label class="col-sm-3 control-label">商品一级分类名称：</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
                                    <input type="hidden" name="oldname" value="<?php echo ($category["name"]); ?>" id="oldname">
                                    <input id="firstname1" name="firstname1" class="form-control" type="text" value="<?php echo ($category["name"]); ?>">
                                    <span class="help-block m-b-none" id="firsterror1" style="color: red"></span>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" id="first">修改</button>&nbsp;&nbsp;
                                    <a href="<?php echo U('category/index');?>" title="返回" class="btn btn-primary">返回</a>
                                    <noscript id="noscript">您的浏览器禁用了JavaScript脚本，请先设置浏览器允许运行JavaScript</noscript>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                        
                        <?php if(($level) == "2"): ?><div id="tab-2" class="tab-pane active">
                        <?php else: ?>
                        <div id="tab-2" class="tab-pane"><?php endif; ?>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>
                                                编辑商品二级分类
                                            </h5>
                                   
                                        </div>
                               
                                    </div>
                                </div>
                                 <form class="form-horizontal m-t" id="secondForm" action="<?php echo U('category/checkedit',array('level'=>2));?>" method="post">

                                <div class="form-group">
                                <label class="col-sm-3 control-label">商品一级分类名称：</label>
                                    <div class="col-sm-3">
                                        <select class="form-control m-b" name="secondpid" id="secondpid">
                                            <option value="-1">请选择一级分类</option>
                                            <?php if(is_array($firstCategorys)): $i = 0; $__LIST__ = $firstCategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $category['pid']): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <span class="help-block m-b-none" id="seconderror1" style="color: red"></span>
                                        <?php if(($firstCategory) == "false"): ?><span class="help-block m-b-none"><i class="fa fa-info-circle"></i>一级分类必须先创建</span><?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-sm-3 control-label">商品二级分类名称：</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
                                    <input type="hidden" name="oldname" value="<?php echo ($category["name"]); ?>" id="oldname">
                                    <input id="secondname2" name="secondname2" class="form-control" type="text" value="<?php echo ($category["name"]); ?>">
                                    <span class="help-block m-b-none" id="seconderror2" style="color: red"> </span>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" id="second">编辑</button>&nbsp;&nbsp;
                                    <a href="<?php echo U('category/secondlist');?>" title="返回" class="btn btn-primary">返回</a>
                                </div>
                                </div>
                                </form>

                            </div>
                        </div>

                        
                        <?php if(($level) == "3"): ?><div id="tab-3" class="tab-pane active">
                        <?php else: ?>
                        <div id="tab-3" class="tab-pane"><?php endif; ?>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>
                                                编辑商品三级分类
                                            </h5>
                                   
                                        </div>
                               
                                    </div>
                                </div>
                                <form class="form-horizontal m-t" id="thirdForm" method="post" action="<?php echo U('category/checkedit',array('level'=>3));?>">
                                <div class="form-group">
                                <label class="col-sm-3 control-label">商品一级分类名称：</label>
                                    <div class="col-sm-3">
                                        <select class="form-control m-b" name="thirdpid1" id="thirdpid1">
                                            <option value="-1">请选择一级分类</option>
                                            <?php if(is_array($firstCategorys)): $i = 0; $__LIST__ = $firstCategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $first_parent_id): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <span class="help-block m-b-none" id="thirderror1" style="color: red"></span>
                                        <?php if(($firstCategory) == "false"): ?><span class="help-block m-b-none"><i class="fa fa-info-circle"></i>一级分类必须先创建</span><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group"  id="seconddiv">
                                <label class="col-sm-3 control-label">商品二级分类名称：</label>
                                    <div class="col-sm-3">
                                        <select class="form-control m-b" name="thirdpid2" id="thirdpid2">
                                            <option value="-1">请选择二级分类</option>
                                            <?php if(is_array($secondCategorys)): $i = 0; $__LIST__ = $secondCategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $second_parent_id): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                            
                                        </select>
                                        <span class="help-block m-b-none" id="thirderror2" style="color: red"></span>
                                        <?php if(($secondCategory) == "false"): ?><span class="help-block m-b-none"><i class="fa fa-info-circle"></i>二级分类必须先创建</span><?php endif; ?>
                                    </div>                                
                                </div>
                                 <div class="form-group">
                                <label class="col-sm-3 control-label">商品三级分类名称：</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
                                    <input type="hidden" name="oldname" value="<?php echo ($category["name"]); ?>" id="oldname">
                                    <input id="thirdname3" name="thirdname3" class="form-control" type="text" value="<?php echo ($category["name"]); ?>">
                                    <span class="help-block m-b-none" id="thirderror3" style="color: red"> </span>
                                </div>
                            </div>
                                <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" id="third">编辑</button>&nbsp;&nbsp;
                                    <a href="<?php echo U('category/thirdlist');?>" title="返回" class="btn btn-primary">返回</a>
                                </div>
                                </div>
                                </form>

                            </div>
                        </div>

                        <?php if(($level) == "4"): ?><div id="tab-4" class="tab-pane active">
                        <?php else: ?>
                        <div id="tab-4" class="tab-pane"><?php endif; ?>
                                <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>
                                                编辑商品品牌名称
                                            </h5>
                                   
                                        </div>
                               
                                    </div>
                                </div>
                                 <form class="form-horizontal m-t" id="brandForm" method="post" action="<?php echo U('category/checkbrandedit');?>">
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">商品品牌名称：</label>
                                        <div class="col-sm-8">
                                        <input type="hidden" name="id" value="<?php echo ($brand["id"]); ?>">
                                        <input type="hidden" name="oldname" value="<?php echo ($brand["name"]); ?>">
                                            <input id="brandname" name="brandname" class="form-control" type="text" value="<?php echo ($brand["name"]); ?>">
                                            <span class="help-block m-b-none" style="color: red" id="branderror"> </span>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" id="brand">编辑</button>&nbsp;&nbsp;
                                    <a href="<?php echo U('category/brandlist');?>" title="返回" class="btn btn-primary">返回</a>
                                </div>
                                    </div>
                                    </form>
                                </div>
                        </div>


                        


                    </div>


                </div>
            </div>

        </div>
 
       

        
    </div>
    <script src="/shop/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/shop/Public/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/shop/Public/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/shop/Public/admin/js/category/editcategory.js"></script>
    <script type="text/javascript">
           var checkCategory="<?php echo U('category/checkcategory');?>";
           var secondCategoryList="<?php echo U('category/secondcategorylist');?>";
           var checkBrand="<?php echo U('category/checkbrand');?>";
    </script>
    
</body>

</html>
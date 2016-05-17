<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>网上服饰购物系统</title>
    <meta name="keywords" content="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统后台">

    <link rel="shortcut icon" href="/shop/Public/admin/favicon.ico"> 
    <link href="/shop/Public/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/shop/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="/shop/Public/admin/css/animate.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet"><!-- <base target="_blank"> -->
    <link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/page.css">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
           
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo U('category/index');?>">查看商品一级分类</a>
                        </li>
                        <li class=""><a href="<?php echo U('category/secondlist');?>">查看商品二级分类</a>
                        </li>
                        <li class=""><a href="<?php echo U('category/thirdlist');?>">查看商品三级分类</a>
                        </li>
                        <li class=""><a href="<?php echo U('category/brandlist');?>">查看商品品牌名称</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">商品一级分类列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($count); ?>个一级分类</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">名称</th>
                                        <th style="text-align: center;">添加时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($category["name"]); ?></td>
                                        <td style="text-align: center;"><?php echo (date("Y-m-d H:i:s",$category["addtime"])); ?></td>
                                        <td style="text-align: center;">
                                           <a href="<?php echo U('category/edit',array('id'=>$category['id'],'level'=>$category['level']));?>">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                            </a> 
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
                                            <input type="hidden" name="level" value="<?php echo ($category["level"]); ?>">
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                            <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($page); ?>    
                                </div>

                            </div>

                        
                    </div>



                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="col-sm-12">
                                 <div class="panel-heading">
                                        <h3 class="panel-title">商品二级分类列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有1个二级分类</span>    

                                    </div>
                            </div>
                      <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">名称</th>
                                        <th style="text-align: center;">父级名称</th>
                                        <th style="text-align: center;">添加时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">1</span>
                                        </td>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">3</td>
                                        <td style="text-align: center;">4</td>
                                        <td style="text-align: center;">
                                           <a href="#">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                            </a> 
                                            <a href="#">
                                                        <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                              
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                           <div class="btn-group">
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i>
                                </button>
                                <button class="btn btn-white">1</button>
                                <button class="btn btn-white  active">2</button>
                                <button class="btn btn-white">3</button>
                                <button class="btn btn-white">4</button>
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i>
                                </button>
                            </div>

                    </div>

                                
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <div class="col-sm-12">
                                 <div class="panel-heading">
                                        <h3 class="panel-title">商品三级分类列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有1个三级分类</span>    

                                    </div>
                            </div>
                      <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">名称</th>
                                        <th style="text-align: center;">父级名称</th>
                                        <th style="text-align: center;">添加时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">1</span>
                                        </td>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">3</td>
                                        <td style="text-align: center;">4</td>
                                        <td style="text-align: center;">
                                           <a href="#">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                            </a> 
                                            <a href="#">
                                                        <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                              
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                           <div class="btn-group">
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i>
                                </button>
                                <button class="btn btn-white">1</button>
                                <button class="btn btn-white  active">2</button>
                                <button class="btn btn-white">3</button>
                                <button class="btn btn-white">4</button>
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i>
                                </button>
                            </div>

                    </div>

                                
                            </div>
                        </div>

                        <div id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">商品品牌列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有1个品牌</span>    

                                    </div>
                            </div>
                            <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">名称</th>
                                        <th style="text-align: center;">添加时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">1</span>
                                        </td>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">3</td>
                                        <td style="text-align: center;">
                                           <a href="#">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                            </a> 
                                            <a  href="#">
                                                        <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                                 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                           <div class="btn-group">
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i>
                                </button>
                                <button class="btn btn-white">1</button>
                                <button class="btn btn-white  active">2</button>
                                <button class="btn btn-white">3</button>
                                <button class="btn btn-white">4</button>
                                <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i>
                                </button>
                            </div>

                    </div>

                                 
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
    <script src="/shop/Public/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".demo4").click(function(){
                swal({title:"您确定要删除这条分类吗",text:"同时会删除其下的二级分类和三级分类，请谨慎操作！",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的，我要删除！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            var id=$(".demo4").parent().next().val();
                            var level=$(".demo4").parent().next().next().val();
                            var url="<?php echo U('category/delete');?>";
                            $.post(
                                url, 
                                {
                                    id:id,
                                    level:level
                                }, 
                                function(data){
                                    if(data==1){
                                        //删除成功
                                    swal("删除成功！","您已经永久删除了这条分类。","success")
                                    window.location.reload();
                                    }else{
                                        //删除失败
                                    }
                                }
                            );
                        }else{
                            swal("已取消","您取消了删除操作！","error")
                        }})
            })});
    </script>
</body>

</html>
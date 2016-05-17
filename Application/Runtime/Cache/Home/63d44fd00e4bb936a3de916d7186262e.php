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
                        <li class=""><a href="<?php echo U('goods/index');?>">全部商品</a>
                        </li>
                        <li class="active"><a href="<?php echo U('goods/list1');?>">分类商品</a>
                        </li>

                        <li class=""><a href="<?php echo U('goods/appointgoods');?>">查看指定商品</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-2" class="tab-pane active">
                            <div class="panel-body">
                                
                             <div class="col-sm-12">
                                <form action="<?php echo U('goods/categoryselect');?>" method="post" id="form" class="form-horizontal m-t">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">商品一级分类：</label>
                                         <div class="col-sm-8">
                                            <select class="form-control m-b" name="firstcategory" id="firstcategory">
                                                <option value="-1">请选择商品一级分类</option>
                                                <?php if(is_array($firstcategorys)): $i = 0; $__LIST__ = $firstcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value="<?php echo ($category['id']); ?>"><?php echo ($category['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                            <span class="help-block m-b-none" style="color: red" id="error1"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none" id="seconddiv">
                                        <label class="col-sm-3 control-label">商品二级分类：</label>
                                         <div class="col-sm-8">
                                            <select class="form-control m-b" name="secondcategory" id="secondcategory">
                                                
                                            </select>
                                            <span class="help-block m-b-none" style="color: red" id="error2"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none" id="thirddiv">
                                        <label class="col-sm-3 control-label">商品三级分类：</label>
                                         <div class="col-sm-8">
                                            <select class="form-control m-b" name="thirdcategory" id="thirdcategory">
                                                
                                            </select>
                                            <span class="help-block m-b-none" style="color: red" id="error3"></span>
                                        </div>
                                    </div>
                                    <!-- <br><br><br><br><br><br> -->
                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-3">
                                            <button class="btn btn-primary" type="button" id="select">查询</button>
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
 
       

        
    </div>
    <script src="/shop/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/shop/Public/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/shop/Public/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/shop/Public/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
            var secondCategoryList="<?php echo U('category/secondcategorylist');?>";
            var thirdCategoryList="<?php echo U('category/thirdcategorylist');?>";
    </script>
    <script src="/shop/Public/admin/js/goods/list1.js"></script>
    <script>
        $(document).ready(function(){
            $(".demo4").click(function(){
                swal({title:"您确定要删除该商品吗",text:"同时会删除与该商品相关的信息，请谨慎操作！",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的，我要删除！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            var id=$(".demo4").parent().next().val();
                            var url="<?php echo U('goods/deletegoods');?>";
                            $.post(
                                url, 
                                {
                                    id:id,
                                }, 
                                function(data){
                                    if(data==1){
                                        //删除成功
                                    swal("删除成功！","您已经永久删除了该商品。","success")
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
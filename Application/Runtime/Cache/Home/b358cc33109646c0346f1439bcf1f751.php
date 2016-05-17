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
                        <li class="active"><a href="<?php echo U('goods/list1');?>" style="cursor: pointer">分类商品</a>
                        </li>

                        <li class=""><a href="<?php echo U('goods/appointgoods');?>">查看指定商品</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-2" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo ($category["name"]); ?>分类商品列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($count); ?>个商品</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <?php if(empty($goods)): ?>暂无商品
                            <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">名称</th>
                                        <th style="text-align: center;">分类</th>
                                        <th style="text-align: center;">品牌</th>
                                        <th style="text-align: center;">封面</th>
                                        <th style="text-align: center;">销售量</th>
                                        <th style="text-align: center;">添加时间</th>
                                        <th style="text-align: center;">下架</th>
                                        <th style="text-align: center;">查看</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($goods)): $num = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($num % 2 );++$num;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$num)); ?>
                                                <?php else: ?>
                                                    <?php echo ($num); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($vo["first_name"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php echo ($category["name"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i; if($vo['shop_goods_brand_id'] == $brand['id']): echo ($brand["name"]); endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($vo["big_picture"]); ?>" alt="" width="64px" height="64px">
                                        </td>
                                        <td style="text-align: center;"><?php echo ($vo["sales"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($vo['is_sale'] == 1): ?>否
                                            <?php else: ?>
                                                是<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('goods/showpicture',array('goods_id'=>$vo['id']));?>">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-photo"></i> 图片</button>
                                            </a>
                                            <a href="<?php echo U('goods/showstock',array('goods_id'=>$vo['id']));?>">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-inbox"></i> 库存</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                           <a href="<?php echo U('goods/edit',array('goods_id'=>$vo['id']));?>">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                            </a> 
                                            
                                            <?php if($vo['is_sale'] == 1): ?><a  href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm  demo3">下架</button>
                                            </a> 
                                            <?php else: ?>
                                                <a  href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm  demo3">取消下架</button>
                                                </a><?php endif; ?>

                                            <a  href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="goods_id" value="<?php echo ($vo["id"]); ?>">
                                            <input type="hidden" name="is_sale" value="<?php echo ($vo["is_sale"]); ?>">
                                                   
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table><?php endif; ?>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($page); ?>    
                                </div>
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
                var id=$(this).parent().next().val();
                swal({title:"您确定要删除该商品吗",text:"同时会删除与该商品相关的信息，请谨慎操作！",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的，我要删除！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            
                            var url="<?php echo U('goods/deletegoods');?>";
                            $.post(
                                url, 
                                {
                                    id:id
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
            })
            $(".demo3").click(function(){
                var id=$(this).parent().next().next().val();
                var type=$(this).parent().next().next().next().val();
                if(type==1){
                    swal({title:"您确定要下架该商品吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            var url="<?php echo U('goods/notsale');?>";
                            $.post(
                                url, 
                                {
                                    id:id,
                                    type:type
                                }, 
                                function(data){
                                    if(data==1){
                                    swal("下架成功！","","success")
                                    window.location.reload();
                                    }
                                    if(data==2){
                                        swal("上架成功！","","success")
                                        window.location.reload();
                                    }
                                }
                            );
                        }else{
                            swal("已取消","您取消了下架操作！","error")
                        }})
                }else{
                    swal({title:"您确定要上架该商品吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            var url="<?php echo U('goods/notsale');?>";
                            $.post(
                                url, 
                                {
                                    id:id,
                                    type:type
                                }, 
                                function(data){
                                    if(data==1){
                                    swal("下架成功！","","success")
                                    window.location.reload();
                                    }
                                    if(data==2){
                                        swal("上架成功！","","success")
                                        window.location.reload();
                                    }
                                }
                            );
                        }else{
                            swal("已取消","您取消了上架操作！","error")
                        }})
                }
                
            })
});
    </script>
    <script type="text/javascript">
    $(".pages a").on('click',function(){
        var pageObj=this;
        var url=pageObj.href;
        var value="<?php echo ($thirdcategory); ?>";
        url=url+'/thirdcategory/'+value;
        $.ajax({
            url:url,
            type:"get",
            success:function(data){
                $("#tab-2").html(data);
            }
        });
        return false;
    });
</script>
</body>

</html>
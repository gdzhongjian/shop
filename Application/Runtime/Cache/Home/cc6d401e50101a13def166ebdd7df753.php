<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>网上服饰购物系统</title>
    <meta name="keywords" content="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统后台">

    <link rel="shortcut icon" href="favicon.ico"> 
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
                        <li class="active" id="all_user"><a data-toggle="tab" href="#tab-1" aria-expanded="true">管理员列表</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($count); ?>个管理员</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">账号</th>
                                        <th style="text-align: center;">昵称</th>
                                        <th style="text-align: center;">头像</th>
                                        <th style="text-align: center;">管理员级别</th>
                                        <th style="text-align: center;">状态</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($admins)): $i = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($admin["account"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($admin["username"]); ?></td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($admin["headimage"]); ?>" alt="" width="50xp" height="50px">
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($admin['level'] == 1): ?>超级管理员
                                            <?php elseif($admin['level'] == 2): ?>
                                                商品管理员
                                            <?php elseif($admin['level'] == 3): ?>
                                                商品分类管理员
                                            <?php elseif($admin['level'] == 4): ?>
                                                订单管理员
                                            <?php elseif($admin['level'] == 5): ?>
                                                评论管理员
                                            <?php else: ?>
                                                用户管理员<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($admin['status'] == 0): ?>正常
                                            <?php else: ?>
                                                锁定<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($admin['level'] != 1): if($admin['status'] == 0): ?><a href="javascript:void(0)">
                                                    <button class="btn btn-primary btn-sm demo3"><i class="fa fa-lock" name="lock"></i> 锁定</button>
                                                </a> 
                                                <?php elseif($admin['status'] == 1): ?>
                                                <a href="javascript:void(0)">
                                                    <button class="btn btn-primary btn-sm demo3"><i class="fa fa-unlock" name="unlock"></i> 解锁</button>
                                                </a><?php endif; ?>
                                                <a href="javascript:void(0)">
                                                    <button class="btn btn-danger btn-sm demo4"><i class="fa fa-trash-o" name="delete"></i> 删除</button>
                                                </a><?php endif; ?>
                                            <input type="hidden" name="status" value="<?php echo ($admin["status"]); ?>">
                                            <input type="hidden" name="id" value="<?php echo ($admin["id"]); ?>">

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
        $(".demo3").click(function(){
            var status=$(this).parent().next().next().val();
            var id=$(this).parent().next().next().next().val();
            if(status==0){
                //锁定操作
                swal({title:"您确定要锁定该管理员吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                function(isConfirm){
                    if(isConfirm){
                        
                        var url="<?php echo U('auth/lock');?>";
                        $.post(
                            url, 
                            {
                                id:id
                            }, 
                            function(data){
                                if(data==1){
                                swal("锁定管理员成功！","","success")
                                window.location.reload();
                                }else{
                                    //锁定用户失败
                                }
                            }
                        );
                    }else{
                        swal("已取消","您取消了操作！","error")
                    }});
            }else{
                // 解锁操作
                swal({title:"您确定要解锁该管理员吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                function(isConfirm){
                    if(isConfirm){
                        var url="<?php echo U('auth/unlock');?>";
                        $.post(
                            url, 
                            {
                                id:id
                            }, 
                            function(data){
                                if(data==1){
                                swal("解锁管理员成功！","","success")
                                window.location.reload();
                                }else{
                                    //解锁用户失败
                                }
                            }
                        );
                    }else{
                        swal("已取消","您取消了操作！","error")
                    }});
            }
            
        });
         $(".demo4").click(function(){
            var id=$(this).parent().next().next().val();
                //删除操作
                swal({title:"您确定要删除该管理员吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                function(isConfirm){
                    if(isConfirm){
                        
                        var url="<?php echo U('auth/delete');?>";
                        $.post(
                            url, 
                            {
                                id:id
                            }, 
                            function(data){
                                if(data==1){
                                swal("删除管理员成功！","","success")
                                window.location.reload();
                                }else{
                                    //锁定用户失败
                                }
                            }
                        );
                    }else{
                        swal("已取消","您取消了操作！","error")
                    }});
        });
        });
</script>
</body>

</html>
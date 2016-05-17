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
                        <li class="active" id="all_user"><a data-toggle="tab" href="#tab-1" aria-expanded="true">全部用户</a>
                        </li>
                        <li class="" id="unlock_user"><a data-toggle="tab" href="#tab-2" aria-expanded="false">正常用户</a>
                        </li>
                        <li class="" id="lock_user"><a data-toggle="tab" href="#tab-3" aria-expanded="false">锁定用户</a>
                        </li>
                        <li class="" id="inactive_user"><a data-toggle="tab" href="#tab-4" aria-expanded="false">未激活用户</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($count); ?>个用户信息</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">昵称</th>
                                        <th style="text-align: center;">真实姓名</th>
                                        <th style="text-align: center;">性别</th>
                                        <th style="text-align: center;">头像</th>
                                        <th style="text-align: center;">邮箱</th>
                                        <th style="text-align: center;">更多信息</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>

                                <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["nickname"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($user["Userinfo"]["truename"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php if($user['Userinfo']['sex'] == 0): ?>女
                                            <?php elseif($user['Userinfo']['sex'] == 1): ?>
                                            男
                                            <?php else: ?>
                                            保密<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($user["Userinfo"]["headimage"]); ?>" alt="" width="50xp" height="50px">
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["email"]); ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('consumer/moreinformation',array('id'=>$user['id']));?>" title="更多信息" >
                                                <button class="btn btn-primary btn-sm">查看</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($user['status'] == 1): ?><a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-lock" name="lock"></i> 锁定</button>
                                            </a> 
                                            <?php elseif($user['status'] == 2): ?>
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-unlock" name="unlock"></i> 解锁</button>
                                            </a>
                                            <?php else: ?>
                                                未激活<?php endif; ?>
                                            <input type="hidden" name="lock_id" value="<?php echo ($user["id"]); ?>">

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
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($unlock_count); ?>个用户</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">昵称</th>
                                        <th style="text-align: center;">真实姓名</th>
                                        <th style="text-align: center;">性别</th>
                                        <th style="text-align: center;">头像</th>
                                        <th style="text-align: center;">邮箱</th>
                                        <th style="text-align: center;">更多信息</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>

                                <?php if(is_array($unlock_users)): $i = 0; $__LIST__ = $unlock_users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["nickname"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($user["Userinfo"]["truename"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php if($user['Userinfo']['sex'] == 0): ?>女
                                            <?php elseif($user['Userinfo']['sex'] == 1): ?>
                                            男
                                            <?php else: ?>
                                            保密<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($user["Userinfo"]["headimage"]); ?>" alt="" width="50xp" height="50px">
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["email"]); ?></td>
                                        
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('consumer/moreinformation',array('id'=>$user['id']));?>" title="查看更多信息">
                                                <button class="btn btn-primary btn-sm">查看</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($user['status'] == 1): ?><a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-lock" name="lock"></i> 锁定</button>
                                            </a> 
                                            <?php elseif($user['status'] == 2): ?>
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-unlock" name="unlock"></i> 解锁</button>
                                            </a><?php endif; ?>
                                            <input type="hidden" name="lock_id" value="<?php echo ($user["id"]); ?>">

                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($unlock_page); ?>    
                                </div>
                            </div>
                            

                        
                    </div>



                            </div>
                        </div>

                        
                    <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($lock_count); ?>个用户</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">昵称</th>
                                        <th style="text-align: center;">真实姓名</th>
                                        <th style="text-align: center;">性别</th>
                                        <th style="text-align: center;">头像</th>
                                        <th style="text-align: center;">邮箱</th>
                                        <th style="text-align: center;">更多信息</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>

                                <?php if(is_array($lock_users)): $i = 0; $__LIST__ = $lock_users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["nickname"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($user["Userinfo"]["truename"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php if($user['Userinfo']['sex'] == 0): ?>女
                                            <?php elseif($user['Userinfo']['sex'] == 1): ?>
                                            男
                                            <?php else: ?>
                                            保密<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($user["Userinfo"]["headimage"]); ?>" alt="" width="50xp" height="50px">
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["email"]); ?></td>
                                        
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('consumer/moreinformation',array('id'=>$user['id']));?>" title="查看更多信息">
                                                <button class="btn btn-primary btn-sm">查看</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($user['status'] == 1): ?><a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-lock" name="lock"></i> 锁定</button>
                                            </a> 
                                            <?php elseif($user['status'] == 2): ?>
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-unlock" name="unlock"></i> 解锁</button>
                                            </a><?php endif; ?>
                                            <input type="hidden" name="lock_id" value="<?php echo ($user["id"]); ?>">

                                           
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($lock_page); ?>    
                                </div>
                            </div>
                            

                        
                    </div>



                            </div>
                        </div>



                    <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($inactive_count); ?>个用户</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">昵称</th>
                                        <th style="text-align: center;">真实姓名</th>
                                        <th style="text-align: center;">性别</th>
                                        <th style="text-align: center;">头像</th>
                                        <th style="text-align: center;">邮箱</th>
                                        <th style="text-align: center;">更多信息</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>

                                <?php if(is_array($inactive_users)): $i = 0; $__LIST__ = $inactive_users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["nickname"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($user["Userinfo"]["truename"]); ?></td>
                                        <td style="text-align: center;">
                                            <?php if($user['Userinfo']['sex'] == 0): ?>女
                                            <?php elseif($user['Userinfo']['sex'] == 1): ?>
                                            男
                                            <?php else: ?>
                                            保密<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="/shop/Public/<?php echo ($user["Userinfo"]["headimage"]); ?>" alt="" width="50xp" height="50px">
                                        </td>
                                        <td style="text-align: center;"><?php echo ($user["email"]); ?></td>
                                        
                                        
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('consumer/moreinformation',array('id'=>$user['id']));?>" title="查看更多信息">
                                                <button class="btn btn-primary btn-sm">查看</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($user['status'] == 1): ?><a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-lock" name="lock"></i> 锁定</button>
                                            </a> 
                                            <?php elseif($user['status'] == 2): ?>
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-sm demo3"><i class="fa fa-unlock" name="unlock"></i> 解锁</button>
                                            </a> 
                                            <?php else: ?>
                                            未激活<?php endif; ?>
                                            <input type="hidden" name="lock_id" value="<?php echo ($user["id"]); ?>">

                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($inactive_page); ?>    
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
    <script type="text/javascript">
    $(".pages a").on('click',function(){
        var pageObj=this;
        var url=pageObj.href;
        var type=$(".nav-tabs li[class='active']").attr('id');
        url=url+'/type/'+type;
        $.ajax({
            url:url,
            type:"get",
            success:function(data){
                if(type=="all_user"){
                    $("#tab-1").html(data);
                }
                if(type=="unlock_user"){
                    $("#tab-2").html(data);
                }
                if(type=="lock_user"){
                    $("#tab-3").html(data);
                }
                if(type=="inactive_user"){
                    $("#tab-4").html(data);
                }
            }
        });
        return false;
    });
</script>
<script>
    $(document).ready(function(){
        $(".demo3").click(function(){
            var type=$(this).children().attr('name');
            var id=$(this).parent().next().val();
            if(type=="lock"){
                //锁定操作
                swal({title:"您确定要锁定该用户吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                function(isConfirm){
                    if(isConfirm){
                        
                        var url="<?php echo U('consumer/lockuser');?>";
                        $.post(
                            url, 
                            {
                                id:id
                            }, 
                            function(data){
                                if(data==1){
                                swal("锁定用户成功！","","success")
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
                swal({title:"您确定要解锁该用户吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                function(isConfirm){
                    if(isConfirm){
                        var url="<?php echo U('consumer/unlockuser');?>";
                        $.post(
                            url, 
                            {
                                id:id
                            }, 
                            function(data){
                                if(data==1){
                                swal("解锁用户成功！","","success")
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
            
        })
        });
</script>
</body>

</html>
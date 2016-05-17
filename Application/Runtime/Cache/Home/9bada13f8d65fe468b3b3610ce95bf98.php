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
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet">
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
                        <li class="active" id="all_comment"><a data-toggle="tab" href="#tab-1" aria-expanded="true">全部评论</a>
                        </li>
                        <li class="" id="good_comment"><a data-toggle="tab" href="#tab-2" aria-expanded="false">好评</a>
                        </li>
                        <li class="" id="middle_comment"><a data-toggle="tab" href="#tab-3" aria-expanded="false">中评</a>
                        </li>
                        <li class="" id="bad_comment"><a data-toggle="tab" href="#tab-4" aria-expanded="false">差评</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">全部评论列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($all_count); ?>个评论</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">商品</th>
                                        <th style="text-align: center;">分类</th>
                                        <th style="text-align: center;">评论内容</th>
                                        <th style="text-align: center;">评分</th>
                                        <th style="text-align: center;">评论人</th>
                                        <th style="text-align: center;">评论时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($all_comments)): $i = 0; $__LIST__ = $all_comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["first_name"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["category"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["content"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($comment['score'] == 3): ?>好评
                                            <?php elseif($comment['score'] == 2): ?>
                                                中评
                                            <?php else: ?>
                                                差评<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["username"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo (Date("Y-m-d H:i:s",$comment["time"])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a  href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="id" value="<?php echo ($comment["id"]); ?>">
                                                   
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($all_page); ?>    
                                </div>
                            </div>
                            

                        
                    </div>



                            </div>
                        </div>
                        
                    
                    <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">好评列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($good_count); ?>个评论</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">商品</th>
                                        <th style="text-align: center;">分类</th>
                                        <th style="text-align: center;">评论内容</th>
                                        <th style="text-align: center;">评分</th>
                                        <th style="text-align: center;">评论人</th>
                                        <th style="text-align: center;">评论时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($good_comments)): $i = 0; $__LIST__ = $good_comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["first_name"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["category"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["content"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($comment['score'] == 3): ?>好评
                                            <?php elseif($comment['score'] == 2): ?>
                                                中评
                                            <?php else: ?>
                                                差评<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["username"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo (Date("Y-m-d H:i:s",$comment["time"])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a  href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="id" value="<?php echo ($comment["id"]); ?>">
                                                   
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($good_page); ?>    
                                </div>
                            </div>
                            

                        
                    </div>



                            </div>
                        </div>


                    <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">中评列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($middle_count); ?>个评论</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">商品</th>
                                        <th style="text-align: center;">分类</th>
                                        <th style="text-align: center;">评论内容</th>
                                        <th style="text-align: center;">评分</th>
                                        <th style="text-align: center;">评论人</th>
                                        <th style="text-align: center;">评论时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($middle_comments)): $i = 0; $__LIST__ = $middle_comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["first_name"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["category"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["content"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($comment['score'] == 3): ?>好评
                                            <?php elseif($comment['score'] == 2): ?>
                                                中评
                                            <?php else: ?>
                                                差评<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["username"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo (Date("Y-m-d H:i:s",$comment["time"])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a  href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="id" value="<?php echo ($comment["id"]); ?>">
                                                   
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($middle_page); ?>    
                                </div>
                            </div>
                            

                        
                    </div>



                            </div>
                        </div>


                    <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">差评列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($bad_count); ?>个评论</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">商品</th>
                                        <th style="text-align: center;">分类</th>
                                        <th style="text-align: center;">评论内容</th>
                                        <th style="text-align: center;">评分</th>
                                        <th style="text-align: center;">评论人</th>
                                        <th style="text-align: center;">评论时间</th>
                                        <th style="text-align: center;">操作</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($bad_comments)): $i = 0; $__LIST__ = $bad_comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["first_name"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["category"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["content"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($comment['score'] == 3): ?>好评
                                            <?php elseif($comment['score'] == 2): ?>
                                                中评
                                            <?php else: ?>
                                                差评<?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($comment["username"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo (Date("Y-m-d H:i:s",$comment["time"])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a  href="javascript:void(0)">
                                                <button class="btn btn-danger btn-sm  demo4"><i class="fa fa-trash-o"></i> 删除</button>
                                            </a>
                                            <input type="hidden" name="id" value="<?php echo ($comment["id"]); ?>">
                                                   
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="btn-group">
                                <div class="pages">
                                    <?php echo ($bad_page); ?>    
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
                if(type=="all_comment"){
                    $("#tab-1").html(data);
                }
                if(type=="good_comment"){
                    $("#tab-2").html(data);
                }
                if(type=="middle_comment"){
                    $("#tab-3").html(data);
                }
                if(type=="bad_comment"){
                    $("#tab-4").html(data);
                }
            }
        });
        return false;
    });
</script>
    <script>
        $(document).ready(function(){
            $(".demo4").click(function(){
                var id=$(this).parent().next().val();
                swal({title:"您确定要删除该评论吗",text:"",type:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",confirmButtonText:"是的，我要删除！",cancelButtonText:"让我再考虑一下…",closeOnConfirm:false,closeOnCancel:false},
                    function(isConfirm){
                        if(isConfirm){
                            
                            var url="<?php echo U('comment/delete');?>";
                            $.post(
                                url, 
                                {
                                    id:id
                                }, 
                                function(data){
                                    if(data==1){
                                        //删除成功
                                    swal("删除成功！","您已经永久删除了该评论。","success")
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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>网上服饰购物系统</title>
    <meta name="keywords" content="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/shop/Public/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/shop/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="/shop/Public/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/colorpicker//shop/Public/admin/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="/shop/Public/admin/css/animate.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
                    <div class="ibox-content">

                    <div class="col-sm-12">
                        <p>订单处理
                        </p>
                    </div>
                        <form class="form-horizontal m-t" id="signupForm" method="post" action="<?php echo U('order/checkdeal');?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">订单当前状态：</label>
                                 <div class="col-sm-3" id="status">
                                    <?php if($order['status'] == 0): ?>已下单，未付款
                                    <?php elseif($order['status'] == 1): ?>
                                        已付款，未发货
                                    <?php elseif($order['status'] == 2): ?>
                                        已发货，未收货
                                    <?php elseif($order['status'] == 3): ?>
                                        交易完成
                                    <?php elseif($order['status'] == -1): ?>
                                        订单已失效
                                    <?php else: ?>
                                        已退款/退货<?php endif; ?>
                                 </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否发货：</label>
                                <div class="col-sm-3">
                                <div class="ibox-content">
                                 <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" class="onoffswitch-checkbox" id="send_goods">
                                        <label class="onoffswitch-label" for="send_goods">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">请输入快递单号：</label>
                                 <div class="col-sm-8">
                                    <input id="postcode" name="postcode" class="form-control" type="text">
                                    <span class="help-block m-b-none" style="color: red" id="error1"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">请输入快递名称：</label>
                                 <div class="col-sm-8">
                                    <input id="post_type" name="post_type" class="form-control" type="text">
                                    <span class="help-block m-b-none" style="color: red" id="error2"></span>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo ($order["id"]); ?>">
                           
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" id="deal">处理</button>
                                </div>
                            </div>
                        </form>
                    </div>
              
   
        </div>
    </div>
    <script src="/shop/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/shop/Public/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/shop/Public/admin/js/plugins/echarts/echarts-all.js"></script>
    <script src="/shop/Public/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/shop/Public/admin/js/plugins/webuploader/webuploader.min.js"></script>
    <script src="/shop/Public/admin/js/demo/webuploader-demo.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/validate/messages_zh.min.js"></script>
    <script src="/shop/Public/admin/js/demo/echarts-demo.min.js"></script>
    <script src="/shop/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>
    <script type="text/javascript">
            $("#deal").click(function(){
                var check=$("#send_goods").attr('checked');
                var postcode=$("#postcode").val();
                var post_type=$("#post_type").val();
                if(!check){
                    layer.alert('您没有确定发货按钮',{title:"提示"});
                    return;
                }
                if(postcode==""){
                    layer.alert('请输入快递单号',{title:"提示"});
                    return false;
                }
                if(post_type==""){
                    layer.alert('请输入快递名称',{title:"提示"});
                    return false;
                }
                $("#signupForm").submit();
                

            });
            $("#send_goods").click(function(){
                var value=$(this).attr('checked');
                if(!value){
                    $(this).attr('checked','checked');
                }else{
                    $(this).removeAttr('checked');
                }
            });
    </script>
</body>

</html>
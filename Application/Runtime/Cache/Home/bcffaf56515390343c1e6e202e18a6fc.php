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
     <link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/plugins/webuploader/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/shop/Public/admin/css/demo/webuploader-demo.min.css">
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet">


</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
                    <div class="ibox-content">

                    <div class="col-sm-12">
                        <h3>用户详细信息</h3>
                    </div>
                        <form class="form-horizontal m-t" id="signupForm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" value="<?php echo ($user["nickname"]); ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">真实姓名：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["truename"]); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">性别：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php if($user['Userinfo']['sex'] == 0): ?>女<?php elseif($user['Userinfo']['sex'] == 1): ?>男<?php else: ?>保密<?php endif; ?> ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">出生日期：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["birthday"]); ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">邮箱：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["email"]); ?>">
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label class="col-sm-3 control-label">头像：</label>
                                <div class="col-sm-8">
                                    <img src="/shop/Public/<?php echo ($user["Userinfo"]["headimage"]); ?>" alt="" width="50px" height="50px">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">所在地：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["location"]); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">学校：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["school"]); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">工作单位：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["work_unit"]); ?>">
                                </div>
                            </div>
                  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">职业：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["job"]); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">爱好：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text" readonly="readonly" value="<?php echo ($user["Userinfo"]["hobby"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <a href="<?php echo U('consumer/cart',array('id'=>$user['id']));?>" title="查看购物车" 
                                    <button class="btn btn-primary btn-sm">查看购物车</button>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo U('consumer/address',array('id'=>$user['id']));?>" title="查看收货地址" 
                                        <button class="btn btn-primary btn-sm">查看收货地址</button>
                                    </a>  
                                </div>
                            </div>

                 
                        </form>
                    </div>
              
   
        </div>
    </div>
    <script src="/shop/Public/admin/js//jquery.min./shop/Public/admin/js/?v=2.1.4"></script>
    <script src="/shop/Public/admin/js//bootstrap.min./shop/Public/admin/js/?v=3.3.5"></script>
    <script src="/shop/Public/admin/js//plugins/echarts/echarts-all./shop/Public/admin/js/"></script>
    <script src="/shop/Public/admin/js//content.min./shop/Public/admin/js/?v=1.0.0"></script>
    <script type="text/javascript">
        var BASE_URL = '/shop/Public/admin/js//plugins/webuploader';
    </script>
    <script src="/shop/Public/admin/js//plugins/webuploader/webuploader.min./shop/Public/admin/js/"></script>
    <script src="/shop/Public/admin/js//demo/webuploader-demo.min./shop/Public/admin/js/"></script>
    <script src="/shop/Public/admin/js//plugins/validate/jquery.validate.min./shop/Public/admin/js/"></script>
    <script src="/shop/Public/admin/js//plugins/validate/messages_zh.min./shop/Public/admin/js/"></script>
    <script src="/shop/Public/admin/js//demo/echarts-demo.min./shop/Public/admin/js/"></script>
    
    <script src="/shop/Public/admin/js//plugins/iCheck/icheck.min./shop/Public/admin/js/"></script>
</body>

</html>
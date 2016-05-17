<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>网上服饰购物系统</title>
    <meta name="keywords" content="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统后台">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/shop/Public/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/shop/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/shop/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/animate.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>管理员信息<small></small></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">管理员账号：</label>

                                <div class="col-sm-10">
                                    <!-- <input type="text" class="form-control"> -->
                                <label class="control-label"><?php echo ($admin_message["account"]); ?></label>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">管理员昵称：</label>

                                <div class="col-sm-10">
                                    <!-- <input type="text" class="form-control"> -->
                                <label class="control-label"><?php echo ($admin_message["username"]); ?></label>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">上次登录时间：</label>

                                <div class="col-sm-10">
                                    <!-- <input type="text" class="form-control"> -->
                                <label class="control-label"><?php echo (Date("Y-m-d H:i:s",$admin_message["last_time"])); ?></label>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">上次登录IP：</label>

                                <div class="col-sm-10">
                                    <!-- <input type="text" class="form-control"> -->
                                <label class="control-label">
                                    <?php if($admin_message['last_ip'] == '0.0.0.0'): ?>本机地址
                                    <?php else: ?>
                                        <?php echo ($admin_message["last_ip"]); endif; ?>
                                </label>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">上次登录地点：</label>

                                <div class="col-sm-10">
                                    <!-- <input type="text" class="form-control"> -->
                                <label class="control-label">
                                    <?php if($admin_message['last_location'] == 'IANA保留地址'): ?>本地电脑
                                    <?php else: ?>
                                        <?php echo ($admin_message["last_location"]); endif; ?>
                                </label>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="/shop/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/shop/Public/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/shop/Public/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/shop/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>网上服饰购物系统</title>
    <meta name="keywords" content="网上服饰购物系统后台">
    <meta name="description" content="网上服饰购物系统后台">
    <link href="/shop/Public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/shop/Public/admin/css/animate.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/style.min.css" rel="stylesheet">
    <link href="/shop/Public/admin/css/login.min.css" rel="stylesheet">
    <script src="/shop/Public/admin/js/jquery.min.js"></script>
    <script src="/shop/Public/admin/js/login.js"></script>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>
    <script type="text/javascript">
        var checkAccount="<?php echo U('register/checkAccount');?>";
        var verifyUrl="<?php echo U('login/verify');?>";
        var checkVerify="<?php echo U('login/checkByVerify');?>";
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                    </div>
                    <div class="m-b"></div>
                    
                </div>
            </div>
            <div class="col-sm-5" style="color: #373434">
                <form method="post" action="<?php echo U('login/checklogin');?>" id="loginform">
                    <h4 class="no-margins">商城后台登录</h4>
                    <p class="m-t-md">还没有有账号？ <a href="<?php echo U('register/index');?>">立即注册&raquo;</a></p>
                    <input type="text" class="form-control uname" placeholder="账号" name="account" id="account" />
                    <span id="error1" style="color: red"></span>
                    <input type="password" class="form-control pword m-b" placeholder="密码" name="password" id="password" />
                    <span id="error2" style="color: red"></span>
                    <input type="text" class="form-control  m-b" placeholder="验证码" name="verify" id="verify" style="width: 35%" />
                    <img src="<?php echo U('login/verify');?>" alt="验证码" width="135px" style="margin-left: 42%;position:relative;top: -50px;cursor: pointer" title="点击刷新" id="verifyimage">
                    <p id="error3" style="color: red;position: relative;top: -30px"></p>
                    <p style="position: relative;top: -20px">
                    <input type="checkbox" name="remember" id="remember" value="1" checked="checked">&nbsp;记住密码</p>
                    <button class="btn btn-success btn-block" id="login" type="button">登录</button>
                    <noscript id="noscript">您的浏览器禁用了JavaScript脚本，请先设置浏览器允许运行JavaScript</noscript>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
            </div>
        </div>
    </div>
</body>

</html>
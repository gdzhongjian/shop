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
                    
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo ($user["nickname"]); ?>的收货地址</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($count); ?>个收货地址</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">用户名</th>
                                        <th style="text-align: center;">收货人</th>
                                        <th style="text-align: center;">收货地址</th>
                                        <th style="text-align: center;">联系电话</th>
                                        <th style="text-align: center;">邮编</th>
                                        <th style="text-align: center;">是否默认</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                <?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addr): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($user["nickname"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($addr["receiver"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($addr["address"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($addr["phone"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo ($addr["postcode"]); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($addr['status'] == 1): ?>是
                                            <?php else: ?>
                                                否<?php endif; ?>
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
</body>

</html>
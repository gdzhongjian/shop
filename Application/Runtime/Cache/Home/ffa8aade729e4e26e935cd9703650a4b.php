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
    <script type="text/javascript" src="/shop/Public/index/layer/layer.js"></script>
    

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
           
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo U('order/index');?>">全部商品订单</a>
                        </li>
                        <li class=""><a href="<?php echo U('order/list2');?>">查看指定日期订单</a>
                        </li>
                        <li class=""><a href="<?php echo U('order/list3');?>">查看指定订单号</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                
                                <div class="col-sm-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">全部商品订单列表</h3>
                                        <div class="actions pull-right">
                                        <span class="badge badge-danager animated bounceIn">已有<?php echo ($all_count); ?>个订单</span>    

                                    </div>
                            </div>
                        <p></p>
                        <div class="example">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">订单号</th>
                                        <th style="text-align: center;">商品</th>
                                        <th style="text-align: center;">颜色</th>
                                        <th style="text-align: center;">尺寸</th>
                                        <th style="text-align: center;">数量</th>
                                        <th style="text-align: center;">总价(元)</th>
                                        <th style="text-align: center;">运费(元)</th>
                                        <th style="text-align: center;">留言</th>
                                        <th style="text-align: center;">下单人</th>
                                        <th style="text-align: center;">下单时间</th>
                                        <th style="text-align: center;">状态</th>
                                        <th style="text-align: center;">收货地址</th>
                                        <th style="text-align: center;">发货</th>
                                    </tr>
                                                    
                                </thead>
                                <tbody>
                                    <?php if(is_array($all_orders)): $i = 0; $__LIST__ = $all_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="text-align: center;">
                                            <span class="badge badge-primary animated bounceIn">
                                                <?php if($_GET['p']> 0): echo (getnumber($_GET['p'],C('PAGE_SIZE'),$i)); ?>
                                                <?php else: ?>
                                                    <?php echo ($i); endif; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><?php echo ($order["order_code"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["first_name"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["color"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["size"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["nums"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["total"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["yunfei"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["message"]); ?></td>
                                        <td style="text-align: center;"><?php echo ($order["username"]); ?></td>
                                        <td style="text-align: center;"><?php echo (Date("Y-m-d H:i:s",$order["buy_time"])); ?></td>
                                        <td style="text-align: center;">
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
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo U('order/address',array('id'=>$order['address_id'],'name'=>$order['username'],'oid'=>$order['id']));?>">
                                                <button class="btn btn-primary btn-sm"> 查看</button>
                                            </a> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($order['status'] == 1): ?><a href="<?php echo U('order/deal',array('id'=>$order['id']));?>">
                                                <button class="btn btn-primary btn-sm"></i> 发货</button>
                                            </a><?php endif; ?>
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
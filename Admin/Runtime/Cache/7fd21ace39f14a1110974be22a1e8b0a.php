<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>订单</h1>
<div >
    <form action="<?php echo U('Adminstore/goodsorder');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">订单号</option>
            <option value="2">电话</option>
        </select>
    </div>
    <div style="float:left">
        <input type="text" name="find" >
    </div>
    <div>
        <input type="submit" value="搜索">
    </div>
    </form>
</div>
    <!-- <h1>订单</h1> -->

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><br><br>
    <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
    <span>订单号: <?php echo ($vo["ordernum"]); ?>&nbsp;总价:<?php echo ($vo["allprice"]); ?>&nbsp;订单状态:</span>
    <tr>
        <th>商品图片</th>
        <th>商品名</th>
        <th>收货人</th>
        <th>收货地址</th>
        <th>电话</th>
        <th>数量</th>
        <th>价格</th>
        <th>合计</th>
        <th>修改订单状态</th>
    </tr>
    <tr>
        <td><?php echo ($vo["iname"]); ?></td>
        <td><?php echo ($vo["gname"]); ?></td>
        <td><?php echo ($vo["lname"]); ?></td>
        <td><?php echo ($vo["address"]); ?></td>
        <td><?php echo ($vo["phone"]); ?></td>
        <td><?php echo ($vo["qty"]); ?></td>
        <td><?php echo ($vo["price"]); ?></td>
        <td><?php echo ($vo["allprice"]); ?></td>
        <td><button>发货</button>
                    <button>强制收货</button>
                    <button>撤销订单</button>
        </td>
    </tr>
    </table><?php endforeach; endif; else: echo "" ;endif; ?>




</body>
</html>
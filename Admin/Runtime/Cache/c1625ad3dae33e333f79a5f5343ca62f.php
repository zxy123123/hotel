<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>我的订单</h1>
<div >
    <form action="<?php echo U('Store/orders');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">订单编号</option>
            <option value="2">联系电话</option>
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
    <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
    <tr>
        <th>订单编号</th>
        <th>商品图片</th>
        <th>数量</th>
        <th>单价</th>
        <th>联系人</th>
        <th>联系电话</th>
        <th>联系地址</th>
        <th>总计</th>
        <th>订单状态</th>
    </tr>

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($vo["ordernum"]); ?></td>
        <td><img src="<?php echo ($vo["iname"]); ?>" alt=""></td>
        <td><?php echo ($vo["qty"]); ?></td>
        <td><?php echo ($vo["price"]); ?></td>
        <td><?php echo ($vo["lname"]); ?></td>
        <td><?php echo ($vo["phone"]); ?></td>
        <td><?php echo ($vo["address"]); ?></td>
        <td><?php echo ($vo["allprice"]); ?></td>
        <td>
        <?php if($vo["status"] == 0): ?>未发货
        <?php elseif($vo["status"] == 1): ?>已发货
        <?php elseif($vo["status"] == 2): ?>已完成
        <?php else: ?>已失效<?php endif; ?> 
        </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table>
</body>
</html>
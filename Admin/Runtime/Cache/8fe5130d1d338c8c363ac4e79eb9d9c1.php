<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>  
    <a href="<?php echo U('Store/index');?>" style="float:right;background:#f00">继续购物</a>
    <a href="<?php echo U('Store/alldel');?>" style="float:right;background:#E9C341">清空购物车</a>
    <a href="" style="float:right;background:#04D900">总计¥<?php echo ($count); ?>
    </a>
    <a href="<?php echo U('Store/dobuy');?>" style="float:right;background:#1596FA">立刻结算</a>
    <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
            <tr>
                    <th>商品</th>
                    <th>商品名</th>
                    <th>商品价格</th>
                    <th>购买数量</th>
                    <th>小计</th>
                    <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><img src="<?php echo ($vo["iname"]); ?>" alt=""></td>
                    <td><a href="<?php echo U('Store/gooddetail');?>?id=<?php echo ($vo["iid"]); ?>"><?php echo ($vo["gname"]); ?></a></td>
                    <td><?php echo ($vo["price"]); ?></td>
                    <td><?php echo ($vo["qty"]); ?></td>
                    <td><?php echo ($vo[price] * $vo[qty]); ?></td>
                    <td><a href="<?php echo U('Store/del');?>?id=<?php echo ($vo["id"]); ?>">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>

</body>
</html>
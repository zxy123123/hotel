<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>商品管理</h1>
<div >
    <form action="<?php echo U('Adminstore/goods');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">商品名</option>
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
        <table  border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
        <tr>
            <th>id</th>
            <th>商品名</th>
            <th style="width:60px">商品信息</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>库存</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["gid"]); ?></td>
            <td ><img src="<?php echo ($vo["iname"]); ?>" alt="">&nbsp;&nbsp;<?php echo ($vo["gname"]); ?></td>
            <td style="width:60px"><?php echo ($vo["msg"]); ?></td>
            <td><?php echo ($vo["cname"]); ?></td>
            <td><?php echo ($vo["price"]); ?></td>
            <td><?php echo ($vo["stock"]); ?></td>
            <td><a href="<?php echo U('Adminstore/editgoods');?>?id=<?php echo ($vo["gid"]); ?>">商品信息编辑</a>
                    <a href="<?php echo U('Adminstore/editimgs');?>?id=<?php echo ($vo["gid"]); ?>">图片信息编辑</a>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>        
    </table>
</body>
</html>
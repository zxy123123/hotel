<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>分类管理</h1>
    <table  border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
    <tr>
        <th>id</th>
        <th>分类名</th>
        <th>PID</th>
        <th>PATH</th>
        <th>相关操作&nbsp;<a href="<?php echo U('Adminstore/category');?>?pid=<?php echo ($row['pid']); ?>">返回</a></th>
    </tr>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["cname"]); ?></td>
        <td><?php echo ($vo["pid"]); ?></td>
        <td><?php echo ($vo["path"]); ?></td>
        <td>
        <a href="<?php echo U('Adminstore/category');?>?pid=<?php echo ($vo["id"]); ?>">查看子类</a>&nbsp;
        <a href="<?php echo U('Adminstore/addcatechrild');?>?pid=<?php echo ($vo["id"]); ?>&path=<?php echo ($vo["path"]); ?>">添加子类</a>&nbsp;
        <a href="<?php echo U('Adminstore/editcate');?>?id=<?php echo ($vo["id"]); ?>">编辑</a>&nbsp;
        <a href="<?php echo U('Adminstore/delcate');?>?id=<?php echo ($vo["id"]); ?>&pid=<?php echo ($vo["pid"]); ?>&path=<?php echo ($vo["path"]); ?>">删除</a>&nbsp;
        </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
<title>后台管理</title>
</head>
<body>
<div >
<!--     <form action="<?php echo U('Order/index');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">电话</option>
        </select>
    </div>
    <div style="float:left">
        <input type="text" name="hotel" >
    </div>
    <div>
        <input type="submit" value="搜索">
    </div>
    </form> -->
</div>

	<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th >用户名</th>
				<th>酒店号码</th>
				<th>酒店名称</th>
				<th >操作</th>
			</tr> 
                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td ><?php echo ($vo["han"]); ?></td>
				<td><?php echo ($vo["at"]); ?></td>
				<td><?php echo ($vo["hn"]); ?></td>
				<td >
                                                    <a href="<?php echo U('Auser/edit');?>?id=<?php echo ($vo["aid"]); ?>">编辑</a>
                                                    <a href="<?php echo U('Auser/del');?>?id=<?php echo ($vo["aid"]); ?>">删除</a>
                                                    </td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>



	<script>


	</script>









</body>
</html>
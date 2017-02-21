<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>

<title>后台管理</title>
</head>
<body>
<div class="easyui-panel" data-options="fit:true">
<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th  width="250" align="center">姓名</th>
				<th  width="200" align="center">联系方式</th>
				<th  width="200" align="center">酒店名称</th>
				<th  width="200" align="center">酒店地址</th>
				<th  width="200" align="center">电子邮箱</th>
				<th  width="200" align="center">酒店管理系统使用情况</th>
			</tr>

			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td width="250" align="center"><?php echo ($vo["name"]); ?></th>
				<td width="250" align="center"><?php echo ($vo["phone"]); ?></th>
				<td width="250" align="center"><?php echo ($vo["hotel_name"]); ?></th>
				<td width="250" align="center"><?php echo ($vo["hotel_address"]); ?></th>
				<td width="250" align="center"><?php echo ($vo["email"]); ?></th>
				<td width="250" align="center">
				<?php if(($vo["platform"] == zlm)): ?>住了吗酒店管理系统
				<?php elseif($vo["platform"] == others): ?>其他酒店管理系统
				<?php else: ?> 没有使用酒店管理系统<?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>

	
</div>
</body>

	<script>

	</script>

</html>
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
	<table class="easyui-datagrid" id="datagrid_Order" data-options="url:'__APP__/Credit/getScore',method:'post',pagination:true,fit:true,toolbar:'#toolbar',rownumbers:true,checkOnSelect: true">
		<thead>
			<tr>
				<th data-options="field:'hotel_name',sortable: true" width="250" align="center">贡献酒店名</th>
				<th data-options="field:'order_number',sortable: true" width="200" align="center">贡献订单数</th>
				<th data-options="field:'total_score',sortable: true" width="200" align="center">贡献金币数</th>
				
			</tr>
		</thead>
	</table>

	
</div>

    
   
       
   
</body>
</html>
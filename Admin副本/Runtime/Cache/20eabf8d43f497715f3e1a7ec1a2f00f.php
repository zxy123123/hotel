<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="keywords" content="">
<meta http-equiv="description" content="easyui示例项目">
<title>住了酒店后台管理系统</title>
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css">
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>

</head>
<body class="easyui-layout">
	<div data-options="region:'north',href:'__APP__/Layout/north',border : false," id="top_image" style="height:65px;overflow:hidden;"></div>
	<div id="layoutMenu" data-options="region:'west',title:'主菜单',href:'__APP__/Layout/west',iconCls:'icon-dhcd'"  split="true" style="width:210px;overflow: hidden;"></div>
	<div data-options="region:'center',title:'',href:'__APP__/Layout/center'" style="overflow: hidden;"></div>
	
</body>
</html>
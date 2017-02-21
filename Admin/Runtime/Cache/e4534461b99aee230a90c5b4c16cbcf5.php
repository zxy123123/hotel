<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Tsys管理系统">
	<title>后台管理</title>
    <link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
</head>

<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" />
<script src="__PUBLIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/layer/layer.js" type="text/javascript"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
<body>
<div class="easyui-panel" fit="true">
<center><form action="<?php echo U('Auser/doedit');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit = "return check()">
	<input name="id" type="hidden" value="<?php echo ($list["aid"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				用户名:
			</td>
			<td width="250">
				<input name="name" style="width: 250px" value="<?php echo ($list["han"]); ?>" id="name"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店名称:
			</td>
			<td width="250">
				<input name="hotelname" style="width: 250px" value="<?php echo ($list["hn"]); ?>" id="hotelname"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right" >
				密码:
			</td>
			<td width="250">
				<input type="password" name="pwd" placeholder="如不修改请勿输入" 
					style="width: 250px" id="pwd"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店电话：
			</td>
			<td width="250">
				<input name="phone" style="width: 250px" value="<?php echo ($list["at"]); ?>" id="phone"/>
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
	 <center><input type="submit" value="修改"></center>
<!-- 		<a href="" class="easyui-linkbutton" style="width:80px" ">修改</a> -->
	</div>
	</form></center>


</script>

<script type="text/javascript">
	function check()
	{
		if ($('#name').val() == '') 
		{
			layer.msg('请输入用户名');
			setTimeout(function(){
				$('#name').focus();
			});
			return false;
		}else if($('#hotelname').val() == ''){
			layer.msg('请输入酒店名称');
			setTimeout(function(){
				$('#hotelname').focus();
			});
			return false;
		}else if($('#phone').val() == ''){
			layer.msg('请输入酒店电话');
			setTimeout(function(){
				$('#phone').focus();
			});
			return false;
		}else{
			return true;
		}
	}


</script>

</body>
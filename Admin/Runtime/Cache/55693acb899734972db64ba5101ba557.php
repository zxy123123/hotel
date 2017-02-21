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
<center><form action="<?php echo U('Auser/doadd');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit = "return check()">
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				用户名:
			</td>
			<td width="250">
				<input name="name" style="width: 250px" id="name"/>
				<span class="uname"></span>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店名称:
			</td>
			<td width="250">
				<input name="hotelname" style="width: 250px"  id="hotelname"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right" >
				密码:
			</td>
			<td width="250">
				<input type="password" name="pwd" 
					style="width: 250px" id="pwd"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店电话：
			</td>
			<td width="250">
				<input name="phone" style="width: 250px" id="phone"/>
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
	 <center><input type="submit" value="添加"></center>
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
		}
		if ($('.uname').text() == '×') 
		{
			layer.msg('用户名有误');
			setTimeout(function(){
				$('#name').focus();
			});
			return false;
		}
		if($('#hotelname').val() == ''){
			layer.msg('请输入酒店名称');
			setTimeout(function(){
				$('#hotelname').focus();
			});
			return false;
		}
		 if($('#pwd').val() == ''){
			layer.msg('请输入密码');
			setTimeout(function()
			{
				$('#pwd').focus();
			});
			return false;
		}
		if($('#phone').val() == ''){
			layer.msg('请输入酒店电话');
			setTimeout(function(){
				$('#phone').focus();
			});
			return false;
		}
	}

	$('#name').blur(function(){
	var username = $(this).val();

	$.ajax({
		type:"post",
		url:"<?php echo U('Auser/username');?>",
		data:{'name':username},
		dataType:"json",
		success:function(data){
			if (data == 1) 
			{
				layer.msg('用户名已存在');
			        	$('.uname').attr({style:"font-size:20px;color:red"});
       				$('.uname').text('×');
			}else{
       				$('.uname').text('');
			}
		}
	})

	})






</script>

</body>
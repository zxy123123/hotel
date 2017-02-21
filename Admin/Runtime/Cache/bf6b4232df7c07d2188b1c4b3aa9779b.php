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
<body>
<div class="easyui-panel" fit="true">
<form action="<?php echo U('Goods/doedit');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit="return check()">
<input name="type_id" type="hidden" value="<?php echo ($list["id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间名称：
			</td>
			<td width="250">
				<input name="type_name"  style="width: 250px" value="<?php echo ($list["display_name"]); ?>" id="name"/>
			</td>
		</tr>

		<tr style="height: 50px;">
			<td width="100" align="right">
				房间大小：
			</td>
			<td width="250">
				<input name="room_area"  style="width: 250px" value="<?php echo ($list["area"]); ?>" id="area"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间价格 ：
			</td>
			<td width="250">
				<input name="room_price"  style="width: 250px" value="<?php echo ($list["price"]); ?>" id="price"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间数量：
			</td>
			<td width="250">
				<input name="count_num"  style="width: 250px" value="<?php echo ($list["count_num"]); ?>" id="count"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				可住人数：
			</td>
			<td width="250">
				<input name="people_num"  style="width: 250px" value="<?php echo ($list["people_num"]); ?>" id="peobun"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间所在楼层：
			</td>
			<td width="250">
				<input name="floors"  style="width: 250px" value="<?php echo ($list["floors"]); ?>" id="floor"/>
			</td>
		</tr>
<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				房间类型：
			</td>
			<td width="250" align="left">
			<select name="room_type" style="width:100px">
				<option value="2" <?php if($list["room_type"] == '2'): ?>selected<?php endif; ?>>标准型</option>
				<option value="3" <?php if($list["room_type"] == '3'): ?>selected<?php endif; ?>>豪华型</option>
				<option value="4" <?php if($list["room_type"] == '4'): ?>selected<?php endif; ?>>奢靡型</option>
				<option value="5" <?php if($list["room_type"] == '5'): ?>selected<?php endif; ?>>总统型</option>
			</select>
			</td>
		</tr>	 -->
		<tr style="height: 50px;">
			<td width="100" align="right">
				有无早餐：
			</td>
			<td width="250" align="left">
			<select name="breakfast" style="width:100px">
				<option value="0" <?php if($list["breakfast"] == '0'): ?>selected<?php endif; ?>>无</option>
				<option value="1" <?php if($list["breakfast"] == '1'): ?>selected<?php endif; ?>>有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				可否加床：
			</td>
			<td width="250" align="left">
			<select name="bed_add" style="width:100px">
				<option value="0" <?php if($list["bed_add"] == '0'): ?>selected<?php endif; ?>>可以</option>
				<option value="1" <?php if($list["bed_add"] == '1'): ?>selected<?php endif; ?>>不可以</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				加床价格：
			</td>
			<td width="250">
				<input name="bed_add_price"  style="width: 250px" value="<?php echo ($list["bed_add_price"]); ?>" id="bedadd"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				单床大小：
			</td>
			<td width="250">
				<input name="bed_area"  style="width: 250px" value="<?php echo ($list["bed_area"]); ?>" id="bedarea"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				可否吸烟：
			</td>
			<td width="250" align="left">
			<select name="smoke" style="width:100px">
				<option value="0" <?php if($list["smoke"] == '0'): ?>selected<?php endif; ?>>可以</option>
				<option value="1" <?php if($list["smoke"] == '1'): ?>selected<?php endif; ?>>不可以</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				是否有热水：
			</td>
			<td width="250" align="left">
			<select name="hot_water" style="width:100px">
				<option value="0" <?php if($list["hot_water"] == '0'): ?>selected<?php endif; ?>>有</option>
				<option value="1" <?php if($list["hot_water"] == '1'): ?>selected<?php endif; ?>>没有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				是否有空调：
			</td>
			<td width="250" align="left">
			<select name="air_conditioner" style="width:100px">
				<option value="0" <?php if($list["air_conditioner"] == '0'): ?>selected<?php endif; ?>>有</option>
				<option value="1" <?php if($list["air_conditioner"] == '1'): ?>selected<?php endif; ?>>没有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				无线网络：
			</td>
			<td width="250" align="left">
			<select name="internet" style="width:100px">
				<option value="none" <?php if($list["internet"] == 'none'): ?>selected<?php endif; ?>>无</option>
				<option value="wifi" <?php if($list["internet"] == 'wifi'): ?>selected<?php endif; ?>>wifi</option>
				<option value="broadband" <?php if($list["internet"] == 'broadband'): ?>selected<?php endif; ?>>broadband</option>
			</select>
			</td>
		</tr>	
<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				容纳人数：
			</td>
			<td width="250" align="left" >
			<select name="people_num" style="width:100px">
				<option value="1" <?php if($list["person"] == '1'): ?>selected<?php endif; ?>>1</option>
				<option value="2" <?php if($list["person"] == '2'): ?>selected<?php endif; ?>>2</option>
			</select>
			</td>
		</tr> -->
	</table>
	 <div style="text-align:left;padding:20px;">
		<input type="submit" value="修改">
	</div>
	</form>
</div>
<script type="text/javascript">
	function check()
	{
		if ($('#name').val() == '') 
		{
			layer.msg('请输入房间名称');
			setTimeout(function(){
				$('#name').focus();
			});
			return false;
		}else if($('#area').val() == ''){
			layer.msg('请输入房间大小');
			setTimeout(function(){
				$('#area').focus();
			});
			return false;
		}else if($('#price').val() == ''){
			layer.msg('请输入房间价格');
			setTimeout(function(){
				$('#price').focus();
			});
			return false;
		}else if($('#count').val() == ''){
			layer.msg('请输入房间数量');
			setTimeout(function(){
				$('#count').focus();
			});
			return false;
		}else if($('#peobun').val() == ''){
			layer.msg('请输入可住人数');
			setTimeout(function(){
				$('#peobun').focus();
			});
			return false;
		}else if($('#floor').val() == ''){
			layer.msg('请输入所在楼层');
			setTimeout(function(){
				$('#floor').focus();
			});
			return false;
		}else{
			return true;
		}
	}

</script>
<!-- <script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script> -->
</body>
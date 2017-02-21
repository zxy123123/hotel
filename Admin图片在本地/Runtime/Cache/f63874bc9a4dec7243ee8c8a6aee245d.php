<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
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
<form action="<?php echo U('Goods/doadd');?>" id="addForm" method="post" enctype="multipart/form-data" onsubmit="return check()">
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间名称：
			</td>
			<td width="250">
				<input name="type_name" 
					style="width: 250px" value="" id="name"/>
			</td>
		</tr>

		<tr style="height: 50px;">
			<td width="100" align="right">
				房间价格：
			</td>
			<td width="250">
				<input name="room_price" 
					style="width: 250px" value=""/ id="price">
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间数量：
			</td>
			<td width="250">
				<input name="room_count" 
					style="width: 250px" value="" id="count"/>
			</td>
		</tr>
		
		<tr style="height: 50px;">
			<td width="100" align="right">
				床位类型 ：
			</td>
			<td width="250">
				<input name="bed_type" 
					style="width: 250px" value="" id="bedtype"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间大小：
			</td>
			<td width="250">
				<input name="room_area"
					style="width: 250px" value="" id="roombs"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				容纳人数：
			</td>
			<td width="250">
				<input name="people_num"
					style="width: 250px" value="" id="peoplenum"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间所在楼层：
			</td>
			<td width="250">
				<input name="floors"
					style="width: 250px" value="" id="floor"/>
			</td>
		</tr>
		


<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				房间类型：
			</td>
			<td width="250" align="left">
			<select name="room_type" style="width:100px">
				<option value="2">标准型</option>
				<option value="3">豪华型</option>
				<option value="4">奢靡型</option>
				<option value="5">总统型</option>
			</select>
			</td>
		</tr>	 -->
		<tr style="height: 50px;">
			<td width="100" align="right">
				有无早餐：
			</td>
			<td width="250" align="left">
			<select name="breakfast" style="width:100px">
				<option value="0">无</option>
				<option value="1">有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				可否加床：
			</td>
			<td width="250" align="left">
			<select name="bed_add" style="width:100px">
				<option value="0">可以</option>
				<option value="1">不可以</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				加床价格：
			</td>
			<td width="250">
				<input name="addprice" 
					style="width: 250px" value="" id="addbed"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				单床大小：
			</td>
			<td width="250">
				<input name="bed_area" 
					style="width: 250px" value="" id="bedarea"/>
			</td>
		</tr>

		<tr style="height: 50px;">
			<td width="100" align="right">
				可否吸烟：
			</td>
			<td width="250" align="left">
			<select name="smoke" style="width:100px">
				<option value="0">可以</option>
				<option value="1">不可以</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				是否有热水：
			</td>
			<td width="250" align="left">
			<select name="hot_water" style="width:100px">
				<option value="0">有</option>
				<option value="1">没有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				是否有空调：
			</td>
			<td width="250" align="left">
			<select name="air_conditioner" style="width:100px">
				<option value="0">有</option>
				<option value="1">没有</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				无线网络：
			</td>
			<td width="250" align="left">
			<select name="internet" style="width:100px">
				<option value="none">无</option>
				<option value="wifi">wifi</option>
				<option value="broadband">broadband</option>
			</select>
			</td>
		</tr>	
		
		<tr style="height: 50px;">
			<td align="right">
				图片上传：
			</td>
			<td>
				<input id="picture" name="file_upload" type="file" multiple="false">
				<div id="up_image" class="image">
				</div>
			</td>
		</tr>
	</table>

	 <div style="text-align:left;padding:20px;">
	<input type="submit" value="添加">
	
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
		}else if($('#price').val() == ''){
			layer.msg('请输入房间价格');
			setTimeout(function(){
				$('#price').focus();
			});
			return false;
		}else if($('#count').val() == ''){
			layer.msg('请输入床位数量');
			setTimeout(function(){
				$('#count').focus();
			});
			return false;
		}else if($('#bedtype').val() == ''){
			layer.msg('请输入床位类型');
			setTimeout(function(){
				$('#bedtype').focus();
			});
			return false;
		}else if($('#roombs').val() == ''){
			layer.msg('请输入房间大小');
			setTimeout(function(){
				$('#roombs').focus();
			});
			return false;
		}else if($('#peoplenum').val() == ''){
			layer.msg('请输入容纳人数');
			setTimeout(function(){
				$('#peoplenum').focus();
			});
			return false;
		}else if($('#floor').val() == ''){
			layer.msg('请输入房间所在楼层');
			setTimeout(function(){
				$('#floor').focus();
			});
			return false;
		}else{
			return true;
		}
	}

</script>

</body>
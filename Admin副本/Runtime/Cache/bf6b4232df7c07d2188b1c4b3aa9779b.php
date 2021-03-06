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
<body>
<div class="easyui-panel" fit="true">
<form id="editForm" method="post" enctype="multipart/form-data">
<input name="type_id" type="hidden" value="<?php echo ($list["id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间名称：
			</td>
			<td width="250">
				<input name="type_name" 
					style="width: 250px" value="<?php echo ($list["name"]); ?>" id="name"/>
			</td>
		</tr>

		<tr style="height: 50px;">
			<td width="100" align="right">
				房间大小：
			</td>
			<td width="250">
				<input name="room_area" class="easyui-validatebox textbox" required missingmessage="大小不能为空"
					style="width: 250px" value="<?php echo ($list["area"]); ?>" id="area"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				床位类型：
			</td>
			<td width="250">
				<input name="bed_type" class="easyui-validatebox textbox" required missingmessage="类型不能为空"
					style="width: 250px" value="<?php echo ($list["display_name"]); ?>" id="type"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间价格 ：
			</td>
			<td width="250">
				<input name="room_price" class="easyui-validatebox textbox" required missingmessage="价格不能为空"
					style="width: 250px" value="<?php echo ($list["price"]); ?>" id="price"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间数量：
			</td>
			<td width="250">
				<input name="room_count" class="easyui-validatebox textbox" required missingmessage="库存不能为空"
					style="width: 250px" value="<?php echo ($list["room_count"]); ?>" id="count"/>
			</td>
		</tr>

		<tr style="height: 50px;">
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
		</tr>	
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
		<tr style="height: 50px;">
			<td width="100" align="right">
				容纳人数：
			</td>
			<td width="250" align="left" >
			<select name="people_num" style="width:100px">
				<option value="1" <?php if($list["person"] == '1'): ?>selected<?php endif; ?>>1</option>
				<option value="2" <?php if($list["person"] == '2'): ?>selected<?php endif; ?>>2</option>
			</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td align="right">
				图片上传：
			</td>
			<td>
				<input id="up_file_upload" name="file_upload" type="file" multiple="false">
				<div id="up_image" class="image">
				</div>
				<input type="hidden" id="url" value="__URL__">
				<input type="hidden" id="root" value="__ROOT__">
				<input type="hidden" id="public" value="__PUBLIC__">
				<input id="hiddenimgpath" name="picture" type="hidden" />
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
		<a href="javascript:void(0);" class="easyui-linkbutton" style="width:80px" onclick="submitForm()">修改</a>
	</div>
	</form>
</div>
<script type="text/javascript">
	function submitForm(){
		var isClickOk = true;
		$.messager.defaults={ok:"确定",cancel:"取消"}; 
		$.messager.confirm('Confirm', '您确定修改?', function(r){
			if (r){
				$('#editForm').form('submit',{
					url:"__APP__/Goods/edit",
					onSubmit: function(){
						if(isClickOk==false){
							$.messager.alert('操作提示', '主键不能重复！','error');
							return false;
						}else if ($('#editForm').form('validate')) {
							$.messager.alert('操作提示', '修改成功','info');
							//parent.$.dialog({id: 'test123'}).close();
							return true;
						}else{
							$.messager.alert('操作提示', '信息填写不完整！','error');
							return false;	
							}								
					},
					success: function(){
						//表单提交成功后执行的函数
					}
				});
			}		
		});	
	}
</script>

<script type="text/javascript">
function aDel(id) {			//点击删除链接，ajax
	var rem_id = $("#adel_"+id);
	$.messager.defaults = { ok: "确定", cancel: "取消" };
	$.messager.confirm('提示', '您确定要删除吗？', function (r) {
		if(r){
			rem_id.hide(500).remove();
		}
	});
}
$(function () {
	var img_path = "";
	$('#up_file_upload').uploadify({
		'formData': {
			'timestamp': '<?php echo ($time); ?>',            //时间
			'token': '<?php echo (md5($time )); ?>', 	//加密字段
			'url': $('#url').val() + '/upload/', //url
			'imageUrl': $('#root').val()				//root
		},

		'fileTypeDesc': 'Image Files', 				//类型描述
		//'removeCompleted' : false,    //是否自动消失
		'fileTypeExts': '*.gif; *.jpg; *.png', 	//允许类型
		'fileSizeLimit': '3MB', 				//允许上传最大值
		'swf': $('#public').val() + '/uploadify/uploadify.swf', //加载swf
		'uploader': $('#url').val() + '/uploadify', 				//上传路径
		'buttonText': '文件上传', 								//按钮的文字

		'onUploadSuccess': function (file, data, response) {			//成功上传返回
			var n = parseInt(Math.random() * 100); 							//100以内的随机数
			img_path += data + "|";
			$('#hiddenimgpath').val(img_path);
			//插入到image标签内，显示图片的缩略图
			$('#up_image').append('<div id="adel_' + n + '" class="photo"><a href="' + data + '"  target="_blank"><img src="' + data + '"  height=80 width=80 /></a><div class="del"><a href="javascript:vo(0)" onclick=aDel("' + n +'");>删除</a></div></div>');
		}
	});
});
</script>
<script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script>
</body>
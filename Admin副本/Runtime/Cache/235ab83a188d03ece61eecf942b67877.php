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
<form action="<?php echo U('Goods/doadd');?>" id="editForm" method="post" enctype="multipart/form-data">
<input name="hotel_id" type="hidden" value="<?php echo ($list["hotel_id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店名称：
			</td>
			<td width="250">
				<input name="hotel_name" class="easyui-validatebox textbox" required missingmessage="名称不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_name"]); ?>"/>
			</td>
		</tr>

		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店星级：
			</td>
			<td width="250">
					
				<select name="hotel_star">
				<option value="kezhan" <?php if($list["hotel_star"] == 'kezhan'): ?>selected<?php endif; ?>>客栈公寓</option>
				<option value="liansuo" <?php if($list["hotel_star"] == 'liansuo'): ?>selected<?php endif; ?>>经济连锁</option>
				<option value="two" <?php if($list["hotel_star"] == 'two'): ?>selected<?php endif; ?>>二星民宿</option>
				<option value="three" <?php if($list["hotel_star"] == 'three'): ?>selected<?php endif; ?>>三星舒适</option>
				<option value="four" <?php if($list["hotel_star"] == 'four'): ?>selected<?php endif; ?>>四星高档</option>
				<option value="five" <?php if($list["hotel_star"] == 'five'): ?>selected<?php endif; ?>>五星豪华</option>
				
			</select>
					
			</td>
		</tr>
<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店主题：
			</td>
			<td width="250">
				<input name="hotel_title" class="easyui-validatebox textbox" required missingmessage="主题不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_title"]); ?>"/>
			</td>
		</tr> -->
		<tr style="height: 50px;">
			<td width="100" align="right">
				房间数量 ：
			</td>
			<td width="250">
				<input name="total_rooms" class="easyui-validatebox textbox" required missingmessage="房间数量不能为空"
					style="width: 250px" value="<?php echo ($list["total_rooms"]); ?>"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店电话：
			</td>
			<td width="250">
				<input name="hotel_telephone" class="easyui-validatebox textbox" required missingmessage="电话不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_telephone"]); ?>"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店地址：
			</td>
			<td width="250">
				<input name="hotel_address" class="easyui-validatebox textbox" required missingmessage="地址不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_telephone"]); ?>"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店邮箱：
			</td>
			<td width="250">
				<input name="hotel_email" class="easyui-validatebox textbox" required missingmessage="邮箱不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_telephone"]); ?>"/>
			</td>
		</tr>

		
		<tr style="height: 220px;">
			<td align="right">
				酒店简介：
			</td>
			<td>
				<textarea style="width: 600px;height: 200px;" name="introduction"><?php echo ($list["introduction"]); ?></textarea>
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
<script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script>
<script type="text/javascript">
	function submitForm(){
		var isClickOk = true;
		$.messager.defaults={ok:"确定",cancel:"取消"}; 
		$.messager.confirm('Confirm', '您确定修改?', function(r){
			if (r){
				$('#editForm').form('submit',{
					url:"__APP__/Goods/edithotel",
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

</body>
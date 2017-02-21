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
<center><form action="<?php echo U('Adminstore/doeditgoods');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit = "return check()">
	<table width="780" border="0">
	<input type="hidden" name="id" value="<?php echo ($list['id']); ?>">
		<tr style="height: 50px;">
			<td width="100" align="right">
				商品名:
			</td>
			<td width="250">
				<input name="name" style="width: 250px" id="name" value="<?php echo ($list['gname']); ?>" />
				<!-- <span class="uname"></span> -->
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				商品分类:
			</td>
			<td width="250">
				<select name="cate_id" id="">
				            <?php if (!empty($cate)): ?>
				            <?php foreach ($cate as $val): ?>
				           <option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $list['cate_id']? 'selected':''; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',substr_count($val['path'],',')).'|----'.$val['cname'] ?></option>
				            <?php endforeach ?>
				            <?php else: ?>                
				            <?php endif ?>
<!-- 					<?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($list['cate_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> -->
				</select>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				价格:
			</td>
			<td width="250">
				<input name="price" style="width: 250px" value="<?php echo ($list['price']); ?>" />
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				库存:
			</td>
			<td width="250">
				<input name="stock" style="width: 250px" value="<?php echo ($list['stock']); ?>" />
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				简介:
			</td>
			<td width="250">
				<textarea name="msg" id="" cols="30" rows="10" style="width: 250px"><?php echo ($list["msg"]); ?></textarea>
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
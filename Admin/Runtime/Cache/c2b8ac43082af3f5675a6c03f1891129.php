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
<script src="__PUBLIC__/js/ajaxfileupload.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/jquery.upload.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/qiniu.zip.min.js" type="text/javascript"></script>
<body>
<div>
<!-- <form action="<?php echo U('Goods/uploadifytwob');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit="return check()">
<input name="type_id" type="hidden" value="<?php echo ($list["id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td align="right">
				修改：
			</td>
			<td>
				<input id="picture" name="img" type="file">
				<div id="up_image" class="image">
				</div>
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
		<button>修改</button>
	</div>
	</form> -->
<!-- 	     <div id="container">
	      <button data-name="file" >上传文件</button>
                <input name="file"/>
	     </div> -->

<form method="post" action="http://up.qiniu.com" enctype="multipart/form-data" class="upfile"  onsubmit="return check()"> 

 <input name="token" type="hidden" value="<?php echo ($uptoken); ?>">

  <input name="file" type="file" id="picture"/>

  <input type="submit" name="上传">

  </form>



</div>
<script type="text/javascript">
	function check()
	{
		 if($('#picture').val() == '')
		 {
			layer.msg('请选择图片');
			setTimeout(function(){
				$('#picture').focus();
			});
			return false;
		}else{
			return true;
		}
	}
       
                // $(function () {
                //     $('button').upload();
                // });



</script>
<!-- <script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script> -->
</body>
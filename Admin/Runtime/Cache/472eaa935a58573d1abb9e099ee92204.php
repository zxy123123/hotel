<?php if (!defined('THINK_PATH')) exit();?>﻿
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

<head>
<body>
    <style>
        .stage{
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:rgba(0,0,0,0.2);
            display:none;
        }
        .form{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding:10px;
            background: #fff;
        }
        .close{
            position:absolute;
            cursor: pointer;
            top:0;
            right:0;
            transform: translate(50%,-50%);
            width:14px;
            height:14px;
            text-align: center;
            line-height:14px;
            border-radius: 100%;
            background:gray;
        }
    </style>


<table  border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
	<thead>
	<tr>
		<th >ID</th>
		<th >酒店名称</th>
		<th >酒店星级</th>
		<th >酒店电话</th>
		<th >酒店地址</th>
		<th >酒店邮箱</th>
                        <th>详情</th>
		<th>酒店图片</th>
		<th >操作</th>
	</tr>

	<tr>
	<th><?php echo ($list["id"]); ?></th>
	<th><?php echo ($list["name"]); ?></th>
	<th>
	<?php if(($list["grade"] == inn)): ?>酒馆
	<?php elseif($list["grade"] == chain): ?>连锁酒店
	<?php elseif($list["grade"] == theme): ?>主题酒店
	<?php elseif($list["grade"] == three_star): ?>三星级
	<?php elseif($list["grade"] == four_star): ?>四星级
	<?php elseif($list["grade"] == five_star): ?>五星级
	<?php else: ?> null<?php endif; ?>
	</th>
	<th><?php echo ($list["phone_number"]); ?></th>
	<th><?php echo ($list["address"]); ?></th>
	<th><?php echo ($list["email"]); ?></th>
    <th>
        <button class="qita" onclick="other(<?php echo ($list["id"]); ?>)">详情</button>
        <div class="stage qita_<?php echo ($list["id"]); ?>" >
                    <div class="form">
                <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
                    <tr>
                        <th width="80">地址经度</th>
                        <th width="80">地址纬度</th>
                        <th width="80">路线</th>
                        <th >酒店介绍</th>
                        <th width="80">改签退订规则</th>
                        <!-- <th width="80">基础设施</th> -->
                    </tr>
                    <tr>
                        <th width="80"><?php echo ($list["longitude"]); ?></th>
                        <th width="80"><?php echo ($list["latitude"]); ?></th>
                        <th width="80"><?php echo ($list["routes"]); ?></th>
                        <th ><?php echo ($list["introduction"]); ?></th>
                        <th width="80"><?php echo ($list["endorse_rules"]); ?></th>
                        <!-- <th width="80">11</th> -->
                    </tr>
                </table>
                        <span class="close">&times;</span>
                    <div>
            </div>
    </th>

	<th>
		<button class="btn" onclick="show(<?php echo ($list["id"]); ?>)">酒店图片</button>
		<div class="stage img_<?php echo ($list["id"]); ?>" >
		        	<div class="form">
				<img src="/Public/image/hotel/<?php echo ($list["url"]); ?>" alt="" >
			            <span class="close">&times;</span>
		        	<div>
	    	</div>

	</th>
	<th><a href="<?php echo U('Goods/edithotel');?>?id=<?php echo ($list["id"]); ?>" class="btn btn-danger">编辑信息</a>
	<a href="<?php echo U('Goods/edhotpicb');?>?id=<?php echo ($list["id"]); ?>" class="btn btn-danger">编辑图片</a>
	<a href="<?php echo U('Goods/infodel');?>?id=<?php echo ($list["id"]); ?>" class="btn btn-danger">删除</a>
            </th>
	</tr>
	</thead>
</table>


</div>
<!-- <script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script> -->
<script type="text/javascript">

        function show(id)
        {
            $('.img_'+id).fadeIn('1000');
        }
        $('.close').click(function(){
            $('.stage').fadeOut('1000');
        })
        function other(id)
        {
            $('.qita_'+id).fadeIn('1000');
        }
</script>
</body>
</html>
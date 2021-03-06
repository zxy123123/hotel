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
<!-- <script type="text/javascript">
function convert(rows) {
	function exists(rows, parentId) {
		for (var i = 0; i < rows.length; i++) {
			if (rows[i].id == parentId) return true;
		}
		return false;
	}

	var nodes = [];
	for (var i = 0; i < rows.length; i++) {
		var row = rows[i];
		if (!exists(rows, row.parentId)) {
			nodes.push({
				id: row.type_id,
				text: row.name
			});
		}
	}

	var toDo = [];
	for (var i = 0; i < nodes.length; i++) {
		toDo.push(nodes[i]);
	}
	while (toDo.length) {
		var node = toDo.shift();    // the parent node
		// get the children nodes
		for (var i = 0; i < rows.length; i++) {
			var row = rows[i];
			if (row.parentId == node.id) {
				var child = { id: row.type_id, text: row.name };
				if (node.children) {
					node.children.push(child);
				} else {
					node.children = [child];
				}
				toDo.push(child);
			}
		}
	}
	return nodes;
}


//添加产品
function addData(){
	var node = $('#menu-tree').tree("getSelected");
	//if(node === null){
	if(node == null){
		$.dialog({lock:true,time: 3,icon:'error.gif',title:'错误提示',content: '请选择要添加的菜单!'});
		return false;
	}else{
		var pid = node.id;
		$.post("<?php echo U('Goods/addpd');?>",{pid:pid},function(data){
			$('#audata').html(data);
		});
		
	}
} 

//删除选中项
function deleteData() {
	var datagrid = $("#tab_data");
	var rows = datagrid.datagrid('getChecked');
	var ids = [];
	if (rows.length > 0) {
		parent.dj.messagerConfirm('请确认', '您要删除当前所选项目？', function(r) {
			if (r) {
				for ( var i = 0; i < rows.length; i++) {
					ids.push(rows[i].fruit_id);
				}
				$.ajax({
					url : '__APP__/Goods/delete',
					data : {
						ids : ids.join(',')
					},
					dataType : 'json',
					success : function(d) {
						datagrid.datagrid('load');
						datagrid.datagrid('unselectAll');
						parent.dj.messagerShow({
							title : '提示',
							msg : d.info
						});
					}
				});
			}
		});
	} else {
		parent.dj.messagerAlert('提示', '请勾选要删除的记录！', 'error');
	}
}


function formatType(val,row,index){ 
	var type = row.hotel_star;
	var typename = '';
	switch(type){
		case "kezhan":
		typename = '客栈公寓';
		break;
		
		case "liansuo":
		typename = '经济连锁';
		break;
		
		case "two":
		typename = '二星民宿';
		break;
		
		case "three":
		typename = '三星舒适';
		break;

		case "four":
		typename = '四星高档';
		break;
		
		case "five":
		typename = '五星豪华';
		break;
		
	}
	return typename;
}  
function formatOper(val,row,index){  
	var optr = '<a href="javascript:void(0);" onclick="edit('+row.hotel_id+')">修改</a>'; 
	optr +=' &nbsp;&nbsp;<a href="javascript:void(0);" onclick="view('+row.hotel_id+')">详情</a>';
	 return optr;
}
function view(id){
	$.ajax({
		url: '__APP__/Goods/getHotelsById',
		data: {id: id},
		dataType: 'json',
		async:false,
		success: function (rows) {
			$('#_hotel_name').html(rows.hotel_name);
			$('#_hotel_star').html(rows.hotel_star);
			$('#_hotel_title').html(rows.hotel_title);
			$('#_hotel_email').html(rows.hotel_email);
			$('#_total_rooms').html(rows.total_rooms);
			$('#_hotel_telephone').html(rows.hotel_telephone);
			$('#_hotel_address').html(rows.hotel_address);
			$('#_introduction').html(rows.introduction);
			$('#_hotel_image').attr('src',rows.image_url);
			
		}
	});
	var html = $('#viewDlg').clone();
	 $.dialog({
			id:'test123',
			lock: true,
			content: html,
			width: 400,
			height: 250,
			title:'查看酒店详情',
			cancel: true
		});
}
function addPanel(){
	$.dialog({
		id:'testadd',
		lock: true,
		//content: 'url:/admin.php/Goods/addpd',
		url: '__APP__/Goods/addpd',
		content: 'url:__APP__/Goods/addpd',
		width: 800,
		height: 350,
		title:"房间添加",
		cancel:function(){
			window.location.reload();
		}
	});	 
}
function edit(id){
 	 $.dialog({
		id:'testedit',
		lock: true,
		//content: 'url:/admin.php/Goods/uppd/id/'+id,
		//url: '__APP__/Goods/uppd?id='+id,
		content: 'url: __APP__/Goods/uphotel?id='+id,
		width: 800,
		height: 350,
		title:"酒店编辑",
		cancel:function(){
			window.location.reload();
		}
	});	 
}
function exportData() {
	
}
//搜索名称
function s_data() {
	$('#tab_data').datagrid('loadData', { total: 0, rows: [] });
	$('#tab_data').datagrid('load', dj.serializeObject($('#searchForm')));
}
</script> -->
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

<div>
    <form action="<?php echo U('Goods/hotelinfo');?>" method="post">
        <div style="float:left">
            <select name="chaxun" id="cha">
                <option value="1">酒店名称</option>
                <option value="2">酒店地址</option>
            </select>
        </div>
        <div style="float:left">
            <input type="text" name="hotel">
        </div>
        <div>
            <input type="submit" value="搜索">
        </div>
    </form>
</div>
<table  border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
	<thead>
	<tr>
		<th >ID</th>
		<th >酒店名称</th>
		<th >酒店星级</th>
		<th >酒店电话</th>
		<th >酒店地址</th>
		<th >酒店邮箱</th>
                        <th>其他</th>
		<th>酒店图片</th>
		<th >操作</th>
	</tr>

	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	<th><?php echo ($vo["id"]); ?></th>
	<th><?php echo ($vo["name"]); ?></th>
	<th>
	<?php if(($vo["grade"] == inn)): ?>酒馆
	<?php elseif($vo["grade"] == chain): ?>连锁酒店
	<?php elseif($vo["grade"] == theme): ?>主题酒店
	<?php elseif($vo["grade"] == three_star): ?>三星级
	<?php elseif($vo["grade"] == four_star): ?>四星级
	<?php elseif($vo["grade"] == five_star): ?>五星级
	<?php else: ?> null<?php endif; ?>
	</th>
	<th><?php echo ($vo["phone_number"]); ?></th>
	<th><?php echo ($vo["address"]); ?></th>
	<th><?php echo ($vo["email"]); ?></th>
    <th>
        <button class="qita" onclick="other(<?php echo ($vo["id"]); ?>)">其他</button>
        <div class="stage qita_<?php echo ($vo["id"]); ?>" >
                    <div class="form">
                <table border="1">
                    <tr>
                        <th width="80">地址经度</th>
                        <th width="80">地址纬度</th>
                        <th width="80">路线</th>
                        <th width="80">酒店介绍</th>
                        <th width="80">基础设施</th>
                    </tr>
                    <tr>
                        <th width="80"><?php echo ($vo["longitude"]); ?></th>
                        <th width="80"><?php echo ($vo["latitude"]); ?></th>
                        <th width="80"><?php echo ($vo["routes"]); ?></th>
                        <th width="80"><?php echo ($vo["introduction"]); ?></th>
                        <th width="80">11</th>
                    </tr>
                </table>
                        <span class="close">&times;</span>
                    <div>
            </div>
    </th>

	<th>
		<button class="btn" onclick="show(<?php echo ($vo["id"]); ?>)">酒店图片</button>
		<div class="stage img_<?php echo ($vo["id"]); ?>" >
		        	<div class="form">
				<img src="/Public/image/hotel/<?php echo ($vo["url"]); ?>" alt="">
			            <span class="close">&times;</span>
		        	<div>
	    	</div>

	</th>
	<th><a href="<?php echo U('Goods/edithotel');?>?id=<?php echo ($vo["id"]); ?>" class="btn btn-danger">编辑信息</a>
	<a href="<?php echo U('Goods/edhotpic');?>?id=<?php echo ($vo["id"]); ?>" class="btn btn-danger">编辑图片</a>
	<a href="<?php echo U('Goods/infodel');?>?id=<?php echo ($vo["id"]); ?>" class="btn btn-danger">删除</a>
            </th>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</thead>
</table>

<!-- 	<div id="toolbar" style="padding:5px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="exportData()">导出CSV</a> -->
		<!--  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cut" plain="true" onclick="deleteData()">删除</a>-->
<!-- 		<form id="searchForm" style="display:inline-block;*display:inline;zoom:1;">
			<input name="search"  placeholder="名称" data-options="prompt:'请输入搜索内容',searcher:''" class="easyui-validatebox textbox"
				style="width: 180px; vertical-align: middle;" />
			<input name="hiddenid" id="hiddenid" type="hidden" />
			<a href="javascript:void(0);" class="easyui-linkbutton" plain="true" onclick="s_data();">搜索</a>
		</form>
	</div> -->
	
	    <!--	添水果详情		-->
    <!-- <div id="viewDlg" class="easyui-dialog" style="width: 600px; height: 500px; padding: 10px 20px">
        <table  border="0" style="height:500px;width:400px" align="center">
            <tr>
                <td width="100" height="30" align="right">酒店名称： </td>
                <td width="300" height="30"><span id="_hotel_name"></span></td>
            </tr>
			 <tr>
                <td width="100" height="30" align="right">酒店星级： </td>
                <td width="300" height="30"><span id="_hotel_star"></span></td>
            </tr>
			 <tr>
                <td width="100" height="30" align="right">酒店主题： </td>
                <td width="300" height="30"><span id="_hotel_title"></span></td>
            </tr>
			 <tr>
                <td width="100" height="30" align="right">房间数量： </td>
                <td width="300" height="30"><span id="_total_rooms"></span></td>
            </tr>
			 <tr>
                <td width="100" height="30" align="right">酒店电话： </td>
                <td width="300" height="30"><span id="_hotel_telephone"></span></td>
            </tr>
			<tr>
                <td width="100" height="30" align="right">酒店地址： </td>
                <td width="300" height="30"><span id="_hotel_address"></span></td>
            </tr>
			<tr>
                <td width="100" height="30" align="right">酒店邮箱： </td>
                <td width="300" height="30"><span id="_hotel_email"></span></td>
            </tr>
            <tr>
            	<td width="100" height="30" align="right">酒店简介：</td>
                <td width="300" height="30"><span id="_introduction"></span></td> 
            </tr>
            <tr>
                <td  align="right">图片：</td>
                <td><img name="" src="" width="300" height="230" alt="" id="_hotel_image"/></td>
            </tr>
        </table>
    </div>
 -->
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
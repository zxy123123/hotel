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

<script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/bootstrap.min.js" type="text/javascript"></script>
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
<body>
<div>
    <form action="<?php echo U('Goods/index');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">房间名称</option>
            <option value="2">床位类型</option>
        </select>
    </div>
    <div style="float:left">
        <input type="text" name="hotel" >
    </div>
    <div>
        <input type="submit" value="搜索">
    </div>
    </form>
</div>

<div >
<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
	<thead>
	<tr>
		<th >ID</th>
		<th >房间名称</th>
		<th >房间大小</th>
		<th >房间价格</th>
		<th >可住人数</th>
		<th width="80">房间数量</th>
		<th width="80">详情</th>
		<th width="80">房间图片</th>
		
		<th  width="200">操作</th>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr  height="50px">
	<th><?php echo ($vo["id"]); ?></th>	
	<th><?php echo ($vo["display_name"]); ?></th>
	<th><?php echo ($vo["area"]); ?></th>
	<th><?php echo ($vo["price"]); ?></th>
	<th><?php echo ($vo["people_num"]); ?></th>
	<th><?php echo ($vo["count_num"]); ?></th>
<!-- 	<th>
	<?php if($vo["breakfast"] == 1): ?>有
	<?php else: ?>无<?php endif; ?>
	</th> -->
	<th>
		<button class="qita" onclick="other(<?php echo ($vo["id"]); ?>)">详情</button>
		<div class="stage qita_<?php echo ($vo["id"]); ?>" >
		        	<div class="form">
				<table border="1">
					<tr>
						<th width="80">早餐</th>
						<th width="80">加床</th>
						<th width="80">加床价格</th>
						<th width="80">单床大小</th>
						<th width="80">吸烟</th>
						<th width="80">热水</th>
						<th width="80">空调</th>
						<th width="80">网络</th>
						<th width="80">所在楼层</th>
					</tr>
					<tr>
						<td>
						<?php if($vo["breakfast"] == 0): ?>有
						<?php else: ?>无<?php endif; ?>
						</td>
						<td>
						<?php if($vo["bed_add"] == 0): ?>可以
						<?php else: ?>不可以<?php endif; ?>
						</td>
						<td><?php echo ($vo["bed_add_price"]); ?></td>
						<td><?php echo ($vo["bed_area"]); ?></td>
						<td>
						<?php if($vo["smoke"] == 0): ?>可以
						<?php else: ?>不可以<?php endif; ?>
						</td>
						<td>
						<?php if($vo["hot_water"] == 0): ?>有
						<?php else: ?>没有<?php endif; ?>
						</td>
						<td>
						<?php if($vo["air_conditioner"] == 0): ?>有
						<?php else: ?>没有<?php endif; ?>
						</td>
						<td>
						<?php if($vo["internet"] == 'wifi'): ?>wifi
						<?php elseif($vo["internet"] == 'wired'): ?>有线
						<?php else: ?>无<?php endif; ?>
						</td>
						<td><?php echo ($vo["floors"]); ?></td>
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
				<img src="/Public/image/room/<?php echo ($vo["url"]); ?>" alt="">
			            <span class="close">&times;</span>
		        	<div>
	    	</div>
	</th>
	<th><a href="<?php echo U('Goods/uppd');?>?id=<?php echo ($vo["id"]); ?>" >编辑信息</a>
	        <a href="<?php echo U('Goods/edrompic');?>?id=<?php echo ($vo["id"]); ?>">编辑图片</a>
	        <a href="<?php echo U('Goods/updel');?>?id=<?php echo ($vo["id"]); ?>" >删除</a>
	</th>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</thead>
</table>
<!-- </form> -->
<!-- 	<div id="toolbar" style="padding:5px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="exportData()">导出CSV</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addPanel()">新增</a> -->
		<!--  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cut" plain="true" onclick="deleteData()">删除</a>-->
<!-- 		<form id="searchForm" style="display:inline-block;*display:inline;zoom:1;">
			<input name="search"  placeholder="名称" data-options="prompt:'请输入搜索内容',searcher:''" class="easyui-validatebox textbox"
				style="width: 180px; vertical-align: middle;" />
			<input name="hiddenid" id="hiddenid" type="hidden" />
			<a href="javascript:void(0);" class="easyui-linkbutton" plain="true" onclick="s_data();">搜索</a>
		</form>
	</div> -->
	
	    <!--	添水果详情		-->
<!--     <div id="viewDlg" class="easyui-dialog" style="width: 400px; height: 300px; padding: 10px 20px">
        <table  border="0" style="height:300px;width:400px">
            <tr>
                <td width="100" height="30" align="right">房间名称： </td>
                <td width="300" height="30"><span id="_type_name"></span></td>
            </tr>
            <tr>
            	<td width="100" height="30" align="right">描述：</td>
                <td width="300" height="30"><span id="_description"></span></td> 
            </tr>
            <tr>
                <td  align="right">图片：</td>
                <td><img name="" src="" width="300" height="230" alt="" id="_room_image"/></td>
            </tr>
        </table>
    </div> -->

</div>
<script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script>
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

// function convert(rows) {
// 	function exists(rows, parentId) {
// 		for (var i = 0; i < rows.length; i++) {
// 			if (rows[i].id == parentId) return true;
// 		}
// 		return false;
// 	}

// 	var nodes = [];
// 	for (var i = 0; i < rows.length; i++) {
// 		var row = rows[i];
// 		if (!exists(rows, row.parentId)) {
// 			nodes.push({
// 				id: row.type_id,
// 				text: row.name
// 			});
// 		}
// 	}

// 	var toDo = [];
// 	for (var i = 0; i < nodes.length; i++) {
// 		toDo.push(nodes[i]);
// 	}
// 	while (toDo.length) {
// 		var node = toDo.shift();    // the parent node
// 		// get the children nodes
// 		for (var i = 0; i < rows.length; i++) {
// 			var row = rows[i];
// 			if (row.parentId == node.id) {
// 				var child = { id: row.type_id, text: row.name };
// 				if (node.children) {
// 					node.children.push(child);
// 				} else {
// 					node.children = [child];
// 				}
// 				toDo.push(child);
// 			}
// 		}
// 	}
// 	return nodes;
// }


// //添加产品
// function addData(){
// 	var node = $('#menu-tree').tree("getSelected");
// 	//if(node === null){
// 	if(node == null){
// 		$.dialog({lock:true,time: 3,icon:'error.gif',title:'错误提示',content: '请选择要添加的菜单!'});
// 		return false;
// 	}else{
// 		var pid = node.id;
// 		$.post("<?php echo U('Goods/addpd');?>",{pid:pid},function(data){
// 			$('#audata').html(data);
// 		});
		
// 	}
// } 

// //删除选中项
// function deleteData() {
// 	var datagrid = $("#tab_data");
// 	var rows = datagrid.datagrid('getChecked');
// 	var ids = [];
// 	if (rows.length > 0) {
// 		parent.dj.messagerConfirm('请确认', '您要删除当前所选项目？', function(r) {
// 			if (r) {
// 				for ( var i = 0; i < rows.length; i++) {
// 					ids.push(rows[i].fruit_id);
// 				}
// 				$.ajax({
// 					url : '__APP__/Goods/delete',
// 					data : {
// 						ids : ids.join(',')
// 					},
// 					dataType : 'json',
// 					success : function(d) {
// 						datagrid.datagrid('load');
// 						datagrid.datagrid('unselectAll');
// 						parent.dj.messagerShow({
// 							title : '提示',
// 							msg : d.info
// 						});
// 					}
// 				});
// 			}
// 		});
// 	} else {
// 		parent.dj.messagerAlert('提示', '请勾选要删除的记录！', 'error');
// 	}
// }


// function formatType(val,row,index){ 
// 	var type = row.type;
// 	var typename = '';
// 	switch(type){
// 		case "tehuishuiguo":
// 		typename = '特惠水果';
// 		break;
		
// 		case "jinkoushuiguo":
// 		typename = '进口水果';
// 		break;
		
// 		case "shiyanshitaocan":
// 		typename = '实验室套餐';
// 		break;
		
// 		case "gerentaocan":
// 		typename = '个人套餐';
// 		break;

// 		case "zhengxiangpifa":
// 		typename = '整箱批发';
// 		break;
		
// 		case "yinliaoguozhi":
// 		typename = '饮料果汁';
// 		break;
// 		case "lingshi":
// 		typename = '零食';
// 		break;
// 		case "qita":
// 		typename = '其他';
// 		break;
// 	}
// 	return typename;
// }  
// function formatOper(val,row,index){  
// 	var optr = '<a href="javascript:void(0);" onclick="edit('+row.type_id+')">修改</a>'; 
// 	optr +=' &nbsp;&nbsp;<a href="javascript:void(0);" onclick="view('+row.type_id+')">详情</a>';
// 	 return optr;
// }
// function view(id){
// 	$.ajax({
// 		url: '__APP__/Goods/getGoodsById',
// 		data: {id: id},
// 		dataType: 'json',
// 		async:false,
// 		success: function (rows) {
// 			$('#_type_name').html(rows.type_name);
// 			$('#_room_image').attr('src',rows.image_url);
// 			$('#_description').html(rows.description);
// 		}
// 	});
// 	var html = $('#viewDlg').clone();
// 	 $.dialog({
// 			id:'test123',
// 			lock: true,
// 			content: html,
// 			width: 400,
// 			height: 250,
// 			title:'查看房间详情',
// 			cancel: true
// 		});
// }
// function addPanel(){
// 	$.dialog({
// 		id:'testadd',
// 		lock: true,
// 		//content: 'url:/admin.php/Goods/addpd',
// 		url: '__APP__/Goods/addpd',
// 		content: 'url:__APP__/Goods/addpd',
// 		width: 800,
// 		height: 500,
// 		title:"房间添加",
// 		cancel:function(){
// 			window.location.reload();
// 		}
// 	});	 
// }
// function edit(id){
//  	 $.dialog({
// 		id:'testedit',
// 		lock: true,
// 		//content: 'url:/admin.php/Goods/uppd/id/'+id,
// 		//url: '__APP__/Goods/uppd?id='+id,
// 		content: 'url: __APP__/Goods/uppd?id='+id,
// 		width: 800,
// 		height: 350,
// 		title:"房间编辑",
// 		cancel:function(){
// 			window.location.reload();
// 		}
// 	});	 
// }
// function exportData() {
	
// }
// //搜索名称
// function s_data() {
// 	$('#tab_data').datagrid('loadData', { total: 0, rows: [] });
// 	$('#tab_data').datagrid('load', dj.serializeObject($('#searchForm')));
// }










</script>


</body>
</html>
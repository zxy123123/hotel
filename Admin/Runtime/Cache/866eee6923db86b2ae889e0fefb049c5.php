<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
<!-- <script type="text/javascript" charset="utf-8">
var datagrid = $('#datagrid_Order');
var isClickOk = true;
function edit(id) {
	$.ajax({
		url: '__APP__/Order/getOrderById',
		data: {id: id},
		dataType: 'json',
		success: function (rows) {
			rows = rows[0];
			$('#_orderid').val(rows.order_id);
			$("input[name='state'][value="+rows.state+"]").attr("checked",true);

		}
	});
	$('#editDlg').dialog('open').dialog('setTitle', '修改订单信息');
}

function view(id) {
	$.ajax({
		url: '__APP__/Order/getOrderById',
		data: {id: id},
		dataType: 'json',
		async: false,
		success: function (rows) {
			var table = '';
				table+= '<tr>';
				table+='<td>'+rows.hotel_name+'</td>';
				table+='<td>'+rows.type_name+'</td>';
				table+='<td>'+rows.name+'</td>';
				table+='<td>'+rows.phone_number+'</td>';
				table+='<td>'+rows.identity_card+'</td>';
				table+='<td>'+rows.start_time+'</td>';
				table+='<td>'+rows.end_time+'</td>';
				table+='<td>'+rows.total_price+'</td>';
				table+='<td>'+rows.special_requirement+'</td>';
				table+="</tr>";
			//alert(table);
			$('.itbody').empty();
			$('.itbody').append(table);
		}
	});
	$('#viewDlg').dialog('open').dialog('setTitle', '订单信息');
}
function batch(t){
	var datagrid = $("#datagrid_Order");
	var rows = datagrid.datagrid('getChecked');
	var ids = [];
	var tn = (t=='confirm')?"接单":"修改订单状态为已支付";
	if (rows.length > 0) {
		parent.dj.messagerConfirm('请确认', '您要批量'+tn+'吗？', function(r) {
			if (r) {
				for ( var i = 0; i < rows.length; i++) {
					ids.push(rows[i].order_id);
				}
				$.ajax({
					url : '__APP__/Order/batch',
					data : {
						type:t,
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
		parent.dj.messagerAlert('提示', '请勾选要处理的订单！', 'error');
	}
}
//接单
function accept(id){
	parent.dj.messagerConfirm('请确认', '入住确认吗？', function(r) {
		if (r) {
			$.ajax({
				url : '__APP__/Order/batch',
				data : {id:id},
				dataType : 'json',
				success : function(d) {
					datagrid.datagrid('load');
					datagrid.datagrid('unselectAll');
					parent.dj.messagerShow({
						title : '提示',
						msg : '入住确认成功'
					});
					window.location.reload();
				}
			});
		}
	});
}
function bgcolor(index,row){  
    if (row.flag==0){   
        return 'background-color:red;';   
    }   
}   

function exportData() {
	var rows = $('#datagrid_Order').datagrid('getChecked');
	var ids = [];
	for (var i = 0; i < rows.length; i++) {
		ids.push(rows[i].order_id);
	}
	var str =  ids.join(',');
	var href = '__APP__/Order/export?idstr='+str;
	location.href=href;
}
function _search() {
	$('#datagrid_Order').datagrid('loadData', { total: 0, rows: [] }); 
	$('#datagrid_Order').datagrid('load', dj.serializeObject($('#searchForm')));
}
function cleanSearch() {
	$('#datagrid_Order').datagrid('load', {});
	$('#searchForm input').val('');
}

//删除选中项
function deleteData() {
	var datagrid = $("#datagrid_Order");
	var rows = datagrid.datagrid('getChecked');
	var ids = [];
	if (rows.length > 0) {
		parent.dj.messagerConfirm('请确认', '您要删除当前所选项目？', function(r) {
			if (r) {
				for ( var i = 0; i < rows.length; i++) {
					ids.push(rows[i].order_id);
				}
				$.ajax({
					url : '__APP__/Order/delete',
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


function edit_ok() {
	$.messager.defaults = { ok: "确定", cancel: "取消" };
	$.messager.confirm('Confirm', '您确定修改?', function (r) {
		if (r) {
			$('#editForm').form('submit', {
				url: "__APP__/Order/edit",
				dataType: 'json',
				onSubmit: function () {

					if ($('#editForm').form('validate')) {
						datagrid.datagrid('loadData', { total: 0, rows: [] }); 
						datagrid.datagrid('load');
						$.messager.alert('操作提示', '修改信息成功！', 'info');
						return true;
					} else {
						$.messager.alert('操作提示', '信息填写不完整！', 'error');
						return false;
					}
				}
			});
			$('#datagrid_Order').datagrid('reload');
			$('#editDlg').dialog('close');
		}

	});
}

function formatOper(val,row,index){  
	var str= '<a href="javascript:void(0);" onclick="accept('+row.reservation_id+')">入住确认</a>'; 
	str+=' &nbsp;&nbsp;<a href="javascript:void(0);" onclick="view('+row.reservation_id+')">订单详情</a>';
	return str;
}
function formatsex(val,row,index){
	return (row.sex==1)?"女":"男";
}
function formatphone(val,row,index){
	return row.order_id;
}
function formataddress(val,row,index){
	return row.address1+''+row.address2+''+row.address3;
}
function myformatter(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser(s){
	if (!s) return new Date();
	var ss = (s.split('-'));
	var y = parseInt(ss[0],10);
	var m = parseInt(ss[1],10);
	var d = parseInt(ss[2],10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
	return new Date(y,m-1,d);
	} else {
	return new Date();
	}
}
</script> -->
<title>后台管理</title>
</head>
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
<div >
    <form action="<?php echo U('Order/payorder');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">手机号</option>
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
<div class="easyui-panel" data-options="fit:true">
	<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th >ID</th>
				<th>用户</th>
				<th >手机号</th>
				<th >入住酒店</th>
				<th>房型</th>
				<th>单价</th>
                                                <th>订房数量</th>
				<th >入住时间</th>
				<th  >支付状态</th>
				<th >支付方式</th>
				<th >详情</th>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td ><?php echo ($vo["oid"]); ?></td>
				<td><?php echo ($vo["uname"]); ?></td>
				<td ><?php echo ($vo["up"]); ?></td>
				<td ><?php echo ($vo["hn"]); ?></td>
				<td><?php echo ($vo["rdn"]); ?></td>
				<td><?php echo ($vo["rp"]); ?></td>
                                                <td><?php echo ($vo["orn"]); ?></td>
				<td ><?php echo ($vo["ost"]); ?></td>
				<td  >
				<?php if($vo["ops"] == paid): ?>已支付
				<?php elseif($vo["ops"] == not_paid): ?>未支付
				<?php else: ?>支付失败<?php endif; ?>
				</td>
				<td >
				<?php if($vo["opm"] == wechat): ?>微信
				<?php elseif($vo["opm"] == score): ?>金币
				<?php else: ?>到店支付<?php endif; ?>
				</td>
				<td >
				<button class="qita" onclick="other(<?php echo ($vo["oid"]); ?>)">详情</button>
				<div class="stage qita_<?php echo ($vo["oid"]); ?>" >
		        		<div class="form">
				<table border="1" >
					<tr>
						<th width="80">订单状态</th>
						<th width="80">最晚到店时间</th>
						<th width="80">微信支付的openid</th>
						<th width="80">特殊要求</th>
						<th width="80">备注</th>
					</tr>
					<tr>
						<td width="80">
                                                                        <?php if($vo["oos"] == wait_for_pay): ?>等待付款
                                                                        <?php elseif($vo["oos"] == wait_for_confirm): ?>等待确认
                                                                        <?php elseif($vo["oos"] == success): ?>成功
                                                                        <?php elseif($vo["oos"] == cancle): ?>取消
                                                                        <?php else: ?>完成<?php endif; ?>
						</td>
						<td width="80"><?php echo ($vo["olat"]); ?></td>
						<td width="80"><?php echo ($vo["ooi"]); ?></td>
						<td width="80"><?php echo ($vo["osr"]); ?></td>
						<td width="80"><?php echo ($vo["ork"]); ?></td>
					</tr>
				</table>
			            <span class="close">&times;</span>
		        	<div>
	    	</div>
				</td>

				<!-- <td><button class="check" bh="<?php echo ($vo["id"]); ?>">确认入住</button></td> -->
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>

<!-- 	<div id="toolbar" style="padding:5px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="exportData()">导出csv</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="">批量接单</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="">批量处理订单</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cut" plain="true" onclick="deleteData()">删除</a>
		
		<form id="searchForm" style="display:inline-block;*display:inline;zoom:1;">
			<input name="search"  placeholder="手机号" data-options="prompt:'请输入搜索内容',searcher:''" class="easyui-validatebox textbox"
				style="width: 180px; vertical-align: middle;" />
				
				</select>
				入住时间:<input name="start_time" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" />
				离开时间: <input name="end_time" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" />
			<input name="hiddenid" id="hiddenid" type="hidden" />
			<a href="javascript:void(0);" class="easyui-linkbutton" plain="true" onclick="_search();">搜索</a>
		</form>
	</div> -->
<!-- </div> -->

    <!--	修改订单信息的表单		-->
<!--     <div id="editDlg" class="easyui-dialog" style="width: 400px; height: 300px; padding: 10px 20px"
        closed="true" buttons="#editDlgBtn" data-options="modal:true">
        <form id="editForm" method="post">
        <table width="350" border="0">
            <tr>
                <td width="150" align="right">
                    订单状态：
                </td>
                <td width="250">
					<input type="radio" name="state" value="未入住" />未入住
					<input type="radio" name="state" value="已入住" />已入住
                </td>
                <input type="hidden" name="reservation_id" id="_orderid" />
            </tr>
        </table>
        </form>
    </div> -->
    
    
    <!-- 密码重置 -->
        <!--	修改订单信息的表单		-->
<!--     <div id="viewDlg" class="easyui-dialog" style="width: 1200px; height: 300px; padding: 10px 20px"
        closed="true" buttons="#viewDlgBtn" data-options="modal:true">
        <style>
    .itemtable th,td{
	border:solid 1px #ccc;
    }
    </style> -->
<!-- 	<table style="border:solid 1px #ccc;width:100%;table-layout:fixed;
empty-cells:show;
border-collapse: collapse;
margin:0 auto; " class="itemtable">
	<tr>
	<th>酒店名</th>
	<th>房间名</th>
	<th>客户名字</th>
	<th>客户手机号</th>
	<th>客户身份证</th>
	<th>入住时间</th>
	<th>离开时间</th>
	<th>订单总价格</th>
	<th>客户留言</th>
	</tr>
	<tbody class="itbody"></tbody>
	</table>
    </div> -->
     <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
<!--     <div id="viewDlgBtn">
         <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#viewDlg').dialog('close')">取消</a>
    </div> -->
       
    <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
<!--     <div id="editDlgBtn">
        <a href="#" id="addSaveBooktimecode" class="easyui-linkbutton" iconcls="icon-ok"
            onclick="edit_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#editDlg').dialog('close')">取消</a>
    </div> -->

	<script>
	function other(id)
	{
		$('.qita_'+id).fadeIn('1000');
	}
	$('.close').click(function(){
		$('.stage').fadeOut('1000');
	})





	</script>


</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
var datagrid = $('#datagrid_user');
var isClickOk = true;
function edit(id) {
	$.ajax({
		url: '__APP__/User/getUserById',
		data: {id: id},
		dataType: 'json',
		success: function (rows) {
			$('#_username').val(rows.name);
			$("input[name='member_id']").val(rows.member_id);
			
			$('#_phone_number').val(rows.phone_number);
			$('#_identity_card').val(rows.identity_card);
		}
	});
	$('#editDlg').dialog('open').dialog('setTitle', '修改用户信息');
}

function initpsw(num) {
	$('#_user_id').val(num);
	$('#initpswDlg').dialog('open').dialog('setTitle', '确定要重置密码?');
}
function initpsw_ok() {
	$('#initpswForm').form('submit', {
		url: "__APP__/User/initPwd",
		dataType: 'json',
		onSubmit: function () {
				$.messager.alert('操作提示', '重置后的密码是:123456', 'info');
				return true;
		}
	});
	$('#datagrid_user').datagrid('reload');
	$('#initpswDlg').dialog('close');
}

function exportData() {
	var rows = $('#datagrid_user').datagrid('getChecked');
	var ids = [];
	for (var i = 0; i < rows.length; i++) {
		ids.push(rows[i].user_id);
	}
	var str =  ids.join(',');
	var href = '__APP__/User/export?idstr='+str;
	location.href=href;
}
function _search() {
	$('#datagrid_user').datagrid('loadData', { total: 0, rows: [] }); 
	$('#datagrid_user').datagrid('load', dj.serializeObject($('#searchForm')));
}
function cleanSearch() {
	$('#datagrid_user').datagrid('load', {});
	$('#searchForm input').val('');
}







function edit_ok() {
	$.messager.defaults = { ok: "确定", cancel: "取消" };
	$.messager.confirm('Confirm', '您确定修改?', function (r) {
		if (r) {
			$('#editForm').form('submit', {
				url: "__APP__/User/edit",
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
			$('#datagrid_user').datagrid('reload');
			$('#editDlg').dialog('close');
		}

	});
}

function formatOper(val,row,index){  
	var str= '<a href="javascript:void(0);" onclick="edit('+row.member_id+')">修改</a>'; 
	
	return str;
}
function formatsex(val,row,index){
	return (row.sex==1)?"女":"男";
}
function formatphone(val,row,index){
	return row.user_id;
}
function formataddress(val,row,index){
	return row.address1+''+row.address2+''+row.address3;
}
</script>
<title>后台管理</title>
</head>
<body>
<div class="easyui-panel" data-options="fit:true">
	<table class="easyui-datagrid" id="datagrid_user" data-options="url:'__APP__/User/getAllUser',method:'post',pagination:true,fit:true,toolbar:'#toolbar',rownumbers:true,checkOnSelect: true">
		<thead>
			<tr>
				<th data-options="field:'member_id',sortable: true,checkbox: true">ID</th>
				<th data-options="field:'name',sortable: true" width="100">用户姓名</th>
				<th data-options="field:'identity_card',sortable: true" width="150">身份证号</th>
				<th data-options="field:'phone_number',sortable: true" width="150" >手机号</th>
				<th data-options="field:'score',sortable: true" width="100">积分</th>
				<th data-options="field:'created_at',align:'center',sortable: true" width="130">注册时间</th>
				<th data-options="field:'hotel_name',align:'center',sortable: true" width="200" >酒店</th>
				
				<th data-options="field:'cz',width:120,align:'center',formatter:formatOper">操作</th>
			</tr>
		</thead>
	</table>

	<div id="toolbar" style="padding:5px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="">导出csv</a>
		<form id="searchForm" style="display:inline-block;*display:inline;zoom:1;">
			<input name="search"  placeholder="标题或内容" data-options="prompt:'请输入搜索内容',searcher:''" class="easyui-validatebox textbox"
				style="width: 180px; vertical-align: middle;" />
			<input name="hiddenid" id="hiddenid" type="hidden" />
			<a href="javascript:void(0);" class="easyui-linkbutton" plain="true" onclick="_search();">搜索</a>
			
		</form>
		
		
		
		
		
	</div>
</div>

    <!--	修改用户信息的表单		-->
    <div id="editDlg" class="easyui-dialog" style="width: 450px; height: 300px; padding: 10px 20px"
        closed="true" buttons="#editDlgBtn" data-options="modal:true" >
        <form id="editForm" method="post">
        <input type="hidden" name="user_id" value="" />
        <table width="350" border="0">
            <tr>
                <td width="150" align="right">
                    用户姓名：
                </td>
                <td width="250">
                    <input name="name" id="_username" class="easyui-validatebox textbox"/>
                </td>
                <input type="hidden" name="member_id" id="_memberid" />
            </tr>
    
             
            <tr>
                <td align="right">
                   手机号：
                </td>
                <td>
                    <input name="phone_number" id="_phone_number" class="easyui-validatebox textbox" />
					
                </td>
            </tr>     
           
            <tr>
                <td align="right">
                    身份证号：
                </td>
                <td>
                    <input name="identity_card" id="_identity_card" class="easyui-validatebox textbox" />
                </td>
            </tr>
			 
        </table>
        </form>
    </div>
    
    
    <!-- 密码重置 -->
        <!--	修改用户信息的表单		-->
    <div id="initpswDlg" class="easyui-dialog" style="width: 400px; height: 300px; padding: 10px 20px"
        closed="true" buttons="#initpswDlgBtn" data-options="modal:true">
        <form id="initpswForm" method="post">
        <input type="hidden" name="user_id" id="_user_id" value="" />
       	 重置密码为:123456.
        </form>
    </div>
     <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
    <div id="initpswDlgBtn">
        <a href="#"  class="easyui-linkbutton" iconcls="icon-ok"
            onclick="initpsw_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#initpswDlg').dialog('close')">取消</a>
    </div>
       
    <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
    <div id="editDlgBtn">
        <a href="#" id="addSaveBooktimecode" class="easyui-linkbutton" iconcls="icon-ok"
            onclick="edit_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#editDlg').dialog('close')">取消</a>
    </div>
</body>
</html>
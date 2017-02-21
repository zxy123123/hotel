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
<div>
    <form action="<?php echo U('User/index');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">所属酒店</option>
            <option value="2">昵称</option>
            <option value="3">备注</option>
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
<div>
	<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th >ID</th>
                                                <th>所属酒店</th>
                                                <th>昵称</th>
                                                <th>姓名</th>
                                                <th>性别</th>
                                                <th  >手机号</th>
                                                <th >拥有积分</th>
                                                <th>备注</th>
			</tr>
                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                <td ><?php echo ($vo["id"]); ?></td>
                                                <td><?php echo ($vo["hn"]); ?></td>
                                                <td><?php echo ($vo["nickname"]); ?></td>
                                                <td><?php echo ($vo["un"]); ?></td>
                                                <td>
                                                    <?php if($vo["gender"] == male): ?>男
                                                    <?php elseif($vo["gender"] == female): ?>女
                                                    <?php else: ?>保密<?php endif; ?>
                                                </td>
                                                <td  ><?php echo ($vo["up"]); ?></td>
                                                <td ><?php echo ($vo["score"]); ?></td>
                                                <td><center>
                                                <?php echo ($vo["mark"]); ?>
                                                <button class="btn" onclick="edit(<?php echo ($vo["id"]); ?>)">修改</button></center>
                                                <div class="stage com_<?php echo ($vo["id"]); ?>">
                                                    <div class="form">
                                                        <form action="<?php echo U('User/editcom');?>?id=<?php echo ($vo["id"]); ?>" method="post">
                                                        修改备注:<input type="text" name="comment">
                                                        <input type="submit" value="修改">
                                                        </form>
                                                            <span class="close">&times;</span>
                                                        </div>
                                                </div>
                                            </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>

<!-- 	<div id="toolbar" style="padding:5px;">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="">导出csv</a>
		<form id="searchForm" style="display:inline-block;*display:inline;zoom:1;">
			<input name="search"  placeholder="标题或内容" data-options="prompt:'请输入搜索内容',searcher:''" class="easyui-validatebox textbox"
				style="width: 180px; vertical-align: middle;" />
			<input name="hiddenid" id="hiddenid" type="hidden" />
			<a href="javascript:void(0);" class="easyui-linkbutton" plain="true" onclick="_search();">搜索</a>
			
		</form>
	</div> -->
</div>

    <!--	修改用户信息的表单		-->
 <!--    <div id="editDlg" class="easyui-dialog" style="width: 450px; height: 300px; padding: 10px 20px"
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
            </tr>      -->
           
<!--             <tr>
                <td align="right">
                    身份证号：
                </td>
                <td>
                    <input name="identity_card" id="_identity_card" class="easyui-validatebox textbox" />
                </td>
            </tr> -->
			 
 <!--        </table>
        </form>
    </div> -->
    
    
    <!-- 密码重置 -->
        <!--	修改用户信息的表单		-->
<!--     <div id="initpswDlg" class="easyui-dialog" style="width: 400px; height: 300px; padding: 10px 20px"
        closed="true" buttons="#initpswDlgBtn" data-options="modal:true">
        <form id="initpswForm" method="post">
        <input type="hidden" name="user_id" id="_user_id" value="" />
       	 重置密码为:123456.
        </form>
    </div> -->
     <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
<!--     <div id="initpswDlgBtn">
        <a href="#"  class="easyui-linkbutton" iconcls="icon-ok"
            onclick="initpsw_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#initpswDlg').dialog('close')">取消</a>
    </div> -->
       
    <!--	修改户信息的按钮，被Jquery设置，当没被调用的时候不显示		-->
<!--     <div id="editDlgBtn">
        <a href="#" id="addSaveBooktimecode" class="easyui-linkbutton" iconcls="icon-ok"
            onclick="edit_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cut"
                onclick="javascript:$('#editDlg').dialog('close')">取消</a>
    </div> -->
    <script type="text/javascript">
    function edit(id)
    {
        $('.com_'+id).fadeIn('1000');
    }
    $('.close').click(function(){
        $('.stage').fadeOut('1000');
    })



    </script>
</body>
</html>
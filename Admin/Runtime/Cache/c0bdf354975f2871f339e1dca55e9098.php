<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <title>后台管理</title>
</head>
<body class="easyui-layout">
    <div class="header" id="sessionInfoDiv">
        <div class="topleft">
            <img src="__PUBLIC__/images/logo.jpg" title="水果博士后台管理系统" style="border: none;height:70px;width:200px" /><a
                href="javascript:void(0);" style="display:none">水果博士后台管理系统 </a>
        </div>
        <div class="topcenter">
        </div>
        <div class="topright">
            <div class="topright_button">
                <a href="javascript:void(0);" class="easyui-linkbutton" iconcls="icon-user" plain="true">
                    <c:if test="${sessionInfo.username != null}">欢迎管理员：[<strong><?php echo ($_SESSION['username']); ?></strong>]使用后台管理系统</c:if>
                </a>
				<a href="javascript:void(0);" class="easyui-linkbutton" iconcls="icon-kzmb" plain="true" onclick="javascript:changepsw()">修改密码</a> 
				<a href="javascript:void(0);" class="easyui-linkbutton" iconcls="icon-zx" plain="true" onclick="$.messager.confirm('注销','您确定要退出么?',function(r){if(r)(logout(true))});">注销</a>
            </div>
        </div>
    </div>
    <!--	初始化密码的表单		-->
    <div id="changepswDlg" class="easyui-dialog" style="width: 400px; height: 220px;
        overflow: hidden; padding: 10px 20px" scroll="no" closed="true" buttons="#changepswDlgBtn">
        <form id="changepswForm" method="post">
        <table width="400" border="0">
            <tr>
                <td align="right">
                    原密码:
                </td>
                <td>
                    <input name="password" type="password" class="easyui-validatebox textbox" required
                        missingmessage="密码不能为空" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    新密码:
                </td>
                <td>
                    <input name="newpassword" id="newpassword1" type="password" class="easyui-validatebox textbox"
                        required missingmessage="密码不能为空" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    重输新密码:
                </td>
                <td>
                    <input name="newpassword2" id="newpassword2" type="password" class="easyui-validatebox textbox"
                        required missingmessage="密码不能为空" />
                </td>
            </tr>
        </table>
        </form>
    </div>
    <div id="changepswDlgBtn">
        <a href="#" id="addSaveBooktimecode" class="easyui-linkbutton" iconcls="icon-ok"
            onclick="changepsw_ok()">确认</a> <a href="#" class="easyui-linkbutton" iconcls="icon-cancel"
                onclick="javascript:$('#changepswDlg').dialog('close')">取消</a>
    </div>
</body>
</html>
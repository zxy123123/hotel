<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <link href="__PUBLIC__/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="__PUBLIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/cloud.js" type="text/javascript"></script>
    <script language="javascript">
        $(function () {
            $('.loginbox').css({ 'position': 'absolute', 'left': ($(window).width() - 692) / 2 });
            $(window).resize(function () {
                $('.loginbox').css({ 'position': 'absolute', 'left': ($(window).width() - 692) / 2 });
            });
			$("#username").focus();
        });  
    </script>
</head>
<body style="background-color: #1c77ac; background-image: url(../../images/light.png);
    background-repeat: no-repeat; background-position: center top; overflow: hidden;">
    <div id="mainBody">
        <div id="cloud1" class="cloud">
        </div>
        <div id="cloud2" class="cloud">
        </div>
    </div>
    <div class="logintop">
        <span>欢迎登录后台管理系统</span>
    </div>
    <div class="loginbody">
        <span class="systemlogo"></span>
        <div class="loginbox">
            <form action="__APP__/Index/checklogin" method="post">
            <ul>
                <li>
                    <input type="text" name="username" id="username" class="loginuser" value="" placeholder="用户名" /></li>
                <li>
                    <input name="password" type="password" class="loginpwd" value="" placeholder="密码" /></li>
                <li>
                    <input type="submit" class="loginbtn" value="登录" /></li>
            </ul>
            </form>
        </div>
    </div>
    <div class="loginbm">
        版权所有 2014 
    </div>
</body>
</html>
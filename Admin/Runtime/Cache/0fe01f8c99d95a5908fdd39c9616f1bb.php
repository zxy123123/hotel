<?php if (!defined('THINK_PATH')) exit();?>﻿<html>
<head>
    <title>积分充值</title> 
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>



<body>

        
    <table width="400" height="20" align="center">
    <tr align="center" valign="middle">
         <c:if test="${sessionInfo.credit != null}">金币余额：<strong><?php echo ($_SESSION['credit']); ?></strong>个</c:if>
    </tr>
    
    </table>    
    
    
    <form action="/pay/example/native.php" method="post">
        <input name="score" id="score" placeholder="充值金额" data-options="prompt:'请输入充值金额'" class="easyui-validatebox textbox"
                style="width: 180px; vertical-align: middle;" type="number" min ="0" required missingmessage="金额不能为空"/>元（1元=2金币，充值1000元起）

             <input type="submit" class="loginbtn" value="充值" onclick="return check()"/>
    </form> 

    <form action="" method="post">
        <input name="dscore" id="score" placeholder="提现金额" data-options="prompt:'请输入提现金额'" class="easyui-validatebox textbox" style="width: 180px; vertical-align: middle;" type="number" min ="0" required missingmessage="金额不能为空"/>元（1元=2金币，提现1000元起）

             <input type="submit" class="loginbtn" value="提现" onclick="return check()"/>
    </form> 
    
<script type="text/javascript">
function check(){
    // var num = document.getElementById("score").value;
    var num = $('#score').val();
    if(num <1){
         alert("为了测试，暂时先至少1分钱起，正式的充值至少1000元起！");
         return false;
    }else{
        return true;
    }

}
</script>


</body>
</html>
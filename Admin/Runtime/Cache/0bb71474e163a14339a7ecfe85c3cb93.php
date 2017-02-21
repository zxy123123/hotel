<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
<body>
<div class="easyui-panel" fit="true">
<center>
    <h1>添加商品</h1>
<form action="<?php echo U('Adminstore/doaddgoods');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit = "return check()">
    <table width="780" border="0">
        <tr style="height: 50px;">
            <td width="100" align="right">
                商品名:
            </td>
            <td width="250">
                <input name="name" style="width: 250px" id="name" />
                <!-- <span class="uname"></span> -->
            </td>
        </tr>
        <tr style="height: 50px;">
            <td width="100" align="right">
                商品分类:
            </td>
            <td width="250">
                <select name="cate_id" id="">
                            <?php if (!empty($cate)): ?>
                            <?php foreach ($cate as $val): ?>
                            <option value="<?php echo $val['id'] ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',substr_count($val['path'],',')).'|----'.$val['cname'] ?></option>
                            <?php endforeach ?>
                            <?php else: ?>
                            <?php endif ?>
                </select>
            </td>
        </tr>
        <tr style="height: 50px;">
            <td width="100" align="right">
                价格:
            </td>
            <td width="250">
                <input name="price" style="width: 250px" value="" id="price" />
            </td>
        </tr>
        <tr style="height: 50px;">
            <td width="100" align="right">
                库存:
            </td>
            <td width="250">
                <input name="stock" style="width: 250px" value="" id="stock" />
            </td>
        </tr>
        <tr style="height: 50px;">
            <td width="100" align="right">
                简介:
            </td>
            <td width="250">
                <textarea name="msg" id="msg" cols="30" rows="10" style="width: 250px"></textarea>
            </td>
        </tr>
    </table>
     <div style="text-align:left;padding:20px;">
     <center><input type="submit" value="添加"></center>
<!--        <a href="" class="easyui-linkbutton" style="width:80px" ">修改</a> -->
    </div>
    </form></center>


</script>

<script type="text/javascript">
    function check()
    {
        if ($('#name').val() == '') 
        {
            layer.msg('请输入商品名');
            setTimeout(function(){
                $('#name').focus();
            });
            return false;
        }
        if($('#price').val() == ''){
            layer.msg('请输入价格');
            setTimeout(function(){
                $('#price').focus();
            });
            return false;
        }
         if($('#stock').val() == ''){
            layer.msg('请输入库存');
            setTimeout(function()
            {
                $('#stock').focus();
            });
            return false;
        }
        if($('#msg').val() == ''){
            layer.msg('请输入简介');
            setTimeout(function(){
                $('#msg').focus();
            });
            return false;
        }
    }


</script>

</body>
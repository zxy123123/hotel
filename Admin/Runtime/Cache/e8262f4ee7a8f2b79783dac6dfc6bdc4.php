<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>添加子类</h1>
    <table style="margin-top:50px">
    <form action="<?php echo U('Adminstore/addchild');?>" method="post" onsubmit="return check()"> 
    <tr>
        <th>
        <input type="hidden" name="pid" value="<?php echo ($pid); ?>" readonly="readonly">
        <input type="hidden" name="path" value="<?php echo ($path); ?>" readonly="readonly">
        名称: <input type="text" name="cname" class="cname">
        </th>
        <th>
        <input type="submit">
        </th>
    </tr>
    </table>
    </form>

    <script>
    function check()
    {
        if ($('.cname').val() == '') 
        {
            layer.msg('请输入分类名');
            setTimeout(function(){
                $('.cname').focus();
            });
            return false;
        }
    }

    </script>


</body>
</html>
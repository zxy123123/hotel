<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script src="__PUBLIC__/layer/layer.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>添加顶级分类</h1>
    <form action="<?php echo U('Adminstore/doaddcate');?>" method="post" onsubmit="return check()">
        <table>
        <input type="hidden" name="pid" value="<?php echo ($pid); ?>" readonly="readonly">
        <input type="hidden" name="path" value="<?php echo ($path); ?>" readonly="readonly">
            <tr>
                    <th>名称<input type="text" name="cname" id="name"></th>
            </tr>
            <tr>
                    <th><input type="submit"> </th>
            </tr>
        </table>
    </form>
            
    <script>
        function check()
        {
            if ($('#name').val() == '') 
            {
                layer.msg('请输入分类名');
                setTimeout(function(){
                    $('#name').focus();
                });
                return false;
            }
        }
    </script>

</body>
</html>
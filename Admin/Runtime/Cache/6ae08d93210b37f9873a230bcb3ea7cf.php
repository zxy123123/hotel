<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>编辑分类</h1>
    <table style="margin-top:50px">
    <form action="<?php echo U('Adminstore/doeditcate');?>" method="post" onsubmit="return check()"> 
    <tr>
        <th>
        <input type="hidden" name="id" value="<?php echo ($list['id']); ?>" >

        名称: <input type="text" name="cname" class="cname" value="<?php echo ($list['cname']); ?>">
        </th>
        <th>
        <input type="submit" value="修改">
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
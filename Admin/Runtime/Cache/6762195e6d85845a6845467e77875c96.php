<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script src="__PUBLIC__/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/layer/layer.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>更换图片</h1>
<form method="post" action="" enctype="multipart/form-data" class="upfile"  onsubmit="return check()"> 

 <input name="token" type="hidden" value="<?php echo ($uptoken); ?>">

  <input name="file" type="file" id="picture"/>

  <input type="submit" value="修改">

  </form>

<script>
    function check()
    {
         if($('#picture').val() == '')
         {
            layer.msg('请选择图片');
            setTimeout(function(){
                $('#picture').focus();
            });
            return false;
        }else{
            return true;
        }
    }

</script>

</body>
</html>
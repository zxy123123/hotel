<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<link href="__PUBLIC__/css/store.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>

    <title>Document</title>
</head>
<body>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods">
<a href="<?php echo U('Store/gooddetail');?>?id=<?php echo ($vo["id"]); ?>"><img src="<?php echo ($vo["iname"]); ?>" alt=""></a>
<p style="text-align:center"><?php echo ($vo["gname"]); ?></p>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>
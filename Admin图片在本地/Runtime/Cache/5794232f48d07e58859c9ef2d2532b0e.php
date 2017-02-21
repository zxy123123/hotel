<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
</head>
<body>
    <div>
        <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
            <tr>
                <th>帖子名</th>
                <th>所属贴吧</th>
                <th>所属分类</th>
                <th>发帖人</th>
                <th>帖子内容</th>
                <th>浏览量</th>
                <th>评论数</th>
                <th>关注数</th>
                <th>分享数</th>
                <th>操作</th>
            </tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo ($vo["tdn"]); ?></td>
                <td><?php echo ($vo["tcdn"]); ?></td>
                <td><?php echo ($vo["nickname"]); ?></td>
                <td><?php echo ($vo["content"]); ?></td>
                <td><?php echo ($vo["view_num"]); ?></td>
                <td><?php echo ($vo["comment_num"]); ?></td>
                <td><?php echo ($vo["heart_num"]); ?></td>
                <td><?php echo ($vo["share_num"]); ?></td>
                <td><button class="del" bh="<?php echo ($vo["id"]); ?>">删除</button></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>

    <script>
    $('.del').click(function(){
        var id = $(this).attr('bh');
        if (confirm('确认删除吗?') == true) 
        {
            $.ajax({
                type:'post',
                url:"<?php echo U('Tieba/opcdel');?>",
                dataType:"json",
                data:{'id':id},
                success:function(data){
                    if (data > 0) 
                    {
                        alert('已删除');
                        window.location.reload();
                    }else{
                        alert('删除失败');
                    }
                }
            })
        }
    })




    </script>





</body>
</html>
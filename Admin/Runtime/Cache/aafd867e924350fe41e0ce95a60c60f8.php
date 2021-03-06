<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
<title>后台管理</title>
</head>
    <style>
        .stage{
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:rgba(0,0,0,0.2);
            display:none;
        }
        .form{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding:10px;
            background: #fff;
        }
        .close{
            position:absolute;
            cursor: pointer;
            top:0;
            right:0;
            transform: translate(50%,-50%);
            width:14px;
            height:14px;
            text-align: center;
            line-height:14px;
            border-radius: 100%;
            background:gray;
        }
    </style>
<body>
<div >
    <form action="<?php echo U('Order/refund');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">手机号</option>
        </select>
    </div>
    <div style="float:left">
        <input type="text" name="hotel" >
    </div>
    <div>
        <input type="submit" value="搜索">
    </div>
    </form>
	<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th >ID</th>
				<th >对应订单</th>
                                                <th>用户</th>
                                                <th>手机号</th>
				<th>退款金额</th>
				<th >退款方式</th>
                                                <th>到账时间</th>
				<th >退款状态</th>
				<th>操作</th>
                                                <th  >备注</th>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td ><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["order_id"]); ?></td>
                                                <td><?php echo ($vo["uname"]); ?></td>
                                                <td><?php echo ($vo["up"]); ?></td>
                                                <td><?php echo ($vo["money"]); ?></td>
				<td>
                                                <?php if($vo["method"] == wechat): ?>微信钱包
                                                <?php elseif($vo["method"] == store): ?>店面退款
                                                <?php else: ?>积分<?php endif; ?>
                                                </td>
                                                <td><?php echo ($vo["refund_time"]); ?></td>
				<td >
                                                <?php if($vo["status"] == apply): ?>用户请求退款
                                                <?php elseif($vo["status"] == agree): ?>酒店同意退款
                                                <?php elseif($vo["status"] == reject): ?>酒店拒绝退款
                                                <?php else: ?>退款到账<?php endif; ?>
                                                </td>
				
                                            <td style="width:300px">
                                            <button class="agree" bh="<?php echo ($vo["id"]); ?>">同意退款</button>
                                            <button class="refuse" bh="<?php echo ($vo["id"]); ?>">拒绝退款</button>
                                            <button class="tui" bh="<?php echo ($vo["id"]); ?>">退款完成</button>
                                            <button class="mask" onclick="other(<?php echo ($vo["id"]); ?>)">修改备注</button>
                                            <div class="stage mask_<?php echo ($vo["id"]); ?>">
                                                <div class="form">
                                                    <form action="<?php echo U('Order/editcom');?>?id=<?php echo ($vo["id"]); ?>" method="post">
                                                        <input type="text" name="mask">
                                                        <input type="submit">
                                                    </form>
                                                    <span class="close">&times;</span>
                                                </div>
                                            </div>
                                            
                                            </td>
                                            <td ><?php echo ($vo["remark"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>



	<script>
	function other(id)
	{
		$('.mask_'+id).fadeIn('1000');
	}
	$('.close').click(function(){
		$('.stage').fadeOut('1000');
	})

            $('.tui').click(function(){
                var id = $(this).attr('bh');
                $.ajax({
                    type:'post',
                    url:"<?php echo U('Order/tuikuan');?>",
                    data:{'id':id},
                    datatype:'json',
                    success:function(data){
                        if (data >0) 
                        {
                            alert('退款完成');
                            window.location.reload();
                        }else{
                            alert('无法修改状态');
                        }
                    }
                })
            })

            $('.agree').click(function(){
                var id = $(this).attr('bh');
                $.ajax({
                    type:'post',
                    url:"<?php echo U('Order/agree');?>",
                    data:{'id':id},
                    datatype:'json',
                    success:function(data){
                        if (data > 0) 
                        {
                            alert('已同意');
                            window.location.reload();
                        }else{
                            alert('订单未完成或非请求退款状态');
                        }
                    }
                })
            })

            $('.refuse').click(function(){
                var id = $(this).attr('bh');
                $.ajax({
                    type:'post',
                    url:"<?php echo U('Order/refuse');?>",
                    data:{'id':id},
                    datatype:'json',
                    success:function(data){
                        if (data > 0) 
                        {
                            alert('已拒绝');
                            window.location.reload();
                        }else{
                            alert('拒绝失败');
                        }
                    }
                })
            })







	</script>
</body>
</html>
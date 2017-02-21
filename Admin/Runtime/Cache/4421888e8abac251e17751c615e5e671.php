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
        .stages{
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:rgba(0,0,0,0.2);
            display:none;
        }
        .forms{
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
        .closes{
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
    <form action="<?php echo U('Order/index');?>" method="get">
    <div style="float:left">
        <select name="chaxun" id="">
            <option value="1">电话</option>
        </select>
    </div>
    <div style="float:left">
        <input type="text" name="hotel" >
    </div>
    <div>
        <input type="submit" value="搜索">
    </div>
    </form>
</div>

	<table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
		<thead>
			<tr>
				<th >ID</th>
				<th>用户</th>
				<th>电话</th>
				<th>积分</th>
				<th >入住时间</th>
				<th >离店时间</th>
				<th  >支付状态</th>
				<th >支付方式</th>
				<th >是否入住</th>
				<th >详情</th>
				<th>操作</th>

			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td ><?php echo ($vo["oid"]); ?></td>
				<td><?php echo ($vo["uname"]); ?></td>
				<td><?php echo ($vo["up"]); ?></td>
				<td><?php echo ($vo["score"]); ?></td>
				<td ><?php echo ($vo["ost"]); ?></td>
				<td ><?php echo ($vo["oed"]); ?></td>
				<td  >
				<?php if($vo["ops"] == paid): ?>已支付
				<?php elseif($vo["ops"] == not_paid): ?>未支付
				<?php else: ?>支付失败<?php endif; ?>
				</td>
				<td >
				<?php if($vo["opm"] == wechat): ?>微信
				<?php elseif($vo["opm"] == score): ?>金币
				<?php else: ?>到店支付<?php endif; ?>
				</td>
				<td >
				<?php if($vo["check_in"] == 0): ?>未入住
				<?php else: ?>入住<?php endif; ?>
				</td>
				<td >
				<button class="qita" onclick="other(<?php echo ($vo["oid"]); ?>)">详情</button>
				<div class="stage qita_<?php echo ($vo["oid"]); ?>" >
		        		<div class="form">
				<table border="1" >
					<tr>
						<th width="80">酒店</th>
						<th width="80">房型</th>
						<th width="80">房间单价</th>
                                                                        <th width="80">订房数量</th>
						<th width="80">订单状态</th>
						<th width="80">最晚到店时间</th>
						<th width="80">微信支付的openid</th>
						<th width="80">特殊要求</th>
						<th width="80">备注</th>
						
					</tr>
					<tr>
						<td width="80"><?php echo ($vo["hn"]); ?></td>
						<td width="80"><?php echo ($vo["rdn"]); ?></td>
						<td width="80"><?php echo ($vo["rp"]); ?></td>
                                                                        <td width="80"><?php echo ($vo["orn"]); ?></td>
						<td width="80">
						<?php if($vo["oos"] == wait_for_pay): ?>等待付款
						<?php elseif($vo["oos"] == wait_for_confirm): ?>等待确认
						<?php elseif($vo["oos"] == success): ?>成功
						<?php elseif($vo["oos"] == cancle): ?>取消
						<?php else: ?>完成<?php endif; ?>
						</td>
						<td width="80"><?php echo ($vo["olat"]); ?></td>
						<td width="80"><?php echo ($vo["ooi"]); ?></td>
						<td width="80"><?php echo ($vo["osr"]); ?></td>
						<td width="80"><?php echo ($vo["ork"]); ?></td>
					</tr>
				</table>
			            <span class="close">&times;</span>
		        	<div>
	    	</div>
		</td>
		<td>
		<button class="mask" onclick="remark(<?php echo ($vo["oid"]); ?>)">备注</button>
		<div class="stages mask_<?php echo ($vo["oid"]); ?>">
		<div class="forms">
		<form action="<?php echo U('Order/mask');?>?id=<?php echo ($vo["oid"]); ?>" method="post">
		<input type="text" name="mask">
		<input type="submit">
		</form>
		<span class="closes">&times;</span>
		</div>
		</div>
		<!-- <button class="check" bh="<?php echo ($vo["oid"]); ?>">确认入住</button> -->
		<button>改签</button>
		<button class="del" bh="<?php echo ($vo["oid"]); ?>">删除</button>
		<!-- <a href="<?php echo U('Order/delorder');?>?id=<?php echo ($vo["id"]); ?>" onclick="if(confirm('确定要删除吗')==false)return false">删除</a> -->
		</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</thead>
	</table>

	<script>

	function other(id)
	{
		$('.qita_'+id).fadeIn('1000');
	}
	function remark(id)
	{
		$('.mask_'+id).fadeIn('1000');
	}

	$('.close').click(function(){
		$('.stage').fadeOut('1000');
	})
	$('.closes').click(function(){
		$('.stages').fadeOut('1000');
	})

	$('.check').click(function(){
		var id = $(this).attr('bh');
		$.ajax({
			type:'post',
			url:"<?php echo U('Order/surecheck');?>",
			data:{'id':id},
			success:function(data){
				if (data > 0) 
				{
					alert('已确认入住');
					window.location.reload();
				}else{
					alert('不可重复确认');
				}
			}
		})
		
	})

	$('.del').click(function(){
		var id=$(this).attr('bh');
		if (confirm('确定要删除吗') == true) 
		{
			$.ajax({
				type:'post',
				url:"<?php echo U('Order/delorder');?>",
				dataType:"json",
				data:{'id':id},
				success:function(data){
					if (data > 0) 
					{
						alert('已删除');
						window.location.reload();
					}else{
						alert('订单未完成无法删除');
					}
				}
			})
		}
	})









	</script>

<!-- <script language="JavaScript"> 
function re_fresh() { 
window.location.reload(); 
} 

setTimeout('re_fresh()',5000); //指定5秒刷新一次 

</script> -->







</body>
</html>
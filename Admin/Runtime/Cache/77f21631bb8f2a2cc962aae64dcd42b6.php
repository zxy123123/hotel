<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/admin.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="__PUBLIC__/js/vue.js" charset="utf-8"></script> -->
<!-- <script type="text/javascript" src="__PUBLIC__/js/vm-addr.js" charset="utf-8"></script> -->
<title>后台管理</title>
</head>
<body>
    <header>热门酒店</header>
                            <table>     
			<tr>
				<td>
				<select name="address1" id="address1">
				</select>

				<select name="address2" id="address2">
				</select>

				<select name="address3"  id="address3">
				</select>

				<input type="submit" value="设置" id="shezhi">
                                                </td>
				
			</tr>

	</table>
            <ul>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["fullname"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

<script type="text/javascript">
       //三级联动地址
       //获取省份的数据
        $.ajax({
            type:'get',
            url:"<?php echo U('City/addred');?>",
            async:false,
            success:function(data){
            	 //console.log(data);
                //将省份信息 追加到 下拉框中
                //先清空原先的数据
                $('#address1').empty();
                //遍历省份数据
                for (var i = 0; i < data.length; i++) {
                    $('<option value="'+data[i].code+'">'+data[i].fullname+'</option>').appendTo('#address1');
                };
            },
            dataType:'json',
        })

        //绑定事件
        $('#address1,#address2,#address3').change(function(){
            var upid = $(this).val();
            // console.log(upid);
            //清空之前的所有数据
            $(this).nextAll('select').empty();
            //保留 $(this) 的值
            var _this = $(this);
            //请求下一级的数据
            $.ajax({
                type:'get',
                url:"<?php echo U('City/addred');?>",
                data:"parent_code="+upid,
                success:function(data){
                	// console.log(data);
                    //如果下一级没有数据,就隐藏后面的下拉框
                    if (!data) {
                        _this.nextAll('select').hide();
                        return;
                    }
                    // console.log(data.length);
                    // 填充下一级的数据
                    for (var i = 0; i < data.length; i++) {
                        // console.log(_this.next('select'));
                        $('<option value="'+data[i].code+'">'+data[i].fullname+'</option>').appendTo(_this.next('select'));

                    }
                    //自动触发 后面的select 的change事件
                    _this.next('select').trigger('change');
                     _this.nextAll('select').show();
                },
                dataType:'json',
            })
        })

        //自动触发 #address1 的change
        $('#address1').trigger('change');

    $('#shezhi').click(function()
    {
        var sheng = $('#address1').val();
        var shi = $('#address2').val();
        var qu = $('#address3').val();
        // console.log(sheng);
        $.ajax({
            type:"post",
            url:"<?php echo U('City/setup');?>",
            data:{'sheng':sheng,'shi':shi,'qu':qu},
            success:function(data){
                // console.log(data);
                window.location.reload();
            }
        })
    })

</script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
<script src="__PUBLIC__/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="__PUBLIC__/ueditor/ueditor.all.js" type="text/javascript"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
<body>
<div class="easyui-panel" fit="true">
<form action="<?php echo U('Goods/doedithotela');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit = "return check()">
<input name="hotel_id" type="hidden" value="<?php echo ($list["id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店名称：
			</td>
			<td width="250">
				<input name="hotel_name" style="width: 250px" value="<?php echo ($list["name"]); ?>" id="name"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店星级：
			</td>
			<td width="250">
					
				<select name="hotel_star">
				<option value="inn" <?php if($list["grade"] == 'inn'): ?>selected<?php endif; ?>>客栈公寓</option>
				<option value="chain" <?php if($list["grade"] == 'chain'): ?>selected<?php endif; ?>>经济连锁</option>
				<option value="theme" <?php if($list["grade"] == 'theme'): ?>selected<?php endif; ?>>主题酒店</option>
				<option value="three_star" <?php if($list["grade"] == 'three_star'): ?>selected<?php endif; ?>>三星舒适</option>
				<option value="four_star" <?php if($list["grade"] == 'four_star'): ?>selected<?php endif; ?>>四星高档</option>
				<option value="five_star" <?php if($list["grade"] == 'five_star'): ?>selected<?php endif; ?>>五星豪华</option>
				
			</select>
					
			</td>
		</tr>
<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店主题：
			</td>
			<td width="250">
				<input name="hotel_title" class="easyui-validatebox textbox" required missingmessage="主题不能为空"
					style="width: 250px" value="<?php echo ($list["hotel_title"]); ?>"/>
			</td>
		</tr> -->
<!-- 		<tr style="height: 50px;">
			<td width="100" align="right">
				房间数量 ：
			</td>
			<td width="250">
				<input name="total_rooms" 
					style="width: 250px" value="<?php echo ($list["total_rooms"]); ?>"/>
			</td>
		</tr> -->
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店电话：
			</td>
			<td width="250">
				<input name="hotel_telephone" style="width: 250px" value="<?php echo ($list["phone_number"]); ?>" id="phone"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店地址：
			</td>
			<td width="250">
				<select name="address1" id="address1" >
				</select>
				<select name="address2" id="address2">
				</select>

				<select name="address3"  id="address3">
				</select>
				<input name="hotel_address" 
					style="width: 250px" value="<?php echo ($list["address"]); ?>" id="address"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				地址经度：
			</td>
			<td width="250">
				<input name="longitude" placeholder="请在底部的地图上查询经度" 
					style="width: 250px" value="<?php echo ($list["longitude"]); ?>" id="longitude"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				地址纬度：
			</td>
			<td width="250">
				<input name="latitude" placeholder="请在底部的地图上查询纬度" 
					style="width: 250px" value="<?php echo ($list["latitude"]); ?>" id="latitude"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				酒店邮箱：
			</td>
			<td width="250">
				<input name="hotel_email" style="width: 250px" value="<?php echo ($list["email"]); ?>" id="email"/>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				基础设施：
			</td>
			<td width="250">
				<label><input type="checkbox" name="checkbox[]" value="1" <?php if($row[0][infrastructure_id] == 1): ?>checked<?php endif; ?> >停车场</label> 
 				<label><input type="checkbox" name="checkbox[]" value="2" <?php if($row[1][infrastructure_id] == 2): ?>checked<?php endif; ?> >游泳池</label>
				<label><input type="checkbox" name="checkbox[]" value="3" <?php if($row[2][infrastructure_id] == 3): ?>checked<?php endif; ?> >接送服务</label>
				<label><input type="checkbox" name="checkbox[]" value="4" <?php if($row[3][infrastructure_id] == 4): ?>checked<?php endif; ?>>健身房</label>
				<label><input type="checkbox" name="checkbox[]" value="5" <?php if($row[4][infrastructure_id] == 5): ?>checked<?php endif; ?> >社交圈</label>
			</td>
		</tr>
		<tr style="height: 50px;">
			<td width="100" align="right">
				路线：
			</td>
			<td width="250">
				<textarea style="width: 600px;height: 100px;" name="routes" id="route"><?php echo ($list["routes"]); ?></textarea>
			</td>
		</tr>
		
                        <tr style="height: 50px;">
                            <td width="100" align="right">
                                退订和改签规则：
                            </td>
                            <td width="250">
                            <textarea style="width: 600px;height: 100px;" name="content" id="contents"><?php echo ($list['endorse_rules']); ?></textarea>
                            </td>
                        </tr>
        
		<tr style="height: 220px;">
			<td align="right">
				酒店简介：
			</td>
			<td>
				<textarea style="width: 600px;height: 200px;" name="introduction" id="intro"><?php echo ($list["introduction"]); ?></textarea>
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
	 <input type="submit" value="修改">
<!-- 		<a href="" class="easyui-linkbutton" style="width:80px" ">修改</a> -->
	</div>
	</form>
    <div style="width:730px;margin:auto;">   
        要查询的地址：<input id="text_" type="text" value="徐州古彭广场" style="margin-right:100px;"/>
        查询结果(经纬度)：<input id="result_" type="text" />
        <input type="button" value="查询" onclick="searchByStationName();"/>
        <div id="container" 
            style="
                margin-top:30px; 
                width: 730px; 
                height: 590px; 
                top: 50; 
                border: 1px solid gray;
                overflow:hidden;">
        </div>
    </div>
</div>
<!-- <script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script> -->
<script type="text/javascript">
   var map = new BMap.Map("container");
    map.centerAndZoom("徐州", 12);
    map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
    map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
    map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
    map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
    map.addControl(new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT }));   //右下角，打开
    var localSearch = new BMap.LocalSearch(map);
    localSearch.enableAutoViewport(); //允许自动调节窗体大小
function searchByStationName() {
    map.clearOverlays();//清空原来的标注
    var keyword = document.getElementById("text_").value;
    localSearch.setSearchCompleteCallback(function (searchResult) {
        var poi = searchResult.getPoi(0);
        document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat;
        map.centerAndZoom(poi.point, 13);
        var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
        map.addOverlay(marker);
        var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
        var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
        marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
        // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        var jing = poi.point.lng;
        var wei = poi.point.lat;
        console.log(jing)
        console.log(wei)
    });
    localSearch.search(keyword);
} 
	// function submitForm(){
	// 	var isClickOk = true;
	// 	$.messager.defaults={ok:"确定",cancel:"取消"}; 
	// 	$.messager.confirm('Confirm', '您确定修改?', function(r){
	// 		if (r){
	// 			$('#editForm').form('submit',{
	// 				url:"__APP__/Goods/edithotel",
	// 				onSubmit: function(){
	// 					if(isClickOk==false){
	// 						$.messager.alert('操作提示', '主键不能重复！','error');
	// 						return false;
	// 					}else if ($('#editForm').form('validate')) {
	// 						$.messager.alert('操作提示', '修改成功','info');
							//parent.$.dialog({id: 'test123'}).close();
						// 	return true;
						// }else{
						// 	$.messager.alert('操作提示', '信息填写不完整！','error');
						// 	return false;	
						// 	}								
	// 				},
	// 				success: function(){
	// 					//表单提交成功后执行的函数
	// 				}
	// 			});
	// 		}		
	// 	});	
	// }
</script>

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
       
		//上传图片
		$(document).on('change','#picture',function(){
		    $.ajaxFileUpload({
		        url:'<?php echo U("Company/ImgUpload");?>',
		        secureuri:false,
		        fileElementId:'picture',
		        dataType: 'json',
		        type:'post',
		        data: { fileElementId: 'picture'},
		        // success: function (data) {
		              
		        // $('#showimg').attr('src',data.upfile.url);
		        // $('#imageurl').val(data.upfile.url);
		        // }　　　　　　　　 
		    }) 
		})




	function check()
	{
		 if($('#phone').val() == ''){
			layer.msg('请输入酒店电话');
			setTimeout(function(){
				$('#phone').focus();
			});
			return false;
		}else if($('#address').val() == ''){
			layer.msg('请输入酒店地址');
			setTimeout(function(){
				$('#address').focus();
			});
			return false;
		}else if($('#longitude').val() == ''){
			layer.msg('请输入经度');
			setTimeout(function(){
				$('#longitude').focus();
			});
			return false;
		}else if($('#latitude').val() == ''){
			layer.msg('请输入纬度');
			setTimeout(function(){
				$('#latitude').focus();
			});
			return false;
		}else if($('#email').val() == ''){
			layer.msg('请输入酒店邮箱');
			setTimeout(function(){
				$('#email').focus();
			});
			return false;
		}else if($('#route').val() == ''){
			layer.msg('请输入路线');
			setTimeout(function(){
				$('#route').focus();
			});
			return false;
                        }else if($('#contents').val() == ''){
                                    layer.msg('请输入退订改签规则');
                                    setTimeout(function(){
                                        $('#contents').focus();
                                    });
                                    return false;
                        }else if($('#contents').val() == ''){
                                    layer.msg('请输入退订改签规则');
                                    setTimeout(function(){
                                        $('#contents').focus();
                                    });
                                    return false;
                        }else if($('#intro').val() == ''){
                            layer.msg('请输入酒店简介');
                            setTimeout(function(){
                                $('#intro').focus();
                            });
                            return false;
		}else{
			return true;
		}
	}


</script>

</body>
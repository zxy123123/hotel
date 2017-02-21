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

<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/iframe.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset.css" /> -->
<script src="__PUBLIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<!-- <script src="//hm.baidu.com/hm.js?4b889ea3d1a9c076184ed8da84e5d719" ></script> -->

<script src="__PUBLIC__/layer/layer.js" type="text/javascript"></script>
<!-- <script src="__PUBLIC__/js/ajaxfileupload.js" type="text/javascript"></script> -->
<!-- <script>

    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?4b889ea3d1a9c076184ed8da84e5d719";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();

</script> -->
<body>
<!-- <div class="easyui-panel" fit="true"> -->
<!-- <form action="<?php echo U('Goods/uploadify');?>" id="editForm" method="post" enctype="multipart/form-data" onsubmit="return check()">
<input name="type_id" type="hidden" value="<?php echo ($list["id"]); ?>"/> 
	<table width="780" border="0">
		<tr style="height: 50px;">
			<td align="right">
				修改：
			</td>
			<td>
				<input id="picture" name="img" type="file">
				<div id="up_image" class="image">
				</div>
			</td>
		</tr>
	</table>
	 <div style="text-align:left;padding:20px;">
		<input type="submit" value="修改">
	</div>
	</form> -->
<form method="post" action="http://up.qiniu.com" enctype="multipart/form-data" class="upfile"  onsubmit="return check()"> 

 <input name="token" type="hidden" value="<?php echo ($uptoken); ?>">

  <input name="file" type="file" id="uploadPic"/>

  <input type="submit" name="修改" id="btn">

  </form>

<!--   <form class="fileForm picUpload" method="post" action="http://up.qiniu.com" enctype="multipart/form-data" class="upfile"  onsubmit="return check()"> 

 <input name="token" type="hidden" value="<?php echo ($uptoken); ?>">

  <input name="file" type="file" id="uploadPic"/>
<label id="fileBtn" for="uploadPic">
        +
        <img class="showPic" src="" />
    </label>
        <span class="tip">
    请上传图片，大小在2M以内<br/>
    (图片类型可为jpg,jepg,png,gif,bmp)<br/>
    推荐图片比例为640*400
    </span>
  <input type="submit" name="修改">
  </form> -->

<!-- <form class="fileForm picUpload" action="http://up.qiniu.com" enctype="multipart/form-data" method="post">
 <input name="token" type="hidden" value="<?php echo ($uptoken); ?>">
<input id="uploadPic" name="file" type="file">

<label id="fileBtn" for="uploadPic">
        +
        <img class="showPic" src="" />
    </label>
    <span class="tip">
    请上传图片，大小在2M以内<br/>
    (图片类型可为jpg,jepg,png,gif,bmp)<br/>
    推荐图片比例为640*400
    </span> -->
<!-- <input class="turnUrl" name="turnUrl" style="display:none" type="text"> -->
<!-- <input value="submit" style="display:none" type="submit"> -->
<!-- </form> -->
<!-- <canvas id="uploadImg" style="display:none"></canvas> -->
<!-- </div> -->
<script type="text/javascript">
	function check()
	{
		if ($('#uploadPic').val() == '') 
		{
			layer.msg('请上传图片');
			setTimeout(function(){
				$('#uploadPic').focus();
			});
			return false;
		}
 		var file = $("#uploadPic")[0].files[0];
		        if(file.size>4194304){
		            alert("上传图片请小于4M");
		            return false;
		        }else if (!/image\/\w+/.test(file.type)) {
		            alert("文件必须为图片！");
		            return false;
		        }
		}

		// $("#uploadPic").on('change', function(event) {
		//         var file = $(this)[0].files[0];
		//         if(file.size>4194304){
		//             alert("上传图片请小于4M");
		//             history.back(-1)
		//             return false;
		//         }else if (!/image\/\w+/.test(file.type)) {
		//             alert("文件必须为图片！");
		//             window.location.reload();
		//             return false;
		//         }
  //  		 });

    // function createCanvas(src) {
    //     var canvas = document.getElementById("uploadImg");
    //     var cxt = canvas.getContext('2d');
    //     canvas.width = 640;
    //     canvas.height = 400;
    //     var img = new Image();
    //     img.src = src;
    //     img.onload = function() {
    //         // var w=img.width;
    //         // var h=img.height;
    //         // canvas.width= w;
    //         // canvas.height=h;
    //         cxt.drawImage(img, 0, 0,640,400);
    //         //cxt.drawImage(img, 0, 0);
    //         $(".showPic").show().attr('src', canvas.toDataURL("image/jpeg", 0.9));
    //         $.ajax({
    //             url: "/front/uploadByBase64.do",
    //             type: "POST",
    //             data: {
    //                 "imgStr": canvas.toDataURL("image/jpeg", 0.9).split(',')[1]
    //             },
    //             success: function(data) {
    //                 console.log(data);
    //                 $(".showPic").show().attr('data-url',"/"+ data.url);
    //             }
    //         });
    //     }
    // }

	//上传图片
// $(document).on('change','#upfile',function(){
//     $.ajaxFileUpload({
//         url:'<?php echo U("Goods/ImgUpload");?>',
//         secureuri:false,
//         fileElementId:'upfile',
//         dataType: 'json',
//         type:'post',
//         data: { fileElementId: 'upfile'},
//         success: function (data) {
              
//         $('#showimg').attr('src',data.upfile.url);
//         $('#imageurl').val(data.upfile.url);
//         }　　　　　　　　 
//     }) 
// })


</script>
<!-- <script type="text/javascript" src="__PUBLIC__/lhgdialog/lhgdialog.min.js"></script> -->
</body>
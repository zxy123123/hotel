<?php if (!defined('THINK_PATH')) exit();?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/themes/default/easyui.css" />

</head>
<body>
<div class="easyui-accordion" data-options="fit:false,border:false">
	<div title="订单管理" icon="icon-sys" style="height:150px" >
       <ul class="easyui-tree">
		<li ><a href="javascript:" style="color: #000" onclick="addTab('所有订单','__APP__/Order/index');">
		    所有订单</a><i></i></li>
		<li><a href="javascript:" style="color: #000" onclick="addTab('未入住订单','__APP__/Order/onorder');">
		    未入住订单</a><i></i></li>   
		<li><a href="javascript:" style="color: #000" onclick="addTab('已入住订单','__APP__/Order/payorder');">
		    已入住订单</a><i></i></li>
                            <li><a href="javascript:" style="color: #000" onclick="addTab('退款订单','__APP__/Order/refund');">
                                退款订单</a><i></i></li>
	    </ul>
    </div>
	
	<?php if($_SESSION['permission']==1){?>
    <div title="管理员管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
		<li><a href="javascript:" style="color: #000" onclick="addTab('管理员设置','__APP__/Auser/index');">
		    管理员设置</a><i></i></li>
	    </ul>
    </div>
	<?php }?> 
	
	 <div title="酒店管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
		<li><a href="javascript:" style="color: #000" onclick="addTab('酒店管理','__APP__/Goods/hotelinfo');">
		    酒店管理</a><i></i></li>
	    </ul>
       <ul class="easyui-tree">
        <li><a href="javascript:" style="color: #000" onclick="addTab('上传酒店','__APP__/Goods/uphotel');">
            上传酒店</a><i></i></li>
        </ul>
    </div>
	
	<?php if($_SESSION['permission']==0){?>
    <div title="房间管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
		<li><a href="javascript:" style="color: #000" onclick="addTab('房间管理','__APP__/Goods/index');">
		    房间管理</a><i></i></li>
	    </ul>
       <ul class="easyui-tree">
        <li><a href="javascript:" style="color: #000" onclick="addTab('添加房间','__APP__/Goods/addpd');">
            添加房间</a><i></i></li>
        </ul>
    </div>
	<?php }?> 
    <div title="用户管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
		<li><a href="javascript:" style="color: #000" onclick="addTab('所有用户','__APP__/User/index');">
		    所有用户</a><i></i></li>
	    </ul>
    </div>
	
	<?php if($_SESSION['permission']==0){?>
	  <div title="积分管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
		<li><a href="javascript:" style="color: #000" onclick="addTab('积分充值','__APP__/Credit/index');">
		    积分充值</a><i></i></li>
		<li><a href="javascript:" style="color: #000" onclick="addTab('积分记录','__APP__/Credit/query');">
		    积分记录</a><i></i></li>
	    </ul>
    </div>
	<?php }?> 

    <?php if($_SESSION['permission']==0){?>
      <div title="城市管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
        <li><a href="javascript:" style="color: #000" onclick="addTab('热门城市','__APP__/City/hot');">
            热门城市</a><i></i></li>
        <li><a href="javascript:" style="color: #000" onclick="addTab('显示城市','__APP__/City/show');">
            显示城市</a><i></i></li>
        </ul>
    </div>
    <?php }?> 
   
    <?php if($_SESSION['permission']==0){?>
      <div title="贴吧管理" icon="icon-sys" style="height:150px">
       <ul class="easyui-tree">
        <li><a href="javascript:" style="color: #000" onclick="addTab('帖子管理','__APP__/Tieba/topic');">
            帖子管理</a><i></i></li>
        <li><a href="javascript:" style="color: #000" onclick="addTab('话题管理','__APP__/Tieba/gambit');">
            话题管理</a><i></i></li>
        </ul>
    </div>
    <?php }?> 

</div>
</body>
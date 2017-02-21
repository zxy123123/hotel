<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>
    <meta charset="UTF-8">
<link href="__PUBLIC__/css/store.css" rel="stylesheet" type="text/css" />    
    <title>Document</title>
</head>
    <style>
        #stage{
            display:none;
            position:fixed;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:rgba(0,0,0,0.5);
        }
        #forms{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding:10px;
            background: #fff;
        }
        #close{
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
            background:rgba(0,250,250,0.7)
        }
</style>
<body>
<span>收货信息:</span>
    <div>
            <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
                <tr>
                      <th>收货人</th>
                      <th>电话</th>
                      <th>地址</th>
                      <th>备注</th>
                      <th>修改</th>
                </tr>
                <tr>
                      <th><?php echo ($list["linkman"]); ?></th>
                      <th><?php echo ($list["phone"]); ?></th>
                      <th><?php echo ($list["address"]); ?></th>
                        <th><?php echo ($list["remark"]); ?></th>
                      <th><button id="btn">修改</button></th>
    <div   id="stage">
    <div id="forms">
        <form action="<?php echo U('Store/edaddress');?>" method="post" onsubmit="return check()">
        <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>">
            <div>姓名:<input type="text" value="<?php echo ($list["linkman"]); ?>" name="linkman" class="name"></div>
            <div style="margin-top:10px">电话:<input type="text" value="<?php echo ($list["phone"]); ?>" name="phone" class="phone"></div>
            <div style="margin-top:10px">地址:<input type="text" value="<?php echo ($list["address"]); ?>" name="address" class="address"></div>
            <div style="marg
            in-top:10px">备注:<input type="text" value="<?php echo ($list["remark"]); ?>" name="remark" class="remark"></div>
            <center><input type="submit" value="修改"></center>
        </form>
           <span id="close">&times;</span>
    </div>
    </div>
    <div>
        <!-- <button id="btn">添加地址</button> -->
    </div>
    </div>
                </tr>
            </table>
    </div>



     <div style="margin-top:50px">
    <table border="1" cellpadding="1" cellspacing="1" width="100%" align="center">
            <tr>
                    <th>商品</th>
                    <th>商品名</th>
                    <th>商品价格</th>
                    <th>购买数量</th>
                    <!-- <th>总价</th> -->
                    <!-- <th>操作</th> -->
            </tr>
            <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><img src="<?php echo ($vo["iname"]); ?>" alt=""></td>
                    <td><a href="<?php echo U('Store/gooddetail');?>?id=<?php echo ($vo["iid"]); ?>"><?php echo ($vo["gname"]); ?></a></td>
                    <td><?php echo ($vo["price"]); ?></td>
                    <td><?php echo ($vo["qty"]); ?></td>
                    <!-- <td><?php echo ($vo[price] * $vo[qty]); ?></td> -->
                    <!-- <td rowspan="2"><button class="jiesuan" bh=<?php echo ($vo["id"]); ?>>结算</button></td> -->
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>

    <div style="margin-top:20px">
    <table border="1" cellpadding="1" cellspacing="1" width="50%" align="center">
    <form action="<?php echo U('Store/sureorder');?>" method="post" onsubmit="return allprices()">
    <tr>
        <th>确认订单</th>
    </tr>
    <tr>
        <td>
        总计:
    <input type="text" value="<?php echo ($sum); ?>" readonly="readonly" name="allprice" class="allprice">
        </td>
    </tr>
    <tr>
        <td>
        <input type="submit" value="提交订单">
        </td>
    </tr>
    </table>
</form>
    </div>





<script>
        $('#btn').click(function(){
            $('#stage').css('display','block')
        })
        $('#close').click(function(){
            $('#stage').css('display','none')
        })


        function allprices()
        {
            if ($('.allprice').val() == '' || $('.allprice').val() == 0) 
            {
                layer.msg('亲,没有购买任何商品哦',{icon:5});
                setTimeout(function(){
                    $('.allprice').focus();
                });
                return false;
            }
        }



        function check()
        {
          if ($('.name').val() == '') 
          {
            layer.msg('请输入姓名');
            setTimeout(function(){
              $('.name').focus();
            });
            return false;
          }else if($('.phone').val()==''){
            layer.msg('请输入电话');
            setTimeout(function(){
              $('.phone').focus();
            });
            return false;
          }else if($('.address').val() == ''){
            layer.msg('请输入地址');
            setTimeout(function(){
              $('.address').focus();
            });
            return false;
          }
        }

        $('.deny').click(function(){
            if ($(this).text() == '设为默认地址') {
                $(this).text('默认地址');
                window.location.reload();
            }else{
                $(this).text('设为默认地址');
                window.location.reload();
            }
            var id = $(this).attr('bh');
            $.ajax({
                type:'get',
                url:"<?php echo U('Store/mo');?>"+'?id='+id,
            })
        });


</script>




</body>
</html>
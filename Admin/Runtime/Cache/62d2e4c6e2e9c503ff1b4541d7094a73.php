<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.js"></script>

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
    <meta charset="UTF-8">
<link href="__PUBLIC__/css/store.css" rel="stylesheet" type="text/css" />    
    <title>Document</title>
</head>
<body>
    <div >
    <table border="1"  width="100%" align="center"  class="normalTab">
            <tr>
                <th>联系姓名</th>
                <th>联系电话</th>
                <th>地址详情</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["linkman"]); ?></td>
                <td><?php echo ($vo["phone"]); ?></td>
                <td><?php echo ($vo["address"]); ?></td>
                <td><?php echo ($vo["remark"]); ?></td>
                <td>
                <?php if(($vo["operate"] == 2)): ?><button class="deny" bh="<?php echo ($vo["id"]); ?>">默认地址</button>
                <?php else: ?><button class="deny" bh="<?php echo ($vo["id"]); ?>">普通地址</button><?php endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <center>
    <div   id="stage">
    <div id="forms">
     <form action="<?php echo U('Store/addaddress');?>" method="post" onsubmit="return check()" >
         <table>
            <tr>
             <th>联系姓名：</th>
             <td><input type="text" class="name" name="name" />
             <span class="lm"></span>
             </td>
           </tr>

           <tr>
             <th>联系电话：</th>
             <td><input type="text" class="phone" name="phone" />
              <span class="lxd"></span>
             </td>
           </tr>

           <tr>
             <th>送货地址：</th>
             <td>
              <input type="text" class="address" name="address" placeholder="请填写详细地址">
              <span class="xxadd"></span>
            </td>
           </tr>

           <tr>
             <th>备&nbsp;&nbsp;注：</th>
             <td><input type="text" placeholder="如公司、家" class="weier" name="mark">
             </td>
           </tr>

         </table>

         <div class="bottom">
           <input type="submit" value="立即添加" class="checkInSuccesss"> 
         </div>

            <span id="close">&times;</span>
        </form>
</div>
    </div>
    <div>
        <button id="btn">添加地址</button>
    </div>
    </center>
    </div>

<script>
        $('#btn').click(function(){
            $('#stage').css('display','block')
        })
        $('#close').click(function(){
            $('#stage').css('display','none')
        })

        $('.jiesuan').click(function(){
            layer.msg('已生成订单');
            window.location.href="<?php echo U('Store/orders');?>"
        })

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
            if ($(this).text() == '普通地址') {
                $(this).text('默认地址');
                window.location.reload();
            }else{
                $(this).text('普通地址');
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
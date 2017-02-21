<?php
// namespace Common\Common;
// use Common\Common;
class OrderAction extends Action {
    public function index() {
        // var_dump($_SESSION);
        // var_dump($_REQUEST);
        if ($_SESSION['permission'] == 0) //等于0是普通用户
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
         $what = "(orders.hotel_id = ".$one['hotel_id'].")";
         if ($_REQUEST['chaxun'] == 1) 
         {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (user_usual_infos.phone like '%".$_REQUEST['hotel']."%')";
            }
         }
         $order = M('orders');
         $list = $order->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.payment_method opm,orders.check_in,orders.room_num orn,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.special_requirement osr,orders.remark ork')->order('oed desc')->select();
         // echo $order->getLastSql();
         // V($list);
 // var_dump(pathinfo("/testweb/test.txt",PATHINFO_EXTENSION));


     // var_dump($list);
    $this->assign('list',$list);
        }else{
        $what = array();
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what['user_usual_infos.phone'] = array('like','%'.$_REQUEST['hotel'].'%');
            }
        }

         $order = M('orders');
         $list = $order->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.room_num orn,orders.payment_method opm,orders.check_in,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.special_requirement osr,orders.remark ork')->order('oed desc')->select();
         // echo $order->getLastSql();
    // var_dump($list);
    $this->assign('list',$list);
        }

        $this->display('order');
    }

    public function surecheck()
    {

        if (IS_AJAX) 
        {
            $id = $_POST['id'];
            if (empty($id)) 
            {
                $this->error('失败,请重试');
                exit;
            }else{
                $one = $_POST['id'];
                $two = M('orders')->field('user_id,hotel_id')->where(array('id'=>$one))->find();//查询会员的id和入住酒店的id
                $wubai = M('hotel_admin')->field('credit')->where(array('hotel_id'=>$two['hotel_id']))->find();
                if ($wubai['credit'] <= 500) 
                {
                    $this->ajaxReturn('3');
                }else{
                $tt = $two['user_id'];
                $three = M('users')->field('score,hotel_id')->where(array("id"=>$tt))->find();//查询会员的积分和所属酒店的id
                if ($two['hotel_id'] == $three['hotel_id']) //如果相等说明A会员在A酒店
                {
                    $aa['score'] = $three['score'] +10;//那么A会员积分加10
                    $bb = M('users')->where(array('id'=>$tt))->save($aa);//用setinc方法不起作用
                    $zhifu['payment_status'] = 'paid';//会员入住后把支付状态改成支付成功
                    $zhifucg = M('orders')->where(array('id'=>$id))->save($zhifu);
                    $cc = M('hotel_admin')->field('credit')->where(array('hotel_id'=>$three['hotel_id']))->find();//查询所属酒店的积分
                    $dd['credit'] = $cc['credit']-10;//把酒店积分减去10
                    $ee = M('hotel_admin')->where(array('hotel_id'=>$three['hotel_id']))->save($dd);
                }else{//如果不相等说明A会员在B酒店,B酒店减30个积分,a酒店加10积分,不管A会员在哪个酒店入住都会加10积分
                    $ff['score'] = $three['score'] +10;//那么A会员积分加10
                    $gg = M('users')->where(array('id'=>$tt))->save($ff);//用setinc方法不起作用
                    $zhifu['payment_status'] = 'paid';
                    $zhifucg = M('orders')->where(array('id'=>$id))->save($zhifu);
                    $hh = M('hotel_admin')->field('credit')->where(array('hotel_id'=>$three['hotel_id']))->find();//查询会员所属酒店的积分然后加10
                    $ii['credit'] = $hh['credit']+10;
                    $jj = M('hotel_admin')->where(array('hotel_id'=>$three['hotel_id']))->save($ii);
                    $kk = M('hotel_admin')->field('credit')->where(array('hotel_id'=>$two['hotel_id']))->find();//查询会员入住酒店的积分然后减30
                    $ll['credit'] = $kk['credit']-30;
                    $mm = M('hotel_admin')->where(array('hotel_id'=>$two['hotel_id']))->save($ll);
                    //往score表增加记录
                    $nn['score_num'] = 30;
                    $nn['hotelId'] = $three['hotel_id'];
                    $nn['contributor'] = $two['hotel_id'];
                    $nn['score_date'] = date('Y-m-d H:i:s');
                    $oo = M('score')->add($nn);
                }
            }
                $data['id'] = $id;
                $data['check_in'] = 1;
                $row = M('orders')->data($data)->save();

                if ($row !== false) 
                {
                    $this->ajaxReturn('1');
                }else{
                    $this->ajaxReturn('2');
                }
            }
        }
    }

    public function delorder()
    {
        
        $id = $_POST['id'];
        // var_dump($id);
        $row = M('orders')->field('order_status')->where(array('id'=>$id))->find();
        // var_dump($row);
        // exit;
        if ($row['order_status'] == 'finsh') 
        {
            $result = M('orders')->where(array('id'=>$id))->delete();
            if ($result !== false && $result !== 0) 
            {
                $this->ajaxReturn($result);
            }else{
                $this->ajaxReturn('false');
            }
        }else{
            $this->ajaxReturn('false');
        }
    }




    public function mask()
    {
        if (IS_POST) 
        {
            if (empty($_POST['mask'])) 
            {
                $this->error('请输入备注信息');
            }
            $data['id'] = $_GET['id'];
            $data['remark'] = $_POST['mask'];
            $row = M('orders')->data($data)->save();
            if ($row !== false) 
            {
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }

        }else{
            $this->redirect(U('Order/index'));
        }
    }


//退款订单
    public function refund()
    {
        if ($_SESSION['permission'] == 0) 
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
        // var_dump($one);
        // exit;
         $what = "(o.hotel_id = ".$one['hotel_id']." and r.order_id = o.id and o.usual_user_info_id = u.id)";

        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (u.phone like '%".$_REQUEST['hotel']."%')";
            }
        }

        $list = M('refunds')->field('r.*,u.name uname,u.phone up')->table('refunds r,user_usual_infos u,orders o')->where($what)->select();
        // echo M('refunds')->getLastSql();
        // var_dump($list);
        $this->assign('list',$list);
        }else{
        $what = "(r.order_id = o.id and o.usual_user_info_id = u.id)";
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (u.phone like '%".$_REQUEST['hotel']."%')";
            }
        }

        $list = M('refunds')->field('r.*,u.name uname,u.phone up')->table('refunds r,user_usual_infos u,orders o')->where($what)->select();
        // var_dump($list);
        $this->assign('list',$list);
        }
        $this->display();
    }

    public function tuikuan()
    {
        if (IS_AJAX) 
        {
            $id = $_POST['id'];
            $one = M('refunds')->field('status')->where(array('id'=>$id))->find();
            if ($one['status'] != 'agree') 
            {
                $this->ajaxReturn('-1');
            }else{
                $data['status'] = 'refund';
                $two = M('refunds')->where(array('id'=>$id))->save($data);
                if ($two !== false) 
                {
                    $pup['refund_id'] = $id;
                    $pup['status'] = 'refund';
                    $pup['created_at'] = date('Y-m-d H:i:s');
                    $pup['updated_at'] = date('Y-m-d H:i:s');
                    $bob = M('refund_records')->add($pup);
                    $this->ajaxReturn($two);
                }else{
                    $this->ajaxReturn('-1');
                }
            }
        }
    }

    public function agree()
    {
        if (IS_AJAX) 
        {
            $id = $_POST['id'];
            $one = M('refunds')->field('order_id')->where(array('id'=>$id))->find();
            if ($one) 
            {
                $two = M('orders')->field('order_status,refund')->where(array('id'=>$one['order_id']))->find();
                if ($two['order_status'] == 'success' && $two['refund'] == 1) 
                {
                    $data['status'] = 'agree';
                    $three = M('refunds')->where(array('id'=>$id))->save($data);
                    if ($three !== false) 
                    {
                        $pup['refund_id'] = $id;
                        $pup['status'] = 'agree';
                        $pup['created_at'] = date('Y-m-d H:i:s');
                        $pup['updated_at'] = date('Y-m-d H:i:s');
                        $bob = M('refund_records')->add($pup);
                        $this->ajaxReturn($three);
                    }else{
                        $this->ajaxReturn('-2');
                    }
                }else{
                    $this->ajaxReturn('-1');
                }

            }else{
                $this->ajaxReturn('false');
            }
        }
    }

    public function refuse()
    {
        if (IS_AJAX) 
        {
            $id = $_POST['id'];
            $one = M('refunds')->field('status')->where(array('id'=>$id))->find();
            if ($one['status'] !== 'apply') 
            {
                $this->ajaxReturn('-1');
            }else{
                $data['status'] = 'reject';
                $two = M('refunds')->where(array('id'=>$id))->save($data);
                if ($two !== false) 
                {
                    $pup['refund_id'] = $id;
                    $pup['status'] = 'reject';
                    $pup['created_at'] = date('Y-m-d H:i:s');
                    $pup['updated_at'] = date('Y-m-d H:i:s');
                    $bob = M('refund_records')->add($pup);
                    $this->ajaxReturn($two);
                }else{
                    $this->ajaxReturn('-2');
                }
            }
        }
    }







    public function editcom()
    {
        if (IS_POST) 
        {
            if (empty($_POST['mask'])) 
            {
                $this->error('请输入备注');
                exit;
            }
            $id=$_GET['id'];
            $data['remark'] = $_POST['mask'];
            $row = M('refunds')->where(array('id'=>$id))->save($data);
            if ($row !== false) 
            {
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }

        }else{
            $this->redirect(U('Order/refund'));
        }
    }






//未入住订单
    public function onorder()
    {
        // var_dump($_REQUEST);
        if ($_SESSION['permission'] == 0) 
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
         $what = "(orders.hotel_id = ".$one['hotel_id']." and check_in = 0)";
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (user_usual_infos.phone like '%".$_REQUEST['hotel']."%')";
            }
        }

        $list = M('orders')->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.payment_method opm,orders.check_in,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.room_num orn,orders.special_requirement osr,orders.remark ork')->select();
        // var_dump($list);
        // echo M('orders')->getLastSql();
        $this->assign('list',$list);
        }else{
        $what = "(check_in = '0')";
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (user_usual_infos.phone like '%".$_REQUEST['hotel']."%')";
            }
        }
        $list = M('orders')->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.payment_method opm,orders.check_in,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.special_requirement osr,orders.room_num orn,orders.remark ork')->select();
        // var_dump($list);
        // echo M('orders')->getLastSql();
        $this->assign('list',$list);
        }
        $this->display();
    }

//已入住订单
    public function payorder()
    {
        if ($_SESSION['permission'] == 0) 
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
         $what = "(orders.hotel_id = ".$one['hotel_id']." and check_in = 1)";
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (user_usual_infos.phone like '%".$_REQUEST['hotel']."%')";
            }
        }

        $list = M('orders')->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.payment_method opm,orders.check_in,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.room_num orn,orders.special_requirement osr,orders.remark ork')->select();

        // var_dump($list);
        $this->assign('list',$list);

        }else{
        $what = "(check_in = '1')";
        if ($_REQUEST['chaxun'] == 1) 
        {
            if (!empty($_REQUEST['hotel'])) 
            {
                $what.="and (user_usual_infos.phone like '%".$_REQUEST['hotel']."%')";
            }
        }

        $list = M('orders')->join('user_usual_infos ON user_usual_infos.id = orders.usual_user_info_id')->join('users ON orders.user_id = users.id')->join('hotels ON hotels.id = orders.hotel_id')->join('rooms ON rooms.id = orders.room_id')->where($what)->field('orders.id oid,user_usual_infos.name uname,user_usual_infos.phone up,users.score,orders.start_time ost,orders.end_time oed,orders.payment_status ops,orders.payment_method opm,orders.check_in,hotels.name hn,rooms.display_name rdn,rooms.price rp,orders.order_status oos,orders.open_id ooi,orders.latest_arrive_time olat,orders.special_requirement osr,orders.room_num orn,orders.remark ork')->select();
        $this->assign('list',$list);
        }
        $this->display();
    }



    
    public function getAllOrder() {
        $o =D("Order_rooms");
        $u = D("Hotel_admin");
        $m = D("members");
        import("ORG.Util.Page"); //导入分页类
        $page=$_POST["page"]? $_POST["page"] :1;
        $rows=$_POST["rows"]? $_POST["rows"] :30;
        $sort=$_POST["sort"]? $_POST["sort"] :'reservation_id';
        $order=$_POST["order"] ? $_POST["order"] :'desc';
        $search=$_POST["search"];
        $flag =$_POST["flag"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $type = $_GET["type"];
        
        //var_dump($type);
        //if($sort=='orderid') $sort='reservation_id';
        //if($sort=='user_id') $sort='order_rooms.member_id';
        //dump($order);
        if($search!=null&&$search!=""){
                    //$condition['invalid_flag'] = 1;
            $condition['m.phone_number']=array('like','%'.$search.'%');
            // $condition['m.member_name']=array('like','%'.$search.'%');
            // $condition['_logic']='OR';
            
        }
        
        if($start_time!=null&&$start_time!=""){
            $condition['start_time']=array('like','%'.$start_time.'%');
        }
        if($end_time!=null&&$end_time!=""){
            $condition['end_time']=array('like','%'.$end_time.'%');
        }
            /*if(!empty($type)){
            if($type=='payorder'){
                $condition['state']='已付款';
            }elseif($type=='onorder'){
                $condition['state']='配送中';
            }
            $order = 'DESC';
        }*/

            // if($search!=null&&$search!=""){
                // $arr[]=" u.user_id like '%".$search."%' OR u.user_name like '%".$search."%'";
            // }
            // if($state!=null&&$state!=""){
                // $arr[]= " state  = '".$state."' ";
            // }
            // if($sdate!=null&&$sdate!=""){
                // $arr[]= "  send_date like '%".$sdate."%'";
            // }
            // if($orderdate!=null&&$orderdate!=""){
                // $arr[]= "  order_date like '%".$orderdate."%'";
            // }
            // if(!empty($type)){
                // if($type=='payorder'){
                    // $arr[]= "  state = '已付款' AND check_flag = 1";
                // }elseif($type=='onorder'){
                    // $arr[]= "  state = '配送中' AND check_flag = 1";
                // }
            // }
            // $where['_string'] = implode(' AND ', $arr);
            // $where['invalid_flag'] = 1;
            // $w['invalid_flag'] = 1;
            //var_dump($where['_string']);
                
        $username=$_SESSION["username"];
        $con['name'] = $username;
        //$admin_id = $_SESSION["admin_id"];
        //$con['admin_id'] = $admin_id;
        if($_SESSION["permission"] == 0){
            $HotelId = $u->where($con)->getField('hotel_id');
            $condition['order_rooms.hotel_id'] = $HotelId;
        }

        if(!empty($type)){
            if($type=='payorder'){
                $condition['flag']='1';
            }else if($type=='onorder'){
                $condition['flag']='0';
            }
            $order = 'DESC';
        }else{
            if($flag!=null&&$flag!=""){
                $condition['flag']=$flag;
            }else{
                $condition['flag'] = array('neq',2);
            }
            
        }
        $count = $o->join('Members m ON m.member_id = Order_rooms.member_id')->join('Hotels h ON h.hotel_id = Order_rooms.hotel_id')->join('rooms r ON r.type_id = order_rooms.type_id')->where($condition)->count();
        $list = $o->join('Members m ON m.member_id = Order_rooms.member_id')->join('Hotels h ON h.hotel_id = Order_rooms.hotel_id')->join('rooms r ON r.type_id = order_rooms.type_id')->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
        
        
        // if(!empty($where['_string'])){
            // $count = $n->relation(true)->join('df_user u ON u.user_id = df_order.user_id')->where($where)->count(); //计算总数
            // $list = $n->relation(true)
            // ->join('df_user u ON u.user_id = df_order.user_id')
            // ->where($where)->page($page,$rows)->order(array($sort=>$order))->select();
        // }else{
            // $count = $n->relation(true)->join('df_user u ON u.user_id = df_order.user_id')->where($w)->count(); //计算总数
            // $list = $n->relation(true)
            // ->join('df_user u ON u.user_id = df_order.user_id')
            // ->page($page,$rows)->order(array($sort=>$order))->where($w)->select();
        // }

        
        //echo $n->getLastSql();
        //var_dump($_GET);
    
        
        $result['total'] = $count;
        $result['rows'] = $list;
        exit(json_encode($result));
    }
    
    // public function getAllOrder() {
        // $n =D("Order_rooms");
        // import("ORG.Util.Page"); //导入分页类
        // $page=$_POST["page"]? $_POST["page"] :1;
        // $rows=$_POST["rows"]? $_POST["rows"] :30;
        // $sort=$_POST["sort"]? $_POST["sort"] :'order_id';
        // $order=$_POST["order"] ? $_POST["order"] :'desc';
        // $search=$_POST["search"];
        // $state =$_POST["state"];
        // $sdate = $_POST["sdate"];
        // $orderdate = $_POST["orderdate"];
        // $type = $_GET["type"];
        // //var_dump($type);
        // if($sort=='orderid') $sort='reservation_id';
        // if($sort=='user_id') $sort='order_rooms.member_id';
// /*       //dump($order);
        // if($search!=null&&$search!=""){
                    // $condition['invalid_flag'] = 1;
            // $condition['u.user_id']=array('like','%'.$search.'%');
            // $condition['u.user_name']=array('like','%'.$search.'%');
            // $condition['_logic']='OR';
            
        // }
        // if($state!=null&&$state!=""){
            // $condition['state']=$state;
        // }
        // if($sdate!=null&&$sdate!=""){
            // $condition['send_date']=array('like','%'.$sdate.'%');
        // }
        // if($orderdate!=null&&$orderdate!=""){
            // $condition['order_date']=array('like','%'.$orderdate.'%');
        // }
        // if(!empty($type)){
            // if($type=='payorder'){
                // $condition['state']='已付款';
            // }elseif($type=='onorder'){
                // $condition['state']='配送中';
            // }
            // $order = 'DESC';
        // }*/

            // if($search!=null&&$search!=""){
                // $arr[]=" u.user_id like '%".$search."%' OR u.user_name like '%".$search."%'";
            // }
            // if($state!=null&&$state!=""){
                // $arr[]= " state  = '".$state."' ";
            // }
            // if($sdate!=null&&$sdate!=""){
                // $arr[]= "  send_date like '%".$sdate."%'";
            // }
            // if($orderdate!=null&&$orderdate!=""){
                // $arr[]= "  order_date like '%".$orderdate."%'";
            // }
            // if(!empty($type)){
                // if($type=='payorder'){
                    // $arr[]= "  state = '已付款' AND check_flag = 1";
                // }elseif($type=='onorder'){
                    // $arr[]= "  state = '配送中' AND check_flag = 1";
                // }
            // }
            // $where['_string'] = implode(' AND ', $arr);
            // $where['invalid_flag'] = 1;
            // $w['invalid_flag'] = 1;
            // //var_dump($where['_string']);
                
        
        // if(!empty($where['_string'])){
            // $count = $n->relation(true)->join('df_user u ON u.user_id = df_order.user_id')->where($where)->count(); //计算总数
            // $list = $n->relation(true)
            // ->join('df_user u ON u.user_id = df_order.user_id')
            // ->where($where)->page($page,$rows)->order(array($sort=>$order))->select();
        // }else{
            // $count = $n->relation(true)->join('df_user u ON u.user_id = df_order.user_id')->where($w)->count(); //计算总数
            // $list = $n->relation(true)
            // ->join('df_user u ON u.user_id = df_order.user_id')
            // ->page($page,$rows)->order(array($sort=>$order))->where($w)->select();
        // }

        
        // //echo $n->getLastSql();
        // //var_dump($_GET);
        // $result['total'] = $count;
        // $result['rows'] = $list;
        // exit(json_encode($result));
    // }
    
    
    // public function payorder(){
    //  $this->display('payorder');
    // }
    // public function onorder(){
    //  $this->display('onorder');
    // }
    
    public function getOrderById() {
        
        
        $o = D("Order_rooms");
        $reservationId = $_POST['id'];
        $condition['order_rooms.reservation_id']=array('EQ',$_POST['id']);
        $list = $o->join('members m ON m.member_id = order_rooms.member_id')
                ->join('hotels h ON h.hotel_id = order_rooms.hotel_id')
                  ->join('rooms r ON r.type_id = order_rooms.type_id')
                  ->where($condition)->find();
        //echo $d->getLastSql();
        
        exit(json_encode($list)); //输出json数据 
    }


    //批量处理
    public function batch(){
        
        $n = D("order_rooms");
        $m = D("Members");
        $h = D("Hotel_admin");
        $s = D("Score");
        //$type= $_POST['type'];
        //$ids = $_POST['ids'];
        
        $map['reservation_id'] = $_POST['id'];
        $r_id = $map['reservation_id'];
        $data['flag'] = 1;
        $data['trade_status'] = 1;
        $paydate=date('Y-m-d H:i:s');
        $data['paid_at'] = $paydate;
        $list = $n->where($map)->data($data)->save();
        $MemberId = $n->where($map)->getField('member_id');
        $HotelId = $n->where($map)->getField('hotel_id');
        $username=$_SESSION["username"];
        $condition['name'] = $username;
        //$admin_id = $_SESSION["admin_id"];
        //$condition['admin_id'] = $admin_id;
        $admin_id = $h->where($condition)->getField('admin_id');
        $h_con['admin_id'] = $admin_id;
        $h_credit = $h->where($h_con)->getField('credit');
        
        $con['member_id'] = $MemberId; 
        $VipId = $m->where($con)->getField('vip_id');
        $m_score = $m->where($con)->getField('score');
        $mdata['score'] = $m_score + 10;
        
        $h_con2['hotel_id'] = $VipId;
        $h_credit2 = $h->where($h_con2)->getField('credit');
        $hdata2['credit'] = $h_credit2 + 10;
        //批量订单确认
        // if($type=='confirm'){
            // $sql = "update order_rooms set flag = 1 where reservation_id in( ".$ids." )";
        // //批量订单处理
        // }
        //echo $sql;exit;
        
        //$vo = $n->execute($sql);
        
        if ($list) {
            
            
            if($HotelId == $VipId){

                $hdata['credit'] = $h_credit - 10;
                $m_result = $m->where($con)->data($mdata)->save();
                $h_result = $h->where($h_con)->data($hdata)->save();
                
                $s_con['hotelId'] = $HotelId;
                $s_con['contributor'] = $VipId;
                $s_con['score_num'] = 10;
                $scdate=date('Y-m-d H:i:s');
                $s_con['score_date'] = $scdate;
                if($s->create($s_con)){
                    $s_reslut = $s->add();
                }
                
            }
            else{
                $hdata['credit'] = $h_credit - 30;
                $m_result = $m->where($con)->data($mdata)->save();
                $h_result = $h->where($h_con)->data($hdata)->save();
                $h_result2 = $h->where($h_con2)->data($hdata2)->save();
                
                $s_con['hotelId'] = $HotelId;
                $s_con['contributor'] = $VipId;
                $s_con['score_num'] = 30;
                $scdate=date('Y-m-d H:i:s');
                $s_con['score_date'] = $scdate;
                if($s->create($s_con)){
                    $s_reslut = $s->add();
                }
                
            }
            $this->ajaxReturn($_POST,'接单成功！',1);
            
        } else {
            $this->ajaxReturn($_POST,'接单失败！',3);
        }
    } 

    
    // 更新数据
    public function edit(){
        //在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
        $Form = D("Order_rooms");
        $vo = $Form->create($_POST);
        if ($vo) {
            $list = $Form->save($vo);
            //var_dump($vo);
            $this->ajaxReturn($_POST,'更新成功！',1);
        } else {
            $this->ajaxReturn($_POST,$Form->getError(),3);
        }
    }

    // 删除数据
    public function delete() {
        //在ThinkPHP中使用delete方法删除数据库中的记录。同样可以使用连贯操作进行删除操作。
        if (!empty ($_POST['ids'])) {
            $d = M("Order_rooms");
            $condition['reservation_id']=array('in',$_POST['ids']);
            //$condition['check_flag'] = 1;
            $condition2['reservation_id']=array('in',$_POST['ids']);

            //删除item
            //$im->where($condition)->delete();
            $data['flag'] = 2;
            $result = $d->where($condition)->data($data)->save();

            //删除order时，admin的count会变
            /*
            if($result>0){
                $asql = 'update df_admin set count = count -'.$result;
                $a->execute($asql);
            }
            */

            /*
              delete方法可以用于删除单个或者多个数据，主要取决于删除条件，也就是where方法的参数，
              也可以用order和limit方法来限制要删除的个数，例如：
              删除所有状态为0的5 个用户数据 按照创建时间排序
              $Form->where('status=0')->order('create_time')->limit('5')->delete();
              本列子没有where条件 传入的是主键值就行了
             */
            if (false !== $result) {
                $this->ajaxReturn($_POST,'删除订单成功！',1);
            } else {
                $this->ajaxReturn($_POST,'删除出错！',1);
            }
        } else {
            $this->ajaxReturn($_POST,'删除项不存在！',1);
        }
        //$this->redirect('index');
    }


    // 导出csv
    public function export() {
        $d = D("Order");
        $im = D("item");
        $str = $_GET['idstr'];
    
        if(empty($str)){
            $list = $d->select();
            $list = $d->join("df_user u ON u.user_id = df_order.user_id")->select();
        }else{
            $ids = explode(',', $str);
            $condition['order_id']=array('in',$ids);
            $list = $d->join("df_user u ON u.user_id = df_order.user_id")
                      ->where($condition)->select();
        }
    
        $datastr = '订单编号,买家姓名,买家手机号,送货地址,送货时间,交易状态';
        $datastr = mb_convert_encoding($datastr,'gbk','utf-8');
        $datastr.="\n";
        if($list){
            foreach($list as $order){
                $icondition['order_id']=array('EQ',$order['order_id']);
                $items = $im->join("df_fruit f ON f.fruit_id = df_item.fruit_id")
                            ->where($icondition)->select();
                
                $name = mb_convert_encoding($order['user_name'],'gbk','utf-8');
                //var_dump($name);
                $address = $order['address1']."".$order['address2']."".$order['address3'];
                $address = mb_convert_encoding($address,'gbk','utf-8');
                $state = mb_convert_encoding($order['state'],'gbk','utf-8');
                $datastr.=$order['order_id'].",".$name.",".$order['user_id']
                        .",".$address.",".$order['send_date'].",".$state;
                $datastr.="\n";
                if($items){
                    $datastr.=' '.',';
                    foreach($items as $item){
                        $fruit_name = $item['fruit_name'];
                        $unit = $item['unit'];
                        $number = $item['number'];
                        
                        $fruit_name = mb_convert_encoding($fruit_name,'gbk','utf-8');
                        $unit = mb_convert_encoding($unit,'gbk','utf-8');
                        
                        $datastr.=$fruit_name."".$number."".$unit."; ";
                        
                    }
                    $datastr.="\n";
                    $tot = ' '.','.'订单总价格:'.$order['total_price'];
                    $tot = mb_convert_encoding($tot,'gbk','utf-8');
                    
                    $datastr.=$tot."\n\n\n";
                    
                }
    
            }
        }
    //exit();
        ob_clean();
        //$datastr = @iconv("UTF-8", "GBK//IGNORE", $datastr);
        //$datastr = @iconv("GBK", "UTF-8//IGNORE", $datastr);
    
        //$datastr = mb_convert_encoding($datastr,'gbk','utf-8');
        //var_dump($list);
        $filename = date("Ymd",time()).".csv";
        header("Content-Type: application/vnd.ms-excel; charset=gbk");
        //header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $datastr;
    }
    
    
}
?>
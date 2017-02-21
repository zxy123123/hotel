<?php
// header('Content-Type: application/json');
     // header('Cache-Control: no-store');

// require_once 'C:\xampp\htdocs\hotel\Public\path_to_sdk\autoload.php';
// use Qiniu\Auth;
// use Qiniu\Storage\UploadManager;

    class GoodsAction extends Action {


    public function index() {

        if ($_SESSION['permission'] == 0) 
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
        // var_dump($one);
         // $what = "(rooms.hotel_id = ".$one['hotel_id']);
        $what = "('rooms.hotel_id'=".$one['hotel_id'].")";
        if (!empty($_REQUEST['chaxun'])) 
        { 
            if ($_REQUEST['chaxun'] == 1) {
                $what .= "and (rooms.name like '%".$_REQUEST['hotel']."%')";
            }
            if ($_REQUEST['chaxun'] == 2) {
                $what .= "and (rooms.display_name  like '%".$_REQUEST['hotel']."%')";
            }
        }
        $rooms = M('rooms');
            // $list = $rooms->where($what)->select();
        $list = $rooms
        ->join('display_pictures ON display_pictures.relate_id = rooms.id')
        ->where(array('hotel_id'=>$one['hotel_id'],'display_pictures.type'=>'room'))
        ->field('rooms.*,display_pictures.url')->
        select();
            // echo $rooms->getLastSql();
            // var_dump($list);

    // var_dump($rooms->getLastSql());
    $this->assign('list',$list);

        }else{
            // var_dump($_SESSION);
        $what ="(display_pictures.type = 'rooms')";
        if (!empty($_REQUEST['chaxun'])) 
        { 
            if ($_REQUEST['chaxun'] == 1) {
                $what .= "and (rooms.name like '%".$_REQUEST['hotel']."%')";
            }
            if ($_REQUEST['chaxun'] == 2) {
                $what .= "and (rooms.display_name  like '%".$_REQUEST['hotel']."%')";
            }
        }
        $rooms = M('rooms');
            $list = $rooms->join('display_pictures ON rooms.id=display_pictures.relate_id')->field('rooms.*,display_pictures.url')->where($what)->select();
            // echo $list->getLastSql();
            
    // var_dump($rooms->getLastSql());
    $this->assign('list',$list);
        }
        $this->display('goods');
    }
    

    // public function edrompic()
    // {
    //     // var_dump($_GET);
    //     $id = $_GET['id'];
    //     $list = M('rooms')->where(array('id'=>$id))->field('id')->find();
    //     // var_dump($list);
    //     $this->assign('list',$list);
    //     $this->display();
    // }

    
 
    // public function callback()
    // {
         
    //      $_body = file_get_contents('php://input');
    //      $body = json_decode($_body, true);
    //      $fname = $body['fname'];
    //      $roomId = $body['roomId'];
    //      //$hash = $body['hash'];
    //      //$key = $body['key'];
         
    //  //$resp = array('hash' => $hash,'key'=>$key);
    //      //echo json_encode($resp);
    // ECHO '{"success":true}';
    // }

 //    public function edrompic()
 //    {
 //        $id = $_GET['id'];
 // $bucket = 'zlmimg';  //空间名称  这里修改，你七牛运空间名称
  
 //  $accessKey = 'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA'; //密钥
 //  $secretKey = 'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4';//密钥
 //  $auth = new Auth($accessKey, $secretKey);

 //  $name=time().rand();
 //    $policy = array
 //    (
 //    'callbackUrl' => 'http://admin.zlmhotel.com/admin.php/Goods/callback',  //修改数据库的页面，比如要把刚刚上传的写入你的数据库
 //    'callbackBody' => '{"fname":"'.$name.'$(fname)","hotelId":"'.$id.'"}',

 //    // 'callbackBody' => '{"fname":"'.$name.'","roomId":"'.$id.'"}',

 //    'callbackBodyType'=>'application/json',
 //    //上传文件名
 //    'saveKey' => "room/$name$(fname)"
 //    );

 //  $token = $auth->uploadToken($bucket, null, 3600, $policy);

 //        // $id = $_GET['id'];
 //        // $list = M('display_pictures')->where(array('relate_id'=>$id,'type'=>'rooms'))->find();
 //        // var_dump($list);
 //        // $this->assign('list',$list);
 //        $this->assign('uptoken',$token);
 //        $this->display();
 //    }


    
    public function getGoodsById() {
        $d = D("rooms");
        $condition['hotel_id']=array('EQ',$_POST['id']);
        $list = $d->where($condition)->find();
        exit(json_encode($list)); //输出json数据 
    }

    public function uploadify(){
        
        $id = $_POST['type_id'];
        $mimo = M('display_pictures')->where(array('relate_id'=>$id))->find();
        // var_dump($id);
        // exit;
        if (!empty($_FILES)) {

            import("ORG.Net.UploadFile");
            $name=time().rand();    //设置上传图片的规则

            $upload = new UploadFile();// 实例化上传类

            $upload->maxSize  = 3145728 ;// 设置附件上传大小

            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

            $upload->savePath =  './Public/image/room/';// 设置附件上传目录
            // $upload->savePath ='.'.$upload_dir;

            $upload->saveRule = $name;  //设置上传图片的规则
            
            $upload->thumb = true;
            
            $upload->thumbMaxWidth = '300';
            $upload->thumbMaxHeight = '200';
            $upload->thumbRemoveOrigin = true;

            if(!$upload->upload()) {// 上传错误提示错误信息

            //return false;

            echo $upload->getErrorMsg();
            //echo $targetPath;

            }else{// 上传成功 获取上传文件信息
                // $this->success('成功');
            $info =  $upload->getUploadFileInfo();
            // echo $upload_dir.$info[0]["savename"];
            
            $data['id'] = $mimo['id'];
            $data['type'] = 'rooms';
            // $data['url'] = 'img.zlmhotel.com/image/hotel/'.$upload_dir.$info[0]["savename"];
            $data['url'] = 'thumb_'.$upload_dir.$info[0]["savename"];
            // var_dump($data);
            // exit;
            $row = M('display_pictures')->data($data)->save();
            if ($row !== false) 
            {
                $this->success('修改成功',U('Goods/index'));
            }else{
                $this->error('修改失败');
                exit;
            }

            }
        }else{
            $this->redirect('Goods/edhotpica');
            exit;
        }
    }

    // public function edhotpicb()
    // {
    //     // $id = $_GET['id'];
    //     $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
    //     $list = M('display_pictures')->where(array('relate_id'=>$one['hotel_id']))->find();
    //     $this->assign('list',$list);

    //     $this->display();
    // }

 //   public function edhotpicb()
 //    {
 //        // var_dump($_GET);
 //        // exit;
 //        $id = $_GET['id'];
 // $bucket = 'zlmimg';  //空间名称  这里修改，你七牛运空间名称
  
 //  $accessKey = 'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA'; //密钥
 //  $secretKey = 'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4';//密钥
 //  $auth = new Auth($accessKey, $secretKey);
 //  $name=time().rand();
 //    $policy = array
 //    (
 //    'callbackUrl' => 'http://admin.zlmhotel.com/zz.php',  //修改数据库的页面，比如要把刚刚上传的写入你的数据库
 //    'callbackBody' => '{"fname":"'.$name.'$(fname)","hotelId":"'.$id.'"}',

 //    // 'callbackBody' => '{"fname":"'.$name.'","roomId":"'.$id.'"}',

 //    'callbackBodyType'=>'application/json',
 //    //上传文件名
 //    'saveKey' => "hotel/$name$(fname)"
 //    );

 //  $token = $auth->uploadToken($bucket, null, 3600, $policy);

 //        // $id = $_GET['id'];
 //        // $list = M('display_pictures')->where(array('relate_id'=>$id,'type'=>'rooms'))->find();
 //        // var_dump($list);
 //        // $this->assign('list',$list);
 //        $this->assign('uptoken',$token);
 //        $this->display();
 //    }


 //    public function uploadifytwob(){
 //     // var_dump($_POST);
 //     // exit;
 //     $id = $_POST['type_id'];
 //     if (!empty($_FILES)) {

 //         import("ORG.Net.UploadFile");
 //         $name=time().rand();    //设置上传图片的规则

 //         $upload = new UploadFile();// 实例化上传类

 //         $upload->maxSize  = 3145728 ;// 设置附件上传大小

 //         $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

 //         $upload->savePath =  './Public/image/hotel/';// 设置附件上传目录
 //         // $upload->savePath ='.'.$upload_dir;

 //         $upload->saveRule = $name;  //设置上传图片的规则
            
 //         $upload->thumb = true;
            
 //         $upload->thumbMaxWidth = '300';
 //         $upload->thumbMaxHeight = '200';
 //         $upload->thumbRemoveOrigin = true;
 //         // var_dump($upload);
 //         // exit;
 //         if(!$upload->upload()) {// 上传错误提示错误信息

 //         //return false;

 //         echo $upload->getErrorMsg();
 //         //echo $targetPath;

 //         }else{// 上传成功 获取上传文件信息
 //             // $this->success('成功');
 //         $info =  $upload->getUploadFileInfo();
 //         // var_dump($info);
 //         // exit;
 //         // echo $upload_dir.$info[0]["savename"];
 //         $data['id'] = $id;
 //         $data['type'] = 'hotels';
 //         // $data['url'] = 'img.zlmhotel.com/image/hotel/'.$info[0]["savename"];
 //         // $data['url'] =$info[0]["savename"];
 //         $data['url'] = 'thumb_'.$upload_dir.$info[0]["savename"];

 //         // var_dump($data);
 //         // exit;
 //         $row = M('display_pictures')->data($data)->save();
 //         if ($row !== false) 
 //         {
 //             $this->success('修改成功',U('Goods/hotelinfo'));
 //         }else{
 //             $this->error('修改失败');
 //         }

 //         }
 //     }
 //    }

    public function uploadifytwoa(){
     // var_dump($_POST);
     // exit;
     $id = $_POST['type_id'];
     if (!empty($_FILES)) {

         import("ORG.Net.UploadFile");
         $name=time().rand();    //设置上传图片的规则

         $upload = new UploadFile();// 实例化上传类

         $upload->maxSize  = 3145728 ;// 设置附件上传大小

         $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

         $upload->savePath =  './Public/image/hotel/';// 设置附件上传目录
         // $upload->savePath ='.'.$upload_dir;

         $upload->saveRule = $name;  //设置上传图片的规则
            
         $upload->thumb = true;
            
         $upload->thumbMaxWidth = '300';
         $upload->thumbMaxHeight = '200';
         $upload->thumbRemoveOrigin = true;
         // var_dump($upload);
         // exit;
         if(!$upload->upload()) {// 上传错误提示错误信息

         //return false;

         echo $upload->getErrorMsg();
         //echo $targetPath;

         }else{// 上传成功 获取上传文件信息
             // $this->success('成功');
         $info =  $upload->getUploadFileInfo();
         // var_dump($info);
         // exit;
         // echo $upload_dir.$info[0]["savename"];
         $data['id'] = $id;
         $data['type'] = 'hotels';
         // $data['url'] = 'img.zlmhotel.com/image/hotel/'.$info[0]["savename"];
            $data['url'] = 'thumb_'.$upload_dir.$info[0]["savename"];

         // var_dump($data);
         // exit;
         $row = M('display_pictures')->data($data)->save();
         if ($row !== false) 
         {
             $this->success('修改成功',U('Goods/hotelinfoa'));
         }else{
             $this->error('修改失败');
         }

         }
     }
    }







public function uptoken()
{

    $ak = 'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA';
    $sk = 'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4';


$bucket = "zlmimg";

include '/Public/Qiniu.class.php';

$qiniu = new Qiniu($ak, $sk);

$uptoken = $qiniu->QiniuRSPutPolicy($bucket);

echo json_encode(array('uptoken' => $uptoken));
}



            public function doedit()
            {

                if (IS_POST) 
                {
                    foreach ($_POST as $val) 
                    {
                        if ($val == '') {
                            $this->error('请完善信息');
                            exit;
                        }
                    }
                }
                                $data['id'] = $_POST['type_id'];
                                $data['area'] = $_POST['room_area'];
                                $data['display_name'] = $_POST['type_name'];
                                $data['price'] = $_POST['room_price'];
                                $data['count_num'] = $_POST['count_num'];
                                $data['people_num'] = $_POST['people_num'];
                                $data['floors'] = $_POST['floors'];
                                $data['bed_add'] = $_POST['bed_add'];
                                $data['bed_add_price'] = $_POST['bed_add_price'];
                                $data['bed_area'] = $_POST['bed_area'];
                                $data['smoke'] = $_POST['smoke'];
                                $data['air_conditioner'] = $_POST['air_conditioner'];
                                $data['breakfast'] = $_POST['breakfast'];
                                $data['internet']= $_POST['internet'];
                                    
                                $mm = M('rooms');
                                $aa = $mm->data($data)->save();
                                // var_dump($aa);
                                // exit;
                                // $runbo['relate_id'] = $id;
                                // $runbo['type'] = 'rooms';
                                // $img['url'] = $img;
                                // $bb = M('display_pictures')->where($runbo)->save($img);

                                if ($aa !== false) {
                                    $this->success('修改成功',U('Goods/index'));
                                }else
                                {
                                    $this->error('修改失败',U('Goods/index'));
                                }

            // }
}




    public function addpd(){
        $this->time = time();
        $this->pid = $_REQUEST['pid'];
        $this->display();
    } 

    public function add() {
        $m = D("rooms");
        $u = D("Hotel_admin");
        $_POST['image_url'] = rtrim($_POST['picture'],'|');
        unset($_POST['picture']);
        $username=$_SESSION["username"];
        $con['name'] = $username;
        //$con['admin_id'] = $admin_id;
        //$_POST['HotelId'] = $HotelId;
        $HotelId = $u->where($con)->getField('Hotel_id');
        //$admin_id = $_SESSION["admin_id"];
        
        
        $image_url = substr($_POST['image_url'],37);

        if($image_url!=null&&$image_url!=""){
            $m->image_url = "thumb_".$image_url;
        }
        

        $m->hotel_id = $HotelId;
        
        $m->name = $_POST['type_name'];//房型英文名
        $m->display_name = $_POST['bed_type'];//大床房
        $m->area = $_POST['room_area'];//房间大小面积
        $m->price = $_POST['room_price'];//单间价格
        $m->count_num = $_POST['room_count'];//房间数量
        $m->bed_add_price = $_POST['addprice'];//加床价格
        // $m->room_type = $_POST['room_type'];
        $m->breakfast = $_POST['breakfast'];//是否有早餐
        $m->internet = $_POST['internet'];//网络情况
        $m->people_num = $_POST['person'];//可住人数
        $result = $m->add();
        if($result) {
            $this->ajaxReturn($_POST,'添加房间成功！',1);
        }else{
            $this->ajaxReturn($m->getError(),'添加房间失败！',0);   
        }
        
        // $vo = $m->create($_POST);
        // if(!$vo) {
            // $this->ajaxReturn($_POST,$m->getError(),3);   
        // }else{
            // echo "<script>alert('success4');</script>";
            // $result = $m->add();
            // echo "<script>alert($result);</script>";
            // if($result) {
                // echo "<script>alert('success');</script>";
                // $this->ajaxReturn($_POST,'添加房间成功！',1);
            // }else{
                // echo "<script>alert('fail');</script>";
                // $this->ajaxReturn($m->getError(),'添加房间失败！',0);   
            // }
        // }
    }
    
    // 更新数据
    public function edit(){
        //在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
        $Form = D("rooms");

        $img_url = rtrim($_POST['picture'],'|');
        $image_url = substr($img_url,37);
        if($image_url!=null&&$image_url!=""){
            $_POST['image_url']  = "thumb_".$image_url;
        }
        
        unset($_POST['picture']);
        $vo = $Form->create($_POST);
        
        if ($vo) {
            $list = $Form->save($vo);
            $this->ajaxReturn($_POST,'更新成功！',1);
        } else {
            $this->ajaxReturn($_POST,$Form->getError(),3);
        }
    }

    // 删除数据
    public function delete() {
        //在ThinkPHP中使用delete方法删除数据库中的记录。同样可以使用连贯操作进行删除操作。
        if (!empty ($_POST['ids'])) {
            $d = M("Fruit");
            $i = M("Item");
            $o = M("Order");
            
            $condition['fruit_id']=array('in',$_POST['ids']);
            
            //item删除
            $data['on_flag'] = 0;
            $result = $d->where($condition)->data($data)->save();
            /*
            $i->where($condition)->delete();
            $result = $d->where($condition)->delete();
            */
            
            /*
              delete方法可以用于删除单个或者多个数据，主要取决于删除条件，也就是where方法的参数，
              也可以用order和limit方法来限制要删除的个数，例如：
              删除所有状态为0的5 个用户数据 按照创建时间排序
              $Form->where('status=0')->order('create_time')->limit('5')->delete();
              本列子没有where条件 传入的是主键值就行了
             */
            if (false !== $result) {
                $this->ajaxReturn($_POST,'删除房间成功！',1);
            } else {
                $this->ajaxReturn($_POST,'删除出错！',1);
            }
        } else {
            $this->ajaxReturn($_POST,'删除项不存在！',1);
        }
        //$this->redirect('index');
    }
    //添加修改页面
    public function uppd(){
        $id = $_GET['id'];
        $d = D("rooms");
        // $con['id'] = $id;
        // $this->list = $d->where($con)->find();
        $list = M('rooms')->where(array('id'=>$id))->find();
        // var_dump($list);
        $this->assign('list',$list);
        $this->assign('time',time());
        $this->display();
    }
    
    public function updel()
    {
        $id = $_GET['id'];
        $list = M('rooms')->where(array('id'=>$id))->delete();
        if ($list !==false && $list !==0) 
        {
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    
    public function getAllHotels(){
        $h = D("Hotels");
        $u = D("Hotel_admin");
        import("ORG.Util.Page");
        $page=$_POST["page"]? $_POST["page"] :1;
        $rows=$_POST["rows"]? $_POST["rows"] :30;
        $sort=$_POST["sort"]? $_POST["sort"] :'hotel_id';
        $order=$_POST["order"] ? $_POST["order"] :'asc';
        $search=$_POST["search"];
        
        $username=$_SESSION["username"];
        $con['name'] = $username;
        //$admin_id = $_SESSION["admin_id"];
        //$con['admin_id'] = $admin_id;
        if($_SESSION["permission"] == 0){
            
            $HotelId = $u->where($con)->getField('hotel_id');
            $condition['hotel_id'] = $HotelId;
        }
        if($search!=null&&$search!=""){
            $condition['hotel_name']=array('like','%'.$search.'%');
        }
    
        $count = $h->where($condition)->select(); //计算总数
        $list = $h->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
        
        $result['total'] = $count;
        $result['rows'] = $list;
        exit(json_encode($result));
    }
    
    
    public function getHotelsById() {
        $h = D("Hotels");
        $condition['id']=array('EQ',$_POST['id']);
        $list = $h->where($condition)->find();
        exit(json_encode($list)); //输出json数据 
    }
    
    public function uphotel(){
        $id = $_GET['id'];
        $this->display();
    }


    public function doadd()
    {
        // var_dump($_POST);
        // exit;
        if (IS_POST) 
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
        $data['hotel_id'] = $one['hotel_id'];
        $data['display_name'] = $_POST['type_name'];
        $data['price'] = $_POST['room_price'];
        $data['count_num'] = $_POST['room_count'];
        $data['area'] = $_POST['room_area'];
        $data['bed_add_price'] = $_POST['addprice'];
        $data['floors'] = $_POST['floors'];
        $data['bed_add'] = $_POST['bed_add'];
        $data['bed_area'] = $_POST['bed_area'];
        $data['addprice'] = $_POST['addprice'];
        $data['breakfast'] = $_POST['breakfast'];
        $data['smoke'] = $_POST['smoke'];
        $data['hot_water'] = $_POST['hot_water'];
        $data['air_conditioner'] = $_POST['air_conditioner'];
        $data['internet'] = $_POST['internet'];
        $data['people_num'] = $_POST['people_num'];

        $row = M('rooms')->add($data);

        if (!empty($_FILES)) {
            import("ORG.Net.UploadFile");
            $name=time().rand();    //设置上传图片的规则

            $upload = new UploadFile();// 实例化上传类

            $upload->maxSize  = 3145728 ;// 设置附件上传大小

            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

            $upload->savePath =  './Public/image/room/';// 设置附件上传目录
            // $upload->savePath ='.'.$upload_dir;

            $upload->saveRule = $name;  //设置上传图片的规则
            
            $upload->thumb = true;
            
            $upload->thumbMaxWidth = '300';
            $upload->thumbMaxHeight = '200';
            $upload->thumbRemoveOrigin = true;

            if(!$upload->upload()) {// 上传错误提示错误信息

            //return false;

            echo $upload->getErrorMsg();
            //echo $targetPath;

            }else
            {// 上传成功 获取上传文件信息
            
            $info =  $upload->getUploadFileInfo();
            // echo $upload_dir.$info[0]["savename"];
            }           
            $data['relate_id'] = $row;
            $data['type'] = 'rooms';
            $data['url'] = 'thumb_'.$upload_dir.$info[0]["savename"];
            // var_dump($data);
            // exit;
            $result = M('display_pictures')->add($data);
            if (!result) 
            {
                $this->error('添加失败1');
                exit;
            }
        }
            $data['relate_id'] = $row;
            $data['type'] = 'rooms';
            $data['url'] = 'thumb_'.$upload_dir.$info[0]["savename"];
            // var_dump($data);
            // exit;
            $result = M('display_pictures')->add($data);
        if ($row) 
        {
            $this->success('添加成功',U('Goods/index'));
        }else{
            $this->error('添加失败');
        }
    }else{
        $this->redirect(U('Goods/addpd'));
    }

    }
    

    

    public function edithotel()
    {
        $id = $_GET['id'];
        // var_dump($id);
        $list = M('hotels')->where(array('id'=>$id))->find();
        $row = M('hotel_infrastructure')->where(array('hotel_id'=>$id))->select();

        $this->assign('list',$list);
        $this->assign('row',$row);
        $this->display();
    }

    public function edithotela()
    {
        $id = $_GET['id'];        
        $list = M('hotels')->where(array('id'=>$id))->find();
        $row = M('hotel_infrastructure')->where(array('hotel_id'=>$id))->select();
        // var_dump($row);
        // $arr = [];
        // for ($i=0; $i <count($row) ; $i++) 
        // { 
        //     $arr[]=$row[$i]['infrastructure_id'];
        // }
        // var_dump($arr);


        // var_dump($list);
        $this->assign('list',$list);
        $this->assign('row',$row);
        $this->display();
    }




    public function hotelinfo()
    {
        if ($_SESSION['permission'] == 0) //普通用户
        {
        $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
        
        $hotels = M('hotels');
        $what = "(display_pictures.relate_id = ".$one['hotel_id'].")";
        // $list = $hotels->where(array('id'=>$one['hotel_id']))->find();
            $list = $hotels->join('display_pictures ON hotels.id=display_pictures.relate_id')->field('hotels.*,display_pictures.url')->where($what)->find();
         // var_dump($hotels->getLastSql());
         // var_dump($list);
        $this->assign('list',$list);
            
        }
        $this->display();
    }

    public function hotelinfoa()
    {
    if($_SESSION['permission'] == 1){
        $what ="(display_pictures.type = 'hotel')";
        if (!empty($_REQUEST['chaxun'])) 
        { 
            if ($_REQUEST['chaxun'] == 1) {
                $what .= "and (hotels.name like '%".$_REQUEST['hotel']."%')";
            }
            if ($_REQUEST['chaxun'] == 2) {
                $what .= "and (hotels.address  like '%".$_REQUEST['hotel']."%')";
            }
        }
        $hotels = M('hotels');
        // $one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
            $list = $hotels->join('display_pictures ON hotels.id=display_pictures.relate_id')->field('hotels.*,display_pictures.url')->where($what)->select();
        // $list = $hotels->where(array("id"=>$one['hoteldisind();
         // var_dump($hotels->getLastSql());
         // var_dump($list);
        $this->assign('list',$list);
        }
        $this->display();
    }

    // public function edhotpica()
    // {
    //     $id = $_GET['id'];
    //     $list = M('display_pictures')->where(array('relate_id'=>$id))->find();

    //     $this->assign('list',$list);

    //     $this->display();
    // }

//     public function edrompic()
//     {
//         $id = $_GET['id'];
//  $bucket = 'zlmimg';  //空间名称  这里修改，你七牛运空间名称
  
//   $accessKey = 'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA'; //密钥
//   $secretKey = 'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4';//密钥
//   $auth = new Auth($accessKey, $secretKey);
//   $name=time().rand();
//     $policy = array
//     (
//     'callbackUrl' => 'http://admin.zlmhotel.com/xx.php',  //修改数据库的页面，比如要把刚刚上传的写入你的数据库
//     'callbackBody' => '{"fname":"'.$name.'$(fname)","roomId":"'.$id.'"}',
// //'callbackBody' => "(fname=".$name.")",
//     'callbackBodyType'=>'application/json',
//     //上传文件名
//     'saveKey' => "room/$name$(fname)"
//     );

//   $token = $auth->uploadToken($bucket, null, 3600, $policy);



//         // $id = $_GET['id'];
//         // $list = M('display_pictures')->where(array('relate_id'=>$id,'type'=>'rooms'))->find();
//         // var_dump($list);
//         // $this->assign('list',$list);
//         $this->assign('uptoken',$token);
//         $this->display();
//     }





    public function doedithotel()
    {
        // var_dump($_POST);
        // exit;
        if (IS_POST) 
        {
            foreach ($_POST as $val) 
            {
                if (empty($val)) 
                {
                    $this->error('请完善信息');
                    exit;
                }
            }
        
        if (empty($_POST['address3']) && empty($_POST['address2'])) 
        {
            $data['area_code'] = $_POST['address1'];
        }else if(empty($_POST['address3']) && !empty($_POST['address2'])){
            $data['area_code'] = $_POST['address2'];
        }else if(!empty($_POST['address3'])){
            $data['area_code'] = $_POST['address3'];
        }

        $hello = M('areas')->where(array('code'=>$data['area_code']))->field('id')->find();

        $data['area_id'] = $hello['id'];

        $id = $_POST['hotel_id'];
        $data['routes'] = $_POST['routes'];
        $data['longitude'] = $_POST['longitude'];
        $data['latitude'] = $_POST['latitude'];
        $data['name'] = $_POST['hotel_name'];
        $data['grade'] = $_POST['hotel_star'];
        $data['phone_number'] = $_POST['hotel_telephone'];
        $data['address'] = $_POST['hotel_address'];
        $data['email'] = $_POST['hotel_email'];
        $data['introduction'] = $_POST['introduction'];
        $data['endorse_rules'] = $_POST['content'];
        // var_dump($data);
        
        if (!empty($_POST['checkbox'])) 
        {
            $arr = [];
            foreach ($_POST['checkbox'] as  $val) 
            {
                $arr[] = $val;
            }
        }
        $lili['hotel_id'] = $id;
        $bob = M('hotel_infrastructure')->delete($lili);
        for ($i=0; $i <count($arr) ; $i++) 
        { 
            $tnt['hotel_id'] = $id;
            $tnt['infrastructure_id'] = $arr[$i];
            $yun = M('hotel_infrastructure')->add($tnt);
        }


        $row = M('hotels')->where(array('id'=>$id))->save($data);
        if ($row !== false) 
        {
            $this->success('修改成功',U('Goods/hotelinfo'));
        }else{
            $this->error('修改失败');
        }

    }else{
        $this->redirect(U('Goods/edithotel'));
    }

    }

    public function doedithotela()
    {
        // var_dump($_POST);
        // exit;
        if (IS_POST) 
        {
            foreach ($_POST as $val) 
            {
                if (empty($val)) 
                {
                    $this->error('请完善信息');
                    exit;
                }
            }
        
        if (empty($_POST['address3']) && empty($_POST['address2'])) 
        {
            $data['area_code'] = $_POST['address1'];
        }else if(empty($_POST['address3']) && !empty($_POST['address2'])){
            $data['area_code'] = $_POST['address2'];
        }else if(!empty($_POST['address3'])){
            $data['area_code'] = $_POST['address3'];
        }

        $hello = M('areas')->where(array('code'=>$data['area_code']))->field('id')->find();

        $data['area_id'] = $hello['id'];


        $id = $_POST['hotel_id'];
        $data['routes'] = $_POST['routes'];
        $data['longitude'] = $_POST['longitude'];
        $data['latitude'] = $_POST['latitude'];
        $data['name'] = $_POST['hotel_name'];
        $data['grade'] = $_POST['hotel_star'];
        $data['phone_number'] = $_POST['hotel_telephone'];
        $data['address'] = $_POST['hotel_address'];
        $data['email'] = $_POST['hotel_email'];
        $data['introduction'] = $_POST['introduction'];
        $data['endorse_rules'] = $_POST['content'];
        // var_dump($data);
        
        if (!empty($_POST['checkbox'])) 
        {
            $arr = [];
            foreach ($_POST['checkbox'] as  $val) 
            {
                $arr[] = $val;
            }
        }
        $lili['hotel_id'] = $id;
        $bob = M('hotel_infrastructure')->delete($lili);
        for ($i=0; $i <count($arr) ; $i++) 
        { 
            $tnt['hotel_id'] = $id;
            $tnt['infrastructure_id'] = $arr[$i];
            $yun = M('hotel_infrastructure')->add($tnt);
        }


        $row = M('hotels')->where(array('id'=>$id))->save($data);
        if ($row !== false) 
        {
            $this->success('修改成功',U('Goods/hotelinfoa'));
        }else{
            $this->error('修改失败');
        }

    }else{
        $this->redirect(U('Goods/edithotel'));
    }

    }






    public function doup()
    {
        // var_dump($_POST);
        // exit;
        if (IS_POST) 
        {
            foreach ($_POST as $val) 
            {
                if (empty($val)) 
                {
                    $this->error('请完善信息');
                    exit;
                }
            }
        $data['routes'] = $_POST['routes'];
        $data['longitude'] = $_POST['longitude'];
        $data['latitude'] = $_POST['latitude'];
        $data['name'] = $_POST['hotel_name'];
        $data['grade'] = $_POST['hotel_star'];
        $data['phone_number'] = $_POST['hotel_telephone'];
        $data['address'] = $_POST['hotel_address'];
        $data['email'] = $_POST['hotel_email'];
        $data['introduction'] = $_POST['introduction'];
        $row = M('hotels')->add($data);

        if (!empty($_POST['checkbox'])) 
        {
            $arr = [];
            foreach ($_POST['checkbox'] as  $val) 
            {
                $arr[] = $val;
            }
        }
        for ($i=0; $i <count($arr) ; $i++) 
        { 
            $tnt['hotel_id'] = $row;
            $tnt['infrastructure_id'] = $arr[$i];
            $yun = M('hotel_infrastructure')->add($tnt);
        }

        $dui = M('hotel_infrastructure')->field('infrastructure_id')->where(array('hotel_id'=>$row))->select();
        if ($dui[4]['infrastructure_id']) 
        {
        $kui['type']='hotel';
        $kui['relate_id'] = $row;
        $kui['display_name'] = $_POST['hotel_name'];
        $kui['created_at']=date('Y-m-d H:i:s');
        $kui['updated_at'] = date('Y-m-d H:i:s');
        $hui = M('tiebas')->add($kui);            
        }

        if (!empty($_FILES)) {
            import("ORG.Net.UploadFile");
            $name=time().rand();    //设置上传图片的规则

            $upload = new UploadFile();// 实例化上传类

            $upload->maxSize  = 3145728 ;// 设置附件上传大小

            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

            $upload->savePath =  './Public/image/hotel/';// 设置附件上传目录
            // $upload->savePath ='.'.$upload_dir;

            $upload->saveRule = $name;  //设置上传图片的规则
            
            // $upload->thumb = true;
            
            // $upload->thumbMaxWidth = '300';
            // $upload->thumbMaxHeight = '200';
            // $upload->thumbRemoveOrigin = true;

            if(!$upload->upload()) {// 上传错误提示错误信息

            //return false;

            echo $upload->getErrorMsg();
            //echo $targetPath;

            }else{// 上传成功 获取上传文件信息
                // $this->success('成功');
            $info =  $upload->getUploadFileInfo();
            // echo $upload_dir.$info[0]["savename"];
            }
            $data['relate_id'] = $row;
            $data['type'] = 'hotels';
            $data['url'] = 'img.zlmhotel.com/image/hotel/'.$upload_dir.$info[0]["savename"];
            // var_dump($data);
            // exit;
            $result = M('display_pictures')->add($data);
            if (!result) 
            {
                $this->error('添加失败');
                exit;
            }
            
        }

        if ($row) 
        {
            $this->success('添加成功',U('Goods/hotelinfo'));
        }else{
            $this->error('添加失败');
        }
    }else{
        $this->redirect(U('Goods/uphotel'));
    }
    }


    public function infodel()
    {
        $id = $_GET['id'];
        $row = M('hotels')->where(array('id'=>$id))->delete();
        $list = M('hotel_infrastructure')->where(array('hotel_id'=>$id))->delete();
        if ($row !== false && $row !==0 && $list !== false && $row !== 0) 
        {
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

// public function ImgUpload()
//     {
//      // var_dump($_FILES);
//      // exit;
//         //$this->error("没有文件！");
//         //TODO: 用户登录检测 
//         /* 调用文件上传组件上传文件 */
//         $Picture = D('Picture');
//         $pic_driver = C('PICTURE_UPLOAD_DRIVER');
//         $info = $Picture->upload(
//             $_FILES,
//             C('PICTURE_UPLOAD'),
//             C('PICTURE_UPLOAD_DRIVER'),
//             C("UPLOAD_&#123;&#36;pic_driver&#125;_CONFIG")
//         ); //TODO:上传到远程服务器
//         /* 记录图片信息 */
//         if($info){
//             /* 返回JSON数据 */
//            echo json_encode($info);
            
//         } else {
//             echo json_encode($info);
//         } 
//     }







}
?>
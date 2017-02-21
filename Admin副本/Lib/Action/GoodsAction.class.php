<?php
class GoodsAction extends Action {
	public function index() {
	// var_dump($_SESSION);
	$list = M('rooms')->select();
	// var_dump($list);
	
	$this->assign('list',$list);
     	$this->display('goods');
	}
	
	
	/*public function getAllGoods() {
		$n =D("rooms");
		$u = D("Hotel_admin");
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"]? $_POST["page"] :1;
		$rows=$_POST["rows"]? $_POST["rows"] :30;
		$sort=$_POST["sort"]? $_POST["sort"] :'type_id';
		$order=$_POST["order"] ? $_POST["order"] :'asc';
		$search=$_POST["search"];
		
		$username=$_SESSION["username"];
		$con['name'] = $username;
		//$admin_id = $_SESSION["admin_id"];
		//$con['admin_id'] = $admin_id;
		if($_SESSION["permission"] == 0){
			$HotelId = $u->where($con)->getField('Hotel_id');
			// var_dump($HotelId);
			$condition['hotel_id'] = $HotelId;
		}
		//dump($order);
		if($search!=null&&$search!=""){
			$condition['type_name']=array('like','%'.$search.'%');
			//$condition['description']=array('like','%'.$search.'%');
			//$condition['type']=array('like','%'.$this->getType($search).'%');
			//$condition['_logic']='OR';
		}
		
		$count = $n->where($condition)->select(); //计算总数
		$list = $n->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
		//$list = $n->relation(true)->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
		//$list = $n->where($condition)->page(1,30)->order(array('type_id'=>'asc'))->select();
		//$list = $n->where($condition)->page(1,30)->order(array('type_id'=>'asc'))->select();

		$result['total'] = $count;
		$result['rows'] = $list;
		
		
		exit(json_encode($result));
	}*/


	
	public function getGoodsById() {
		$d = D("rooms");
		$condition['hotel_id']=array('EQ',$_POST['id']);
		$list = $d->where($condition)->find();
		exit(json_encode($list)); //输出json数据 
	}

	public function uploadify(){
    	//$targetPath = "/Public/upload/";
    	$upload_dir= C('ROOM_UPLOAD_DIR');
		//echo $_POST['token'];
		$verifyToken = md5($_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

			import("ORG.Net.UploadFile");
			$name=time().rand();	//设置上传图片的规则

			$upload = new UploadFile();// 实例化上传类

			$upload->maxSize  = 3145728 ;// 设置附件上传大小

			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

			//$upload->savePath =  './Public/upload/';// 设置附件上传目录
			$upload->savePath ='.'.$upload_dir;

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

			$info =  $upload->getUploadFileInfo();
			echo $upload_dir.$info[0]["savename"];

			}
		}
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
	// 导出csv
	
	
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
		$h = D("Hotels");
		$con['id'] = $id;
		$this->list = $h->where($con)->find();
		// $row = M('hotels')->where(array('id'=>1))->find();

		// var_dump($row);
		$this->assign('time',time());
		$this->display();
	}
	public function doadd()
	{
		// var_dump($_POST);
		$id = $_POST['hotel_id'];
		$data['name'] = $_POST['hotel_name'];
		$data['grade'] = $_POST['hotel_star'];
		// $hotel_title = $_POST['hotel_title'];
		// $total_rooms = $_POST['total_rooms'];
		$data['telephone'] = $_POST['hotel_telephone'];
		$data['address'] = $_POST['hotel_address'];
		$data['email'] = $_POST['hotel_email'];
		$data['introduction'] = $_POST['introduction'];

		$row = M('hotels')->where(array('id'=>$id))->save();

	}
	
	public function edithotel(){
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("Hotels");
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
	
	public function export() {
		// $d = D("Fruit");
		// $str = $_GET['idstr'];
	
		// if(empty($str)){
			// $list = $d->select();
		// }else{
			// $ids = explode(',', $str);
			// $condition['fruit_id']=array('in',$ids);
			// $list = $d->where($condition)->select();
		// }
	
		// $datastr = '水果名称,类目,售价,市场价,进货价,单位,库存,卖出数量,点赞数,推荐数,描述';
		// $datastr = mb_convert_encoding($datastr,'gbk','utf-8');
		// $datastr.="\n";
		// if($list){
			// foreach($list as $fruit){
				// $name = mb_convert_encoding($fruit['fruit_name'],'gbk','utf-8');
				
				// $typename = $this->getTypename($fruit['type']);
				// $typename = mb_convert_encoding($typename,'gbk','utf-8');
				// $unit = $fruit['unit'];
				// $unit = mb_convert_encoding($unit,'gbk','utf-8');
				// $desc = mb_convert_encoding($fruit['description'],'gbk','utf-8');
				
				// $datastr .= $name.",".$typename.",".$fruit['price'].","
						 // .$fruit['market_price'].",".$fruit['purchase_price'].",".$unit.','.$fruit['stock'].","
						 // .$fruit['sold_num'].','.$fruit['praise'].','.$fruit['recommend']
						 // .','.$desc."\n";
	
			// }
		// }
	
		// ob_clean();
		// //$datastr = @iconv("UTF-8", "GBK//IGNORE", $datastr);
		// //$datastr = @iconv("GBK", "UTF-8//IGNORE", $datastr);
	
		// //$datastr = mb_convert_encoding($datastr,'gbk','utf-8');
		// //var_dump($list);
		// $filename = date("Ymd",time()).".csv";
		// header("Content-Type: application/vnd.ms-excel; charset=gbk");
		// //header("Content-type:text/csv");
		// header("Content-Disposition:attachment;filename=".$filename);
		// header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		// header('Expires:0');
		// header('Pragma:public');
		// echo $datastr;
	}
	
	public function getTypename($type){
		$typename = '';
		switch($type){
			case "jinritehui":
				$typename = '特惠水果';
				break;
	
			case "jinkoushuiguo":
				$typename = '进口水果';
				break;
	
			case "shiyanshitaocan":
				$typename = '实验室套餐';
				break;
	
			case "gerentaocan":
				$typename = '个人套餐';
				break;
	
			case "zhengxiangpifa":
				$typename = '整箱批发';
				break;
	
			case "yinliaoguozhi":
				$typename = '饮料果汁';
				break;
			case "lingshi":
				$typename = '零食';
				break;
			case "qita":
				$typename = '其他';
				break;
		}
		return $typename;
	}
	
	public function getType($typename){
		$type = '';
		switch($typename){
			case "特惠水果":
				$type = 'jinritehui';
				break;
	
			case "进口水果":
				$type = 'jinkoushuiguo';
				break;
	
			case "实验室套餐":
				$type = 'shiyanshitaocan';
				break;
	
			case "个人套餐":
				$type = 'gerentaocan';
				break;
	
			case "整箱批发":
				$type = 'zhengxiangpifa';
				break;

			case "饮料果汁":
				$type = 'yinliaoguozhi';
				break;
			case "零食":
				$type = 'lingshi';
				break;
			case "其他":
				$type = 'qita';
				break;
		}
		return $type;
	}

	public function hotelinfo()
	{
	    $this->display();
	}

}
?>
<?php
class AuserAction extends Action {
	public function auser() {

		$row = M('hotel_admin');
		// $list = M('hotel_admin')->table('hotel_admin ha,hotels h')->field('ha.name han,ha.admin_telephone at,h.name hn')->select();

		 $list = $row->join('hotels ON hotels.id=hotel_admin.hotel_id')->field('hotel_admin.name han,hotel_admin.admin_telephone at,hotels.name hn,hotel_admin.admin_id aid')->select();
		 // var_dump($list);
		$this->assign('list',$list);
		$this->display();
	}

	public function edit()
	{
		$id = $_GET['id'];
		// var_dump($id);
		// exit;
		 $row = M('hotel_admin');

		 $what = "(hotel_admin.admin_id = ".$id.")";

		 $list = $row->join('hotels ON hotels.id=hotel_admin.hotel_id')->field('hotel_admin.name han,hotel_admin.admin_telephone at,hotels.name hn,hotel_admin.admin_id aid')->where($what)->find();
		 // var_dump($list);
		 $this->assign('list',$list);
		$this->display();

	}

	public function doedit()
	{
		// var_dump($_POST);
		// exit;
		if (IS_POST) 
		{
			// var_dump($_SESSION);
			// exit;
			$bun['name'] = $_POST['hotelname'];
			if (!empty($_POST['pwd'])) 
			{
				$id = $_POST['id'];
				$data['name'] = $_POST['name'];
				$data['password'] = md5($_POST['pwd']);
				$data['admin_telephone'] = $_POST['phone'];
				$row = M('hotel_admin')->where(array('admin_id'=>$id))->save($data);
				$one = M('hotel_admin')->where(array('admin_id'=>$id))->field('hotel_id')->find();
				$result = M('hotels')->where(array('id'=>$one['hotel_id']))->save($bun);
				if ($row !== false && $result !== false) 
				{
					$this->success('修改成功',U('Auser/auser'));
				}else{
					$this->error('修改失败');
				}
			}else{
				$id = $_POST['id'];
				$data['name'] = $_POST['name'];
				$data['admin_telephone'] = $_POST['phone'];
				$row = M('hotel_admin')->where(array('admin_id'=>$id))->save($data);
				$one = M('hotel_admin')->where(array('admin_id'=>$id))->field('hotel_id')->find();

				$result = M('hotels')->where(array('id'=>$one['hotel_id']))->save($bun);
				if ($row !== false && $result !== false) 
				{
					$this->success('修改成功',U('Auser/auser'));
				}else{
					$this->error('修改失败');
				}
			}
		}else{
			$this->redirect(U('Auser/auser'));
		}
	}

	public function del()
	{
		$id = $_GET['id'];
		$one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
		$row = M('hotel_admin')->where(array('admin_id'=>$id))->delete();
		$result = M('hotels')->where(array('id'=>$one['hotel_id']))->delete();
		if ($row !== false && $row !== 0 && $result !== false && $row !==0) 
		{
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	public function doadd()
	{
		// var_dump($_POST);
		// exit;
		if (IS_POST) 
		{
			foreach ($_POST as  $val) 
			{
				if (empty($val)) 
				{
					$this->error('请完善信息');
					exit;
				}
			}
		$one = M('hotel_admin')->where(array('name'=>$_POST['name']))->find();
		if ($one) 
		{
			$this->error('用户名已存在,请重新输入');
			exit;
		}
		$data['name'] = $_POST['hotelname'];
		$list = M('hotels')->add($data);//把酒店名字上传,获得酒店id

		$bun['relate_id'] = $list;
		$bun['type'] = 'hotels';
		$pun = M('display_pictures')->add($bun);

		$run['admin_telephone'] = $_POST['phone'];
		$run['password'] = md5($_POST['pwd']);
		$run['name'] = $_POST['name'];
		$run['hotel_id'] = $list;
		$run['credit'] = 0;
		$result = M('hotel_admin')->add($run);
		$bob['relate_id'] = $list;
		$bob['type'] = 'hotel';
		$res = M('display_pictures')->add($bob);
		if ($result && $res) 
		{
			$this->success('增加成功',U('Auser/auser'));
		}else{
			$this->error('增加失败');
		}

		}else{
			$this->redirect(U('Auser/adduser'));
		}
	}


	public function username()
	{
		if (IS_AJAX) 
		{
			$name = $_POST['name'];
			$list = M('hotel_admin')->where(array('name'=>$name))->find();
			if ($list) 
			{
				$this->ajaxReturn('1');
			}else{
				$this->ajaxReturn('0');
			}
		}else{
			$this->redirect('Auser/adduser');
		}
	}




	// public function getAllUser() {
	// 	$n =D("Hotel_admin");
	// 	//$n =new Model("Admin");
	// 	import("ORG.Util.Page"); //导入分页类
	// 	$page=$_POST["page"]? $_POST["page"] :1;
	// 	$rows=$_POST["rows"]? $_POST["rows"] :10;
	// 	$sort=$_POST["sort"]? $_POST["sort"] :'admin_id';
	// 	$order=$_POST["order"] ? $_POST["order"] :'asc';
	// 	$search=$_POST["search"];
	// 	//dump($order);
	// 	if($search!=null&&$search!=""){
	// 		$condition['hotel_admin.name']=array('like','%'.$search.'%');
	// 	}
	// 	$count = $n->count(); //计算总数
	// 	//$p = new Page($count,$rows);order($sort+','+$order)->
	// 	$list = $n->join('Hotels h ON h.hotel_id = Hotel_admin.hotel_id')->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
	// 	$result['total'] = $count;
	// 	$result['rows'] = $list;
	// 	exit(json_encode($result));
	// }
	// public function getUserById(){
	// 	$d = d("Hotel_admin");
	// 	$condition['admin_id']=array('EQ',$_POST['id']);
	// 	$list = $d->where($condition)->find();
	// 	exit(json_encode($list));
	// }
	// //添加用户提交处理  
	// public function add() {
	// 	$m = D("Hotel_admin");
	// 	$h = D("Hotels");
		
	// 	//$_POST['image_url'] = rtrim($_POST['picture'],'|');
	// 	//unset($_POST['picture']);
	// 	$cond['hotel_name'] = $_POST['hotel_name'];
	// 	//$cond['hotel_title'] = $_POST['hotel_title'];
	// 	$cond['tieba'] = $_POST['tieba'];
	// 	$cond['hotel_star'] = $_POST['hotel_star'];
	// 	//$cond['hotel_address'] = $_POST['hotel_address'];
	// 	//$cond['hotel_telephone'] = $_POST['admin_telephone'];
	// 	//$cond['introduction'] = $_POST['introduction'];
	// 	//$cond['total_rooms'] = $_POST['total_rooms'];
	// 	//$cond['hotel_email'] = $_POST['hotel_email'];
	// 	$cond['invalid'] = 1;
	// 	//$cond['image_url'] = $_POST['image_url'];
		
	// 	if(!$h->create($cond)) {
	// 		$this->ajaxReturn($_POST,$m->getError(),3);   
	// 	}else{
	// 		if($h->add()) {
				
	// 			$hotelId = $h->where($cond)->getField('hotel_id');
	// 			$condition['hotel_id'] = $hotelId;
	// 			$condition['name'] = $_POST['name'];
	// 			$condition['password'] = $_POST['password'];
	// 			$condition['admin_telephone'] = $_POST['admin_telephone'];
	// 			$condition['credit'] = 0;
	// 			if(!$m->create($condition)) {
	// 				$this->ajaxReturn($_POST,$m->getError(),3);   
	// 			}else{
	// 				if($m->add()) {
	// 					$this->ajaxReturn($_POST,'添加用户成功！',1);
	// 				}else{
	// 					$this->ajaxReturn($m->getError(),'添加用户失败！',0);   
	// 				}
	// 			}
	// 		}else{
	// 			$this->ajaxReturn($m->getError(),'添加失败！',0);   
	// 		}
	// 	}
		
		
	// }
	
	// // 更新数据
	// public function edit(){
	// 	//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
	// 	$Form = D("Hotel_admin");

	// 	if ($Form->create($_POST)) {
	// 		$list = $Form->save($_POST);
			
	// 		$this->ajaxReturn($_POST,'更新成功！',1);
	// 	} else {
	// 		$this->ajaxReturn($_POST,$Form->getError(),3);
	// 	}
	// }

	// // 删除数据
	// public function delete() {
	// 	//在ThinkPHP中使用delete方法删除数据库中的记录。同样可以使用连贯操作进行删除操作。
	// 	if (!empty ($_POST['ids'])) {
	// 		$d = M("Hotel_admin");
	// 		$h = M("Hotels");
	// 		$condition['admin_id']=array('in',$_POST['ids']);
	// 		//超级管理员禁止删除
	// 		$result = $d->where($condition)->select();
	// 		$HotelId = $d->where($condition)->getField('hotel_id');
	// 		$data['invalid'] = 0;
	// 		$con['hotel_id'] = $HotelId;
	// 		$result = $d->where($condition)->delete();
	// 		$res = $h->where($con)->data($data)->save();
	// 		/*
	// 		  delete方法可以用于删除单个或者多个数据，主要取决于删除条件，也就是where方法的参数，
	// 		  也可以用order和limit方法来限制要删除的个数，例如：
	// 		  删除所有状态为0的5 个用户数据 按照创建时间排序
	// 		  $Form->where('status=0')->order('create_time')->limit('5')->delete();
	// 		  本列子没有where条件 传入的是主键值就行了
	// 		 */
	// 		if (false !== $result && false !== $res) {
	// 			$this->ajaxReturn($_POST,'删除用户成功！',1);
	// 		} else {
	// 			$this->ajaxReturn($_POST,'删除出错！',1);
	// 		}
	// 	} else {
	// 		$this->ajaxReturn($_POST,'删除项不存在！',1);
	// 	}
	// 	//$this->redirect('index');
	// }
	
	// public function uploadify(){
 //    	//$targetPath = "/Public/upload/";
 //    	$upload_dir= C('UPLOAD_DIR');
	// 	//echo $_POST['token'];
	// 	$verifyToken = md5($_POST['timestamp']);

	// 	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

	// 		import("ORG.Net.UploadFile");
	// 		$name=time().rand();	//设置上传图片的规则

	// 		$upload = new UploadFile();// 实例化上传类

	// 		$upload->maxSize  = 3145728 ;// 设置附件上传大小

	// 		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

	// 		//$upload->savePath =  './Public/upload/';// 设置附件上传目录
	// 		$upload->savePath ='.'.$upload_dir;

	// 		$upload->saveRule = $name;  //设置上传图片的规则

	// 		if(!$upload->upload()) {// 上传错误提示错误信息

	// 		//return false;

	// 		echo $upload->getErrorMsg();
	// 		//echo $targetPath;

	// 		}else{// 上传成功 获取上传文件信息

	// 		$info =  $upload->getUploadFileInfo();
	// 		echo $upload_dir.$info[0]["savename"];

	// 		}
	// 	}
 //    }
	// // 更新数据
	// public function editPwd(){
		
		
	// 	echo "<script>alert('test');</script>";
	// 	//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
	// 	$Form = D("Hotel_admin");
	// 	$user=M("Hotel_admin");
	// 	$password=md5($_POST['password']);
	// 	$newpassword=md5($_POST['newpassword']);
	// 	$username=$_SESSION["username"];
	// 	$condition['name']=$username;
	// 	$condition['password']=$password;
	// 	$query=$user->where($condition)->find();
	// 	//header("Content-type:text/html;charset=utf-8");
	// 	if($query)
	// 	{
	// 	$admin_id = $user->where($condition)->getField('admin_id');
	// 	$condition2['admin_id']=$admin_id;
	// 	$condition2['password']=$newpassword;
	// 	if ($vo = $Form->create()) {
			
	// 		$list = $Form->save($condition2);
	// 		//dump($_POST);
	// 		//未传入$data理由同上面的add方法
	// 		/* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
	// 		  save方法不会更新任何数据库的记录。
	// 		  因此下面的代码不会更改数据库的任何记录
	// 		 */
	// 		//dump($list);
	// 		if ($list !== false) {
	// 			//注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
	// 			//所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
	// 			//$this->ajaxReturn($_POST,'修改密码成功！',1);
	// 			unset($_SESSION["username"]);
	// 			//$this->success('密码修改成功，请用新密码重新登录', '../../admin.php');
	// 			echo "<script>alert('密码修改成功，请用新密码重新登录');top.location = '../../admin.php';</script>";
	// 		} else {
	// 			//$this->error('密码修改失败');
	// 			echo "<script>alert('密码修改失败');</script>";
	// 			//$this->ajaxReturn($_POST,'没有更新任何数据!',0);
	// 		}
	// 	} else {
	// 		echo "<script>alert('密码修改失败');</script>";
	// 		//$this->ajaxReturn($_POST,$Form->getError(),3);
	// 		//$this->error('密码修改失败');
	// 	}
	// }
	// else 
	// 	echo "<script>alert('原密码错误');</script>";
	// 	//$this->ajaxReturn($_POST,'原密码错误',0);
	// 	//$this->error('原密码错误');
	// }
	
	
	
	// public function queryCredit(){
		
		
	// }
	
	
	
	
	
}
?>
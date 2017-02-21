<?php
class UserAction extends Action {
	public function index() {
		if ($_SESSION['permission'] == 0) //普通用户
		{
			// var_dump($_SESSION);
		$one = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
		$what = "(users.hotel_id = ".$one['hotel_id'].")";

		if ($_GET['chaxun'] == 1) 
		{
			if (!empty($_GET['hotel'])) 
			{
				$what .= "and (hotels.name like '%".$_GET['hotel']."%')";
			}
		}else if($_GET['chaxun'] == 2){
			if (!empty($_GET['hotel'])) 
			{
				$what .= "and (users.nickname like '%".$_GET['hotel']."%')";
			}
		}else if($_GET['chaxun'] == 3){
			if (!empty($_GET['hotel'])) {
				$what .= "and (users.comment like '%".$_GET['hotel']."%')";
			}
		}

		$list = M('users')->join('hotels ON users.hotel_id = hotels.id')->join('user_usual_infos ON user_usual_infos.user_id = users.id')->where($what)->field('users.*,hotels.name hn,user_usual_infos.name un')->select();
		// var_dump($list);
		$this->assign('list',$list);

		}else{
			
		$what = array();
		if ($_GET['chaxun'] == 1) 
		{
			if (!empty($_GET['hotel'])) 
			{
				$what['hotels.name'] = array('like','%'.$_GET['hotel'].'%');
			}
		}else if($_GET['chaxun'] == 2){
			if (!empty($_GET['hotel'])) 
			{
				$what['users.nickname'] = array('like','%'.$_GET['hotel'].'%');
			}
			
		}else if($_GET['chaxun'] == 3){
			if (!empty($_GET['hotel'])) {
				$what['users.comment'] = array('like','%'.$_GET['hotel'].'%');
			}
		}
		$list = M('users')->join('hotels ON users.hotel_id = hotels.id')->join('user_usual_infos ON user_usual_infos.user_id = users.id')->where($what)->field('users.*,hotels.name hn,user_usual_infos.name un,user_usual_infos.phone up')->select();
		// var_dump($list);
		$this->assign('list',$list);
		}
		$this->display('user');
	}

	public function editcom()
	{
		// var_dump($_POST);
		// // var_dump($_GET);
		// exit;
		if (IS_POST) 
		{
			if ($_POST['comment'] == '') 
			{
				$this->error('请完善信息');
				exit;
			}
			$data['id'] = $_GET['id'];
			// $id = ('get.id');
			$data['mark'] = $_POST['comment'];
			$row = M('users');
			$list = $row->data($data)->save();
			// echo $row->getLastSql();
			// exit;
			if ($list !== false) 
			{
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->redirect(U('User/index'));
		}
	}



	public function getAllUser() {

		$n =D("Members");
		$u =D("Hotel_admin");
		//$n =new Model('user');
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"]? $_POST["page"] :1;
		$rows=$_POST["rows"]? $_POST["rows"] :10;
		$sort=$_POST["sort"]? $_POST["sort"] :'member_id';
		$order=$_POST["order"] ? $_POST["order"] :'asc';
		$search=$_POST["search"];
		if($sort=='phone_number') $sort = 'member_id';
		//dump($order);
		if($search!=null&&$search!=""){
			$condition['phone_number']=array('like','%'.$search.'%');
			
			
		}
		$count = $n->count(); //计算总数
		//$p = new Page($count,$rows);order($sort+','+$order)->
		
		$username=$_SESSION["username"];
		$con['name'] = $username;
		//$admin_id = $_SESSION["admin_id"];
		//$con['admin_id'] = $admin_id;
		if($_SESSION["permission"] == 0){
			$HotelId = $u->where($con)->getField('hotel_id');
			$condition['vip_id'] = $HotelId;
			$list = $n->relation(true)->join('hotels h ON h.hotel_id = members.vip_id')->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
		}
		else{
			$list = $n->relation(true)->join('hotels h ON h.hotel_id = members.vip_id')->page($page,$rows)->order(array($sort=>$order))->select();
		}
		
		$result['total'] = $count;
		$result['rows'] = $list;
		exit(json_encode($result));
	}
	public function getUserById(){
		$d = D("Members");
		$condition['member_id']=array('EQ',$_POST['id']);
		$list = $d->where($condition)->find();
		exit(json_encode($list));
	}

	// 更新数据
	public function edit(){
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("Members");
		//$_POST['password']=md5($_POST['password']);
		$vo= $Form->create();
		//var_dump($vo);exit;
		if ($vo) {
			$list = $Form->save($vo);
			
			$this->ajaxReturn($_POST,'更新成功！',1);
		} else {
			$this->ajaxReturn($_POST,$Form->getError(),3);
		}
	}

	// 导出csv
	public function export() {
		$d = D("User");
		$str = $_GET['idstr'];
		
		if(empty($str)){
			$list = $d->select();
		}else{
			$ids = explode(',', $str);
			$condition['user_id']=array('in',$ids);
			$list = $d->where($condition)->select();
		}
		
		$datastr = '姓名,性别,手机,果币,点赞,注册日期,地址';
		$datastr = mb_convert_encoding($datastr,'gbk','utf-8');
		$datastr.="\n";
		if($list){
			foreach($list as $user){
				$name = mb_convert_encoding($user['user_name'],'gbk','utf-8');
				$sex = ($user['sex']==1)?'女':'男';
				$sexn = mb_convert_encoding($sex,'gbk','utf-8');
				$address = $user['address1']."".$user['address2']."".$user['address3'];
				$address = mb_convert_encoding($address,'gbk','utf-8');
				$datastr .= $name.",".$sexn.",".$user['user_id'].","
						.$user['fruit_coin'].",".$user['praise_flag'].",".$user['register_time'].","
						.$address."\n"; 
						
			}
		}
	
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
	
	//重置密码
	public function initPwd(){
		$Form = D("User");
		$password=md5('123456');
		$_POST['password'] =$password;
		$vo = $Form->create();
		if ($vo) {
			$list = $Form->save($vo);
		}
	}
	
	// 更新数据
	public function editPwd(){
		
		//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
		$Form = D("Hotel_admin");
		$user=M('Hotel_admin');
		$password=md5($_POST['password']);
		$newpassword=md5($_POST['newpassword']);
		$username=$_SESSION["username"];
		$condition['name']=$username;
		$condition['password']=$password;
		$query=$user->where($condition)->find();
		if($query)
		{
		$user_id = $user->where($condition)->getField('user_id');
		$condition2['user_id']=$user_id;
		$condition2['password']=$newpassword;
		if ($Form->create()) {
			
			$list = $Form->save($condition2);
			//dump($_POST);
			//未传入$data理由同上面的add方法
			/* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
			  save方法不会更新任何数据库的记录。
			  因此下面的代码不会更改数据库的任何记录
			 */
			//dump($list);
			if ($list !== false) {
				//注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
				//所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
				//$this->ajaxReturn($_POST,'修改密码成功！',1);
				unset($_SESSION["username"]);
				//$this->success('密码修改成功，请用新密码重新登录', '../../admin.php');
				echo "<script>alert('密码修改成功，请用新密码重新登录');top.location = '../../admin.php';</script>";
			} else {
				//$this->error('密码修改失败');
				echo "<script>alert('密码修改失败');</script>";
				//$this->ajaxReturn($_POST,'没有更新任何数据!',0);
			}
		} else {
			echo "<script>alert('密码修改失败');</script>";
			//$this->ajaxReturn($_POST,$Form->getError(),3);
			//$this->error('密码修改失败');
		}
	}
	else 
		echo "<script>alert('原密码错误');</script>";
		//$this->ajaxReturn($_POST,'原密码错误',0);
		//$this->error('原密码错误');
	}
}
?>
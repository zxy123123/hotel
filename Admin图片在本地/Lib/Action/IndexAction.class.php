<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action 
{
    public function index()
    {
    	if (!isset($_SESSION["username"]))
    	{
    		$this->redirect('Index/login') ;
    	}
    	$dtcount = C('DT_TIME_COUNT');
    	$rfcount = C('DT_REFRESH_COUNT');
    	$this->assign('dtcount',$dtcount);
    	$this->assign('rfcount',$rfcount);
    	$this->display();
    }
    
    public function checklogin()
    {
	$admin=M('admin');
    	$user=M('Hotel_admin');
    	$username=trim($_POST['username']);
    	$password=trim($_POST['password']);
    	//$password2=md5($password);
    	$condition['name']=$username;
    	$condition['password']=$password;
		$con['Name'] = $username;
		$con['Password'] = $password;
    	$query=$user->where($condition)->find();
		$query_admin=$admin->where($con)->find();
		$admin_id = $user->where($con)->getField('admin_id');
		$credit = $user->where($con)->getField('credit');
    	//var_dump($user->getLastSql());exit;
		if($query_admin){
			$_SESSION["username"] = $username;
    		$_SESSION['permission'] = 1;
    		$this->redirect('../../admin.php') ;
    		//$this->success('登录成功', '../../admin.php');
		}
		else{
			if($query){
    		$_SESSION["username"] = $username;
    		$_SESSION['permission'] = 0;
			$_SESSION["admin_id"] = $admin_id;
			$_SESSION["credit"] = $credit;
    		$this->redirect('../../admin.php') ;
    		//$this->success('登录成功', '../../admin.php');
			}else{
				$this->error('登录失败，请重新登录');
			}
		}
    	
    }
    
    public function loginout() {
    	if (isset($_SESSION["username"])){
			unset($_SESSION["username"]);
			//unset($_SESSION["admin_id"]);
			unset($_SESSION["credit"]);
			session('[destroy]');
			exit();
    	}else {
			session('[destroy]');
			exit();
    		//$this->error("已经注销登录！");
    	}

    }
	
	
	public function editPwd(){
    	//在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
    	$Form = D("Hotel_admin");
    	$user=M('Hotel_admin');
    	//$password=md5($_POST['password']);
    	//$newpassword=md5($_POST['newpassword']);
    	$password=$_POST['password'];
    	$newpassword=$_POST['newpassword'];
    	$username=$_SESSION["username"];
    	$condition['name']=$username;
    	$condition['password']=$password;
    	$query=$user->where($condition)->find();
    	header("Content-type:text/html;charset=utf-8");
    	if($query)
    	{
			$AdminId = $user->where($condition)->getField('admin_id');
			$con1['admin_id'] = $AdminId;
			$con['name'] = $username;
			$con['password'] = $newpassword;
			$result = $user->where($con1)->save($con);
    		unset($_SESSION["username"]);
    		//$this->success('密码修改成功，请用新密码重新登录', '../../admin.php');
    		echo "<script>alert('密码修改成功，请用新密码重新登录');top.location = '../../admin.php';</script>";
		}
    	else
    		echo "<script>alert('原密码错误');</script>";
    	//$this->ajaxReturn($_POST,'原密码错误',0);
    	//$this->error('原密码错误');
    	
    }
   
    // public function editPwd(){
    	// //在ThinkPHP中使用save方法更新数据库，并且也支持连贯操作的使用
    	// $Form = D("admin");
    	// $user=M('admin');
    	// //$password=md5($_POST['password']);
    	// //$newpassword=md5($_POST['newpassword']);
    	// $password=$_POST['password'];
    	// $newpassword=$_POST['newpassword'];
    	// $username=$_SESSION["username"];
    	// $condition['Name']=$username;
    	// $condition['Password']=$password;
    	// $query=$user->where($condition)->find();
    	// header("Content-type:text/html;charset=utf-8");
    	// if($query)
    	// {
    		// $user_id = $user->where($condition)->getField('admin_id');
    		// $condition2['admin_id']=$user_id;
    		// $condition2['admin_password']=$newpassword;
    		// if ($Form->create($condition2)) {
    			// $list = $Form->save($condition2);
    			// //dump($_POST);
    			// //未传入$data理由同上面的add方法
    			// /* 为了保证数据库的安全，避免出错更新整个数据表，如果没有任何更新条件，数据对象本身也不包含主键字段的话，
    			 // save方法不会更新任何数据库的记录。
    			// 因此下面的代码不会更改数据库的任何记录
    			// */
    			// //dump($list);
    			// if ($list !== false) {
    				// //注意save方法返回的是影响的记录数，如果save的信息和原某条记录相同的话，会返回0
    				// //所以判断数据是否更新成功必须使用 '$list!== false'这种方式来判断
    				// //$this->ajaxReturn($_POST,'修改密码成功！',1);
    				// unset($_SESSION["username"]);
    				// //$this->success('密码修改成功，请用新密码重新登录', '../../admin.php');
    				// echo "<script>alert('密码修改成功，请用新密码重新登录');top.location = '../../admin.php';</script>";
    			// } else {
    				// //$this->error('密码修改失败');
    				// echo "<script>alert('密码修改失败');</script>";
    				// //$this->ajaxReturn($_POST,'没有更新任何数据!',0);
    			// }
    		// } else {
    			// echo "<script>alert('密码修改失败');</script>";
    			// //$this->ajaxReturn($_POST,$Form->getError(),3);
    			// //$this->error('密码修改失败');
    		// }
    	// }
    	// else
    		// echo "<script>alert('原密码错误');</script>";
    	// //$this->ajaxReturn($_POST,'原密码错误',0);
    	// //$this->error('原密码错误');
    	
    // }
    
	
	public function check(){
		$o = D('Order_rooms');
		$sql = 'select count(*) count  from Order_rooms where flag = 0';
		$count = $o->query($sql);
		if($count[0]['count'] > 0){
			$code = true;
			$num = $count[0]['count'];
		}else{
			$code = false;
			$num = 0;
		}
		
		echo json_encode(array('code'=>$code,'num'=>$num));
	}
	
    //订单监听
    // public function check(){
    	// $o = D('Order_rooms');
    	// $a = D('Admin');
    	// $sql = 'select count(*) count from Order_rooms';
    	// $asql = 'select count from Admin where admin_id = 1';
    	// $count1 = $o->query($sql);
    	// $count2 = $a->query($asql);
    	// if($count2[0]['count']<$count1[0]['count']){
    		// //有订单没处理
    		// $code = true;
    		// $num = $count1[0]['count'] - $count2[0]['count'];
    		
    	// }else{
    		// $code = false;
    		// $num = 0;
    	// }
    	
    	// echo json_encode(array('code'=>$code,'num'=>$num));
    // }
}
<?php
// ±¾ÀàÓÉÏµÍ³×Ô¶¯Éú³É£¬½ö¹©²âÊÔÓÃÍ¾
class CreditAction extends Action {
	 public function index()
	    {
		// var_dump($_SESSION);
	    	$this->display();
	    }
	
	public function query()
	{
		// var_dump($_SESSION);
		// $list =M('hotel_admin')
		// ->join('hotels ON hotel_admin.hotel_id = hotels.id')
		// ->where(array('admin_id'=>$_SESSION['admin_id']))
		// ->field('hotels.name')->select();
		// var_dump($list);

		// $row =M('hotel_admin')
		// ->join('orders ON orders.hotel_id = hotel_admin.hotel_id')
		// ->where(array('admin_id'=>$_SESSION['admin_id']))
		// ->field('count(*) as total')->group("orders.hotel_id")->select();
		// var_dump($row);

		// $result = M('hotel_admin')
		// ->join('score ON score.hotelId = hotel_admin.hotel_id')
		// ->where(array('admin_id'=>$_SESSION['admin_id']))
		// ->field('sum(score_num)')->select();
		// var_dump($result);
		
		$one = M('hotel_admin')->field('hotel_id')->where(array('admin_id'=>$_SESSION['admin_id']))->select();
		// var_dump($one);
		$two=[];
		foreach ($one as $key => $value) 
		{
			$two[] = $value['hotel_id'];
		}
		$a = [];

		foreach ($two as $val) 
		{
			$b = [];
			$list =M('hotels')
			->where(array('id'=>$val))
			->field('hotels.name')->select();
			$row = M('orders')->field('count(*) as total')->where(array('hotel_id'=>$val))->select();
			$result  = M('score')->field('sum(score_num) as allscore')->where(array('hotelId'=>$val))->select();

				$b['name'] = $list[0]['name'];
				$b['total'] = $row[0]['total'];
				$b['allscore'] =$result[0]['allscore'];
				$a[] = $b;
		}

		$this->assign('list',$a);
		$this->display(); 
	}

	public function aindex()
	{
		$this->display();
	}

	public function aquery()
	{
		// var_dump($_SESSION);

		$one = M('hotel_admin')->field('hotel_id')->select();
		// var_dump($one);
		$two=[];
		foreach ($one as $key => $value) 
		{
			$two[] = $value['hotel_id'];
		}
		$a = [];

		foreach ($two as $val) 
		{
			$b = [];
			$list =M('hotels')
			->where(array('id'=>$val))
			->field('hotels.name')->select();
			$row = M('orders')->field('count(*) as total')->where(array('hotel_id'=>$val))->select();
			$result  = M('score')->field('sum(score_num) as allscore')->where(array('hotelId'=>$val))->select();

				$b['name'] = $list[0]['name'];
				$b['total'] = $row[0]['total'];
				$b['allscore'] =$result[0]['allscore'];
				$a[] = $b;
		}

		$this->assign('list',$a);
		$this->display(); 
	}

// $model->field('count(*) as total,hotel_id')->where()->group('hotel_id')->select();

	// public function getScore(){
	// 	var_dump($_SESSION);
	// 	$s = D("Score");
	// 	import("ORG.Util.Page"); //µ¼Èë·ÖÒ³Àà
	// 	$page=$_POST["page"]? $_POST["page"] :1;
	// 	$rows=$_POST["rows"]? $_POST["rows"] :10;
		
	// 	$admin_id = $_SESSION["admin_id"];
	// 	$con['admin_id'] = $admin_id;
		
	// 	$count = $s->count();
		
	// 	$list = $s->field('hotel_name,count(*) as order_number,sum(score_num) as total_score')->join('hotels ON score.contributor = hotels.hotel_id')->where($con)->group('contributor')->select();
		
		
	// 	$result['total'] = $count;
	// 	$result['rows'] = $list;
	// 	exit(json_encode($result));
	// }



}
?>
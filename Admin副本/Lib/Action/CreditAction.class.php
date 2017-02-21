<?php
// 本类由系统自动生成，仅供测试用途
class CreditAction extends Action {
 public function index()
    {
	// var_dump($_SESSION);
    	$this->display();
    }
	
	
	public function getScore(){
		
		$s = D("Score");
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"]? $_POST["page"] :1;
		$rows=$_POST["rows"]? $_POST["rows"] :10;
		
		$admin_id = $_SESSION["admin_id"];
		$con['admin_id'] = $admin_id;
		
		$count = $s->count();
		
		$list = $s->field('hotel_name,count(*) as order_number,sum(score_num) as total_score')->join('hotels ON score.contributor = hotels.hotel_id')->where($con)->group('contributor')->select();
		
		
		$result['total'] = $count;
		$result['rows'] = $list;
		exit(json_encode($result));
	}
}
?>
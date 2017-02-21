<?php
class TiebaAction extends Action {
	public function topic() 
	{
		if ($_SESSION['permission'] == 0) 
		{
			// var_dump($_SESSION);
			// exit;
			$id = M('hotel_admin')->where(array('admin_id'=>$_SESSION['admin_id']))->field('hotel_id')->find();
			$hotelid = $id['hotel_id'];
			$map = "('tiebas.type = hotel') and (relate_id=".$hotelid.")";
			$list = M('tieba_topics')
			->join('tiebas ON tieba_topics.tieba_id = tiebas.id')
			->join('tieba_classifies ON tieba_topics.classify_id = tieba_classifies.id')
			->join('users ON tieba_topics.user_id = users.id')
			->where($map)
			-> field('tieba_topics.*,tiebas.display_name tdn,tieba_classifies.display_name tcdn,users.nickname')
			->select();
		}else{
			$list = M('tieba_topics')
			->join('tiebas ON tieba_topics.tieba_id = tiebas.id')
			->join('tieba_classifies ON tieba_topics.classify_id = tieba_classifies.id')
			->join('users ON tieba_topics.user_id = users.id')
			-> field('tieba_topics.*,tiebas.display_name tdn,tieba_classifies.display_name tcdn,users.nickname')
			->select();
		}


		$this->assign('list',$list);
		$this->display();
	}

	public function opcdel()
	{
		$id = $_POST['id'];
		$list = M('tieba_topics')->delete($id);
		if ($list !== false && $list !== 0) 
		{
			$this->ajaxReturn($list);
		}else{
			$this->ajaxReturn('false');
		}
	}

	public function alldel()
	{
		// var_dump($_POST);
		// exit;
		// $arr = [];
		foreach ($_POST as $key => $val) 
		{
			foreach ($val as  $v) {
			$list = M('tieba_topics')->delete($v);	
			}
		}
		if ($list !== false && $list !== 0) 
		{
			$this->ajaxReturn('1');
		}else{
			$this->ajaxReturn('2');
		}
	}



	public function gambit()
	{
		$this->display();
	}























}
?>
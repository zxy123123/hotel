<?php
class TiebaAction extends Action {
	public function topic() 
	{
		$list = M('tieba_topics')->join('tiebas ON tieba_topics.tieba_id = tiebas.id')->join('tieba_classifies ON tieba_topics.classify_id = tieba_classifies.id')->join('users ON tieba_topics.user_id = users.id')-> field('tieba_topics.*,tiebas.display_name tdn,tieba_classifies.display_name tcdn,users.nickname')->select();

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




	public function gambit()
	{
		$this->display();
	}























}
?>
<?php

class JoinAction extends Action {
	 public function index()
	    {
		$list = M('contants')->select();
		// var_dump($list);
		$this->assign('list',$list);
	    	$this->display();
	    }
}
?>
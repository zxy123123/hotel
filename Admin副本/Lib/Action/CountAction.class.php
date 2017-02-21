<?php
class CountAction extends Action {
	public function index() {
		$u =D("User");
		$o =D("Order");
		
		
		$mcount = $u->count();
		$fcount = $u->where(array('sex'=>1))->count();
		$sql = 'select sum(total_price) as total from df_order';
		$totalrow = $o->query($sql);
		
		$fsql = 'select sum(i.buy_price*i.number) as total from df_order o left join df_item i on i.order_id = o.order_id left join df_fruit f on f.fruit_id = i.fruit_id ';
		$ftotalrow = $o->query($fsql);
		$lr = $totalrow[0]['total']-$ftotalrow[0]['total'];
		$data = array('bl'=>($mcount-$fcount).':'.$fcount,'lr'=>sprintf('%.2f',$lr),'ze'=>sprintf('%.2f',$totalrow[0]['total']));
		$this->assign('data',$data);
		$this->display();
		//var_dump($ftotalrow[0]['total']);
	}

}
?>
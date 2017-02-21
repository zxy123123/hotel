<?php
class StoreAction extends Action {
	public function index() {
        $list = M('goods')->table('goods g,image i')->where('i.goods_id = g.id')->select();

        // var_dump($list);
        $this->assign('list',$list);
	$this->display();
	}

	public function gooddetail()
	{
		$id = $_GET['id'];
		$what = "(g.id = i.goods_id and i.id = $id)";
		$list = M('image')->table('goods g,image i')->where($what)->find();
		// var_dump($list);
		$this->assign('list',$list);
		$this->display();
	}
//购物车展示页
	public function showcart()
	{
		
		// var_dump($_SESSION);
		// $abc = $_SESSION['cart']['price']
		$aaa = $_SESSION['cart'];
		  foreach ($aaa as $k => $v) {
			         $aaa[$k]['chengji'] = $v['qty'] * $v['price'];
			     }
			     // var_dump($aaa);

		$sum = 0;
		foreach ($aaa as  $val) 
		{
			$sum += $val['chengji'];
		}
		// var_dump($sum);
		// var_dump($_SESSION);
		$this->assign('count',$sum);
		$this->assign('list',$_SESSION['cart']);
		$this->display();
	}

	public function alldel()
	{
		unset($_SESSION['cart']);
		$this->success('已清空');
	}



	public function cartdo()
	{
		// unset($_SESSION);
		// exit;
		// var_dump($_GET);
		// exit;
		$goods_id = $_GET['goods_id'];
		$qty = $_GET['qty'];
		$sql = M('goods')->field('stock')->where(array('id'=>$goods_id))->find();
		$stock = $sql['stock'];
		// var_dump($stock);
		// var_dump($_SESSION['cart']);
		// exit;
		if ($_GET['b'] == 'buy') 
		{
		if (!empty($_SESSION['cart'][$goods_id])) 
		{
			//之前的数量加上新传过来的数量
			$c = $_SESSION['cart'][$goods_id]['qty'] += $qty;
			//跳转购物车展示页
			if ($c > $stock) 
			{
				$c = $_SESSION['cart'][$goods_id]['qty'] -= $qty;
				$this->error('商品库存不足');
				exit;
			}
			$this->success('去往交钱的路上',U('Store/showcart'));
			exit;
		}
	//查询商品信息
	$what = "(g.id=i.goods_id and g.id =$goods_id)";
	$lili = M('goods')->table('goods g,image i')->field('g.gname,i.iname,g.price,g.id,i.id iid')->where($what)->find();
	//将购买数量放入$row数组中
	$row['qty'] = $qty;
	$row['gname'] = $lili['gname'];
	$row['iname'] = $lili['iname'];
	$row['id'] = $lili['id'];
	$row['price'] = $lili['price'];
	$row['iid'] = $lili['iid'];
	//将信息存入session中
	$_SESSION['cart'][$goods_id] = $row;
	// var_dump($_SESSION);
	// exit;
	$this->success('正在加载中',U('Store/showcart'));
	exit;
	}else if($_GET['b'] == 'add')
	{
		if (!empty($_SESSION['cart'][$goods_id])) 
		{
			//之前的数量加上,新传过来的数量
			$d = $_SESSION['cart'][$goods_id]['qty'] += $qty;
			//跳转购物车展示页
			if ($d > $stock) 
			{
				$d = $_SESSION['cart'][$goods_id]['qty'] -=$qty;
				$this->error('商品库存不足');
				exit;
			}else{
				$cool['stock'] = $stock -$qty;
				$list = M('goods')->where(array('id'=>$goods_id))->save($cool);
				if ($list !== false) 
				{
					$this->success('已加入购物车');
					exit;
				}else{
					$this->error('无法加入购物车');
					exit;
				}

			}
		}
	}
	//查询商品的信息
	$what = "(g.id=i.goods_id and g.id =$goods_id)";
	$lili = M('goods')->table('goods g,image i')->field('g.gname,i.iname,g.price,g.id,i.id iid,g.stock')->where($what)->find();
	if ($lili['stock'] >= $qty) 
	{
		$row['qty'] = $qty;
	}else{
		$this->error('库存不足');
		exit;
	}
	
	$row['gname'] = $lili['gname'];
	$row['iname'] = $lili['iname'];
	$row['id'] = $lili['id'];
	$row['price'] = $lili['price'];
	$row['iid'] = $lili['iid'];

	//将信息存入session中
	$_SESSION['cart'][$goods_id] = $row;
	// $jack = M
	$rose['stock'] = $lili['stock'] -$qty;
	$list = M('goods')->where(array('id'=>$goods_id))->save($rose);
	// var_dump($_SESSION);
	// exit;
	$this->success('已加入购物车');
	exit;
}
	//删除购物车单条记录
	public function del()
	{
		$goods_id = $_GET['id'];
		unset($_SESSION['cart'][$goods_id]);
		$this->success('已删除');
	}

	public function dobuy()
	{
		// unset($_SESSION['cart']);
		// var_dump($_SESSION['cart']);
		$list = M('address')->where(array('operate'=>'2'))->find();

		$aaa = $_SESSION['cart'];
		  foreach ($aaa as $k => $v) {
			         $aaa[$k]['chengji'] = $v['qty'] * $v['price'];
			     }
			     // var_dump($aaa);

		$sum = 0;
		foreach ($aaa as  $val) 
		{
			$sum += $val['chengji'];
		}
		$_SESSION['cart'] = $aaa;
		// var_dump($sum);
		// var_dump($_SESSION);
		$this->assign('sum',$sum);
		$this->assign('row',$_SESSION['cart']);
		$this->assign('list',$list);
		$this->display();
	}

	public function addaddress()
	{
		// var_dump($_POST);
		// exit;
		if (IS_POST) 
		{
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$remark = $_POST['mark'];
			if (empty($name) && empty($phone) && empty($address)) 
			{
				$this->error('请完善信息');
				exit;
			}
			$data['linkman'] = $name;
			$data['phone'] = $phone;
			$data['address'] = $address;
			$data['remark'] = $remark;
			$list = M('address')->add($data);
			if ($list) 
			{
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}

		}else{
			$this->redirect('Store/dobuy');
			exit;
		}
	}
//默认地址
	public function mo()
	{
		$id = $_GET['id'];
		$data['operate'] = '1';
		$row['operate'] = '2';
		$list = M('address')->where(array('id'=>$id))->save($row);
		$row = M('address')->where(array('id'=>array('neq',$id)))->save($data);
	}

	public function address()
	{
		$list = M('address')->order('id desc')->select();
		$this->assign('list',$list);
		$this->display();
	}

	public function edaddress()
	{
		// var_dump($_POST);
		if (IS_POST) 
		{
			$id = $_POST['id'];
			$name = $_POST['linkman'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$remark = $_POST['remark'];
			if (empty($id) && empty($name) && empty($phone) && empty($address)) 
			{
				$this->error('请完善信息');
				exit;
			}
			$data['linkman'] = $name;
			$data['phone'] = $phone;
			$data['address'] = $address;
			$data['remark'] = $remark;
			$list = M('address')->where(array('id'=>$id))->save($data);
			if ($list !== false) 
			{
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}

		}else{
			$this->redirect('Store/dobuy');
		}
	}


	public function sureorder()
	{
		if (IS_POST) 
		{
			if (empty($_POST['allprice'])) 
			{
				$this->error('请购买商品再提交');
			}
			$allprice = $_POST['allprice'];
			$list = M('address')->where(array('operate'=>2))->find();
			// var_dump($list);
			$data['ordernum'] = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
			$data['lname'] = $list['linkman'];
			$data['phone'] = $list['phone'];
			$data['address'] = $list['address'];
			$data['allprice'] = $allprice;
			$result = M('goodsorder')->add($data);
			if ($result) 
			{

				foreach ($_SESSION['cart'] as $key => $val) 
				{
					$jack['goods_id'] = $val['id'];
					$jack['price'] = $val['price'];
					$jack['qty'] = $val['qty'];
					$jack['order_id'] = $result;
					$rose = M('order_goods')->add($jack);
				}
				unset($_SESSION['cart']);
				$this->success('订单已生成',U('Store/orders'));
			}else{
				$this->error('提交失败');
			}
		}
	}




	public function orders()
	{
		$what = "(og.order_id = go.id and og.goods_id = g.id and i.goods_id = g.id)";
	                if (!empty($_REQUEST['chaxun'])) 
	                {
	                    if ($_REQUEST['chaxun'] == 1) 
	                    {
	                        $what .= "and (go.ordernum like '%".$_REQUEST['find']."%')";
	                    }
	                    if ($_REQUEST['chaxun'] == 2) 
	                    {
	                        $what .= "and (go.phone like '%".$_REQUEST['find']."%')";
	                    }
	                }
                $list = M('goodsorder')->field('i.iname,g.gname,go.lname,go.address,go.phone,go.allprice,og.price,og.qty,go.ordernum')->table('goodsorder go,image i,order_goods og,goods g')->where($what)->select();

		// $list = M('goodsorder')->order('id desc')->select();

		// var_dump($list);
		$this->assign('list',$list);
		$this->display();
	}

}
?>
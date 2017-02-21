<?php
// header('Content-Type: application/json');
//      //header('Cache-Control: no-store');
//     header('Access-Control-Allow-Origin:*');
// require_once 'C:\xampp\htdocs\hotel\Public\path_to_sdk\autoload.php';
// use Qiniu\Auth;
// use Qiniu\Storage\UploadManager;
class AdminstoreAction extends Action {
            public function category()
            {
                $pid = empty($_GET['pid'])?0:$_GET['pid'];
                $list = M('categroy')->where(array('pid'=>$pid))->select();
                $row = M('categroy')->where(array('id'=>$pid))->find();
                // var_dump($row);
                // var_dump($list);
                $this->assign('row',$row);
                $this->assign('list',$list);
                $this->display();
            }
	
	public function addcatechrild()
            {
                // var_dump($_GET);
                $pid = $_GET['pid'];
                $path = $_GET['path'].$pid.',';
                $this->assign('pid',$pid);
                $this->assign('path',$path);
                $this->display();
            }

            public function addchild()
            {
                if (IS_POST) 
                {
                    foreach ($_POST as $key => $val) 
                    {
                        if (empty($val)) 
                        {
                            $this->error('请完善信息');
                            exit;
                        }
                    }
                    $data['cname'] = $_POST['cname'];
                    $data['pid'] = $_POST['pid'];
                    $data['path'] = $_POST['path'];
                    $row = M('categroy')->add($data);
                    if ($row) 
                    {
                        $this->success('添加成功',U('Adminstore/category'));
                    }else{
                        $this->error('添加失败');
                    }
                }else{
                    $this->redirect('Adminstore/addcatechrild');
                }
            }

            public function editcate()
            {
                // var_dump($_GET);
                $id = $_GET['id'];
                $list = M('categroy')->where(array('id'=>$id))->find();
                // var_dump($list);
                $this->assign('list',$list);
                $this->display();
            }

            public function doeditcate()
            {
                // var_dump($_POST);
                if (IS_POST) 
                {
                    foreach ($_POST as $val) 
                    {
                        if (empty($val)) 
                        {
                            $this->error('请完善信息');
                        }
                    }
                    $id = $_POST['id'];
                    $data['cname'] = $_POST['cname'];
                    $row = M('categroy')->where(array('id'=>$id))->save($data);
                    if ($row !== false) 
                    {
                        $this->success('修改成功',U('Adminstore/category'));
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $this->redirect('Adminstore/editcate');
                }
            }

            public function delcate()
            {
                // var_dump($_GET);
                $id = $_GET['id'];
                $pid = $_GET['pid'];
                $path = $_GET['path'];

                if ($pid !=0 && $path != '0,') 
                {
                    //子类的规律:自己的path拼接自己的id再加逗号
                    $cons = $path.$id.',';

                    // $what['path'] = "(path like".$cons."%)";
                    $what['path'] = array('like',''.$cons.'%');
                    $row = M('categroy')->where($what)->select();
                    // var_dump($row);
                    // echo M('categroy')->getLastSql();
                    if ($row) 
                    {
                        $this->error('不能删除,该类下还有商品');
                        exit;
                    }
                    $result = M('categroy')->where(array('id'=>$id))->delete();
                    if ($result !== 0 && $result !== false) 
                    {
                        $this->success('删除成功');
                    }else{
                        $this->error('删除失败');
                    }


                }else{
                    $this->error('顶级分类不可删除');
                }
            }

            public function addcate()
            {//直接产生pid
                $pid = empty($_GET['pid'])?0:$_GET['pid'];
                //直接产生path
                //为空默认0,不为空就是传值,拼接pid和一个逗号
                $path = empty($_GET['path'])?'0,':$_GET['path'].$pid.',';
                // var_dump($pid);
                // var_dump($path);
                $this->assign('pid',$pid);
                $this->assign('path',$path);
                $this->display();
            }

            public function doaddcate()
            {
                // var_dump($_POST);
                // exit;
                if (IS_POST) 
                {
                    if (empty($_POST['cname'])) 
                    {
                        $this->error('请输入分类名');
                        exit;
                    }
                    $data['pid'] = $_POST['pid'];
                    $data['path'] = $_POST['path'];
                    $data['cname'] = $_POST['cname'];
                    $row = M('categroy')->add($data);
                    if ($row) 
                    {
                        $this->success('添加成功',U('Adminstore/category'));
                    }else{
                        $this->error('添加失败');
                    }

                }else{
                    $this->redirect(U('Adminstore/addcate'));
                    exit;
                }
            }

            public function goods()
            {
                $what = "(g.cate_id = c.id and g.id = i.goods_id)";
                if (!empty($_REQUEST['chaxun'])) 
                {
                    if ($_REQUEST['chaxun'] == 1) 
                    {
                        $what .= "and (g.gname like '%".$_REQUEST['find']."%')";
                    }
                }
                $list = M('goods')->field('g.id gid,g.gname,c.cname,g.price,g.stock,i.iname,g.msg')->table('categroy c,image i,goods g')->where($what)->select();
                // var_dump($list);
                $this->assign('list',$list);
                $this->display();
            }

            public function editgoods()
            {
                $id = $_GET['id'];
                $cate = M('categroy')->field('cname,id,path')->select();
                $list = M('goods')->field('id,gname,cate_id,price,stock,msg')->where(array('id'=>$id))->find();
                // var_dump($list);
                $this->assign('list',$list);
                $this->assign('cate',$cate);
                // var_dump($_GET);
                // $list = M('')
                $this->display();
            }

            public function doeditgoods()
            {
                // var_dump($_POST);
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
                    $data['id'] = $_POST['id'];
                    $data['gname'] = $_POST['name'];
                    $data['cate_id'] = $_POST['cate_id'];
                    $data['price'] = $_POST['price'];
                    $data['stock'] = $_POST['stock'];
                    $data['msg'] = $_POST['msg'];
                    $row = M('goods')->data($data)->save();
                    if ($row !== false) 
                    {
                        $this->success('修改成功',U('Adminstore/goods'));
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $this->redirect('Adminstore/editgoods');
                }
            }

            public function editimgs()
            {
        // var_dump($_GET);
        // exit;
        $id = $_GET['id'];
 $bucket = 'zlmimg';  //空间名称  这里修改，你七牛运空间名称
  
  $accessKey = 'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA'; //密钥
  $secretKey = 'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4';//密钥
  $auth = new Auth($accessKey, $secretKey);
  $name=time().rand();
    $policy = array
    (
    'callbackUrl' => 'http://admin.zlmhotel.com/goods.php',  //修改数据库的页面，比如要把刚刚上传的写入你的数据库
    'callbackBody' => '{"fname":"'.$name.'$(fname)","imgId":"'.$id.'"}',

    // 'callbackBody' => '{"fname":"'.$name.'","roomId":"'.$id.'"}',

    'callbackBodyType'=>'application/json',
    //上传文件名
    'saveKey' => "goodsimg/$name$(fname)"
    );

  $token = $auth->uploadToken($bucket, null, 3600, $policy);

        $this->assign('uptoken',$token);
                $this->display();
            }

            public function addgoods()
            {
                $list = M('categroy')->field('id,cname,path')->select();

                // var_dump($list);
                $this->assign('cate',$list);
                $this->display();
            }

            public function doaddgoods()
            {
                // var_dump($_POST);
                // exit;
                if (IS_POST) 
                {
                    foreach ($_POST as $val) 
                    {
                        if (empty($val)) 
                        {
                            $this->error('请完善信息');
                            exit;
                        }
                    }
                    $data['gname'] = $_POST['name'];
                    $data['cate_id'] = $_POST['cate_id'];
                    $data['price'] = $_POST['price'];
                    $data['stock'] = $_POST['stock'];
                    $data['msg'] = $_POST['msg'];
                    $row = M('goods')->add($data);

                    if ($row) 
                    {
                    $jack['iname']= '1';
                    $jack['goods_id'] = $row;
                    $result = M('image')->add($jack);
                        $this->success('添加成功',U('Adminstore/goods'));
                    }else{
                        $this->error('添加失败');
                    }
                }else{
                    $this->redirect(U('Adminstore/addgoods'));
                }
            }

            public function goodsorder()
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

                 // echo M('goodsorder')->getLastSql();

            // var_dump($list);
            $this->assign('list',$list);
            $this->display();
            }
}
?>
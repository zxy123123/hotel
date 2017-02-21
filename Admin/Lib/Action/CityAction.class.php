<?php
class CityAction extends Action {
	public function hot() 
	{
		$area = M('areas');
		$map['fullname'] =array('notlike',array('%省','%区'),'AND');
		$map['level'] = array('exp','IN(1,2)');
		$map['hot'] = 1;
		$list = $area->where($map)->select();
		// var_dump($list);

	            $this->assign('list',$list);
	     	$this->display();

	}

	public function show() {
	$area = M('areas');
	$map['fullname'] =array('notlike',array('%省','%区'),'AND');
	$map['level'] = array('exp','IN(1,2)');
	$map['fronted_show'] = 1;
	$list = $area->where($map)->select();
	// var_dump($list);

            $this->assign('list',$list);
     	$this->display();
	}
	
public function addred(){

               // $upid = empty($_GET['parent_code'])?"":$_GET['parent_code'];
                $model = M('areas');

               // $data = $model->where(array('parent_code'=>$upid))->select();
        //var_dump($upid);

        if($_GET['parent_code']!=null&&$_GET['parent_code']!=""){
            $con['parent_code'] = $_GET['parent_code'];
        }else{
            $con['parent_code'] = "";
        }
        $data = $model->where($con)->select();
                $this->ajaxReturn($data);
        }

    
        // public function addred(){

        //         $upid = empty($_GET['parent_code'])?"":$_GET['parent_code'];
        //         $model = M('areas');

        //         $data = $model->where(array('parent_code'=>$upid))->select();
        //         // var_dump($data);
        //         $this->ajaxReturn($data);
        // }

        public function setup()
        {
                 $sheng = $_POST['sheng'];
                 $shi = $_POST['shi'];
                 $qu = $_POST['qu'];

                    if (!empty($sheng)) {
 	         $data['hot'] = 1;
                     $edit = M('areas')->where(array("code"=>$qu))->save($data);
                    }
                    if (!empty($shi)) {
                      $row['hot'] = 1;                          
                     $one = M('areas')->where(array('code'=>$shi))->save($row);
                    }
                    if (!empty($qu)) {
                     $result['hot'] = 1;	
                     $two = M('areas')->where(array('code'=>$sheng))->save($result);
                    }
                    $data['statue'] = 'fail';
                    $data['msg']='设置成功';
                    $this->ajaxReturn($data);
        }

        public function isshow()
        {
                    $sheng = $_POST['sheng'];
                    $shi = $_POST['shi'];
                    $qu = $_POST['qu'];
                    if (!empty($sheng)) 
                    {
     	             $data['fronted_show'] = 1;
                         $edit = M('areas')->where(array("code"=>$qu))->save($data);
                    }
                    if (!empty($shi)) {
                      $row['fronted_show'] = 1;
                     $one = M('areas')->where(array('code'=>$shi))->save($row);
                    }
                    if (!empty($qu)) {
                     $result['fronted_show'] = 1;
                     $two = M('areas')->where(array('code'=>$sheng))->save($result);
                    }
        }
	
	
}
?>
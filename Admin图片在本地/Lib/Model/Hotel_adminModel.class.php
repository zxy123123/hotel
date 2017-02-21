<?php
// 本类由系统自动生成，仅供测试用途
class Hotel_adminModel extends RelationModel{
	

	protected function pwdHash() {
		if(isset($_POST['password'])) {
			return md5($_POST['password']);
		}else{
			return 123456;
		}
	}

}
?>
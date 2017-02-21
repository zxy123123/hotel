<?php


return array(
	//'配置项'=>'配置值'
	

	
		'OUTPUT_ENCODE' =>  false,
		'APP_DEBUG' => false, 		// 开启调试模式
		
		
		'DB_TYPE'=> 'mysql',        	// 数据库类型
		'DB_HOST'=> 'localhost', 	// 数据库服务器地址
		'DB_NAME'=>'hotel', 	// 数据库名称
		'DB_USER'=>'root', 		// 数据库用户名
		'DB_PWD'=>'', 		// 数据库密码
		'DB_PORT'=>'3306', 		// 数据库端口
		'DB_PREFIX'=>'', 		// 数据表前缀

	 //酒店	
		// 'DB_TYPE'=>'mysql',        	// 数据库类型
		// 'DB_HOST'=>'121.196.203.152', 	// 数据库服务器地址
		// 'DB_NAME'=>'zjuhotel', 	// 数据库名称
		// 'DB_USER'=>'zjuhotel', 		// 数据库用户名
		// 'DB_PWD'=>'zju-hotel', 		// 数据库密码
		// 'DB_PORT'=>'3306', 		// 数据库端口
		// 'DB_PREFIX'=>'', 		// 数据表前缀
	//	'DB_CHARSET'=>'utf8',		
		
		'DB_CHARSET'=>'utf8',
		'SESSION_AUTO_START' =>true,
		
		//图片上传路径
		'UPLOAD_DIR'=>'/Public/upload/',

		'ROOM_UPLOAD_DIR'=>'./laravel/public/uploads/image/',

		//监听时间间隔10s
		'DT_TIME_COUNT'=>'10000',//默认10s 这个单位是ms
		//监听消息提示n次后刷新订单页面
		'DT_REFRESH_COUNT'=>'5',//默认是5次

		
		
		
		

		)






?>

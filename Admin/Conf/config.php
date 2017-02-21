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
		// 'DB_HOST'=>'121.199.47.225', 	// 数据库服务器地址
		// 'DB_NAME'=>'zlm', 	// 数据库名称
		// 'DB_USER'=>'zlm', 		// 数据库用户名
		// 'DB_PWD'=>'zlm2016', 		// 数据库密码
		// 'DB_PORT'=>'3306', 		// 数据库端口
		// 'DB_PREFIX'=>'', 		// 数据表前缀
		//    //'DB_CHARSET'=>'utf8',		

		//'OUTPUT_ENCODE' =>  false,
		//'APP_DEBUG' => false, 		// 开启调试模式
		//
		//
		//'DB_TYPE'=> 'mysql',        	// 数据库类型
		//'DB_HOST'=> '121.199.47.225', 	// 数据库服务器地址
		//'DB_NAME'=>'zlm', 	// 数据库名称
		//'DB_USER'=>'zlm', 		// 数据库用户名
		//'DB_PWD'=>'zlm2016', 		// 数据库密码
		//'DB_PORT'=>'3306', 		// 数据库端口
		//'DB_PREFIX'=>'', 		// 数据表前缀
		//'DB_CHARSET'=>'utf8',
		
		'SESSION_AUTO_START' =>true,


		// 'DB_TYPE'=>'mysql',        	// 数据库类型
		// 'DB_HOST'=>'121.199.47.225', 	// 数据库服务器地址
		// 'DB_NAME'=>'zlm', 	// 数据库名称
		// 'DB_USER'=>'zlm', 		// 数据库用户名
		// 'DB_PWD'=>'zlm2016', 		// 数据库密码
		// 'DB_PORT'=>'3306', 		// 数据库端口
		// 'DB_PREFIX'=>'', 		// 数据表前缀
		// 'DEFAULT_FILTER' => 'htmlspecialchars',
		
		'DB_CHARSET'=>'utf8',
		'SESSION_AUTO_START' =>true,
		
		// //图片上传路径
		// 'UPLOAD_DIR'=>'/Public/upload/',

		'ROOM_UPLOAD_DIR'=>'./laravel/public/uploads/image/',

		//监听时间间隔10s
		'DT_TIME_COUNT'=>'10000',//默认10s 这个单位是ms
		//监听消息提示n次后刷新订单页面
		'DT_REFRESH_COUNT'=>'5',//默认是5次

		// 'THINK_SDK_QINIU'=>array(
		//     'APP_KEY'=>'<QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA>',
		//     'APP_SECRET'=>'<QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4>',
		//     'DOWN_DOMAIN'=>'<zlmimg.qiniudn.com>'
		//     ),

		//七牛上传文件设置
		  //   'PICTURE_UPLOAD_DRIVER'=>'Qiniu',   
		  //   //本地上传文件驱动配置
		  //   'UPLOAD_LOCAL_CONFIG'=>array(),
		  // 'UPLOAD_QINIU_CONFIG'=>array(
		  //       'accessKey'=>'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA',
		  //       'secrectKey'=>'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4',
		  //       'bucket'=>'zlmimg',
		  //       'domain'=>'zlmimg.qiniudn.com',
		  //       'timeout'=>3600,
		  //   ),
		
		
		  // 'UPLOAD_SITEIMG_QINIU'=>array(
				// 'maxSize'=>5*1024*1024,//文件大小
				// 'rootPath'=>'./',
				// 'saveName'=>array('uniqid',''),
				// 'driver'=>'Qiniu',
				// 'driverConfig'=>array(
				// 'secrectKey'=>'QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4',
				// 'accessKey'=>'QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA',
				// 'domain'=>'zlmimg.qiniudn.com',
				// 'bucket'=>'zlmimg',
				// 'default'   => 'ofnl1imqj.bkt.clouddn.com',
				// ),
				// )

//***********************************SESSION设置**********************************
    'SESSION_OPTIONS'         =>  array(
        'name'                =>  'cart',                    //设置session名
        'expire'              =>  24*3600*15,                      //SESSION保存15天
        'use_trans_sid'       =>  1,                               //跨页传递
        'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    ),


		// 'qiniu' => [
		//               'driver'  => 'qiniu',
		//               'domains' => [
		//                 'default'   => 'ofnl1imqj.bkt.clouddn.com', //你的七牛域名
		//                 'https'     => '',         //你的HTTPS域名
		//                 'custom'    => 'img.zlmhotel.com',     //你的自定义域名
		//              ],
		//             'access_key'=> env('QINIU_AK','QOtJUoE6oDwj-QFb7_fwm7Db0UXv_eEB9GlDq-hA'),  //AccessKey
		//             'secret_key'=> env('QINIU_SK','QvA1FvkHmyGdf2R66yEK1cKqalFhsZMIBiuT6CI4'),  //SecretKey
		//             'bucket'    => env('QINIU_BUCKET','zlmimg'),  //Bucket名字
		//             'notify_url'=> '',  //持久化处理回调地址
		//         ],


		

		)






?>

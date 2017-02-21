<?php

    define('HOST','101.200.37.79');
    //用户名
    define('USER','zlm');
    //密码
    define('PWD','zlm2016');
    //库名
    define('DB','zlm');
    //字符集
    define('CHAR','utf8');

    $link = mysqli_connect(HOST,USER,PWD,DB) or die('数据库没有连接成功!');
    mysqli_set_charset($link,CHAR);

     $_body = file_get_contents('php://input');
         $body = json_decode($_body, true);

         $fname = $body['fname'];
         $hotelId = $body['hotelId'];

         $url = "http://img.zlmhotel.com/hotel/$fname";

        $sql = "UPDATE display_pictures SET `url`='$url' WHERE `relate_id`='$hotelId' and type='hotels'";
        $result = mysqli_query($link,$sql);
        if ($result && mysqli_affected_rows($link)>0) 
        {
            ECHO '{"success":true}';
        }else{
            ECHO '{"success":false}';
        }
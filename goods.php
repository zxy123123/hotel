<?php

    define('HOST','101.200.37.79');
    //�û���
    define('USER','zlm');
    //����
    define('PWD','zlm2016');
    //����
    define('DB','zlm');
    //�ַ���
    define('CHAR','utf8');

    $link = mysqli_connect(HOST,USER,PWD,DB) or die('���ݿ�û�����ӳɹ�!');
    mysqli_set_charset($link,CHAR);

	 $_body = file_get_contents('php://input');
         $body = json_decode($_body, true);

         $fname = $body['fname'];
         $imgId = $body['imgId'];

         $url = "http://img.zlmhotel.com/goodsimg/$fname";

        $sql = "UPDATE image SET `iname`='$url' WHERE `goods_id`='$imgId'";
        $result = mysqli_query($link,$sql);
        if ($result && mysqli_affected_rows($link)>0) 
        {
            ECHO '{"success":true}';
        }else{
            ECHO '{"success":false}';
        }
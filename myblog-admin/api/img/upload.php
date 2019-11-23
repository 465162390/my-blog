<?php
/** 上传图片 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $base_url = $_SERVER['DOCUMENT_ROOT'];  // 获取项目的根路径
    $time = date("YmdHis");
    $file = $_FILES["img"];

    $status = new stdClass();

    $new_tmp = "/data/wwwroot/my-blog/articleImg/".$time.".jpg";

    // 将上传的图片移动到图片文件夹
    move_uploaded_file($file["tmp_name"],$new_tmp);

    $new_url = "../../../articleImg/". $time .".jpg";

    // 创建返回给页面的对象
    $status -> code = 200;
    $status -> url = $new_url;
    $status -> message = "图片上传成功";

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;




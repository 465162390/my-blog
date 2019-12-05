<?php
/**  删除友情链接 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $status = new stdClass();

    $sql = "delete from friendly_link where id='$id'";
    $result = mysqli_query($link, $sql);

    if($result) {
        $status -> code = 200;
        $status -> message = "删除链接成功!";
    } else {
        $status -> code = 400;
        $status -> message = "删除链接失败!";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
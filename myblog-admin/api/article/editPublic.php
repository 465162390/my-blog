<?php
/** 修改文章的是否公开 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $state = $_POST["state"];
    $status = new stdClass();
    $state == "true" ? $message = "文章公开状态修改为公开！" : $message = "文章公开状态修改为私密！";

    $sql = "update article set public='$state' where id='$id'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $status -> code = 200;
        $status -> message = $message;
    } else {
        $status -> code = 400;
        $status -> message = "文章是否公开状态修改失败！";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;


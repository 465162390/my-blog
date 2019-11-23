<?php
/** 请求用户详情信息 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $status = new stdClass();

    $sql = "select * from user where id = '$id'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $row = mysqli_fetch_object($result);
        unset($row -> password);

        $status -> code = 200;
        $status -> message = "success";
        $status -> data = $row;
    } else {
        $status -> code = 400;
        $status -> message = "failed";
        $status -> data = new stdClass();
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;

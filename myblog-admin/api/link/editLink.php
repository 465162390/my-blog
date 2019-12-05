<?php
/** 新增/修改友情链接 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $operation = $_POST["operation"];
    $name = $_POST["name"];
    $_link = $_POST["link"];
    $status = new stdClass();

    if ($operation == "create") {
        $sql = "insert into friendly_link (name, link) values ('$name', '$_link')";
        $message = "新增";
    } else {
        $id = $_POST["id"];
        $sql = "update friendly_link set name='$name', link='$_link' where id='$id'";
        $message = "修改";
    }

    $result = mysqli_query($link, $sql);
    if ($result) {
        $status -> code = 200;
        $status -> message = $message."友情链接成功!";
    } else {
        $status -> code = 400;
        $status -> message = $message."友情链接失败!";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
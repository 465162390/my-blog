<?php
/** 请求前5篇热门文章 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $array = [];
    $status = new stdClass();

    $sql = "select id, title from article where public='true' ORDER BY viewCount limit 0,5";
    $result = mysqli_query($link, $sql);

    if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($array, $row);
        }

        $status -> code = 200;
        $status -> data = $array;
        $status -> message = "success";
    } else {
        $status -> code = 400;
        $status -> data = [];
        $status -> message = "failed";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;


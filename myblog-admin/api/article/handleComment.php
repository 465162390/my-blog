<?php
/** 新增/删除 文章评论 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $operation = $_POST["operation"];
    $articleId = $_POST["articleId"];
    $status = new stdClass();
    $array = [];

    if ($operation == "add") {
        $time = date("Y-m-d H:i:s");
        $name = $_POST["name"];
        $content = $_POST["content"];
        $sql = "insert into comment (articleId, name, content, createdAt) values ('$articleId', '$name', '$content', '$time')";
    } else {
        $id = $_POST["id"];
        $sql = "delete from comment where id='$id'";
    }

    $result = mysqli_query($link, $sql);

    if ($result) {
        $select_sql = "select * from comment where articleId = '$articleId' ORDER BY createdAt DESC";
        $select_result = mysqli_query($link, $select_sql);
        while ($row = mysqli_fetch_assoc($select_result)) {
            array_push($array, $row);
        }
        $status -> data = $array;
        $status -> code = 200;

        $operation == "add" ? $status -> message = "评论成功!" : $status -> message = "删除评论成功!";
    } else {
        $status -> code = 400;
        $operation == "add" ? $status -> message = "评论失败!" : $status -> message = "删除评论失败!";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
<?php
/** 删除文章 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $sql = "delete from article where id = '$id'";
    $result = mysqli_query($link, $sql);
    $status = new stdClass();

    if ($result) {
        $tag_sql = "delete from tag_links where article_id = '$id'";
        mysqli_query($link, $tag_sql);
        $category_sql = "delete from category_links where article_id = '$id'";
        mysqli_query($link, $category_sql);
        $comment_sql = "delete from comment where article_id = '$id'";
        mysqli_query($link, $comment_sql);

        $status -> code = 200;
        $status -> message = "删除文章成功！";
    } else {
        $status -> code = 200;
        $status -> message = "删除文章失败！";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
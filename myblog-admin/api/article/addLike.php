<?php
/** 文章点赞 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

$id = $_POST["id"];

// 增加文章的点赞数
$sql = "update article set aLike = aLike + 1 where id = '$id'";
$result = mysqli_query($link, $sql);

// 增加博客数据中的新增点赞和总点赞数
$day = date("Ymd");
$data_sql = "update blogdata set dailyLike = dailyLike + 1, totalLike = totalLike + 1 where name = '$day'";
$data_result = mysqli_query($link, $data_sql);

// 查询文章的点赞数，返回前端
$select_sql = "select aLike from article where id='$id'";
$select_result = mysqli_query($link, $select_sql);
$row = mysqli_fetch_assoc($select_result);
$likeNum = $row['aLike'];

// 返回前端的数据
$status = new stdClass();
$status -> like = $likeNum;

$obj = json_encode($status, JSON_UNESCAPED_UNICODE) . ' ';
echo $obj;

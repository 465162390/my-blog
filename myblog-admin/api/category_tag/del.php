<?php
/** 删除 标签/分类 **/
require_once("../config/config.php");
mysqli_query($link, 'set names utf8 ');

$id = $_POST["id"];
$type = $_POST["type"];
$link_ = $type . "_links";   // 链接表的名称
$type_id = $type . "_id";
$status = new stdClass();
$type == "tag" ? $type_message = "标签" : $type_message = "分类";

$select_sql = "select * from $link_ where $type_id = '$id'";
$select_result = mysqli_query($link, $select_sql);

if (mysqli_num_rows($select_result) >= 1) {
	$status->code = 400;
	$status->message = "删除失败，还有文章使用该" . $type_message;
} else {
	$sql = "delete from $type where id = '$id'";
	$result = mysqli_query($link, $sql);

	if ($result) {
		$status->code = 200;
		$status->message = "删除" . $type_message . "成功！";
	}
}

$obj = json_encode($status, JSON_UNESCAPED_UNICODE) . ' ';
echo $obj;

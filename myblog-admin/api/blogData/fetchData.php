<?php 
// 获取博客数据
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

// 返回一个对象的方法
function createObject($id, $name, $num) {
  $object = new stdClass();
  $object -> id = $id;
  $object -> name = $name;
  $object -> num = $num;
  return $object;
};

// 获取文章总数
$totalArticle = mysqli_query($link, "select count(*) as total from article");
$articleNum = (int)mysqli_fetch_assoc($totalArticle)["total"];

// 获取今天新增的评论数量
$createdAt = date("Y-m-d");
$dailyComment = mysqli_query($link, "select count(*) as total from comment where createdAt like '%$createdAt%'");
$dailyCommentNum = (int)mysqli_fetch_assoc($dailyComment)["total"];

// 获取总评论数量
$totalComment = mysqli_query($link, 'select count(*) as total from comment');
$totalCommentNum = (int)mysqli_fetch_assoc($totalComment)["total"];

// 获取今天的新增点赞，访客，总访客，总点赞数
$day = date("Ymd");
$dayData = mysqli_query($link, "select * from blogdata where name='$day'");
$dayDataRow = $dayData -> num_rows;

if( $dayDataRow == 1 ) {
  $row = mysqli_fetch_assoc($dayData);
  $dailyVistorNum = (int)$row["dailyVistor"];   // 新增访客
  $dailyLikeNum = (int)$row["dailyLike"];     // 新增点赞量

} else {
  // 查询最新的一条记录
  $lastResult = mysqli_query($link, "select * from blogdata order by name desc limit 1");
  $row = mysqli_fetch_assoc($lastResult);

  $dailyVistorNum = 0; 
  $dailyLikeNum = 0;
}

$dailyCommentNum = $dailyCommentNum;    // 新增评论量
$totalVistorNum = (int)$row["totalVistor"];   // 总访客数
$totalLikeNum = (int)$row["totalLike"];   // 总点赞数
$totalCommentNum = $totalCommentNum;   // 总评论数
$totalArticleNum = $articleNum;   // 总点赞数

$daily = array( createObject("1", "今日新增访客", $dailyVistorNum), createObject("2", "今日新增点赞", $dailyLikeNum), createObject("3", "今日新增评论", $dailyCommentNum));
$total = array( createObject("1", "总访客数", $totalVistorNum), createObject("1", "总点赞数", $totalLikeNum), createObject("1", "总评论数", $totalCommentNum), 
createObject("1", "总文章数", $totalArticleNum) );

$status = new stdClass();
$status -> code = 200;
$status -> message = "success";
$status -> daily = $daily;
$status -> total = $total;

$obj = json_encode($status, JSON_UNESCAPED_UNICODE) . ' ';
echo $obj;
?>
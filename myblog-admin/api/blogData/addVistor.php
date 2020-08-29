<?php 
// 判断用户是否为第一次访问网站
// 第一次访问网站则访客数 +1,后端返回一个cookie,24小时内再次访问不加访客数
require_once("../config/config-cookie.php");

// 回传给前端的对象
$status = new stdClass();

// 先查询最新一条记录的总访客数,总评论数，总点赞数，总查看数，总文章数
$result = mysqli_query($link, "select id, totalVistor, totalLike from blogdata order by name desc limit 1");
$row = mysqli_fetch_assoc($result);
$lastVistor = (int)$row["totalVistor"];   // 总访客数
$lastLike = $row["totalLike"];
$id = (int)$row["id"] + 1;

if (isset($_COOKIE['visitTime'])) {
  $status -> message = "not first visit";

} else {
  $accessTime = date("Y-m-d H:i");
  $expireTime = date("Y-m-d H:i",strtotime("+1 day"));
  setcookie('visitTime', "access:$accessTime&expire:$expireTime", time()+60*60*24, '/', '',false);
  $status -> message = "first visit";

  // 首次访问,则数据库总访客数+1，新增访客数+1，id + 1
  $lastVistor = $lastVistor + 1;
  $day = date("Ymd");
  $sql = "insert into blogdata (id, name, dailyVistor, totalVistor, totalLike) 
  values ('$id', '$day', '1', '$lastVistor', '$lastLike')
   ON DUPLICATE KEY UPDATE dailyVistor=dailyVistor+1, totalVistor=totalVistor+1";
  $result = mysqli_query($link,$sql);
}

$status -> num = $lastVistor;

$obj = json_encode($status, JSON_UNESCAPED_UNICODE) . ' ';
echo $obj;

?>
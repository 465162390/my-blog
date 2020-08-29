<?php 
// 绑定本站账号
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

$username = $_POST["username"];
$password = md5($_POST["password"]);
$uniqueId = $_POST["uniqueId"];
$accountType = $_POST["accountType"];
$status = new stdClass();

$sql = "select * from user where username='$username' and password='$password'";
$result = mysqli_query($link, $sql);

// 获取绑定的账号的role权限
$row = mysqli_fetch_assoc($result);
$role = $row["role"];

if (mysqli_num_rows($result) == 1) {
  switch($accountType) {
    case "weibo": 
      $update_sql = "update user set uid = '$uniqueId' where username = '$username'";
    break;
    case "qq":
      $update_sql = "update user set openid = '$uniqueId' where username = '$username'";
    break;
    case "github":
      $update_sql = "update user set gid = '$uniqueId' where username = '$username'";
    break;
  };
  $update_result = mysqli_query($link, $update_sql);

  if( $update_result ){
    $status -> code = 200;
    $status -> message = "本站账号绑定成功!";
    $status -> role = $role;
  } else {
    $status -> code = 400;
    $status -> message = "本站账号绑定失败!";
  }
  
} else {
  $status -> code = 400;
  $status -> message = "没有该账号!";
}

$obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
echo $obj;

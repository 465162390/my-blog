<?php 
  // QQ账号登录
  require_once("../config/config.php");
  mysqli_query($link,'set names utf8 ');

  // 用户授权的access_token
  $access_token = $_POST["access_token"];
  // qq应用里的id
  $id = "101876230";
  // qq应用里的secret
  $key =  "37e0de0eb1f3906b88020b2b0b037313";
  // qq应用里的重定向地址
  $redirect_uri = "https://www.ngkakui.cn/loginCallBack/qq";

  // get方法
  function httpget($url, $type) {
    $curl = curl_init();   // 启动一个curl会话
    curl_setopt($curl, CURLOPT_URL, $url);   // 要访问的地址
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);   // 设置超时时间
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // 信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    //禁止 cURL 验证对等证书
    // type判断是否需要限制参数格式为json
    $type == "json" ? curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
    )) : "";
    $tmpInfo = curl_exec($curl);  // 执行操作
    if (curl_errno($curl)) {
      echo 'Curl error: ' . curl_error($curl);
    }
    curl_close($curl);  // 关闭curl对话
    return $tmpInfo;
  }

  // 将openid_url返回的数据转成json对象
  function changeJson($str) {
    $lpos = strpos($str, "(");
    $rpos = strrpos($str, ")");
    $str = substr($str, $lpos+1, $rpos-$lpos-1);
    $str_json = json_decode($str);
    return $str_json;
  }

  // 换取openId的url
  $openid_url = "https://graph.qq.com/oauth2.0/me?access_token=$access_token";
  $openId = changeJson(httpget($openid_url, "")) -> openid;

  // 获取用户信息url
  $userInfo_url = "https://graph.qq.com/user/get_user_info?access_token=$access_token&oauth_consumer_key=$id&openid=$openId";
  $userData = json_decode(httpget($userInfo_url, "json"));

  // 获取用户的相关信息并保存到数据库中
  $name = $userData -> nickname;   // 用户名称
  $gender = $userData -> gender;   // 用户性别
  $province = $userData -> province;   // 省份
  $city = $userData -> city;   // 城市
  $year = $userData -> year;   // 出生年份
  $figureurl = $userData -> figureurl;   // 用户头像地址
  $last_time = date("Y-m-d H:i:s");   // 用户最后一次登录时间

  // 查询数据库中是否有该用户
  $row = mysqli_num_rows(mysqli_query($link, "select * from qq_user where openid = '$openId'"));
  // 有该用户则更新数据，没有则插入数据
  if($row == 1) {
    $qq_sql = "update qq_user set openid='$openId', name='$name', gender='$gender', province='$province', 
     city='$city', year='$year', figureurl='$figureurl', last_time='$last_time' where openid='$openId'";
  } else {
    $qq_sql = "insert into qq_user (openid, name, gender, province, city, year, figureurl, last_time)
     values ('$openId', '$name', '$gender', '$province', '$city', '$year', '$figureurl', '$last_time')";
  }
  mysqli_query($link, $qq_sql);

  // 新建返回给前端的用户信息对象
  $user = new stdClass();
  $user -> uniqueId = $openId;
  $user -> name = $name;
  $user -> last_time = $last_time;
  $user -> accountType = "qq";

  // 查询本站用户表里是否有该uid绑定了的用户，没有则提示用户是否注册本站账号
  $user_result = mysqli_query($link, "select * from user where openid='$openId'");
  $userNums = $user_result -> num_rows;
  if($userNums == 1) {
    $row = mysqli_fetch_assoc($user_result);
    $user -> role = $row["role"];
    $user -> bind = "binded";     // 已绑定本站账号
  } else {
    $user -> role = "0";
    $user -> bind = "notBind";     // 没绑定本站账号
  };

  // 返回给前端的数据
  $status = new stdClass();
  $status -> userData = $user;
  $status -> message = "success";
  $status -> code = 200;  
  $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
  echo $obj;
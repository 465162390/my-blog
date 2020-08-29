<?php 
  // 微博账号登录
  require_once("../config/config.php");
  mysqli_query($link,'set names utf8 ');

  // 用户授权的code
  $code = $_POST["code"];
  // 微博应用里的 key
  $key = "167444771";
  // 微博应用里的secret
  $secret = "a1921ee14cabf9a75ca34e645757ad43";
  // 微博应用里的重定向地址
  $redirect_uri = "https://www.ngkakui.cn/loginCallBack/weibo";

  // post方法
  function httppost($postdata, $url) {
    $curl = curl_init();   // 启动一个curl会话
    curl_setopt($curl, CURLOPT_URL, $url);   // 要访问的地址
    curl_setopt($curl, CURLOPT_POST, 1);   // 发送一个常规的POST请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);   // POST请求提交的数据
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);   // 设置超时时间
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // 信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $tmpInfo = curl_exec($curl);  // 执行操作
    if (curl_errno($curl)) {
      echo 'Curl error: ' . curl_error($curl);
    }
    curl_close($curl);  // 关闭curl对话
    return $tmpInfo;
  }

  // get方法
  function httpget($url) {
    $curl = curl_init();   // 启动一个curl会话
    curl_setopt($curl, CURLOPT_URL, $url);   // 要访问的地址
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);   // 设置超时时间
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // 信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
    ));
    $tmpInfo = curl_exec($curl);  // 执行操作
    if (curl_errno($curl)) {
      echo 'Curl error: ' . curl_error($curl);
    }
    curl_close($curl);  // 关闭curl对话
    return $tmpInfo;
  }

  // 换取token的url
  $token_url = "https://api.weibo.com/oauth2/access_token?client_id=$key&client_secret=$secret&grant_type=authorization_code&redirect_uri=$redirect_uri&code=$code";
  
  // post请求传的参数
  $postdata = new stdClass();
  $postdata -> client_id = $key;
  $postdata -> client_secret = $secret;
  $postdata -> grant_type = "authorization_code";
  $postdata -> code = $code;
  $postdata -> redirect_uri = $redirect_uri;

  // 通过code换取回来的token、uid值
  $data = json_decode(httppost($postdata, $token_url));
  $access_token = $data -> access_token;     // token
  $uid = $data -> uid;    // 用户uid

  // 获取用户信息的url
  $user_url = "https://api.weibo.com/2/users/show.json?access_token=$access_token&uid=$uid";
  $userData = json_decode(httpget($user_url));

  // 获取用户的相关信息并保存到数据库中
  $name = $userData -> name;    // 友好显示名称
  $screen_name = $userData -> screen_name;    // 用户名
  $location = $userData -> location;    // 用户所在地
  $avatar_hd = $userData -> avatar_hd;   // 用户高清头像
  $gender = $userData -> gender;    // 用户性别
  $description = $userData -> description;    // 用户个人描述
  $followers_count = $userData -> followers_count;    // 用户粉丝数
  $friends_count = $userData -> friends_count;    // 用户关注数
  $last_time = date("Y-m-d H:i:s");   // 用户最近登录时间

  // 查询数据库中是否有该用户
  $row = mysqli_num_rows(mysqli_query($link, "select * from weibo_user where uid = '$uid'"));
  // 有该用户则更新数据，没有则插入数据
  if($row == 1) {
    $weibo_sql = "update weibo_user set uid='$uid', name='$name', screen_name='$screen_name', location='$location', avatar_hd='$avatar_hd', gender='$gender', 
     description='$description', followers_count='$followers_count', friends_count='$friends_count', last_time='$last_time' where uid='$uid'";
  } else {
    $weibo_sql = "insert into weibo_user (uid, name, screen_name, location, avatar_hd, gender, description, followers_count, friends_count, last_time)
     values ('$uid', '$name', '$screen_name', '$location', '$avatar_hd', '$gender', '$description', '$followers_count', '$friends_count', '$last_time')";
  }
  mysqli_query($link, $weibo_sql);

  // 新建返回给前端的用户信息对象
  $user = new stdClass();
  $user -> uniqueId = $uid;
  $user -> name = $name;
  $user -> last_time = $last_time;
  $user -> accountType = "weibo";

  // 查询本站用户表里是否有该uid绑定了的用户，没有则提示用户是否注册本站账号
  $user_result = mysqli_query($link, "select * from user where uid='$uid'");
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

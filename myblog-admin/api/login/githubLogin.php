<?php 
  // github账号登录
  require_once("../config/config.php");
  mysqli_query($link,'set names utf8 ');

  // 用户授权获取的code
  $code = $_POST["code"];
  // github应用的id
  $id = "5a16d2b557c027310af2";
  // github的secret
  $secret = "c2f685091d181e715769b2d3f5ea34857a23e651";
  // github的重定向地址
  $redirect_uri = "https://www.ngkakui.cn/loginCallBack/github";

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
  function httpget($url, $access_token) {
    $curl = curl_init();   // 启动一个curl会话
    curl_setopt($curl, CURLOPT_URL, $url);   // 要访问的地址
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);   // 设置超时时间
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // 信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // 设置header请求头
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      "Authorization: token ".$access_token,
      "User-Agent: NGKAKUI博客",
    ));
    $tmpInfo = curl_exec($curl);  // 执行操作
    if (curl_errno($curl)) {
      return '{"Curl_error": "'.curl_error($curl).'"}';
    }
    curl_close($curl);  // 关闭curl对话
    return $tmpInfo;
  }

  // 将string转换为数组对象
  function changeArray($str) {
    $data = explode('&',$str);
    foreach ($data as $key => $value){
      $temp = explode('=',$value);
      $Array[$temp[0]] = $temp[1];
    };
    return $Array;
  }

  // 换取token的url
  $token_url = "https://github.com/login/oauth/access_token";

  // post请求传的参数
  $postdata = new stdClass();
  $postdata -> client_id = $id;
  $postdata -> client_secret = $secret;
  $postdata -> code = $code;
  
  // 通过code换取回来的access_token值
  $dataArr = changeArray(httppost($postdata, $token_url));
  $access_token = $dataArr["access_token"];

  // 获取用户信息url
  $userInfo_url = "https://api.github.com/user";
  $userData = json_decode(httpget($userInfo_url, $access_token), true);

  // 返回给前端的数据
  $status = new stdClass();

  // 判断是否登录成功返回用户信息
  if( isset($userData["id"]) == 1 ) {

    // 获取用户的相关信息并保存到数据库中
    $login = $userData["login"];   // github账号
    $uid = $userData["id"];    // github用户唯一固定的id
    $avatar_url = $userData["avatar_url"];    // 用户头像地址
    $html_url = $userData["html_url"];    // github地址
    $name = $userData["name"];    // 用户名称
    $company = $userData["company"];    // 用户公司名称
    $blog = $userData["blog"];   // 用户博客地址
    $location = $userData["location"];   // 用户所在地
    $email = $userData["email"];   // 用户邮箱
    $bio = $userData["bio"];    // 用户自我介绍
    $last_time = date("Y-m-d H:i:s");   // 用户最后一次登录时间

    // 查询数据库中是否有该用户
    $row = mysqli_num_rows(mysqli_query($link, "select * from github_user where uid = '$uid'"));
    // 有该用户则更新数据，没有则插入数据
    if($row == 1) {
      $qq_sql = "update github_user set login='$login', uid='$uid', avatar_url='$avatar_url', html_url='$html_url', name='$name', 
      company='$company', blog='$blog', location='$location', email='$email', bio='$bio', last_time='$last_time' where uid='$uid'";
    } else {
      $qq_sql = "insert into github_user (login, uid, avatar_url, html_url, name, company, blog, location, email, bio, last_time)
      values ('$login', '$uid', '$avatar_url', '$html_url', '$name', '$company', '$blog', '$location', '$email', '$bio', '$last_time')";
    }
    mysqli_query($link, $qq_sql);

    // 新建返回给前端的用户信息对象
    $user = new stdClass();
    $user -> uniqueId = $uid;
    $user -> name = $name;
    $user -> last_time = $last_time;
    $user -> accountType = "github";

    // 查询本站用户表里是否有该gid绑定了的用户，没有则提示用户是否注册本站账号
    $user_result = mysqli_query($link, "select * from user where gid='$uid'");
    $userNums = $user_result -> num_rows;
    if($userNums == 1) {
      $row = mysqli_fetch_assoc($user_result);
      $user -> role = $row["role"];
      $user -> bind = "binded";     // 已绑定本站账号
    } else {
      $user -> role = "0";
      $user -> bind = "notBind";     // 没绑定本站账号
    };

    $status -> userData = $user;
    $status -> message = "success";
    $status -> code = 200;  
  
  } else {

    $status -> message = "login failed";
    $status -> code = 400;  

  };

  $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
  echo $obj;


  


  

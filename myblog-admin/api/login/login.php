<?php
/** 登录 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $date = date("Ymd");
    $status = new stdClass();

    $sql = "select * from user where username='$username' and password='$password'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        // 生成token返回到前端页面
        $str = md5($row["name"].$row["username"].$date).$id;
        $token = base64_encode($str);  // 经过base64处理
        // 将token插入到数据库
        $update_sql = "update user set token = '$token' where id = '$id'";
        mysqli_query($link, $update_sql);

        $status -> user = new stdClass();
        $status -> user -> token = $token;
        $status -> user -> name = $row["name"];
        $status -> user -> username = $row["username"];
        $status -> user -> role = $row["role"];

        $status -> code = 200;
        $status -> message = "登录成功！";
    } else {
        $status -> code = 400;
        $status -> message = "账号或密码错误！";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
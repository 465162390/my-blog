<?php
/** 用户注册 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $name = $_POST["name"];
    $role = $_POST["role"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $createdAt = date("Y-m-d H:i:s");
    $type = $_POST["type"];

    // accountType判断用户绑定的是什么类型的账号
    isset($_POST["accountType"]) == 1 ? $accountType = $_POST["accountType"] : $accountType = "";
    isset($_POST["uniqueId"]) == 1 ? $uniqueId = $_POST["uniqueId"] : $uniqueId = "";
    $status = new stdClass();

    $select_sql = "select * from user where username='$username'";
    $select_result = mysqli_query($link, $select_sql);
    if (mysqli_num_rows($select_result) == 1) {
        $status -> code = 400;
        $status -> message = "该账号已经被注册，请重新输入!";
    } else {
        switch ($accountType) {
          case "weibo":
            $sql = "insert into user (name, username, password, role, createdAt, uid) values ('$name', '$username', '$password', '$role', '$createdAt', '$uniqueId')";
          break;
          case "qq":
            $sql = "insert into user (name, username, password, role, createdAt, openid) values ('$name', '$username', '$password', '$role', '$createdAt', '$uniqueId')";
          break;
          case "github":
            $sql = "insert into user (name, username, password, role, createdAt, gid) values ('$name', '$username', '$password', '$role', '$createdAt', '$uniqueId')";
          break;
          default:
            $sql = "insert into user (name, username, password, role, createdAt) values ('$name', '$username', '$password', '$role', '$createdAt')";
        }
        $result = mysqli_query($link, $sql);
        if ($result) {
            $status -> code = 200;
            $status -> message = "注册成功! 您的本站账号为: ".$username;
        } else {
            $status -> code = 400;
            $status -> message = "注册失败！";
        }
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;

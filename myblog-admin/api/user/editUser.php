<?php
/** 修改用户信息 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $role = $_POST["role"];
    $status = new stdClass();


    if (isset($_POST["newpwd"]) && $_POST["newpwd"] != "" && isset($_POST["oldpwd"]) && $_POST["oldpwd"] != "") {
        $oldpwd = md5($_POST["oldpwd"]);
        $newpwd = md5($_POST["newpwd"]);

        $select_sql = "select password from user where id = '$id'";
        $select_result = mysqli_query($link, $select_sql);
        $password = mysqli_fetch_row($select_result)[0];

        if ($oldpwd == $password) {
            $sql = "update user set name='$name', role='$role', password='$newpwd' where id='$id'";
            sql($sql, $link, $status);
        } else {
            $status -> code = 400;
            $status -> message = "旧密码错误，请重新输入!";
        }
    } else {
        $sql = "update user set name='$name', role='$role' where id='$id'";
        sql($sql, $link, $status);
    }
    // 更新用户信息
    function sql($sql, $link, $status) {
        $result = mysqli_query($link, $sql);

        if ($result) {
            $status -> code = 200;
            $status -> message = "修改用户信息成功！";
        } else {
            $status -> code = 400;
            $status -> message = "修改用户信息失败!";
        }
        return $status;
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;



<?php
/** 配置文件 **/

// 解决跨域的问题
header("Content-type:text/html;charset=utf8");
header("Access-Control-Allow-Origin: *");  // 允许跨域
header('Access-Control-Allow-Headers: Authorization');  // 允许请求头哪些字段跨域
header('Access-Control-Max-Age: 2592000');  // 设置会让axios在设置时间内不再发送option预检请求
//    header("Access-Control-Allow-Origin: http://localhost:8080");
//    header("Access-Control-Allow-Credentials: true");
//    header("Access-Control-Allow-Headers: X-Requested-With");
//    header("Access-Control-Allow-Methods: GET,POST");

// 数据库配置
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "ng0130");

$link = mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_select_db($link, 'my_blog');

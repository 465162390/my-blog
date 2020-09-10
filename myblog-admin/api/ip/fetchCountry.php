<?php

/** 获取客户端的ip地址 **/
/** 根据ip地址获取所在城市信息 **/

header("Content-type:text/html;charset=utf8");
require_once("../config/config.php");
require_once '../../vendor/gethtml/simple_html_dom.php';

// php后端获取ip地址方法
function getip()
{
	global $ip;
	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "Unknow";
	return $ip;
}

/**** GET请求方法 ****/
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

// ip地址
$ip = getip();
$status = new stdClass();

// 调用高德地图api，根据IP地址定位
$url = "https://restapi.amap.com/v3/ip?output=JSON&key=xxx&ip=".$ip;
$data = json_decode(httpget($url));
// 如果ip地址获取不到省市的信息，就默认为广东省广州市
$data -> province == [] ? $data->province="广东省" : "";
$data -> city == [] ? $data->city="广州市" : "";

$province = $data -> province;   // 省份
$city = $data -> city;   // 城市
$status -> code = 200;
$status -> message = "success";
$status -> city = $city;
$status -> province = $province;
$status -> ip = $ip;

$obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
echo $obj;
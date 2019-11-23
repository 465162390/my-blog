<?php
/** 获取客户端的ip地址 **/
/** 根据ip地址获取所在城市信息 **/
/** 获取信息的网址：http://ip.tool.chinaz.com （站长工具） **/

header("Content-type:text/html;charset=utf8");
require_once("../config/config.php");
require_once '../../vendor/gethtml/simple_html_dom.php';

    function getip() {
        global $ip;
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknow";
        return $ip;
    }

    $ip = getip();
    $url = "http://ip.tool.chinaz.com/".$ip;

    // 获取该网址的内容
    $html = file_get_html($url);
    $arr = [];
    $status = new stdClass();

    // 获取该网址指定内容
    foreach($html -> find('div .IpMainWrap-Left .IcpMain02 .WhoIpWrap .bor-b1s span') as $element) {
        array_push($arr, $element);
    }

    $info = explode('>', explode(' ', $arr[3])[2])[1];   // 获取到省市
    $province = explode('省', $info)[0] . "省";
    $city = explode('省', $info)[1];
    $status -> code = 200;
    $status -> message = "success";
    $status -> city = $city;
    $status -> province = $province;
    $status -> ip = $ip;

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;

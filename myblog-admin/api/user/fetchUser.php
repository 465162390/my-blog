<?php
/** 查询所有用户信息 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $current_page = $_POST["page"];
    $pagesize = $_POST["pagesize"];
    $name = $_POST["name"];
    $Array = [];
    $status = new stdClass();

    if( $name == "" ) {
        $sql = "select * from user";
    } else {
        $sql = "select * from user where name Like '%$name%'";
    }

    $result = mysqli_query($link, $sql);
    $recordcount = mysqli_num_rows($result);   // 总记录数

    // 计算总页数
    if($recordcount == 0) {
        $pagecount = 0;   // 如果记录数为0，则总页数也为0
    } else if( $recordcount < $pagesize || $recordcount == $pagesize ){  // 如果总记录数小于等于每页显示总数则只有一页
        $pagecount = 1;
    } else if( $recordcount % $pagesize == 0 ){
        $pagecount = $recordcount / $pagesize;   // 如果没有余数,总页数等于总记录数量除以每页显示记录的数量
    } else {
        $pagecount = (int)($recordcount / $pagesize)+1;   // 有余数，则总数再加一
    }

    $from = ($current_page-1) * $pagesize;  // 从第几条记录开始取
    $to = $current_page * $pagesize;   // 取到第几条数据

    $sql .= " ORDER BY createdAt DESC limit $from,$pagesize";
    $select_result = mysqli_query($link,$sql);

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)) {
            $row["role"] == "1" ? $row["role"] = "博主用户" : $row["role"] = "普通用户";
            unset($row["password"]);
            array_push($Array, $row);
        }

        $status -> code = 200;
        $status -> data = $Array;
        $status -> message = "success";
        $status -> page = $current_page;
        $status -> total = $recordcount;
        $status -> from = $from;
        $status -> to = $to;
    } else {
        $status -> code = 400;
        $status -> data = [];
        $status -> message = "failed";
        $status -> total = 0;
        $status -> from = $from;
        $status -> to = $to;
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;

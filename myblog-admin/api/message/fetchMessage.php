<?php
/** 查找所有留言 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $array = [];
    $status = new stdClass();
    $current_page = $_POST["page"];  // 当前页
    $pagesize = $_POST["pagesize"];    // 每页显示总数

    $sql = "select * from message";
    $result = mysqli_query($link, $sql);
    $recordcount = mysqli_num_rows($result);   // 总留言数

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
    $select_result = mysqli_query($link, $sql);

    if($select_result) {
        while( $row = mysqli_fetch_assoc($select_result) ) {
            array_push($array, $row);
        }

        $status -> data = $array;
        $status -> code = 200;
        $status -> message = "success";

        $status -> total = $recordcount;
        $status -> current_page = $current_page;
        $status -> from = $from;
        $status -> to = $to;
    } else {
        $status -> data = [];
        $status -> code = 400;
        $status -> message = "failed";
        $status -> total = 0;
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;
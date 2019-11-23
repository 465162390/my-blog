<?php
/** 查找标签/分类信息 **/
require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $type = $_POST["type"];
    $current_page = $_POST["page"];
    $pagesize = $_POST["pagesize"];
    $name = $_POST["name"];
    $link_ = $type."_links";   // 链接表的名称
    $type_id = $type."_id";
    $Array = [];

    $status = new stdClass();

    if( $name == "" ) {
        $sql = "select * from $type";
    } else {
        $sql = "select * from $type where name Like '%$name%'";
    }

    $result = mysqli_query($link,$sql);
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

    $sql .= " limit $from,$pagesize";
    $select_result = mysqli_query($link,$sql);

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)) {
            $num_sql = "select * from $link_ where $type_id = '$row[id]'";
            $num = mysqli_num_rows(mysqli_query($link, $num_sql));
            $row["num"] = $num;
            array_push($Array, $row);
        }

        $status -> code = 200;
        $status -> data = $Array;
        $status -> page = $current_page;
        $status -> total = $recordcount;
        $status -> from = $from;
        $status -> to = $to;
        $status -> message = "success";
    } else {
        $status -> code = 400;
        $status -> data = [];
        $status -> page = $current_page;
        $status -> total = 0;
        $status -> from = $from;
        $status -> to = $to;
        $status -> message = "failed";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;


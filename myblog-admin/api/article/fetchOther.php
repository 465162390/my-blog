<?php
/** 查询标签/分类列表 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $tags = [];
    $categories = [];
    $status = new stdClass();

    function select($link, $type) {
        $link_ = $type."_links";   // 链接表的名称
        $type_id = $type."_id";    // 分类/标签的id

        $arr = [];
        $sql = "select * from $type";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            // 从链接表中查询该标签/分类下的文章有多少篇
            $num_sql = "select * from $link_ where $type_id = '$row[id]'";
            $num = mysqli_num_rows(mysqli_query($link, $num_sql));
            $row["num"] = $num;
            $row["type"] = "info";
            $row["effect"] = "plain";
            array_push($arr, $row);
        };
        return $arr;
    }

    $tags = select($link, "tag");
    $categories = select($link, "category");

    if (count($tags) != 0 && count($categories) !=0) {
        $status -> data = new stdClass();
        $status -> data -> tags= $tags;
        $status -> data -> categories= $categories;
        $status -> code = 200;
        $status -> message = "success";
    } else {
        $status -> data = new stdClass();
        $status -> data -> tags = [];
        $status -> data -> categories = [];
        $status -> code = 400;
        $status -> message = "failed";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;



<?php
/** 按分类/标签 归档文章 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $current_page = $_POST["page"];  // 当前页
    $pagesize = $_POST["pagesize"];    // 每页显示总数
    $type = $_POST["type"];
    $value = $_POST["value"];
    $_link = $type."_links";
    $_id = $type."_id";
    $articleIds = [];
    $articles = [];
    $status = new stdClass();

    // 查询当前标签/分类的 id
    $sql = "select id from $type where name = '$value'";
    $result = mysqli_query($link, $sql);
    $id = mysqli_fetch_assoc($result)["id"];

    // 根据id查询该标签/分类下的文章id
    $select_sql = "select article_id from $_link where $_id = '$id'";
    $select_result = mysqli_query($link, $select_sql);

    // 文章总数
    $recordcount = mysqli_num_rows($select_result);

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

    $select_sql .= " limit $from,$pagesize";
    $select_result = mysqli_query($link, $select_sql);

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)) {
            array_push($articleIds, $row["article_id"]);
        }

        for($i=0; $i<count($articleIds); $i++) {
            $id = $articleIds[$i];
            $select_article = "select id, title, createdAt from article where id = '$id'";
            $result_article = mysqli_query($link, $select_article);
            $article = mysqli_fetch_assoc($result_article);
            array_push($articles, $article);
        }

        $status -> code = 200;
        $status -> message = "success";
        $status -> data = $articles;
        $status -> total = $recordcount;
        $status -> from = $from;
        $status -> to = $to;
        $status -> current_page = $current_page;
        $status -> pagecount = $pagecount;

    } else {
        $status -> data = [];
        $status -> code = 400;
        $status -> message = "success";
        $status -> current_page = "1";
        $status -> pagecount = "1";
        $status -> total = "0";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;

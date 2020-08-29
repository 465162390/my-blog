<?php
/** 前台查找所有文章 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $current_page = $_POST["page"];  // 当前页
    $pagesize = $_POST["pagesize"];    // 每页显示总数
    isset($_POST["title"]) ? $title = $_POST["title"] : $title = "";
    isset($_POST["tag"]) ? $tag = $_POST["tag"] : $tag = "";
    isset($_POST["category"]) ? $category = $_POST["category"] : $category = "";
    $role = $_POST["role"];

    $Array = array();  // 记录所有的文章信息
    $status = new stdClass();

    // 查询该文章的标签/分类的方法
    function select($link, $id, $type) {
        $arr = [];
        $tab = $type."_links";
        $type_id = $type."_id";
        $sql = "select $type_id from $tab where article_id = $id";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $select_sql = "select * from $type where id = $row[$type_id]";
            $select_result = mysqli_query($link, $select_sql);
            while ($row = mysqli_fetch_assoc($select_result)) {
                array_push($arr, $row);
            }
        }
        return $arr;
    }

    // 查询该文章的评论的方法
    function s_comment($link, $id) {
        $arr = [];
        $sql = "select * from comment where articleId = '$id'";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
        }
        return $arr;
    }

    // 所有查询条件都为空
    if( $title == "" && $tag == "" && $category == "" ) {
      // $sql = "select * from article";
      $role == "1" ? $sql = "select * from article" : $sql = "select * from article where public = 'true'";
    } else {
	    // $sql = "select * from article where ";
			$role == "1" ? $sql = "select * from article where " : $sql = "select * from article where public = 'true' and ";

      $tag != "" ? $sql .= "id in(SELECT article_id from tag_links WHERE tag_id =  $tag) and " : $sql;
      $category != "" ? $sql .= "id in(SELECT article_id from category_links WHERE category_id =  $category) and " : $sql;
      $title != "" ? $sql .= "title Like '%". $title ."%'" : $sql = substr($sql,0,count($sql)-5);
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
    $select_result = mysqli_query($link, $sql);

    $from = $from + 1;

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)) {
            $row["public"] == "true" ? $row["public"] = true : $row["public"] = false;
            // 文章标签
            $row["tags"] = select($link, $row["id"], "tag");
            // 文章分类
            $row["categories"] = select($link, $row["id"], "category");
            // 文章评论
            $row["comments"] = s_comment($link, $row["id"]);
            array_push($Array, $row);
        }

        $status -> data = $Array;
        $status -> code = 200;
        $status -> message = "success";
        $status -> from = $from;
        $status -> to = $to;
        $status -> total = $recordcount;
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

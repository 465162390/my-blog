<?php
/** 查看文章详情 **/
    require_once("../config/config.php");
    mysqli_query($link,'set names utf8 ');

    isset($_POST["role"]) != "" ? $role = $_POST["role"] : $role = "undefined";
    $id = $_POST["id"];
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
                $row["type"] = "primary";
                $row["effect"] = "dark";
                array_push($arr, $row);
            }
        }
        return $arr;
    }

    // 查询该文章的评论的方法
    function s_comment($link, $id) {
        $arr = [];
        $sql = "select * from comment where articleId = '$id' ORDER BY createdAt DESC";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
        }
        return $arr;
    }

    // 查询当前文章
    $sql = "select * from article where id='$id'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $row["public"] == "true" ? $row["public"] = true : $row["public"] = false;
        // 文章标签
        $row["tags"] = select($link, $row["id"], "tag");
        // 文章分类
        $row["categories"] = select($link, $row["id"], "category");
        // 文章评论
        $row["comments"] = s_comment($link, $row["id"]);

        // 如果浏览者不是博主用户，文章浏览数 +1，并且将浏览数更新到数据库
        if($role != 1) {
            $row["viewCount"] += 1;
            $viewCount = $row["viewCount"];
            $update_sql = "update article set viewCount= '$viewCount' where id = '$id'";
            mysqli_query($link, $update_sql);
        }
        
        $status -> code = 200;
        $status -> data = $row;
        $status -> message = "success";
    } else {
        $status -> code = 400;
        $status -> data = new stdClass();
        $status -> message = "failed";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;


<?php
/** 修改文章 **/

require_once("../config/config.php");
mysqli_query($link,'set names utf8 ');

    $id = $_POST["id"];
    $title = $_POST["title"];
    $tags = $_POST["tags"];
    $categories = $_POST["categories"];
    $content = $_POST["content"];
    $public = $_POST["public"];
    $updatedAt = date("Y-m-d H:i:s");
    $tag_ids = [];
    $category_ids = [];

    // 创建返回页面的对象
    $status = new stdClass();

    // 将内容中的单引号，多加一个单引号，避免插入数据库时匹配错误
    $content = str_replace("'", "''", $content);

    // 判断哪些标签/分类是新增的，新增的先存进数据库
    // 函数最后返回一个该文章的标签/分类的id数组
    function insert($link, $arr, $type) {
        $ids = [];
        for ($i=0; $i<count($arr); $i++) {
            $name = $arr[$i]['name'];
            $sql = "select id from $type where name='$name'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                array_push($ids, $row["id"]);
            } else {
                $sql = "insert into $type (name) values ('$name')";
                mysqli_query($link, $sql);
                array_push($ids, mysqli_insert_id($link));
            }
        }
        return $ids;
    }

    // 函数将分类文章的标签id与分类id分别插入到分类和标签的链接表
    function insert_link($link, $arr, $type, $articleId) {
        $typeid = $type."_id";
        $type = $type."_links";
        // 先删除该文章的对应链接
        $delete_sql = "delete from $type where article_id = '$articleId'";
        mysqli_query($link, $delete_sql);
        for ($i=0; $i<count($arr); $i++) {
            $sql = "insert into $type ($typeid, article_id) values ('$arr[$i]', '$articleId') ON DUPLICATE KEY UPDATE $typeid='$arr[$i]', article_id='$articleId'";
            mysqli_query($link, $sql);
        }
    }

    // 该文章的标签/分类的id数组
    $tag_ids = insert($link, $tags, "tag");
    $category_ids = insert($link, $categories, "category");

    // 将文章id与标签/分类id保存到链接表
    insert_link($link, $tag_ids, "tag", $id);
    insert_link($link, $category_ids, "category", $id);

    $update_sql = "update article set title='$title', content='$content', updatedAt='$updatedAt', public='$public' where id='$id'";
    $update_result = mysqli_query($link, $update_sql);

    if ($update_result) {
        $status -> code = 200;
        $status -> message = "文章提交成功！";
    } else {
        $status -> code = 400;
        $status -> message = "文章提交失败！";
    }

    $obj = json_encode($status,JSON_UNESCAPED_UNICODE).' ';
    echo $obj;


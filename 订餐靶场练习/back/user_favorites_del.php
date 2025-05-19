<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$member_id = $_SESSION['memberId'];

$id = $_GET['id'];
if (!$id){
    msg("非法操作",INDEX);
}

$sql = "delete from collection where member_id=$member_id and res_id=$id";
if (execute($sql)){
    //减少收藏数
    $coll_count = query_once("select coll_count from restaurant where id=$id");
    $coll_count['coll_count'] = $coll_count['coll_count']-1 <0 ? 0 : $coll_count['coll_count']-1;
    $sql = "update restaurant set coll_count=".$coll_count['coll_count'].",updated_time='".nowTime()."' where id=$id";
    if (!execute($sql)){
        msg("收藏减少失败",INDEX);
    }
    header("location:".FAVORITE."?id=".$id."");
}else{
    msg("删除失败",FAVORITE."?id=".$id);
}


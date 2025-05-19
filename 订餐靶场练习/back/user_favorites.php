<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/define.php";
require_once "../func/database.php";
require_once "../func/member-check.php";

$res_id = $_GET['id'];

session_start();
$_SESSION=loginCheck($_SESSION);
$member_id = $_SESSION['memberId'];

if (!$res_id){
    msg("非法操作",INDEX);
}

$sql = "insert into collection (res_id,member_id) values ($res_id,$member_id)";
if (execute($sql)){
    //增加收藏数
    $coll_count = query_once("select coll_count from restaurant where id=$res_id");
    $coll_count['coll_count'] +=1;
    $sql = "update restaurant set coll_count=".$coll_count['coll_count'].",updated_time='".nowTime()."' where id=$res_id";
    if (!execute($sql)){
        msg("收藏数增加失败",INDEX);
    }
    header("location:".SHOP."?id=".$res_id."");
}else{
    msg("该店铺已收藏",SHOP."?id=".$res_id);
}

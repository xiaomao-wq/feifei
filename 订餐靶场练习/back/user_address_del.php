<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/member-check.php";

$id = $_GET['id'];
if (!$id){
    msg("非法操作",INDEX);
}
//获取当前时间
$time = nowTime();

$sql = "update member_address set status=0,updated_time='$time' where id=$id;";

if (execute($sql)){
    header("location:".ADDRESS."");
} else {
    msg("删除收货地址失败",ADDRESS);
}
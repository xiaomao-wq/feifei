<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/address-check.php";
require_once "../func/database.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$member_id = $_SESSION['memberId'];

$order_id = $_POST['order_id'];
$food_ids = $_POST['food_ids'];
$content = $_POST['content'];

//将food_ids变为数组
$food_id = explode(',',$food_ids);

for ($i=0;$i<count($food_id);$i++){
    $sql = "insert into member_comments (member_id,food_id,pay_order_id,content) values ($member_id,$food_id[$i],$order_id,'$content')";
    if (!execute($sql)){
        msg("评论失败",COMMENT);
    }
}
$sql = "update pay_order set comment_status=1 where id=$order_id";
if (!execute($sql)){
    msg("订单评论失败,请重试",COMMENT);
}
msg("评论成功",COMMENT);

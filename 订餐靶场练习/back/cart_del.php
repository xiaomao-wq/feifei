<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);

$cart_id = $_GET['id'];

if ($cart_id){
    $sql = "update member_cart set status=0,updated_time='".nowTime()."' where id=$cart_id and member_id=".$_SESSION['memberId'].";";
    if (execute($sql)){
        header("location:".CART."");
    }
}else{
    msg("非法操作",INDEX);
}


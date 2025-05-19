<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/address-check.php";
require_once "../func/database.php";

$add = addCheck($_POST);
//获取验证后的值
$province = $add['province'];
$city = $add['city'];
$county = $add['county'];
$nickName = $add['nickName'];
$address = $add['address'];
$mobile = $add['mobile'];

session_start();
$_SESSION=loginCheck($_SESSION);

//获取当前登录会员名的id
$id = $_SESSION['memberId'];

$sql = "insert into member_address (member_id,nickname,mobile,province,city,county,address)
        values ($id,'$nickName','$mobile','$province','$city','$county','$address');";

if (execute($sql)) {
    //msg("添加收货地址成功", ADDRESS);
    header("location:".ADDRESS."");
} else {
    msg("添加收货地址失败",ADDRESS);
}



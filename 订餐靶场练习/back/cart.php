<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);

$memberName = $_SESSION['memberName'];
//获取member的id
$member_id = query("select id from member where nickname='$memberName';");
$member_id = $member_id[0]['id'];

$food_id = $_GET['food_id'];
$number = $_POST['number'];

//获取加入购物车的食品信息
$food = query("select f.name food_name,f.price,f.main_image,r.name res_name from food f left join restaurant r on f.res_id=r.id where f.id=$food_id");

//将食品加入购物车中
$sql = "insert into member_cart (member_id,food_id,quantity) values ($member_id,$food_id,$number);";
if (execute($sql)){
    header("location:".CART."");
}else{
    msg("加入购物车失败",CART);
}



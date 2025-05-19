<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
//当前用户id
session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$order_id = $_GET['id'];

//查询订单信息
$pay_order = query("select order_sn,pay_price from pay_order where member_id=$memberId and id=$order_id");


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>确认订单-DeathGhost</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <link href="../static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../static/js/public.js"></script>
    <script type="text/javascript" src="../static/js/jquery.js"></script>
    <script type="text/javascript" src="../static/js/jqpublic.js"></script>
</head>
<body>
<section class="Psection MT20 Textcenter"  id="Aflow">
<!-- 订单提交成功后则显示如下 -->
<p class="Font14 Lineheight35 FontW">恭喜你！订单生成成功！</p>
<p class="Font14 Lineheight35 FontW">您的订单编号为：<span class="CorRed"><?=$pay_order[0]['order_sn']?></span></p>
<p class="Font14 Lineheight35 FontW">共计金额：<span class="CorRed"><?=$pay_order[0]['pay_price']?></span></p>
<p>
    <button type="button" class="Lineheight35"><a href="pay.php?id=<?=$order_id?>" target="_blank">支付宝立即支付</a></button>
    <button type="button" class="Lineheight35"><a href="user_center.php">进入用户中心</button>
</p>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/database.php";
require_once "../func/member-check.php";

session_start();
//
if ($_SESSION['memberId']){
    $cart_count = query_once("select count(1) number from member_cart where status=1 and member_id=".$_SESSION['memberId'].";");
    $cart_count = $cart_count['number'];
}
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>网上订餐</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <meta name="author" content="DeathGhost"/>
    <link href="../static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../static/js/public.js"></script>
    <script type="text/javascript" src="../static/js/jquery.js"></script>
    <script type="text/javascript" src="../static/js/jqpublic.js"></script>
</head>

<body>
<header>
    <section class="Topmenubg">
        <div class="Topnav">
            <div class="LeftNav">
                <?php  if (!$_SESSION['memberName']) { ?>
                    <a href="../views/register.php">注册</a>/<a href="../views/login.php?file=../common/header.php">登录</a>
                <?php  } else { ?>
                    <a href="../views/user_center.php"><?= $_SESSION['memberName'] ?></a>/<a
                        href="../back/loginOut.php">退出</a>
                <?php  } ?>
                <a href="#">QQ客服</a><a href="#">微信客服</a><a href="#">手机客户端</a>
            </div>
            <div class="RightNav">
                <a href="../views/user_center.php">用户中心</a> <a href="../views/user_orderlist.php" target="_blank"
                                                               title="我的订单">我的订单</a> <a href="../views/cart.php">购物车（<?=isset($cart_count) ? $cart_count : 0;?>）</a> <a
                    href="../views/user_favorites.php" target="_blank" title="我的收藏">我的收藏</a> <a href="#">商家入驻</a>
            </div>
        </div>
    </section>
    <div class="Logo_search">
        <div class="Logo">
            <img src="../static/images/logo.jpg" title="DeathGhost" alt="模板">
            <i></i>
            <span>成都市 [ <a href="#">高新区</a> ]</span>
        </div>
        <div class="Search">
            <form method="get" id="main_a_serach" onsubmit="return check_search(this)">
                <div class="Search_nav" id="selectsearch">
                    <a href="javascript:;" onClick="selectsearch(this,'restaurant_name')" class="choose">餐厅</a>
                    <a href="javascript:;" onClick="selectsearch(this,'food_name')">食物名</a>
                </div>
                <div class="Search_area">
                    <input type="search" id="fkeyword" name="keyword" placeholder="请输入您所需查找的餐厅名称或食物名称..."
                           class="searchbox"/>
                    <input type="submit" class="searchbutton" value="搜 索"/>
                </div>
            </form>
        </div>
    </div>
    <nav class="menu_bg">
        <ul class="menu">
            <li><a href="../index.php">首页</a></li>
            <li><a href="../views/list.php">订餐</a></li>
            <li><a href="#">积分商城</a></li>
            <li><a href="#">关于我们</a></li>
        </ul>
    </nav>
</header>



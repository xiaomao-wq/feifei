<?php
session_start();

unset($_SESSION['memberName']);
unset($_SESSION['memberId']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>网上订餐-注册</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <meta name="author" content="DeathGhost"/>
    <link href="../static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../static/js/public.js"></script>
    <script type="text/javascript" src="../static/js/jquery.js"></script>
    <script type="text/javascript" src="../static/js/jqpublic.js"></script>
    <!--
    Author: DeathGhost
    Author URI: http://www.deathghost.cn
    -->
</head>
<body>
<header>
    <section class="Topmenubg">
        <div class="Topnav">
            <div class="LeftNav">
                <a href="register.php">注册</a>/<a href="login.php?file=../common/header.php">登录</a><a href="#">QQ客服</a><a href="#">微信客服</a><a
                    href="#">手机客户端</a>
            </div>
            <div class="RightNav">
                <a href="user_center.php">用户中心</a> <a href="user_orderlist.php" target="_blank" title="我的订单">我的订单</a>
                <a href="cart.php">购物车（0）</a> <a href="user_favorites.php" target="_blank" title="我的收藏">我的收藏</a> <a
                    href="#">商家入驻</a>
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
            <p class="hotkeywords"><a href="#" title="酸辣土豆丝">酸辣土豆丝</a><a href="#" title="这里是产品名称">螃蟹炒年糕</a><a href="#"
                                                                                                              title="这里是产品名称">牛奶炖蛋</a><a
                    href="#" title="这里是产品名称">芝麻酱凉面</a><a href="#" title="这里是产品名称">滑蛋虾仁</a><a href="#" title="这里是产品名称">蒜汁茄子</a>
            </p>
        </div>
    </div>
    <nav class="menu_bg">
        <ul class="menu">
            <li><a href="../index.php">首页</a></li>
            <li><a href="list.php">订餐</a></li>
            <li><a href="#">积分商城</a></li>
            <li><a href="#">关于我们</a></li>
        </ul>
    </nav>
</header>
<!--Start content-->
<section class="Psection MT20">
    <form action="../back/register.php" method="POST">
        <table class="Register">
            <tr>
                <td width="40%" align="right" class="FontW">用户名：</td>
                <td>
                    <input type="text" name="memberName" maxlength="10" required autofocus>
                    <p>请输入6-10位的用户名(由字母、数字或下划线组成，不能以数字开头)</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">密码：</td>
                <td>
                 <input type="password" name="memberPwd1" maxlength="12" required>
                 <p>请输入6-12位的密码(不能是纯数字,不能包含空格)</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">再次确认：</td>
                <td>
                 <input type="password" name="memberPwd2" maxlength="12" required>
                 <p>请再次输入密码</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">电子邮件：</td>
                <td>
                 <input type="email" name="memberEmail" required>
                 <p>请输入邮箱</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">手机号码：</td>
                <td>
                 <input type="text" name="memberMobile" maxlength="11" required pattern="[0-9]{11}">
                 <p>请输入手机号码</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td><input type="submit" name="" class="Submit_b" value="注 册">( 已经是会员，<a href="login.php"
                                                                                         class="BlueA">请登录</a> )
                </td>
            </tr>
        </table>
    </form>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

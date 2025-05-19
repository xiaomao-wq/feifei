<?php
$file = $_GET['file'];
include $file;
?>
<body>
<header>
    <section class="Topmenubg">
        <div class="Topnav">
            <div class="LeftNav">
                <a href="register.php">注册</a>/<a href="login.php">登录</a><a href="#">QQ客服</a><a href="#">微信客服</a><a
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
    <form action="../back/login.php" method="POST">
        <table class="login">
            <tr>
                <td width="40%" align="right" class="FontW">账号：</td>
                <td><input type="text" name="memberName" required autofocus placeholder="账号/电子邮件/手机号码"></td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">密码：</td>
                <td><input type="password" name="memberPwd" required></td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td><input type="submit" name="" value="登 录" class="Submit_b">
                </td>
            </tr>
        </table>
    </form>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../define/define.php";
require_once "../func/database.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberName = $_SESSION['memberName'];
$member_id = $_SESSION['memberId'];

// 查询数据
$member = query("select avatar,nickname,last_login_time from member where id=$member_id");

//待付款的订单条数
$pay_pending = query_count("select id from pay_order where status=-8 and member_id=$member_id;");

//待发货的条数
$express_pending = query_count("select id from pay_order where express_status=-7 and member_id=$member_id;");

//待评论的条数
$comment_pending = query_count("select id from pay_order where comment_status=0 and member_id=$member_id;");

?>

<!DOCTYPE html>
<html>

<!--Start content-->
<section class="Psection MT20">
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <!--"引用“user_page/user_index.html”"-->
        <section class="usercenter">
            <span class="Weltitle Block Font16 CorRed FontW Lineheight35">Welcome欢迎光临！</span>
            <div class="U-header MT20 Overflow">
                <?php
                foreach ($member as $value) {
                    ?>
                <img src="<?=UPLOAD.$value['avatar']?>">
                <p class="Font14 FontW"><?=$value['nickname']?> 欢迎您回到 用户中心！</p>
                <p class="Font12">您的上一次登录时间:
                    <time><?=$value['last_login_time']?></time>
                </p>
                    <?php
                }
                ?>
                <!--<p class="Font12 CorRed FontW">我的优惠券( 0 ) | 我的积分( 0 )</p>-->
            </div>
            <ul class="s-States Overflow FontW" id="Lbn">
                <li class="Font14 FontW">幸福业务在线提醒：</li>
                <li><a href="<?=ORDERLIST?>">待付款( <?=$pay_pending?> )</a></li>
                <li><a href="<?=ORDERLIST?>">待发货( <?=$express_pending?> )</a></li>
                <li><a href="<?=ORDERLIST?>">待收货( <?=$express_pending?> )</a></li>
                <li><a href="<?=ORDERLIST?>">待评价( <?=$comment_pending?> )</a></li>
            </ul>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

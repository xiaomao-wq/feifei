<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
require_once "../func/paging.php";

$id = $_GET['id'];

$food = query("select f.name,f.price,f.main_image,f.summary,f.stock,f.total_count,f.comment_count,r.address 
                from food f left join restaurant r on f.res_id=r.id where f.id=$id");

//食品所属店铺
$food_res = query_once("select r.id from food f left join restaurant r on f.res_id=r.id where f.id=$id");
//获取店铺id
$res_id = $food_res['id'];

//热销商品
$food_hot = query("select id,name,price,main_image,total_count from food order by total_count desc limit 2");

//成交记录
$sql = "select m.nickname,i.food_ids,i.quantities,i.prices,o.updated_time from pay_order_item i left join pay_order o on i.pay_order_id=o.id left join member m on i.member_id=m.id where i.food_ids like '%" . $id . "%' and o.status=1 and o.express_status=1 order by o.id desc";
$order_complete = query($sql);
$count = query_count($sql);

//将字符串转换为数组
for ($i = 0; $i < $count; $i++) {
    $food_ids[$i] = explode(',', $order_complete[$i]['food_ids']);
    $quantities[$i] = explode(',', $order_complete[$i]['quantities']);
    $prices[$i] = explode(',', $order_complete[$i]['prices']);
}
//获取商品的价格和数量
$k = 0;
for ($i = 0; $i < count($food_ids); $i++) {
    for ($j = 0; $j < count($food_ids[$i]); $j++) {
        if ($food_ids[$i][$j] == $id) {
            $result[$k]['food_price'] = $prices[$i][$j];
            $result[$k]['quantities'] = $quantities[$i][$j];
            $k++;
        }
    }
}

//获取评论
$sql = "select m.nickname,mc.food_id,mc.content,mc.created_time from member_comments mc left join member m on mc.member_id=m.id where food_id=$id order by mc.id desc;";
$comments = query($sql);
$comment_count = query_count($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <?php foreach ($food as $value) { ?>
        <title><?= $value['name'] ?></title>
    <?php } ?>
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
    <script>
        $(function () {
            $('.title-list li').click(function () {
                var liindex = $('.title-list li').index(this);
                $(this).addClass('on').siblings().removeClass('on');
                $('.menutab-wrap div.menutab').eq(liindex).fadeIn(150).siblings('div.menutab').hide();
                var liWidth = $('.title-list li').width();
                $('.shopcontent .title-list p').stop(false, true).animate({'left': liindex * liWidth + 'px'}, 300);
            });

            $('.menutab-wrap .menutab li').hover(function () {
                $(this).css("border-color", "#ff6600");
                $(this).find('p > a').css('color', '#ff6600');
            }, function () {
                $(this).css("border-color", "#fafafa");
                $(this).find('p > a').css('color', '#666666');
            });
        });
    </script>
</head>
<body>
<!--Start content-->
<section class="slp">
    <section class="food-hd">
        <?php foreach ($food as $value) { ?>
            <div class="foodpic">
                <img src="<?= UPLOAD . $value['main_image'] ?>" id="showimg">
                <ul class="smallpic">
                    <li><img src="<?= UPLOAD . $value['main_image'] ?>" onmouseover="show(this)" onmouseout="hide()">
                    </li>
                </ul>
            </div>
            <div class="foodtext">
                <div class="foodname_a">
                    <h1><?= $value['name'] ?></h1>
                    <p><?= $value['address'] ?></p>
                </div>
                <div class="price_a">
                    <p class="price01">价格：￥<span><?= $value['price'] ?></span></p>
                </div>
                <ul class="Tran_infor">
                    <li>
                        <p class="Numerical"><?= $value['total_count'] ?></p>
                        <p>总销量</p>
                    </li>
                    <li class="line">
                        <p class="Numerical"><?= $value['comment_count'] ?></p>
                        <p>累计评价</p>
                    </li>
                </ul>
                <form action="../back/cart.php?food_id=<?= $id ?>" method="POST">
                    <div class="BuyNo">
                        <span>我要买：<input type="number" name="number" required autofocus min="1"
                                         max="<?= $value['stock'] ?>" value="1"/>份</span>
                        <span>库存：<?= $value['stock'] ?></span>
                        <div class="Buybutton">
                            <input type="submit" value="加入购物车" class="BuyB">
                            <a href="shop.php?id=<?= $res_id ?>"><span class="Backhome">进入店铺首页</span></a>
                        </div>
                    </div>
            </div>
        <?php } ?>
        <div class="viewhistory">
            <span class="VHtitle">热销商品推荐</span>
            <ul class="Fsulist">
                <?php foreach ($food_hot as $value) { ?>
                    <li>
                        <a href="detailsp.php?id=<?= $value['id'] ?>" title="<?= $value['name'] ?>" target="_blank"><img
                                    src="<?= UPLOAD . $value['main_image'] ?>"></a>
                        <p><?= $value['name'] ?></p>
                        <p>￥<?= $value['price'] ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <!--bottom content-->
    <section class="Bcontent">
        <article>
            <div class="shopcontent">
                <div class="title2 cf">
                    <ul class="title-list fr cf ">
                        <li class="on">详细说明</li>
                        <li>评价详情（<?= $comment_count ?>）</li>
                        <li>成交记录（<?= $count ?>）</li>
                        <p><b></b></p>
                    </ul>
                </div>
                <div class="menutab-wrap">
                    <!--case1-->
                    <?php foreach ($food as $value) { ?>
                        <div class="menutab show">
                            <div class="cont_padding">
                                <?= $value['summary'] ?>
                            </div>
                        </div>
                    <?php } ?>
                    <!--case2-->
                    <div class="menutab">
                        <div class="cont_padding">
                            <table class="Dcomment">
                                <th width="80%">评价内容</th>
                                <th width="20%" style="text-align:right">评价人</th>
                                <?php foreach ($comments as $value) { ?>
                                    <tr>
                                        <td>
                                            <?= $value['content'] ?>
                                            <time><?= $value['created_time'] ?></time>
                                        </td>
                                        <td align="right"><?= $value['nickname'] ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!--case4-->
                    <div class="menutab">
                        <div class="cont_padding">

                            <table width="888">
                                <th width="35%">买家</th>
                                <th width="20%">价格</th>
                                <th width="15%">数量</th>
                                <th width="30%">成交时间</th>
                                <?php for ($i = 0; $i < $count; $i++) { ?>
                                    <tr height="40">
                                        <td><?= $order_complete[$i]['nickname'] ?></td>
                                        <td>￥<?= $result[$i]['food_price'] ?></td>
                                        <td><?= $result[$i]['quantities'] ?></td>
                                        <td><?= $order_complete[$i]['updated_time'] ?></td>
                                    </tr>
                                <?php } ?>
                            </table>

                        </div>
                    </div>
        </article>
        <!--ad&other infor-->
        <aside>
            <!--广告位或推荐位-->
            <!--<a href="#" title="广告位占位图片" target="_blank"><img src="../upload/2014912.jpg"></a>-->
        </aside>
    </section>
</section>
<?php require_once "../define/bottom.php" ?>
</body>
</html>

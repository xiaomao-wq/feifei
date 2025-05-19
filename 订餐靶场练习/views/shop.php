<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
require_once "../func/paging.php";

$id = $_GET['id'];
if (!$id){
    msg("非法操作",INDEX);
}
//获取餐厅信息
$res = query("select * from restaurant where id=$id;");

//获取该餐厅下的食品前两条（特色菜）
$res_spec_food = query("select f.id,f.name from restaurant r left join food f on r.id=f.res_id where r.id=$id limit 0,2;");

//菜谱分页
$sql = "select f.id,f.main_image,f.name,f.price from restaurant r left join food f on r.id=f.res_id where r.id=$id ";
$result = turnPage($_GET['page'],4,$sql);

//收藏数
$coll_count = query_once("select coll_count from restaurant where id=$id");

//获取评论
$sql = "select f.name,f.id,mc.content,mc.created_time,m.nickname from member_comments mc left join member m on mc.member_id=m.id left join food f on mc.food_id=f.id left join restaurant r on f.res_id=r.id where r.id=$id order by mc.id desc";
$comments = query($sql);
$comm_count = query_count($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <?php  foreach ($res as $value) { ?>
        <title><?= $value['name'] ?></title>
    <?php  } ?>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <meta name="author" content="DeathGhost"/>
    <link href="../static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../static/js/public.js"></script>
    <script type="text/javascript" src="../static/js/jquery.js"></script>
    <script type="text/javascript" src="../static/js/jqpublic.js"></script>
    <script type="text/javascript" src="../static/js/cart.js"></script>
    <script type="text/javascript" src="../static/js/jquery.easyui.min.js"></script>
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
        var mt = 0;
        window.onload = function () {
            var Topcart = document.getElementById("Topcart");
            var mt = Topcart.offsetTop;
            window.onscroll = function () {
                var t = document.documentElement.scrollTop || document.body.scrollTop;
                if (t > mt) {
                    Topcart.style.position = "fixed";
                    Topcart.style.margin = "";
                    Topcart.style.top = "200px";
                    Topcart.style.right = "191px";
                    Topcart.style.boxShadow = "0px 0px 20px 5px #cccccc";
                    Topcart.style.top = "0";
                    Topcart.style.border = "1px #636363 solid";
                } else {
                    Topcart.style.position = "static";
                    Topcart.style.boxShadow = "none";
                    Topcart.style.border = "";
                }
            }
        }
    </script>
    <!--
    Author: DeathGhost
    Author URI: http://www.deathghost.cn
    -->
</head>
<body>
<!--Start content-->
<section class="Shop-index">
    <article>
        <div class="shopinfor">
            <div class="title">
                <?php  foreach ($res as $value){ ?>
                <img src="<?= UPLOAD . $value['main_image'] ?>" class="shop-ico">
                <span><?= $value['name'] ?></span>
                <span>
     <img src="../static/images/star-on.png">
     <img src="../static/images/star-on.png">
     <img src="../static/images/star-on.png">
     <img src="../static/images/star-on.png">
     <img src="../static/images/star-off.png">
    </span>
                <span>4.8</span>
            </div>
            <div class="imginfor">
                <div class="shopimg">
                    <img src="<?= UPLOAD . $value['res_image'] ?>" id="showimg">
                    <ul class="smallpic">
                        <li><img src="<?= UPLOAD . $value['res_image'] ?>" >
                        </li>
                    </ul>
                </div>
                <div class="shoptext">
                    <p><span>地址：</span><?= $value['address'] ?></p>
                    <p><span>电话：</span><?= $value['mobile'] ?></p>

                        <p><span>特色菜品：</span>
                            <?php  foreach ($res_spec_food as $item) {
                            echo $item['name']."  ";
                             } ?>
                        </p>

                    <p><span>优惠活动：</span>暂无信息</p>
                    <p><span>停车位：</span>4个停车位（免费）</p>
                    <p><span>营业时间：</span><?= $value['opening'] ?></p>
                    <p><span>WIFI：</span>免费WIFI</p>
                    <?php  } ?>
                    <div class="Button">
                        <a href="#ydwm"><span class="DCbutton">查看菜谱点菜</span></a>
                    </div>
                    <div class="otherinfor">
                        <a href="../back/user_favorites.php?id=<?=$id?>" class="icoa"><img src="../static/images/collect.png">收藏店铺（<?=$coll_count['coll_count']?>）</a>
                        <div class="bshare-custom"><a title="分享"
                                                      class="bshare-more bshare-more-icon more-style-addthis">分享</a>
                        </div>
                        <script type="text/javascript" charset="utf-8"
                                src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=1&amp;lang=zh"></script>
                        <script type="text/javascript" charset="utf-8"
                                src="http://static.bshare.cn/b/bshareC0.js"></script>
                    </div>
                </div>
            </div>
            <div class="shopcontent">
                <div class="title2 cf">
                    <ul class="title-list fr cf ">
                        <li class="on">菜谱</li>
                        <li>累计评论（<?=$comm_count?>）</li>
                        <li>商家详情</li>
                        <!--<li>店铺留言</li>-->
                        <p><b></b></p>
                    </ul>
                </div>
                <div class="menutab-wrap">
                    <a name="ydwm">
                        <!--case1-->
                        <div class="menutab show">
                            <ul class="products">
                                <?php foreach ($result['result'] as $value){?>
                                <li>
                                    <a href="detailsp.php?id=<?=$value['id']?>" target="_blank" title="">
                                        <img src="<?=UPLOAD.$value['main_image']?>" class="foodsimgsize">
                                    </a>
                                    <a href="#" class="item">
                                        <div>
                                            <p><?=$value['name']?></p>
                                            <p class="AButton">拖至购物车:￥<?=$value['price']?></p>
                                        </div>
                                    </a>
                                </li>
                                <?php }?>
                                <div class="TurnPage">
                                    <a href="shop.php?id=<?=$id?>&page=<?=$result['prePage']?>">
                                        <span class="Prev"><i></i>上一页</span>
                                    </a>
                                    <?php for ($i=1;$i<=$result['pageMax'];$i++){?>
                                    <a href="shop.php?id=<?=$id?>&page=<?=$i?>"><span class="PNumber"><?=$i?></span></a>
                                    <?php }?>
                                    <a href="shop.php?id=<?=$id?>&page=<?=$result['nextPage']?>">
                                        <span class="Next">下一页<i></i></span>
                                    </a>
                                </div>
                            </ul>
                        </div>
                    </a>
                    <!--case2-->
                    <div class="menutab">
                        <?php foreach ($comments as $value){?>
                        <div class="shopcomment">
                            <div class="Spname">
                                <a href="detailsp.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>"><?=$value['name']?></a>
                            </div>
                            <div class="C-content">
                                <q><?=$value['content']?></q>
                                <i><?=$value['created_time']?></i>
                            </div>
                            <div class="username">
                                <?=$value['nickname']?>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <!--case4-->
                    <div class="menutab">
                        <div class="shopdetails">
                            <div class="shopmaparea">
                                <img src="../upload/testimg.jpg"><!--此处占位图调用动态地图后将其删除即可-->
                            </div>
                            <?php foreach ($res as $value){?>
                            <div class="shopdetailsT">
                                <p><span>店铺：<?=$value['name']?></span></p>
                                <p><span>地址：</span><?=$value['address']?></p>
                                <p><span>电话：</span><?=$value['mobile']?></p>
                                <!--<p><span>乘车路线：</span>300路、115路、14路、800路到西辛庄站下车往东100米</p>-->
                                <p><span>店铺介绍：<?=$value['summary']?></span>
                                </p>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <!--case5-->
                    <!--<div class="menutab">
                        <span class="Ask"><i>DeathGhost</i>:这里是测试问答？</span>
                        <span class="Answer"><i>管理员回复</i>：这里是测试回答！</span>

                        <div class="TurnPage">
                            <a href="#">
                                <span class="Prev"><i></i>首页</span>
                            </a>
                            <a href="#"><span class="PNumber">1</span></a>
                            <a href="#"><span class="PNumber">2</span></a>
                            <a href="#">
                                <span class="Next">最后一页<i></i></span>
                            </a>
                        </div>

                        <form class="A-Message" action="#">
                            <p><i>姓名：</i><input name="usr_name" type="text" autofocus placeholder="张三" required></p>
                            <p><i>手机：</i><input name="" type="text" placeholder="15825518***" pattern="[0-9]{11}"
                                                required></p>
                            <p><i>邮件：</i><input type="email" name="email" autocomplete="off"
                                                placeholder="admin@admin.com" required/></p>
                            <p><i>问题补充：</i><textarea name="" cols="" rows="" required
                                                     placeholder="详细说明您的问题..."></textarea></p>
                            <p><input type="submit" class="Abutt"/></p>
                        </form>
                    </div>-->
                </div>
            </div>
    </article>
    <aside>
        <div class="cart" id="Topcart">
            <span class="Ctitle Block FontW Font14"><a href="cart.php" target="_blank">我的购物车</a></span>
            <table id="cartcontent" fitColumns="true">
                <thead>
                <tr>
                    <th width="33%" align="center" field="name">商品</th>
                    <th width="33%" align="center" field="quantity">数量</th>
                    <th width="33%" align="center" field="price">价格</th>
                </tr>
                </thead>
            </table>
            <p class="Ptc"><span class="Cbutton"><a href="cart.php" target="进入购物车">进入购物车</a></span><span
                        class="total">共计金额: ￥0</span></p>
        </div>

    </aside>

</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

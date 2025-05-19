<?php
header("Content-type:text/html;charset:utf-8");
require_once "./func/database.php";
require_once "./define/define.php";


session_start();
// 查询数据
$foods = query("select * from food limit 0,6");
$restaurants = query("select * from restaurant limit 0,5");

if ($_SESSION['memberId']){
    $cart_count = query("select count(1) number from member_cart where status=1 and member_id=".$_SESSION['memberId'].";");
    $cart_count = $cart_count[0]['number'];
}

//查询订单
$orders = query("select o.order_sn,o.express_status,o.comment_status,a.nickname from pay_order o left join member_address a on o.express_address_id=a.id where o.status=1 order by o.order_sn desc;");

//获取评论
$sql = "select f.name food_name,f.id,f.main_image,mc.content,mc.created_time,m.nickname,r.name res_name from member_comments mc left join member m on mc.member_id=m.id left join food f on mc.food_id=f.id left join restaurant r on f.res_id=r.id order by mc.id desc limit 2";
$comments = query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>网上订餐</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <meta name="author" content="DeathGhost"/>
    <link href="static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="static/js/public.js"></script>
    <script type="text/javascript" src="static/js/jquery.js"></script>
    <script type="text/javascript" src="static/js/jqpublic.js"></script>
</head>

<body>
<header>
    <section class="Topmenubg">
        <div class="Topnav">
            <div class="LeftNav">
                <?php  if (!$_SESSION['memberName']) { ?>
                    <a href="views/register.php">注册</a>/<a href="views/login.php?file=../common/header.php">登录</a>
                <?php  } else { ?>
                    <a href="views/user_center.php"><?= $_SESSION['memberName'] ?></a>/<a
                            href="back/loginOut.php">退出</a>
                <?php  } ?>
                <a href="#">QQ客服</a><a href="#">微信客服</a><a href="#">手机客户端</a>
            </div>
            <div class="RightNav">
                <a href="views/user_center.php">用户中心</a> <a href="views/user_orderlist.php" target="_blank"
                                                            title="我的订单">我的订单</a> <a href="views/cart.php">购物车（<?=isset($cart_count) ? $cart_count : 0;?>）</a> <a
                    href="views/user_favorites.php" target="_blank" title="我的收藏">我的收藏</a> <a href="#">商家入驻</a>
            </div>
        </div>
    </section>
    <div class="Logo_search">
        <div class="Logo">
            <img src="static/images/logo.jpg" title="DeathGhost" alt="模板">
            <i></i>
            <span>成都市 [ <a href="#">高新区</a> ]</span>
        </div>
        <div class="Search">
            <form method="post" id="main_a_serach" onsubmit="return check_search(this)"">
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
            <script>
                function selectsearch(theA,word){
                    obj=document.getElementById("selectsearch").getElementsByTagName("a");
                    for(var i=0;i< obj.length;i++ ){
                        obj[i].className='';
                    }
                    theA.className='choose';
                    if(word=='restaurant_name'){
                        document.getElementById('main_a_serach').action="./views/search_s.php";//Test url
                    }else if(word=='food_name'){
                        document.getElementById('main_a_serach').action="./views/search_p.php";//Test url
                    }
                }
            </script>
        </div>
    </div>
    <nav class="menu_bg">
        <ul class="menu">
            <li><a href="index.php">首页</a></li>
            <li><a href="views/list.php">订餐</a></li>
            <li><a href="#">积分商城</a></li>
            <li><a href="#">关于我们</a></li>
        </ul>
    </nav>
</header>
<!--Start content-->
<section class="Cfn">
    <aside class="C-left">
        <div class="S-time">服务时间：周一~周六
            <time>09:00</time>
            -
            <time>23:00</time>
        </div>
        <div class="C-time">
            <img src="upload/dc.jpg"/>
        </div>
        <a href="views/list.php" target="_blank"><img src="static/images/by_button.png"></a>
        <a href="views/list.php" target="_blank"><img src="static/images/dc_button.png"></a>
    </aside>
    <div class="F-middle">
        <ul class="rslides f426x240">
            <?php foreach ($foods as $value){?>
            <li><a href="javascript:"><img width="600px" src="upload/<?=$value['main_image']?>"/></a></li>
            <?php }?>
        </ul>
    </div>
    <aside class="N-right">
        <div class="N-title">公司新闻 <i>COMPANY NEWS</i></div>

        <ul class="Orderlist" id="UpRoll">
            <?php foreach ($orders as $value){?>
            <li>
                <p>订单编号：<?=$value['order_sn']?></p>
                <p>收件人：<?=$value['nickname']?>先生\女士</p>
                <p>订单状态：<i class="State03">
                        <?php
                        switch ($value['express_status']) {
                            case -7:
                                echo '待发货 ';
                                break;
                            case 1:
                                echo '已签收 ';
                                break;
                            case 0:
                                echo '已取消 ';
                                break;
                        }
                        ?>
                    </i>
                    <i class="State03">
                        <?php
                        switch ($value['comment_status']) {
                            case 0:
                                echo '未评论 ';
                                break;
                            case 1:
                                echo '已评论';
                                break;
                        }
                        ?>
                    </i>
                </p>
            </li>
            <?php }?>
        </ul>
        <script>
            var UpRoll = document.getElementById('UpRoll');
            var lis = UpRoll.getElementsByTagName('li');
            var ml = 0;
            var timer1 = setInterval(function () {
                var liHeight = lis[0].offsetHeight;
                var timer2 = setInterval(function () {
                    UpRoll.scrollTop = (++ml);
                    if (ml == 1) {
                        clearInterval(timer2);
                        UpRoll.scrollTop = 0;
                        ml = 0;
                        lis[0].parentNode.appendChild(lis[0]);
                    }
                }, 10);
            }, 5000);
        </script>
    </aside>
</section>
<section class="Sfainfor">
    <article class="Sflist">
        <div id="Indexouter">
            <ul id="Indextab">
                <li class="current">点菜</li>
                <li>餐馆</li>
                <!--<p class="class_B">
                    <a href="#">中餐</a>
                    <a href="#">西餐</a>
                    <a href="#">甜点</a>
                    <a href="#">日韩料理</a>
                    <span><a href="#" target="_blank">more ></a></span>
                </p>-->
            </ul>
            <div id="Indexcontent">
                <ul style="display:block;">
                    <li>
                        <p class="seekarea">
                            <a href="#">青羊区</a>
                            <a href="#">锦江区</a>
                            <a href="#">金牛区</a>
                            <a href="#">武侯区</a>
                            <a href="#">成华区</a>
                            <a href="#">新都区</a>
                            <a href="#">温江区</a>
                            <a href="#">都江堰区</a>
                            <a href="#">龙泉驿区</a>
                            <a href="#">青白江区</a>
                            <a href="#">郫县</a>
                        </p>
                        <div class="SCcontent">
                            <?php foreach ($foods as $value){?>
                            <a href="views/detailsp.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>">
                                <figure>
                                    <img src="upload/<?=$value['main_image']?>">
                                    <figcaption>
                                        <span class="title"><?=$value['name']?></span>
                                        <span class="price"><i>￥</i><?=$value['price']?></span>
                                    </figcaption>
                                </figure>
                            </a>
                            <?php }?>
                        </div>
                        <div class="bestshop">
                            <?php foreach ($restaurants as $value){?>
                            <a href="views/shop.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>">
                                <figure>
                                    <img src="upload/<?=$value['main_image']?>">
                                </figure>
                            </a>
                            <?php }?>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <p class="seekarea">
                            <a href="#">青羊区</a>
                            <a href="#">锦江区</a>
                            <a href="#">金牛区</a>
                            <a href="#">武侯区</a>
                            <a href="#">成华区</a>
                            <a href="#">新都区</a>
                            <a href="#">温江区</a>
                            <a href="#">都江堰区</a>
                            <a href="#">龙泉驿区</a>
                            <a href="#">青白江区</a>
                            <a href="#">郫县</a>
                        </p>
                        <div class="DCcontent">
                            <?php foreach ($restaurants as $value){?>
                            <a href="views/shop.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>">
                                <figure>
                                    <img src="upload/<?=$value['main_image']?>">
                                    <figcaption>
                                        <span class="title"><?=$value['name']?></span>
                                    </figcaption>
                                    <p class="p1"><q><?=$value['summary']?></q></p>
                                    <p class="p2">
                                        店铺评分：
                                        <img src="static/images/star-on.png">
                                        <img src="static/images/star-on.png">
                                        <img src="static/images/star-on.png">
                                        <img src="static/images/star-on.png">
                                        <img src="static/images/star-off.png">
                                    </p>
                                    <p class="p3">店铺地址：<?=$value['address']?></p>
                                </figure>
                            </a>
                            <?php }?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </article>
    <aside class="A-infor">
        <img src="upload/2014911.jpg">
        <div class="usercomment">
            <span>用户菜品点评</span>
            <ul>
                <?php foreach ($comments as $value){?>
                <li>
                    <img src="<?='upload/'.$value['main_image']?>">
                    用户“<?=$value['nickname']?>”对[ <?=$value['res_name']?> ]“<?=$value['food_name']?>”评说：<?=$value['content']?>
                </li>
                <?php }?>
            </ul>
        </div>
    </aside>
</section>
<!--End content-->
<div class="F-link">
    <span>友情链接：</span>
    <a href="http://www.deathghost.cn" target="_blank" title="DeathGhost">DeathGhost</a>
    <a href="http://www.17sucai.com/pins/15966.html" target="_blank" title="免费后台管理模板">绿色清爽版通用型后台管理模板免费下载</a>
    <a href="http://www.17sucai.com/pins/17567.html" target="_blank" title="果蔬菜类模板源码">HTML5果蔬菜类模板源码</a>
    <a href="http://www.17sucai.com/pins/14931.html" target="_blank" title="黑色的cms商城网站后台管理模板">黑色的cms商城网站后台管理模板</a>
</div>
<footer>
    <section class="Otherlink">
        <aside>
            <div class="ewm-left">
                <p>手机扫描二维码：</p>
                <img src="static/images/Android_ico_d.gif">
                <img src="static/images/iphone_ico_d.gif">
            </div>
            <div class="tips">
                <p>客服热线</p>
                <p><i>1830927**73</i></p>
                <p>配送时间</p>
                <p>
                    <time>09：00</time>
                    ~
                    <time>22:00</time>
                </p>
                <p>网站公告</p>
            </div>
        </aside>
        <section>
            <div>
                <span><i class="i1"></i>配送支付</span>

            </div>
            <div>
                <span><i class="i2"></i>关于我们</span>

            </div>
            <div>
                <span><i class="i3"></i>帮助中心</span>

            </div>
        </section>
    </section>
    <div class="copyright">© 版权所有 2016 DeathGhost 技术支持：<a href="http://www.deathghost.cn"
                                                          title="DeathGhost">DeathGhost</a></div>
</footer>
</body>
</html>

<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../define/define.php";
require_once "../func/database.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$member_id = $_SESSION['memberId'];

$coll = query("select c.res_id,r.res_image,r.name from collection c left join restaurant r on c.res_id=r.id where c.member_id=$member_id and c.status=1");

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DeathGhost-用户中心</title>
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
<!--Start header-->
<!--Start content-->
<section class="Psection MT20">
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <!--user Favorites-->
        <section class="ShopFav Overflow">
            <span class="ShopFavtitle Block Font14 FontW Lineheight35">我的收藏</span>
            <?php foreach ($coll as $value){?>
            <ul>
                <a href="shop.php?id=<?=$value['res_id']?>" target="_blank">
                    <li>
                        <img src="<?=UPLOAD.$value['res_image']?>">
                        <p><?=$value['name']?> <a href="../back/user_favorites_del.php?id=<?=$value['res_id']?>">( 删除 )</a></p>
                    </li>
                </a>
            </ul>
            <?php }?>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/paging.php";
require_once "../func/member-check.php";

$keyword = $_GET['keyword'];
if (!isset($keyword)){
    msg("请输入关键字",INDEX);
}

$sql = "select id,name,res_image,address from restaurant where name like '%".$keyword."%'";
//分页
$result = turnPage($_GET['page'],4,$sql);

//热门推荐
$res_hot = query("select id,name,res_image,address from restaurant order by weight desc limit 0,2;");



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>店铺搜索页面-网上订餐</title>
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
<!--Start content-->
<section class="Psection MT20">
    <article class="Searchlist Overflow">
        <ul class="Overflow">
            <?php foreach ($result['result'] as $value){?>
            <li>
                <a href="shop.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>"><img src="<?=UPLOAD.$value['res_image']?>"></a>
                <p class="P-shop Overflow"><span class="sa"><a href="shop.php?id=<?=$value['id']?>" target="_blank" title="<?=$value['name']?>"><?=$value['name']?></a></span></p>
                <p class="P-shop Overflow"><?=$value['address']?></p>
            </li>
            <?php }?>
        </ul>
        <div class="TurnPage">
            <a href="search_s.php?keyword=<?=$keyword?>&page=<?=$result['prePage']?>">
                <span class="Prev"><i></i>上一页</span>
            </a>
            <?php for ($i=1;$i<=$result['pageMax'];$i++){?>
                <a href="search_s.php?keyword=<?=$keyword?>&page=<?=$i?>"><span class="PNumber"><?=$i?></span></a>
            <?php }?>
            <a href="search_s.php?keyword=<?=$keyword?>&page=<?=$result['nextPage']?>">
                <span class="Next">下一页<i></i></span>
            </a>
        </div>
    </article>
    <aside class="Sraside">
        <div class="bestshop">
            <span class="Bpt Block FontW Font14">推荐店铺</span>
            <ul>
                <?php foreach ($res_hot as $value){?>
                <li>
                    <a href="shop.php?id=<?=$value['id']?>" title="<?=$value['name']?>" target="_blank"><img src="<?=UPLOAD.$value['res_image']?>"></a>
                    <p>
                        <span class="Block FontW Font14"><a href="shop.php?id=<?=$value['id']?>" title="<?=$value['name']?>" target="_blank"
                                                            class="CorRed"><?=$value['name']?></a></span>
                        <span class="Block Overflow"><?=$value['address']?></span>
                    </p>
                </li>
                <?php }?>
            </ul>
        </div>
        <!--广告位或其他推荐版块-->
        <!--<img src="../upload/ggw.jpg">-->
    </aside>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

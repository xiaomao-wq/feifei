<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/paging.php";

$keyword = $_GET['keyword'];
if (!isset($keyword)){
    msg("请输入关键字",INDEX);
}

$sql = "select f.id food_id,f.name food_name,f.main_image,f.price,r.id res_id,r.name res_name,r.address from food f left join restaurant r on f.res_id=r.id where f.name like '%".$keyword."%'";

//分页
$result = turnPage($_GET['page'],4,$sql);

//热销商品
$food_hot =query("select id,name,price,main_image,total_count from food order by total_count desc limit 2");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>搜索商品页面-网上订餐</title>
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
        <section class="Fslmenu slt" style="margin-bottom:5px">
            <a href="#" title="默认排序">
   <span>
   <span>默认排序</span>
   </span>
            </a>
            <a href="#" title="评价">
   <span>
   <span>评价</span>
   <span class="s-up"></span>
   </span>
            </a>
            <a href="#" title="销量">
   <span>
   <span>销量</span>
   <span class="s-up"></span>
   </span>
            </a>
            <a href="#" title="价格排序">
   <span>
   <span>价格</span>
   <span class="s-down"></span>
   </span>
            </a>
            <a href="#" title="发布时间排序">
   <span>
   <span>发布时间</span>
   <span class="s-up"></span>
   </span>
            </a>
        </section>
        <ul class="Overflow">
            <?php foreach ($result['result'] as $value){?>
            <li>
                <a href="detailsp.php?id=<?=$value['food_id']?>" target="_blank" target="_blank" title="<?=$value['food_name']?>"><img src="<?=UPLOAD.$value['main_image']?>"></a>
                <p class="P-price FontW Font16"><span>￥<?=$value['price']?></span></p>
                <p class="P-title"><a href="detailsp.php?id=<?=$value['food_id']?>" target="_blank" target="_blank" title="<?=$value['food_name']?>"><?=$value['food_name']?></a></p>
                <p class="P-shop Overflow"><span class="sa"><a href="shop.php?id=<?=$value['res_id']?>" target="_blank" target="_blank"
                                                               title="<?=$value['res_name']?>"><?=$value['res_name']?></a></span><span
                            class="sp"><?=$value['address']?></span></p>
            </li>
            <?php }?>
        </ul>
        <div class="TurnPage">
            <a href="search_p.php?keyword=<?=$keyword?>&page=<?=$result['prePage']?>">
                <span class="Prev"><i></i>上一页</span>
            </a>
            <?php for ($i=1;$i<=$result['pageMax'];$i++){?>
                <a href="search_p.php?keyword=<?=$keyword?>&page=<?=$i?>"><span class="PNumber"><?=$i?></span></a>
            <?php }?>
            <a href="search_p.php?keyword=<?=$keyword?>&page=<?=$result['nextPage']?>">
                <span class="Next">下一页<i></i></span>
            </a>
        </div>
    </article>
    <aside class="Sraside">
        <div class="bestproduct">
            <span class="Bpt Block FontW Font14">热销商品推荐</span>
            <ul>
                <?php foreach ($food_hot as $value){?>
                <li>
                    <a href="detailsp.php?id=<?=$value['id']?>" title="<?=$value['name']?>" target="_blank"><img src="<?=UPLOAD.$value['main_image']?>"></a>
                    <p>
                        <span class="Block FontW Font16 CorRed">￥<?=$value['price']?></span>
                        <span class="Block Overflow"><a href="detailsp.php?id=<?=$value['id']?>" title="<?=$value['name']?>"
                                                        target="_blank"><?=$value['name']?></a></span>
                        <span class="Block Overflow">累计销量：<i><?=$value['total_count']?></i>笔</span>
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

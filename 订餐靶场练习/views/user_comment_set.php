<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/member-check.php";
require_once "../func/database.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$order_id = $_GET['id'];
if (!$order_id){
    msg("非法操作",INDEX);
}

$goods = query_once("select i.food_ids,i.quantities,o.order_sn,o.updated_time,o.created_time from pay_order_item i left join pay_order o on i.pay_order_id=o.id  where i.pay_order_id=$order_id and i.member_id=$memberId");

//将字符串转换为数组
$food_ids = explode(',', $goods['food_ids']);
$quantities = explode(',', $goods['quantities']);
$prices = explode(',', $goods['prices']);



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
<!--Start content-->
<section class="Psection MT20">
    <?php require_once "../define/user_center.php";?>
    <article class="U-article Overflow">
        <section>
            <table class="Myorder">
                <th class="Font14 FontW">订单编号</th>
                <th class="Font14 FontW">菜品</th>
                <th class="Font14 FontW">数量</th>
                <th class="Font14 FontW">下单时间</th>
                <th class="Font14 FontW">完成时间</th>
                <?php  for ($i=0;$i<count($food_ids);$i++) {
                    $food_name = query_once("select name from food where id=$food_ids[$i]");
                    ?>
                    <tr>
                        <?php  if ($i == 0) { ?>
                            <td rowspan="<?= count($food_ids) ?>"><?= $goods['order_sn'] ?></td>
                        <?php  } ?>
                        <td class="FontW"><a href="detailsp.php?id=<?= $food_ids[$i] ?>"><?= $food_name['name'] ?></a>
                        </td>
                        <td><?= $quantities[$i] ?></td>
                        <?php  if ($i == 0) { ?>
                        <td rowspan="<?= count($food_ids) ?>"><?= $goods['created_time'] ?></td>
                        <td rowspan="<?= count($food_ids) ?>"><?= $goods['updated_time'] ?></td>
                        <?php  } ?>
                    </tr>
                <?php  } ?>
            </table>
            <span class="Font14 FontW Lineheight35 Block">发表评论：</span>
            <form action="../back/user_comment_set.php" method="post">
                <input type="hidden" naem="">
                <table class="U-order-A">
                    <tr>
                        <td width="30%" align="right" class="FontW">评论内容：</td>
                        <td><input type="text" name="content" class="input_mark" value=""></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"></td>
                        <td>
                            <input type="hidden" name="order_id" value="<?=$order_id?>">
                            <input type="hidden" name="food_ids" value="<?=$goods['food_ids']?>">
                            <input type="submit" value="提交评价" class="Submit">
                        </td>
                    </tr>
                </table>


            </form>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

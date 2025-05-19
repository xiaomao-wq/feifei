<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$order_id = $_GET['id'];

$orders = query_once("select o.pay_price,o.status,i.quantities,i.prices,i.food_ids 
                from pay_order_item i left join pay_order o on i.pay_order_id=o.id where i.pay_order_id=$order_id and o.status=-8 and o.express_status=-8;");

if (!$orders){
    msg("不允许支付",ORDERLIST);
}

//将字符串转换为数组
$food_ids = explode(',', $orders['food_ids']);
$quantities = explode(',', $orders['quantities']);
$prices = explode(',', $orders['prices']);

?>


<!DOCTYPE html>
<html>
<body>
<!--Start content-->
<section class="Psection MT20">
    <div class="Reserve Overflow">
        <form action="../back/pay.php" method="post">
            <table>
                <th>菜品</th>
                <th>数量</th>
                <th>单价</th>
                <th>小计</th>
                <?php  for ($i = 0; $i < count($food_ids); $i++) {
                    $food = query("select name,price from food where id=$food_ids[$i];");
                    ?>
                <tr>
                    <td><a href="detailsp.php?id=<?= $food_ids[$i] ?>" title="<?= $food[0]['name']; ?>" target="_blank"><?= $food[0]['name']; ?></a></td>
                    <td><b><?= $quantities[$i] ?></b></td>
                    <td>￥<?= $food[0]['price'] ?></td>
                    <td><b>￥<?=number_format($quantities[$i]*$food[0]['price'],'2')?></b></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="4" class="FontW CorRed Font14">共计费用：￥<?=$orders['pay_price']?></td>
                </tr>
                <tr>
                    <input type="hidden" name="order_id" value="<?=$order_id?>">
                    <td colspan="4"><input type="submit" value="支付" class="Submit"></td>
                </tr>
            </table>
        </form>
    </div>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

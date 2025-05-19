<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$order_id = $_GET['id'];


$orders = query("select o.order_sn,o.express_address_id,o.pay_select,o.pay_price,o.note,o.status,i.quantities,i.prices,i.food_ids 
                from pay_order_item i left join pay_order o on i.pay_order_id=o.id where i.pay_order_id=$order_id");

$address = query("select ma.nickname,ma.mobile,ma.province,ma.city,ma.county,ma.address from pay_order o 
                left join member_address ma on o.express_address_id=ma.id where o.id=$order_id;");


//将字符串转换为数组
$food_ids = explode(',', $orders[0]['food_ids']);
$quantities = explode(',', $orders[0]['quantities']);
$prices = explode(',', $orders[0]['prices']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DeathGhost-订单详情</title>
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
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <span class="Font14 FontW Lineheight35 Block">订单信息：</span>
        <table class="U-order-D">
            <th>订单编号</th>
            <th>订单产品</th>
            <th>订购数量</th>
            <th>单价</th>
            <th>共计金额</th>
            <th>付款方式</th>
            <?php  for ($i = 0; $i < count($food_ids); $i++) {
                $food = query("select name,price from food where id=$food_ids[$i];");
                ?>
                <tr>
                    <?php  if ($i == 0) { ?>
                        <td rowspan="<?= count($food_ids) ?>"><?= $orders[0]['order_sn'] ?></td>
                    <?php  } ?>
                    <td><a href="detailsp.php?id=<?= $food_ids[$i] ?>" target="_blank"
                           title="<?= $food[0]['name']; ?>"><?= $food[0]['name']; ?></a></td>
                    <td><?= $quantities[$i] ?></td>
                    <td>￥<?= $food[0]['price'] ?></td>
                    <?php  if ($i == 0) { ?>
                        <td rowspan="<?= count($food_ids) ?>">￥<?= $orders[0]['pay_price'] ?></td>
                        <td rowspan="<?= count($food_ids) ?>"><?= $orders[0]['pay_select'] == 'alipay' ? '支付宝' : '微信'; ?></td>
                        <!--如果未付款，则显示立即付款按钮-->
                        <td rowspan="<?= count($food_ids) ?>" style="<?= $orders[0]['status'] == -8 ? 'display:block' : 'display:none' ?>;"><a href="pay.php?id=<?=$order_id?>" target="_blank">立即付款</a></td>
                    <?php  } ?>
                </tr>
            <?php  } ?>
        </table>
        <span class="Font14 FontW Lineheight35 Block">收件地址：</span>
        <form action="../back/user_order_update.php" method="post">
            <input type="hidden" name="order_id" value="<?=$order_id?>">
            <input type="hidden" name="address_id" value="<?=$orders[0]['express_address_id']?>">
            <table class="U-order-A">
                <tr>
                    <td width="30%" align="right" class="FontW">收件地址：</td>
                    <td>
                        <select id="s_province" name="province" class="select_ssq" >
                            <option value="<?=$address[0]['province']?>"><?=$address[0]['province']?></option>
                        </select>
                        <select id="s_city" name="city" class="select_ssq">
                            <option value="<?=$address[0]['city']?>"><?=$address[0]['city']?></option>
                        </select>
                        <select id="s_county" name="county" class="select_ssq">
                            <option value="<?=$address[0]['county']?>"><?=$address[0]['county']?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right" class="FontW">详细地址：</td>
                    <td><input type="text" name="address" class="input_addr" value="<?=$address[0]['address']?>" required></td>
                </tr>
                <tr>
                    <td width="30%" align="right" class="FontW">收件人姓名：</td>
                    <td><input type="text" name="nickName" class="input_name" value="<?=$address[0]['nickname']?>" required></td>
                </tr>
                <tr>
                    <td width="30%" align="right" class="FontW">手机号码：</td>
                    <td><input type="text" name="mobile" class="input_tel" value="<?=$address[0]['mobile']?>" required pattern="[0-9]{11}">
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right" class="FontW">订单备注：</td>
                    <td><input type="text" name="note" class="input_mark" value="<?=$orders[0]['note']?>"></td>
                </tr>
                <tr>
                    <td width="30%" align="right"></td>
                    <!--未付款订单，可以修改地址！-->
                    <td>
                        <input type="hidden" name="order_id" value="<?=$order_id?>">
                        <input type="submit" style="<?= $orders[0]['status'] == -8 ? 'display:block' : 'display:none' ?>;" value="确认修改地址" class="Submit">（未付款订单，可以修改地址！）
                    </td>
                </tr>
            </table>
        </form>
        <script class="resources library" src="../static/js/updateArea.js" type="text/javascript"></script>
        <script type="text/javascript">_init_area();</script>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

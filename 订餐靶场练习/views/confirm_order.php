<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
//当前用户id
session_start();
$_SESSION = loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$cartList = $_POST['cartList'];

if (!$cartList) {
    msg("请添加购物车", CART);
}

//获取收货地址
$add = query("select * from member_address where member_id=$memberId and status=1");


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>确认订单-网上订餐</title>
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
<section class="Psection MT20" id="Cflow">
    <form action="../back/pay_order.php" method="post">
        <!--如果用户未添加收货地址，则显示如下-->
        <div class="confirm_addr_f">
            <span class="flow_title">收货地址：</span>
            <!--已保存的地址列表-->
            <?php if ($add) { ?>
                <ul class="address">
                    <?php $i = 1;
                    foreach ($add as $value) { ?>
                        <li id="style<?= $i ?>">
                            <input type="radio" value="<?= $value['id'] ?>" id="<?= $i ?>" name="order_address"
                                   onclick="changeColor(<?= $i ?>)"/>
                            <label for="<?= $i++ ?>"> <?= $value['province'] . ' ' . $value['city'] . ' ' . $value['county'] . ' ' . $value['address'] . '（' . $value['nickname'] . '先生\女士收）' ?>
                                <span class="fontcolor"><?= $value['mobile'] ?></span></label></li>
                    <?php } ?>
                    <li><a href="<?= ADDRESS ?>"
                           onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><img
                                    src="../static/images/newaddress.png"/></a></li>
                </ul>
            <?php } ?>
        </div>
        <!--配送方式及支付，则显示如下-->
        <!--check order or add other information-->
        <div class="pay_delivery">
            <span class="flow_title">配送方式：</span>
            <table>
                <th width="30%">配送方式</th>
                <th width="30%">运费</th>
                <th width="40%">说明</th>
                <tr>
                    <td>送货上门</td>
                    <td>￥0.00</td>
                    <td>配送说明信息...</td>
                </tr>
            </table>
            <span class="flow_title">在线支付方式：</span>
            <ul>
                <li><input type="radio" name="pay_select" id="alipay" value="alipay"/><label for="alipay"><i
                                class="alipay"></i></label></li>
            </ul>
        </div>

        <div class="inforlist">
            <span class="flow_title">商品清单</span>
            <table>
                <th>名称</th>
                <th>数量</th>
                <th>单价</th>
                <th>小计</th>
                <?php for ($i = 0; $i < count($cartList); $i++) {
                    $carts = query("select mc.id cart_id,f.id food_id,f.name,f.price,mc.quantity from member_cart mc left join food f on mc.food_id=f.id where 
                                         mc.id=" . $cartList[$i] . " and mc.member_id=$memberId and mc.status=1;");
                    foreach ($carts as $value) {
                        ?>
                        <tr>
                            <input type="hidden" name="carts[<?= $i ?>][cart_id]" value="<?= $value['cart_id'] ?>">
                            <input type="hidden" name="carts[<?= $i ?>][food_id]" value="<?= $value['food_id'] ?>">
                            <input type="hidden" name="carts[<?= $i ?>][name]" value="<?= $value['name'] ?>">
                            <input type="hidden" name="carts[<?= $i ?>][quantity]" value="<?= $value['quantity'] ?>">
                            <input type="hidden" name="carts[<?= $i ?>][price]" value="<?= $value['price'] ?>">
                            <input type="hidden" name="carts[<?= $i ?>][quantity]" value="<?= $value['quantity'] ?>">
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['quantity'] ?></td>
                            <td>￥<?= $value['price'] ?></td>
                            <td>￥<?php $pay_price = number_format($value['price'] * $value['quantity'], '2');
                                $total_price = number_format($total_price + $pay_price, '2');
                                echo $pay_price;
                                ?>
                            </td>

                        </tr>
                    <?php
                    }
                } ?>

            </table>
            <div class="Order_M">
                <p><em>订单附言:</em><input name="order_note" type="text"></p>
            </div>
            <div class="Sum_infor">
                <!--<p class="p1">配送费用：￥0.00+商品费用：￥177.00-优惠券：￥10.00</p>-->
                <p class="p2">合计：<span>￥<?= $total_price ?></span></p>
                <input type="hidden" name="total_price" value="<?= $total_price ?>">
                <input type="submit" value="提交订单" class="p3button">
            </div>
        </div>
    </form>
    </div>
</section>

<script>
    //Test code,You can delete this script /2014-9-21DeathGhost/
    $(document).ready(function () {
        var submitorder = $.noConflict();
        submitorder(".p3button").click(function () {
            submitorder("#Cflow").hide();
            submitorder("#Aflow").show();
        });
    });
</script>
<?php require_once "../define/bottom.php" ?>
</body>
</html>

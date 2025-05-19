<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION = loginCheck($_SESSION);
$memberName = $_SESSION['memberName'];
//获取member的id
$member_id = $_SESSION['memberId'];

if ($member_id) {
    //获取当前用户下的购物车
    $cart = query("select c.id cart_id,r.name res_name,f.id food_id,f.name food_name,f.price,f.main_image,quantity from member_cart c 
                left join food f on c.food_id=f.id left join restaurant r on f.res_id=r.id where c.member_id=$member_id and c.status=1;");
} else {
    msg("请先登录", LOGIN);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>网上订餐-我的购物车</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发"/>
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!"/>
    <meta name="author" content="DeathGhost"/>
    <link href="../static/style/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../static/js/public.js"></script>
    <script type="text/javascript" src="../static/js/jquery.js"></script>
    <script type="text/javascript" src="../static/js/jqpublic.js"></script>
    <script type="text/javascript" src="../static/js/cart1.js"></script>
</head>
<body>
<!--Start content-->
<form action="confirm_order.php" method="post">
    <div class="gwc" style=" margin:auto;">
        <table cellpadding="0" cellspacing="0" class="gwc_tb1">
            <tr>
                <td class="tb1_td1"><input id="Checkbox1" type="checkbox" class="allselect"/></td>
                <td class="tb1_td1">全选</td>
                <td class="tb1_td3">商品</td>
                <!--<td class="tb1_td4">原价</td>-->
                <td class="tb1_td5">数量</td>
                <td class="tb1_td6">单价</td>
                <td class="tb1_td7">操作</td>
            </tr>
        </table>
        <?php foreach ($cart as $value) { ?>
            <table cellpadding="0" cellspacing="0" class="gwc_tb2">
                <tr>
                    <td colspan="7" class="shopname Font14 FontW"><?= $value['res_name'] ?></td>
                </tr>
                <tr>
                    <td class="tb2_td1"><input type="checkbox" value="<?= $value['cart_id'] ?>" name="cartList[]"
                                               id="newslist-1"/></td>
                    <td class="tb2_td2"><a href="detailsp.php?id=<?= $value['food_id'] ?>" target="_blank">
                            <img src="<?= UPLOAD . $value['main_image'] ?>"/></a></td>
                    <td class="tb2_td3"><a href="detailsp.php?id=<?= $value['food_id'] ?>"
                                           target="_blank"><?= $value['food_name'] ?></a></td>
                    <td class="tb1_td5">
                        <input class="text_box1" name="" type="text" value="<?= $value['quantity'] ?>"
                               style=" width:40px;height:28px; text-align:center; border:1px solid #ccc;"/>
                    </td>
                    <td class="tb1_td6"><label class="tot"
                                               style="color:#ff5500;font-size:14px; font-weight:bold;"><?= $value['quantity'] * $value['price'] ?></label>
                    </td>
                    <td class="tb1_td7"><a href="../back/cart_del.php?id=<?= $value['cart_id'] ?>" id="delcart1">删除</a>
                    </td>
                </tr>
            </table>
        <?php } ?>

        <table cellpadding="0" cellspacing="0" class="gwc_tb3">
            <tr>
                <td class="tb1_td1"><input id="checkAll" class="allselect" type="checkbox"/></td>
                <td class="tb1_td1">全选</td>
                <td class="tb3_td1"><input id="invert" type="checkbox"/>
                    反选
                    <input id="cancel" type="checkbox"/>
                    取消
                </td>
                <td class="tb3_td2 GoBack_Buy Font14"><a href="<?= INDEX ?>" target="_blank">继续购物</a></td>
                <td class="tb3_td2">已选商品
                    <label id="shuliang" style="color:#ff5500;font-size:14px; font-weight:bold;">0</label>
                    件
                </td>
                <td class="tb3_td3"><span></span>
                    <span style=" color:#ff5500;">
                            <label id="zong1" style="color:#ff5500;font-size:14px; font-weight:bold;"></label>
                        </span>
                </td>
                <td class="tb3_td4">
                    <input type="submit" tyle=" display:none;" class="jz2" id="jz2" value="结算">
                </td>
            </tr>
        </table>
    </div>
</form>
<?php require_once "../define/bottom.php" ?>
</body>
</html>

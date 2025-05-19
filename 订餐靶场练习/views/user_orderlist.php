<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
require_once "../func/paging.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

//分页
$sql = "select o.id,o.order_sn,o.created_time,o.pay_price,o.status,o.express_status,ma.nickname from pay_order o 
                left join member_address ma on o.express_address_id=ma.id where o.member_id=$memberId order by o.order_sn desc";

$result = turnPage($_GET['page'],10,$sql);

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
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <!--user order list-->
        <section>
            <table class="Myorder">
                <th class="Font14 FontW">订单编号</th>
                <th class="Font14 FontW">下单时间</th>
                <th class="Font14 FontW">收件人</th>
                <th class="Font14 FontW">订单总金额</th>
                <th class="Font14 FontW">订单状态(支付\发货)</th>
                <th class="Font14 FontW">操作</th>
                <?php  foreach ($result['result'] as $value) { ?>
                    <tr>
                        <td class="FontW"><a href="user_order.php?id=<?= $value['id'] ?>"><?= $value['order_sn'] ?></a>
                        </td>
                        <td><?= $value['created_time'] ?></td>
                        <td><?= $value['nickname'] ?></td>
                        <td><?= $value['pay_price'] ?></td>
                        <td>
                            <?php
                            switch ($value['status']) {
                                case 0:
                                    echo '订单无效,';
                                    break;
                                case 1:
                                    echo '支付完成,';
                                    break;
                                case -8:
                                    echo '待支付,';
                                    break;
                                case -7:
                                    echo '支付完成待确认,';
                                    break;
                            }
                            switch ($value['express_status']) {
                                case 0:
                                    echo '订单无效';
                                    break;
                                case 1:
                                    echo '确认收货';
                                    break;
                                case -8:
                                    echo '待支付';
                                    break;
                                case -7:
                                    echo '已付款待发货';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <a style="<?php  if ($value['status'] == 0 || ($value['express_status'] == 0 || $value['express_status'] == 1)) {
                                echo 'display:none';
                            } else {
                                echo 'display:block';
                            } ?>" href="../back/user_order_cancel.php?id=<?= $value['id'] ?>">取消订单</a>
                            <a style="<?= $value['status'] == -8 ? 'display:block' : 'display:none' ?>"
                                    href="pay.php?id=<?= $value['id'] ?>">付款</a>
                            <a style="<?php  if ($value['status'] == 1 && $value['express_status'] == -7) {
                                echo 'display:block';
                            } else {
                                echo 'display:none';
                            }?>"
                               href="../back/user_order_confirm.php?id=<?= $value['id'] ?>">确认收货</a>
                        </td>
                    </tr>
                <?php  } ?>
            </table>
            <div class="TurnPage">
                <a href="user_orderlist.php?page=<?=$result['prePage']?>">
                    <span class="Prev"><i></i>上一页</span>
                </a>
                <?php for ($i=1;$i<=$result['pageMax'];$i++){?>
                    <a href="user_orderlist.php?page=<?=$i?>"><span class="PNumber"><?=$i?></span></a>
                <?php }?>
                <a href="user_orderlist.php?page=<?=$result['nextPage']?>">
                    <span class="Next">下一页<i></i></span>
                </a>
            </div>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

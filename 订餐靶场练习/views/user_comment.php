<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/paging.php";


session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

$sql = "select o.id,o.order_sn,o.updated_time,o.pay_price,o.comment_status,ma.nickname from pay_order o 
                left join member_address ma on o.express_address_id=ma.id where o.member_id=$memberId and o.status=1 and o.express_status=1 order by o.order_sn desc";

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
    <?php require_once "../define/user_center.php";?>
    <article class="U-article Overflow">
        <!--user message-->
        <span class="Font14 FontW Lineheight35 Block">已完成订单：</span>
        <section>
            <table class="Myorder">
                <th class="Font14 FontW">订单编号</th>
                <th class="Font14 FontW">完成时间</th>
                <th class="Font14 FontW">收件人</th>
                <th class="Font14 FontW">评论状态</th>
                <th class="Font14 FontW">操作</th>
                <?php  foreach ($result['result'] as $value) { ?>
                    <tr>
                        <td class="FontW"><a href="user_order.php?id=<?= $value['id'] ?>"><?= $value['order_sn'] ?></a>
                        </td>
                        <td><?= $value['updated_time'] ?></td>
                        <td><?= $value['nickname'] ?></td>
                        <td><?= $value['comment_status'] ==0 ? "未评论" : "已评论"?></td>
                        <td>
                            <a style="<?=$value['comment_status'] ==0 ? 'display:block' : 'display:none'?>" href="../views/user_comment_set.php?id=<?= $value['id'] ?>">去评论</a>
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

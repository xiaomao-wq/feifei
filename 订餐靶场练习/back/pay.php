<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/database.php";
require_once  "../define/define.php";
require_once "../func/member-check.php";

$order_id = $_POST['order_id'];

if ($order_id){
    $sql = "update pay_order set status=1,express_status=-7 where id=$order_id;";

    if (execute($sql)){
        msg("支付成功",ORDERLIST);
    }else{
        msg("支付失败，请重试",PAY.'?id='.$order_id.'');
    }
}else{
    msg("非法操作",INDEX);
}




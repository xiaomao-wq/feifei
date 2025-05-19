<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/address-check.php";

$id = $_GET['id'];

//支付完成且确认收货后不能取消订单
if ($id){
    $sql = "update pay_order set status=0,express_status=0,updated_time='".nowTime()."' where id=$id";
    if (execute($sql)){
        header("location:".ORDERLIST."");
    }
}else{
    msg("非法操作",INDEX);
}
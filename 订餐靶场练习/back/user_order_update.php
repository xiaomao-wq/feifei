<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
require_once "../func/address-check.php";

$_POST = addCheck($_POST);

$order_id = $_POST['order_id'];
$address_id = $_POST['address_id'];
$note = $_POST['note'];

$province = $_POST['province'];
$city = $_POST['city'];
$county = $_POST['county'];
$nickName = $_POST['nickName'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];

//判断订单的付款状态
$order_status = query_once("select status from pay_order where id=$order_id");
if ($order_status['status'] == -8){
    $add = "update member_address set nickname='$nickName',mobile='$mobile',province='$province',
        city='$city',county='$county',address='$address',updated_time='".nowTime()."' where id=$address_id;";
    if (execute($add)){
        $sql = "update pay_order set note='$note',updated_time='".nowTime()."' where id=$order_id;";
        if (execute($sql)){
            execute("update pay_order_item set note='$note',updated_time='".nowTime()."' where pay_order_id=$order_id;");
            msg("成功修改地址订单信息", UORDER.'?id='.$order_id.'');
        }else{
            msg("订单备注修改失败，请重试",UORDER.'?id='.$order_id.'');
        }
    } else {
        msg("修改订单地址信息失败",UORDER.'?id='.$order_id.'');
    }
}else{
    msg("非法操作",UORDER.'?id='.$order_id.'');
}











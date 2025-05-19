<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/address-check.php";

$id = $_GET['id'];

if ($id){
    $sql = "update pay_order set express_status=1,updated_time='".nowTime()."' where id=$id";
    if (execute($sql)){
        header("location:".ORDERLIST."");
    }
}else{
    msg("非法操作",INDEX);
}
<?php
header("Content-type:text/html;charset:utf-8");
require_once  "../func/database.php";
require_once "../func/address-check.php";

$id = $_GET['id'];

$updateAdd = addCheck($_POST);
//获取验证后的值
$province = $updateAdd['province'];
$city = $updateAdd['city'];
$county = $updateAdd['county'];
$nickName = $updateAdd['nickName'];
$address = $updateAdd['address'];
$mobile = $updateAdd['mobile'];

//获取当前时间
$time = nowTime();
if ($id){
    $sql = "update member_address set nickname='$nickName',mobile='$mobile',province='$province',
        city='$city',county='$county',address='$address',updated_time='$time' where id=$id;";
    if (execute($sql)){
        //msg("修改收货地址成功", ADDRESS);
        header("location:".ADDRESS."");
    } else {
        msg("修改收货地址失败",ADDRESS);
    }
}else{
    msg("非法操作",INDEX);
}


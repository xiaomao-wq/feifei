<?php
header("Content-type:text/html;charset:utf-8");
require_once "member-check.php";

function addCheck($add){
    if ($add['province'] == "省份"){
        msg("请选择省份信息",ADDRESS);
    }

    if ($add['city'] == "地级市"){
        msg("请选择地级市信息",ADDRESS);
    }

    if ($add['county'] == "区县" || !$add['county']){
        $add['county'] = '';
    }

    if (strlen($add['nickName']) == 0){
        msg("请填写联系人姓名",ADDRESS);
    }

    if (strlen($add['address']) == 0){
        msg("请填写详细地址",ADDRESS);
    }

    $add['mobile'] = checkMemberMobile($add['mobile'],ADDRESS);

    return $add;
}

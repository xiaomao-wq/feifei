<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/database.php";

$memberName = checkMemberName($_POST["memberName"]);
$memberPwd1 = checkMemberPwd($_POST["memberPwd1"]);
$memberPwd2 = checkMemberPwd2($memberPwd1,$_POST["memberPwd2"]);
$memberEmail = checkMemberEmail($_POST["memberEmail"]);
$memberMobile = checkMemberMobile($_POST["memberMobile"]);

$sql = "insert into member (nickname,password,email,mobile) values ('$memberName','$memberPwd1','$memberEmail','$memberMobile');";
if (execute($sql)) {
    msg("注册成功", LOGIN);
} else {
    msg("注册失败",REG);
}

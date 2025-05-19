<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/database.php";

//获取用户ID
session_start();
$_SESSION=loginCheck($_SESSION);

//获取可以修改的信息
$memberAvatar = upload($_FILES["memberAvatar"]);
$memberPwd1 = checkMemberPwd($_POST["memberPwd1"],MEMBER);
$memberPwd2 = checkMemberPwd2($memberPwd1,$_POST["memberPwd2"],MEMBER);
$memberEmail = checkMemberEmail($_POST["memberEmail"],MEMBER);
$memberMobile = checkMemberMobile($_POST["memberMobile"],MEMBER);

$member_id = $_SESSION['memberId'];

//获取当前时间
$time = nowTime();

$sql = "update member set avatar='$memberAvatar',password='$memberPwd2',email='$memberEmail',mobile='$memberMobile',updated_time='$time'
        where id=$member_id;";
if (execute($sql)) {
    msg("修改成功", LOGIN);
} else {
    msg("修改失败",MEMBER);
}


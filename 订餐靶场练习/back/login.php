<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/database.php";

session_start();

$memberName = $_POST["memberName"];
$memberName = htmlentities(htmlspecialchars($memberName, ENT_QUOTES));

$memberPwd = $_POST["memberPwd"];
//获取当前时间
$time = nowTime();


$sql = "select * from member where nickname='".$memberName."' and password='".$memberPwd."';";

$member = query($sql);
$memberId = $member[0]['id'];
if($member){
    $sql = "update member set last_login_time='".$time."' where nickname='".$memberName."' ;";
    execute($sql);
    $_SESSION['memberName'] = $memberName;
    $_SESSION['memberId'] = $memberId;
    msg("登录成功",INDEX);
}else{
    msg("登录失败，请重新登录",LOGIN);
}

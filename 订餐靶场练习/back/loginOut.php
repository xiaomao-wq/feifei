<?php
header("Content-type:text/html;charset:utf-8");
require_once "../func/member-check.php";
require_once "../func/database.php";

session_start();

unset($_SESSION['memberName']);
unset($_SESSION['memberId']);
msg("退出成功",INDEX);
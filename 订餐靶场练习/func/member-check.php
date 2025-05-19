<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/define.php";

function pre($info){
    echo "<pre>";
    print_r($info);
    echo "</pre>";
}


function msg($msg,$url=REG){
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";


echo '<!DOCTYPE html>
<html>
<head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .box{
        width: 500px;
        height: 100px;
        margin: 50px auto;
    }
    .box p{
        text-align: center;
    }
    #msg{
        font-size: 30px;
        font-family: 幼圆;
        font-weight: 600;
        margin-top: 50px;
    }
    #time{
        font-size: 40px;
        font-family: 幼圆;
        font-weight: 600;
        margin-top: 20px;
        color: red;
    }
</style>

<meta charset="utf-8" />
<title>DeathGhost-状态页面</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
<link href="../static/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../static/js/public.js"></script>
<script type="text/javascript" src="../static/js/jquery.js"></script>
<script type="text/javascript" src="../static/js/jqpublic.js"></script>
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
<body>
<!--Start content-->
<section class="Psection MT20">
 <div class="box">
        <p id="msg">'.$msg.'</p>
        <p id="time">3</p>
    </div>
    <script>
        var sec = 3;
        var time = document.getElementById("time");
        time.innerText = sec;

        setInterval(function () {
            sec--;
            time.innerText = sec;
            if (sec <= 0){
                window.location.href="'.$url.'";
            }
        },1000);
    </script>
</section>
<!--End content-->
<div class="F-link">
  <span>友情链接：</span>
  <a href="http://www.deathghost.cn" target="_blank" title="DeathGhost">DeathGhost</a>
  <a href="http://www.17sucai.com/pins/15966.html" target="_blank" title="免费后台管理模板">绿色清爽版通用型后台管理模板免费下载</a>
  <a href="http://www.17sucai.com/pins/17567.html" target="_blank" title="果蔬菜类模板源码">HTML5果蔬菜类模板源码</a>
  <a href="http://www.17sucai.com/pins/14931.html" target="_blank" title="黑色的cms商城网站后台管理模板">黑色的cms商城网站后台管理模板</a>
 </div>
<footer>
 <section class="Otherlink">
  <aside>
   <div class="ewm-left">
    <p>手机扫描二维码：</p>
    <img src="../static/images/Android_ico_d.gif">
    <img src="../static/images/iphone_ico_d.gif">
   </div>
   <div class="tips">
    <p>客服热线</p>
    <p><i>1830927**73</i></p>
    <p>配送时间</p>
    <p><time>09：00</time>~<time>22:00</time></p>
    <p>网站公告</p>
   </div>
  </aside>
  <section>
    <div>
    <span><i class="i1"></i>配送支付</span>
    
    </div>
    <div>
    <span><i class="i2"></i>关于我们</span>
    
    </div>
    <div>
    <span><i class="i3"></i>帮助中心</span>
    
    </div>
  </section>
 </section>
<div class="copyright">© 版权所有 2016 DeathGhost 技术支持：<a href="http://www.deathghost.cn" title="DeathGhost">DeathGhost</a></div>
</footer>
</body>
</html>

    ';
    die;
}

function checkMemberName($memberName,$url=REG){
    if(strlen($memberName) == 0){
        msg("用户名输入错误",$url);
    }elseif(strlen($memberName) < 6 || strlen($memberName) >10){
        msg('用户名长度输入错误',$url);
    }elseif (preg_match("/^[a-zA-Z_]\\w{5,9}$/",$memberName) == 0){
        msg('用户名输入错误,由字母、数字或下划线组成，不能以数字开头',$url);
    }
    return $memberName;
}

function checkMemberPwd($memberPwd1,$url=REG){
    if(strlen($memberPwd1) == 0){
        msg('密码输入错误',$url);
    }
    if(strlen($memberPwd1) < 6 || strlen($memberPwd1) > 12){
        msg('密码长度输入错误',$url);
    }
    if(preg_match("/^\\d{6,12}$/",$memberPwd1) == 1){
        msg('密码不能是纯数字',$url);
    }
    if(preg_match("/^\\S{6,12}$/",$memberPwd1) == 0){
        msg('密码不能包含空格',$url);
    }
    return $memberPwd1;
}

function checkMemberPwd2($memberPwd1,$memberPwd2,$url=REG){
    if(strlen($memberPwd2) == 0){
        msg('再次输入的密码不能为空',$url);
    }
    if($memberPwd1 !== $memberPwd2){
        msg('两次输入的密码不一样',$url);
    }
    return $memberPwd2;
}

function checkMemberEmail($memberEmail,$url=REG){
    if(strlen($memberEmail) == 0){
        msg('请填写邮箱',$url);
    }
    if(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$memberEmail) == 0){
        msg('邮箱填写错误',$url);
    }
    return $memberEmail;
}

function checkMemberMobile($memberMobile,$url=REG){
    if(strlen($memberMobile) == 0){
        msg('请填写手机号',$url);
    }
    if(strlen($memberMobile) > 11){
        msg('请填写正确的手机号码',$url);
    }
    if(preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|166|17[3678]|18[0-9]|14[57])[0-9]{8}$/",$memberMobile) == 0){
        msg('请填写正确的手机号码',$url);
    }
    return $memberMobile;
}

/**
 * 文件上传的方法
 * @param $file : 文件对象数组
 * @return array
 */
function upload($file){
    if ($file['error'] == 0){
        // 限制大小
        // 允许的大小 2M
        $allowSize = 2*1024*1024;
        // 文件的大小
        $fileSize = $file['size'];
        if ($fileSize > $allowSize){
            msg('文件过大！',MEMBER);
        }
        // 白名单
        $allowExts = array("png","jpg","gif","jpeg");


        $fileName = $file['name'];
        $ext = getExt($fileName);
        if (!in_array(strtolower($ext), $allowExts)){
            msg("是不允许上传的后缀！",MEMBER);
        }

        $fileName = time().'.'.$ext;

        $tempFile = $file['tmp_name'];

        $datePath = getDatePath();
        $uploadPath = UPLOAD.$datePath;
        if (!file_exists($uploadPath)) {
            // 不存在就创建目录
            mkdir($uploadPath, 0777, true);
        }

        if (move_uploaded_file($tempFile, $uploadPath.$fileName)) {
            return $datePath.$fileName;
        }
        msg("上传失败",MEMBER);
    }else{
        switch ($file['error']){
            case 1:
                msg("超过文件最大上传限制",MEMBER);//php.ini中upload_max_filesize
            case 2:
                msg("超过表单文件大小限制",MEMBER);//HTML表单中MAX_FILE_SIZE选项
            case 3:
                msg("文件部分被上传",MEMBER);
            case 4:
                return "testuser.jpg";
            case 6:
                msg("没有找到临时目录",MEMBER);
            case 7://文件写入失败
                msg("文件写入失败",MEMBER);
            case 8:
                msg("系统错误",MEMBER);
        }
    }
}


/**
 * 获取文件后缀的方法
 * @param $fileName
 * @return bool|mixed
 */
function getExt($fileName){
    // 判断是否是字符串
    if (!is_string($fileName)) {
        return false;
    }
    // 判断文件名是否正确
    if (strlen($fileName) == 0) {
        return false;
    }
    // 判断点
    if (!strpos($fileName, ".")) {
        return false;
    }
    // 获取后缀 =》 将字符串转换成数组
    $arr = explode(".", $fileName);
    return $arr[count($arr)-1];
}


/**
 * 获取日期目录
 * @return false|string
 */
function getDatePath(){
    $datePath = date("Y/m/d/", time());
    return $datePath;
}

function loginCheck($session){
    if (!$session){
        msg("请先登录",LOGIN);
    }else{
        return $session;
    }
}


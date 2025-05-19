<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberName = $_SESSION['memberName'];

// 查询数据
$member = query("select * from member where nickname='" . $memberName . "'");

?>

<!DOCTYPE html>
<html>
<!--Start content-->
<section class="Psection MT20">
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <!--user Account-->
        <section class="AccManage Overflow">
            <span class="AMTitle Block Font14 FontW Lineheight35">账户管理</span>
            <!--<p>登陆邮箱：232***413@qq.com ( <a href="#" target="_blank">更换手机号码</a> )</p>
            <p>手机号码：183****5673 ( <a href="#" target="_blank">更换手机号码</a> ) ( <a href="#" target="_blank">解绑手机</a> )</p>-->
            <?php
            foreach ($member as $value) {
            ?>
            <p>上次登陆：<?= $value['last_login_time'] ?>( *如非本人登陆，请立即修改您的密码</a>！ )</p>
            <form action="../back/user_account.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td width="30%" align="right">*修改头像：</td>
                        <td>
                            <input  id="head" name="memberAvatar" type="file">
                        </td>
                        <td><img  style="display: inline-block" id="thumb" height="50px" alt=""></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right">会员名：</td>
                        <td>
                            <input type="text" readonly="true" value="<?= $value['nickname'] ?>">
                            <label style="color: red">会员名不可更改</label>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right">*修改密码：</td>
                        <td>
                            <input type="password" name="memberPwd1" maxlength="12" value="<?= $value['password'] ?>">
                            <lable>请输入6-12位的密码(不能是纯数字,不能包含空格)</lable>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right">*确认密码：</td>
                        <td>
                            <input type="password" name="memberPwd2" maxlength="12" value="<?= $value['password'] ?>">
                            <lable>请再次输入密码</lable>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right">*修改邮箱：</td>
                        <td>
                            <input type="email" name="memberEmail" value="<?= $value['email'] ?>">
                            <lable>请输入邮箱</lable>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right">*修改手机：</td>
                        <td>
                            <input type="tel" name="memberMobile"  maxlength="11" value="<?= $value['mobile'] ?>">
                            <lable>请输入手机号</lable>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td><input name="" type="submit" value="保 存"></td>
                    </tr>
                </table>
            </form>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
<script>
    var head = document.getElementById("head");
    var thumb = document.getElementById("thumb");

    head.onchange=function () {
        thumb.src = window.URL.createObjectURL(this.files[0]);
    }
</script>

</body>
</html>

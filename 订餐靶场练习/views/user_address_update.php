<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once  "../func/database.php";
require_once "../func/member-check.php";


session_start();
$_SESSION=loginCheck($_SESSION);
$memberName = $_SESSION['memberName'];

$id = $_GET['id'];

//查询当前会员下选中的收货地址
$sql = "select * from member_address where id=$id";
$add = query($sql);
?>
<!DOCTYPE html>
<html>
<!--Start content-->
<section class="Psection MT20">
    <?php require_once "../define/user_center.php"?>
    <article class="U-article Overflow">
        <!--user Address-->
        <section class="Myaddress Overflow">
            <span class="MDtitle Font14 FontW Block Lineheight35">修改收货地址</span>

            <!--add new address-->
            <?php foreach ($add as $value){?>
            <form action="../back/user_address_update.php?id=<?=$id?>" method="POST">

                <table style="margin-top:10px;">
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">选择所在地：</td>
                        <td>
                            <select id="s_province" name="province" class="select_ssq">
                                <option value="<?=$value['province']?>"><?=$value['province']?></option>
                            </select>
                            <select id="s_city" name="city" class="select_ssq">
                                <option value="<?=$value['city']?>"><?=$value['city']?></option>
                            </select>
                            <select id="s_county" name="county" class="select_ssq">
                                <option value="<?=$value['county']?>"><?=$value['county']?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">联系人姓名：</td>
                        <td><input type="text" name="nickName" required class="input_name" value="<?=$value['nickname']?>"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">详细地址：</td>
                        <td><input type="text" name="address" required class="input_addr" value="<?=$value['address']?>"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">手机号码：</td>
                        <td><input type="text" name="mobile" required pattern="[0-9]{11}" class="input_tel" value="<?=$value['mobile']?>"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right"></td>
                        <td class="Font14 Font Lineheight35">
                            <input type="submit" value="保存修改" class="Submit">
                        </td>
                    </tr>
                </table>

            </form>
            <?php }?>
            <script class="resources library" src="../static/js/updateArea.js" type="text/javascript"></script>
            <script type="text/javascript">_init_area();</script>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

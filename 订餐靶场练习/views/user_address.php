<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once  "../func/database.php";
require_once "../func/member-check.php";

session_start();
$_SESSION=loginCheck($_SESSION);
$memberId = $_SESSION['memberId'];

//查询当前会员下的收货地址
$sql = "select ma.id,ma.nickname,ma.mobile,ma.province,ma.city,ma.county,ma.address 
        from member_address ma left join member m on ma.member_id=m.id where ma.member_id=$memberId and ma.status=1;";
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
            <span class="MDtitle Font14 FontW Block Lineheight35">我的收货地址</span>
            <?php if($add){ foreach ($add as $value){?>
            <form id="<?=$value['id']?>" method="POST">

                <table>
                    <tr>
                        <td rowspan="3" width="30%" class="Font14 FontW Lineheight35" align="center">收货地址</td>
                        <td><?=$value['nickname'].'  '.$value['mobile']?></td>
                    </tr>
                    <tr>
                        <td><?=$value['province'].'  '.$value['city'].'  '.$value['county']?></td>
                    </tr>
                    <tr>
                        <td><?=$value['address']?></td>
                    </tr>
                    <tr>
                        <td align="right" width="30%" class="Font14 FontW Lineheight35"></td>
                        <td class="Lineheight35">
                            <input  type="submit"  onclick="changeActionToUpdate(<?=$value['id']?>)"  value="修改" class="Submit">
                            <input  type="submit"  onclick="changeActionToDel(<?=$value['id']?>)" value="删除" class="Submit">
                        </td>
                    </tr>
                </table>
            </form>
            <?php }}?>
            <script type="text/javascript">
                function changeActionToUpdate(id){
                    var s=document.getElementById(id);
                    s.setAttribute("action", "user_address_update.php?id="+id+"");
                }
                function changeActionToDel(id){
                    var s=document.getElementById(id);
                    s.setAttribute("action", "../back/user_address_del.php?id="+id+"");
                }
            </script>
            <!--add new address-->
            <form action="../back/user_address_set.php" method="POST">
                <table style="margin-top:10px;">
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">选择所在地：</td>
                        <td>
                            <select id="s_province" name="province" class="select_ssq"></select>
                            <select id="s_city" name="city" class="select_ssq"></select>
                            <select id="s_county" name="county" class="select_ssq"></select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">联系人姓名：</td>
                        <td><input type="text" name="nickName" required class="input_name"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">详细地址：</td>
                        <td><input type="text" name="address" required class="input_addr"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right">手机号码：</td>
                        <td><input type="text" name="mobile" required pattern="[0-9]{11}" class="input_tel"></td>
                    </tr>
                    <tr>
                        <td width="30%" class="Font14 FontW Lineheight35" align="right"></td>
                        <td class="Font14 Font Lineheight35">
                            <input type="submit" value="新增收货地址" class="Submit">
                        </td>
                    </tr>
                </table>
            </form>
            <script class="resources library" src="../static/js/area.js" type="text/javascript"></script>
            <script type="text/javascript">_init_area();</script>
        </section>
    </article>
</section>
<?php require_once "../define/bottom.php"?>
</body>
</html>

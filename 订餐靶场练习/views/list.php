<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";
require_once "../func/paging.php";

//分页
$sql = "select id,name,res_image,address from restaurant";
$result = turnPage($_GET['page'], 4, $sql);

//食品类别
$food_cat = query("select id,name from food_cat;");

//热门推荐
$res_hot = query("select id,name,res_image from restaurant order by weight desc limit 0,2;");

?>

<!DOCTYPE html>
<html>
<!--Start content-->
<section class="Psection">
    <section class="fslist_navtree">
        <ul class="select">
            <li class="select-list">
                <dl id="select1">
                    <dt>分类：</dt>
                    <dd class="select-all selected"><a href="javascript:">全部</a></dd>
                    <?php foreach ($food_cat as $value) { ?>
                        <dd><a href="javascript:"><?= $value['name'] ?></a></dd>
                    <?php } ?>
                </dl>
            </li>
            <li class="select-list">
                <dl id="select4">
                    <dt>价位区间：</dt>
                    <dd class="select-all selected"><a href="javascript:">全部</a></dd>
                    <dd><a href="javascript:">20元以下</a></dd>
                    <dd><a href="javascript:">20-40元</a></dd>
                    <dd><a href="javascript:">40-60元</a></dd>
                    <dd><a href="javascript:">60-80元</a></dd>
                    <dd><a href="javascript:">80-100元</a></dd>
                </dl>
            </li>
            <li class="select-result">
                <dl>
                    <dd class="select-no">已选择：</dd>
                </dl>
            </li>
        </ul>
    </section>
    <section class="Fslmenu">
        <a href="#" title="默认排序">
  <span>
  <span>默认排序</span>
  <span></span>
  </span>
        </a>
        <a href="#" title="评价">
  <span>
  <span>评价</span>
  <span class="s-up"></span>
  </span>
        </a>
        <a href="#" title="销量">
  <span>
  <span>销量</span>
  <span class="s-up"></span>
  </span>
        </a>
        <a href="#" title="价格排序">
  <span>
  <span>价格</span>
  <span class="s-down"></span>
  </span>
        </a>
        <a href="#" title="发布时间排序">
  <span>
  <span>发布时间</span>
  <span class="s-up"></span>
  </span>
        </a>
    </section>
    <section class="Fsl">
        <ul>
            <?php foreach ($result['result'] as $value) { ?>
                <li>
                    <a href="shop.php?id=<?= $value['id'] ?>" target="_blank" title="<?= $value['name'] ?>"><img
                                src="<?= UPLOAD . $value['res_image'] ?>"></a>
                    <hgroup>
                        <h3><?= $value['name'] ?></h3>
                        <h4></h4>
                    </hgroup>
                    <p>特色菜：
                        <?php
                        $res_spec_food = query("select f.id,f.name from restaurant r left join food f on r.id=f.res_id where r.id=" . $value['id'] . " limit 0,2;");
                        foreach ($res_spec_food as $item) {
                            echo $item['name'] . "  ";
                        } ?>
                    </p>
                    <p>地址：<?= $value['address'] ?></p>
                    <p>平均价格：
                        <?php
                        $res_food_avg = query("select round(avg(f.price),2) p from restaurant r left join food f on r.id=f.res_id where r.id=" . $value['id'] . ";");
                        foreach ($res_food_avg as $item) {
                            echo $item['p'];
                        } ?>
                    </p>
                    <p>
    <span class="Score-l">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-off.png">
    <span class="Score-v">4.8</span>
    </span>
                        <span class="DSBUTTON"><a href="shop.php?id=<?= $value['id'] ?>" target="_blank"
                                                  class="Fontfff">点外卖</a></span>
                    </p>
                </li>
            <?php } ?>
        </ul>
        <aside>
            <div class="title">热门商家</div>
            <?php foreach ($res_hot as $value) { ?>
                <div class="C-list">
                    <a href="shop.php?id=<?= $value['id'] ?>" target="_blank" title="<?= $value['name'] ?>"><img
                                src="<?= UPLOAD . $value['res_image'] ?>"></a>
                    <p><a href="shop.php?id=<?= $value['id'] ?>" target="_blank"><?= $value['name'] ?></a></p>
                    <p>
                    <span>平均价格：
                    <?php
                    $res_food_avg = query("select round(avg(f.price),2) p from restaurant r left join food f on r.id=f.res_id where r.id=" . $value['id'] . ";");
                    foreach ($res_food_avg as $item) {
                        echo $item['p'];
                    } ?>
                    </span>
                        <span style=" float:right">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-on.png">
    <img src="../static/images/star-off.png">
    <span class="ALscore">4.8</span>
   </span>
                    </p>
                </div>
            <?php } ?>
        </aside>
        <div class="TurnPage">
            <a href="list.php?page=<?= $result['prePage'] ?>">
                <span class="Prev"><i></i>上一页</span>
            </a>
            <?php for ($i = 1; $i <= $result['pageMax']; $i++) { ?>
                <a href="list.php?page=<?= $i ?>"><span class="PNumber"><?= $i ?></span></a>
            <?php } ?>
            <a href="list.php?page=<?= $result['nextPage'] ?>">
                <span class="Next">下一页<i></i></span>
            </a>
        </div>
    </section>
</section>
<?php require_once "../define/bottom.php" ?>
</body>
</html>

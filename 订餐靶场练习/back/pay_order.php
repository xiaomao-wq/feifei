<?php
header("Content-type:text/html;charset:utf-8");
require_once "../define/header.php";
require_once "../func/database.php";
require_once "../func/member-check.php";


$order_address = $_POST['order_address'];
$pay_select = $_POST['pay_select'];
$carts = $_POST['carts'];
$order_note = $_POST['order_note'];
$total_price = $_POST['total_price'];


//获取购物车中的信息
$i=0;
for ($j=0;$j<count($carts);$j++){
    if($i<count($carts)){
        $cart_ids[$i] = isset($carts[$j]['cart_id']) ? $carts[$j]['cart_id'] : '' ;
        $food_ids[$i] = isset($carts[$j]['food_id']) ? $carts[$j]['food_id'] : '';
        $prices[$i] = isset($carts[$j]['price']) ? $carts[$j]['price'] : '';
        $quantities[$i] = isset($carts[$j]['quantity']) ? $carts[$j]['quantity'] : '';
        $i++;
    }else{
        break;
    }
}

$food_ids_str = implode(",", $food_ids);
$prices_str = implode(",", $prices);
$quantities_str = implode(",", $quantities);


//当前用户id
session_start();
$memberId = $_SESSION['memberId'];

if(!$order_address){
    msg("请选择收货地址",CART);
}

if (!$pay_select){
    msg("请选择支付方式",CART);
}

//库存改变
for ($i=0;$i<count($carts);$i++){
    //查库春和销量
    $result = query_once("select stock,total_count from food where id=$food_ids[$i] for update ");
    if ($quantities[$i] > $result['stock']){
        msg("库存不足,下单失败",INDEX);
    }
    $stock_update = $result['stock']-$quantities[$i];
    $count_update = $result['total_count']+$quantities[$i];
    //改变库存和销量
    $sql = "update food set stock=$stock_update,total_count=$count_update,updated_time='".nowTime()."' where id=$food_ids[$i];";
    if(!execute($sql)){
        msg("库存错误",INDEX);
    }
}


//生成随机订单号
$order_sn = date("YmdHis").rand(10000,99999);

//将信息存入订单表
$order = "insert into pay_order (order_sn,member_id,pay_price,pay_select,note,status,express_status,express_address_id) 
        values ('$order_sn',$memberId,$total_price,'$pay_select','$order_note',-8,-8,$order_address);";

if (execute($order)){
    //根据订单号查到订单的id
    $order_id = query("select id from pay_order where order_sn='$order_sn';");
    $order_id = $order_id[0]['id'];
    //将食品信息存入订单详情
    $order_item = "insert into pay_order_item (pay_order_id,member_id,quantities,prices,food_ids,note) 
                    values ($order_id,$memberId,'$quantities_str','$prices_str','$food_ids_str','$order_note');";
    if (execute($order_item)){
        //将购物车删除
        for ($i=0;$i<count($carts);$i++){
            $del_cart = "update member_cart set status=0,updated_time='".nowTime()."' where id=$cart_ids[$i] ";
            execute($del_cart);
        }
    }else{
        msg("订单号生成失败，请稍后再试",CART);
    }
    header("location:".ORDERS."?id=$order_id");
}else{
    msg("订单生成失败，请重试",CART);
}






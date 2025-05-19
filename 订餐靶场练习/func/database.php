<?php
header("Content-type:text/html;charset=utf-8");
ini_set("error_reporting","E_ALL & ~E_NOTICE");
ini_set('display_errors','off');


/**
 * 连接数据库的方法
 * @param string $host ： 主机
 * @param string $userName : 数据库用户名
 * @param string $userPwd ： 数据库用户密码
 * @param string $database ： 数据库名字
 * @return bool|false|mysqli
 */
function connect($host = "localhost",$userName = "root", $userPwd = "123456", $database="food_db"){
    $link =  @mysqli_connect($host, $userName, $userPwd, $database);
    if ($link){
        // 设置编码
        mysqli_set_charset($link, "utf8");
        return $link;
    }
    return false;
}

/**
 * 增删改
 * @param $sql ： sql语句
 * @return bool|mysqli_result
 */
function execute($sql){
    // 连接数据库
    $link = connect();
    if (!$link){
        // 连接失败
        return false;
    }
    //echo mysqli_error($link);
    return mysqli_query($link, $sql);
}

/**
 * 查询
 * @param $sql ： sql语句
 * @return array|bool
 */
function query($sql){
    // 连接数据库
    $link = connect();
    if (!$link){
        // 连接失败
        return false;
    }
    $mysqli_result = mysqli_query($link, $sql);
    return mysqli_fetch_all($mysqli_result, MYSQLI_ASSOC);
}

/**
 * 查一条数据
 * @param $sql ： sql语句
 * @return bool|string[]|null
 */
function query_once($sql){
    $link = connect();
    if (!$link){
        return false;
    }
    $mysqli_result = mysqli_query($link, $sql);
    return mysqli_fetch_assoc($mysqli_result);
}

/**
 * 查数据条数
 * @param $sql
 * @return bool|int
 */
function query_count($sql){
    $link = connect();
    if (!$link){
        return false;
    }
    $mysqli_result = mysqli_query($link, $sql);
    return mysqli_num_rows($mysqli_result);
}

/**
 * 打印当前时间
 * @return false|string
 */
function nowTime(){
    return date("Y-m-d H:i:s",intval(time()));
}
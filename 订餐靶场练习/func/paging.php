<?php
header("Content-type:text/html;charset:utf-8");
require_once "database.php";
require_once "member-check.php";


//分页
function turnPage($page,$pageSize,$sql){
    $arr['page'] = isset($page) ? $page : 1;
    $count =  query_count($sql);
    $arr['pageMax'] = ceil($count/$pageSize);


    $arr['result'] = query("$sql limit ".(($arr['page']-1)*$pageSize).",".$pageSize.";");

    //页数的前进和后退
    $arr['prePage'] = $arr['page']-1 < 1 ? 1 : $arr['page']-1;
    $arr['nextPage'] = $arr['page']+1 > $arr['pageMax'] ? $arr['pageMax'] : $arr['page']+1;

    return $arr;
}




<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/2
 * Time: 21:37
 */

require_once __DIR__.'/../libs/mysql_connection.php';

$con=get_connection();
$location=$_POST["location"];
$type=$_POST["type"];
$name=$_POST["name"];
$community_id=select_table_condition($con,'community',["community_name"=>$name]);
if (isset($community_id)){
    $res=insert_table($con,'parking',["parking_location"=>$location,"type"=>$type,"community_id"=>$community_id[0]["community_id"]]);
    echo $res;
}else{
    echo 0;
}

?>
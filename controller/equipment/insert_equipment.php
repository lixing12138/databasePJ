<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 18:00
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$con=get_connection();
$equipmentName=$_POST["equipmentName"];
$equipmentLocation=$_POST["equipmentLocation"];
$equipmentPrice=$_POST["equipmentPrice"];
$equipmentType=$_POST["equipmentType"];
$equipmentCommunity=$_POST["equipmentCommunity"];
$community_id=select_table_condition($con,'community',["community_name"=>$equipmentCommunity]);
if (isset($community_id)){
    $res=insert_table($con,'equipment',["e_name"=>$equipmentName,"e_location"=>$equipmentLocation,
        "e_price"=>$equipmentPrice,"e_type"=>$equipmentType,"community_id"=>$community_id[0]["community_id"]]);
    echo $res;
}
?>
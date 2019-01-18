<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 23:28
 */
require_once __DIR__ . '/../../libs/mysql_connection.php';

$con = get_connection();

$search_community=$_POST["search_community"];
$search_building=$_POST["search_building"];
$search_unit=$_POST["search_unit"];
$search_door=$_POST["search_door"];

//echo $search_building."\n";
//echo $search_community."\n";
//echo $search_door;
//echo $search_unit;
$sql="SELECT * FROM house WHERE 1";
if ($search_community!=""){
    $sql=$sql." AND community_id= ".$search_community;
}
if ($search_building!=""){
    $sql=$sql." AND building_number= ".$search_building;
}
if ($search_unit!=""){
    $sql=$sql." AND unit_number= ".$search_unit;
}
if ($search_door!=""){
    $sql=$sql." AND door_number= ".$search_door;
}
//echo $sql;

$stmt=$con->prepare($sql);
$stmt->execute();
$res= $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);
?>
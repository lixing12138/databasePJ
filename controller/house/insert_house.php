<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 21:04
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$con=get_connection();
$houseOwnerID=$_POST["houseOwnerID"];
$houseCommunity=$_POST["houseCommunity"];
$houseBuildingNumber=$_POST["houseBuildingNumber"];
$houseUnitNumber=$_POST["houseUnitNumber"];
$houseDoorNumber=$_POST["houseDoorNumber"];
$houseStatus=$_POST["houseStatus"];
$houseSquare=$_POST["houseSquare"];

$community_id=select_table_condition($con,'community',["community_name"=>$houseCommunity]);

$res=insert_table($con,'house',["unit_number"=>$houseUnitNumber,"building_number"=>$houseBuildingNumber,
    "door_number"=>$houseDoorNumber,"owner_id"=>$houseOwnerID,"house_status"=>$houseStatus,
    "community_id"=>$community_id[0]["community_id"],"square"=>$houseSquare]);

echo $res;
?>
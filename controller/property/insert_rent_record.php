<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 16:39
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$ownerRentID=$_POST["ownerRentID"];
$parkingRentID=$_POST["parkingRentID"];
$rentStartTime=$_POST["rentStartTime"];
$rentEndTime=$_POST["rentEndTime"];
$rentChargeTime=$_POST["rentChargeTime"];
$rentChargeMoney=$_POST["rentChargeMoney"];

$con=get_connection();
$res=insert_table($con,'parkingrentrecord',["owner_id"=>$ownerRentID,
    "parking_id"=>$parkingRentID,"start_time"=>$rentStartTime,"end_time"=>$rentEndTime,
    "charge_time"=>$rentChargeTime,"charge_money"=>$rentChargeMoney]);
echo $res;

?>
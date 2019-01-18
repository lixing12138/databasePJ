<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 16:04
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$parkingId=$_POST["parkingId"];
$plateNumber=$_POST["plateNumber"];
$parkingStartTime=$_POST["parkingStartTime"];
$parkingEndTime=$_POST["parkingEndTime"];
$parkingChargeMoney=$_POST["parkingChargeMoney"];
$parkingChargeTime=$_POST["parkingChargeTime"];

$con=get_connection();
$res=insert_table($con,'parkingrecord',["plate_number"=>$plateNumber,
    "parking_id"=>$parkingId,"start_time"=>$parkingStartTime,
    "end_time"=>$parkingEndTime,"charge_time"=>$parkingChargeTime,"charge_money"=>$parkingChargeMoney]);
echo $res;
?>
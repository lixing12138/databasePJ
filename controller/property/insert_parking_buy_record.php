<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 19:00
 */

require_once __DIR__.'/../../libs/mysql_connection.php';

$buyParkingId=$_POST["buyParkingId"];
$buyOwnerID=$_POST["buyOwnerID"];
$buyChargeMoney=$_POST["buyChargeMoney"];
$buyChargeTime=$_POST["buyChargeTime"];

$con=get_connection();
$res=insert_table($con,'parkingbuyrecord',["owner_id"=>$buyOwnerID,"parking_id"=>$buyParkingId,
    "charge_time"=>$buyChargeTime,"charge_money"=>$buyChargeMoney]);
echo $res;
?>
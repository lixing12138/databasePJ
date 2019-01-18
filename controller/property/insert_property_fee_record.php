<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 15:12
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$houseID=$_POST["houseID"];
$chargeDate=$_POST["chargeDate"];
$chargeMoney=$_POST["chargeMoney"];
$endTime=$_POST["endTime"];
$startTime=$_POST["startTime"];
$con=get_connection();

$res=insert_table($con,'propertyfeerecord',["house_id"=>$houseID,"start_time"=>$startTime,
    "end_time"=>$endTime,"charge_time"=>$chargeDate,"charge_money"=>$chargeMoney]);
echo $res;
?>
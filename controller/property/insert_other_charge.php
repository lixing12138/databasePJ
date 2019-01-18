<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 19:25
 */

require_once __DIR__.'/../../libs/mysql_connection.php';

$otherChargeSource=$_POST["otherChargeSource"];
$otherChargeTime=$_POST["otherChargeTime"];
$otherChargeMoney=$_POST["otherChargeMoney"];

$con=get_connection();
$res=insert_table($con,'othercharge',["charge_source"=>$otherChargeSource,
    "charge_time"=>$otherChargeTime,"charge_money"=>$otherChargeMoney]);
echo $res;
?>
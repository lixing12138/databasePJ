<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 18:36
 */

require_once __DIR__.'/../../libs/mysql_connection.php';

$ownerAdministrateID=$_POST["ownerAdministrateID"];
$parkingAdministrateID=$_POST["parkingAdministrateID"];
$administrateStartTime=$_POST["administrateStartTime"];
$administrateEndTime=$_POST["administrateEndTime"];
$administrateChargeTime=$_POST["administrateChargeTime"];
$administrateChargeMoney=$_POST["administrateChargeMoney"];


$con=get_connection();
$res=insert_table($con,'parkingadministratefee',["owner_id"=>$ownerAdministrateID,
    "parking_id"=>$parkingAdministrateID,"start_time"=>$administrateStartTime,"end_time"=>$administrateEndTime,
    "charge_time"=>$administrateChargeTime,"charge_money"=>$administrateChargeMoney]);
echo $res;
<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 20:04
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$con=get_connection();
$equipmentCheckID=$_POST["equipmentCheckID"];
$equipmentCheckTime=$_POST["equipmentCheckTime"];
$equipmentCheckSituation=$_POST["equipmentCheckSituation"];

$res=insert_table($con,'equipcheckrecord',["e_id"=>$equipmentCheckID,"check_time"=>$equipmentCheckTime,"e_status"=>$equipmentCheckSituation]);
echo $res;
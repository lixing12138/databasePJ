<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 23:54
 */

require_once __DIR__.'/../../libs/mysql_connection.php';

$baoxiuID=$_POST["baoxiuID"];//设备ID
$baoxiuTime=$_POST["baoxiuTime"];
$buildingNumber=$_POST["buildingNumber"];
$unitNumber=$_POST["unitNumber"];
$doorNumber=$_POST["doorNumber"];
$baoxiuItem=$_POST["baoxiuItem"];
$baoxiureason=$_POST["baoxiureason"];
$baoxiuSituation=$_POST["baoxiuSituation"];
$con=get_connection();
$res=insert_table($con,'equipbaoxiurecord',["e_id"=>$baoxiuID,"baoxiu_time"=>$baoxiuTime,
    "building_number"=>$buildingNumber,"unit_number"=>$unitNumber,"door_number"=>$doorNumber,
    "baoxiu_item"=>$baoxiuItem,"reason"=>$baoxiureason,"baoxiu_situation"=>$baoxiuSituation]);
echo $res;
?>
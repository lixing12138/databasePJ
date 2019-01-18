<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 21:43
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$equipmentRepairID=$_POST["equipmentRepairID"];
$equipmentSpendTime=$_POST["equipmentSpendTime"];
$equipmentSpendMoney=$_POST["equipmentSpendMoney"];

$con=get_connection();
$res=insert_table($con,'equiprepairrecord',["e_id"=>$equipmentRepairID,"spend_time"=>$equipmentSpendTime,"spend_money"=>$equipmentSpendMoney]);

echo $res;
?>
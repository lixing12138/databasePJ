<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 22:45
 */

require_once __DIR__ . '/../../libs/mysql_connection.php';

$con = get_connection();
$ownerId = $_POST["ownerId"];
$ownerName = $_POST["ownerName"];
$ownerPhone = $_POST["ownerPhone"];
$ownHouseId = $_POST["ownHouseId"];

$res_house = select_table_condition($con, 'house', ["house_id" => $ownHouseId]);
if ($res_house == null) {
    echo 2;//房屋不存在
} else {
    if ($res_house[0]["owner_id"] == null){
        echo insert_table($con,'owner',["owner_id"=>$ownerId,"owner_name"=>$ownerName,"owner_phone"=>$ownerPhone]);
        update_table($con,'house',["owner_id"=>$ownerId,"house_status"=>"占用"],"house_id",$ownHouseId);
    }else{
        echo 3;//房屋被占用
    }
}
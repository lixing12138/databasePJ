<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 22:07
 */
require_once __DIR__ . '/../../libs/mysql_connection.php';

$con = get_connection();


$householdId = $_POST["householdId"];
$householdName = $_POST["householdName"];
$householdPhone = $_POST["householdPhone"];
$houseId = $_POST["houseId"];

$res = select_table_condition($con, 'households', ["households_id" => $householdId]);
if ($res == null) {
    $result_house_id = select_table_condition($con, 'house', ["house_id" => $houseId]);
    if ($result_house_id == null) {
        echo 2;
    } else {
        $re = insert_table($con, 'households', ["households_id" => $householdId, "households_name" => $householdName,
            "households_phone" => $householdPhone, "house_id" => $houseId]);

        update_table($con, 'house', ["house_status" => "占用"], "house_id", $houseId);

        echo $re;
    }
} else {
    echo 3;
}

?>
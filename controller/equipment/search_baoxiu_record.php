<?php
///**
// * Created by PhpStorm.
// * User: lixin
// * Date: 2019/1/4
// * Time: 10:53
// */
//require_once __DIR__ . '/../../libs/mysql_connection.php';
//
//if (isset($_POST["baoxiuStartTime"]) && isset($_POST["baoxiuEndTime"])) {
//    $baoxiuStartTime = $_POST["baoxiuStartTime"];
//    $baoxiuEndTime = $_POST["baoxiuEndTime"];
////$baoxiuStartTime='2019-01-02 00:00';
////$baoxiuEndTime='2019-01-02 00:01';
//    $sql = "SELECT community_name,e_name,COUNT(baoxiu_id) FROM equipbaoxiurecord
//NATURAL JOIN equipment NATURAL JOIN community WHERE baoxiu_time<='" . $baoxiuEndTime . "'
//and baoxiu_time>='" . $baoxiuStartTime . "' group by e_name order by COUNT(baoxiu_id)";
//
//    $con = get_connection();
//    $stmt = $con->prepare($sql);;
//    $stmt->execute();
//    $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
////echo $res;
//?>
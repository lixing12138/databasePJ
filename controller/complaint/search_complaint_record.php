<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/5
 * Time: 14:17
 */

require_once __DIR__.'/../../libs/mysql_connection.php';


$compFCStartTime=$_POST["compFCStartTime"];
$compFCEndTime=$_POST["compFCEndTime"];
$compFCType=$_POST["compFCType"];

//$compFCStartTime="2018-01-01 00:00:00";
//$compFCEndTime="2020-01-01 00:00:00";
//$compFCType="楼宇";

$sql1 = "SELECT community_name,COUNT(complaint_id) AS complaint_count FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community
WHERE complaint_time>= '$compFCStartTime' AND complaint_time<= '$compFCEndTime'
GROUP BY community_name";
$sql2 ="SELECT community_name,building_number,COUNT(complaint_id) AS complaint_count FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community
WHERE complaint_time>= '$compFCStartTime' AND complaint_time<= '$compFCEndTime'
GROUP BY community_name,building_number";
$sql3 ="SELECT community_name,building_number,unit_number,COUNT(complaint_id) AS complaint_count FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community
WHERE complaint_time>= '$compFCStartTime' AND complaint_time<= '$compFCEndTime'
GROUP BY community_name,building_number,unit_number";
$sql4 ="SELECT community_name,building_number,unit_number,door_number,COUNT(community_id) AS complaint_count FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community
WHERE complaint_time>= '$compFCStartTime' AND complaint_time<= '$compFCEndTime'
GROUP BY community_name,building_number,unit_number,door_number";
$sql5 ="SELECT complaint_type,COUNT(complaint_id) AS complaint_count FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community
WHERE complaint_time>= '$compFCStartTime' AND complaint_time<= '$compFCEndTime'
GROUP BY complaint_type";
$con=get_connection();

$compFCResult=null;

$i1=0;
$stmt1 = $con->prepare($sql1);
$stmt1->execute();
$search_result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$i2=0;
$stmt2 = $con->prepare($sql2);
$stmt2->execute();
$search_result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$i3=0;
$stmt3 = $con->prepare($sql3);
$stmt3->execute();
$search_result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
$i4=0;
$stmt4 = $con->prepare($sql4);
$stmt4->execute();
$search_result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
$i5=0;
$stmt5 = $con->prepare($sql5);
$stmt5->execute();
$search_result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
if ($compFCType=="小区"){
    foreach ($search_result1 as $res1) {
        $compFCResult[$i1]["fcName"]=$res1["community_name"]."小区";
        $compFCResult[$i1]["fcCount"]=$res1["complaint_count"];
        $i1++;
    }
}else if ($compFCType=="楼宇"){
    foreach ($search_result2 as $res2) {
        $compFCResult[$i2]["fcName"]=$res2["community_name"]."小区".$res2["building_number"]."楼";
        $compFCResult[$i2]["fcCount"]=$res2["complaint_count"];
        $i2++;
    }
}else if($compFCType=="单元"){
    foreach ($search_result3 as $res3) {
        $compFCResult[$i3]["fcName"]=$res3["community_name"]."小区".$res3["building_number"]."楼".$res3["unit_number"]."单元";
        $compFCResult[$i3]["fcCount"]=$res3["complaint_count"];
        $i3++;
    }
}else if($compFCType=="户"){
    foreach ($search_result4 as $res4) {
        $compFCResult[$i4]["fcName"]=$res4["community_name"]."小区".$res4["building_number"]."楼".$res4["unit_number"]."单元".$res4["door_number"]."户";
        $compFCResult[$i4]["fcCount"]=$res4["complaint_count"];
        $i4++;
    }
}else if($compFCType=="投诉种类"){
    foreach ($search_result5 as $res5) {
        $compFCResult[$i5]["fcName"]=$res5["complaint_type"];
        $compFCResult[$i5]["fcCount"]=$res5["complaint_count"];
        $i5++;
    }
}else{
    $compFCResult[0]["fcName"]="";
    $compFCResult[0]["fcCount"]="";
}
if ($compFCResult == null){
    $compFCResult[0]["fcName"]="";
    $compFCResult[0]["fcCount"]="";
}
echo json_encode($compFCResult);
?>
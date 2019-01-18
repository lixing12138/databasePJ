<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/5
 * Time: 10:55
 */

require_once __DIR__ . '/../../libs/mysql_connection.php';

$con = get_connection();

$ownerSearchID=$_POST["ownerSearchID"];
$ownerSearchStartTime=$_POST["ownerSearchStartTime"];
$ownerSearchEndTime=$_POST["ownerSearchEndTime"] ;

//$ownerSearchID='23023019980816';
//$ownerSearchStartTime="2019-01-02 00:00:00";
//$ownerSearchEndTime="2019-02-10 00:00:00";
$sql1="SELECT house_id,square,community_id FROM house NATURAL JOIN owner NATURAL JOIN community WHERE owner_id= ".$ownerSearchID;
$sql2="SELECT house_id,Max(end_time) as endTime,charge_time from propertyfeerecord group by house_id";

$stmt=$con->prepare($sql1);
$stmt->execute();
$result= $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2=$con->prepare($sql2);
$stmt2->execute();
$result2= $stmt2->fetchAll(PDO::FETCH_ASSOC);
$propertyFee;//物业费
foreach ($result as $res){
    $i=0;
    $propertyFee[$i]["feeName"] = "物业费";
    $propertyFee[$i]["houseId"]="房屋ID".$res["house_id"];
    if ($res["community_id"]==1){
        $propertyFee[$i]["property"]=1*$res["square"];
    }else if ($res["community_id"]==2){
        $propertyFee[$i]["property"]=1.5*$res["square"];
    }else{
        $propertyFee[$i]["property"]=2*$res["square"];
    }
    $propertyFee[$i]["chargeStatus"] = "未缴费";
    $propertyFee[$i]["chargeTime"] = "---";
    $i=$i+1;
}

foreach ($result2 as $res2){
    for ($i = 0;$i<count($propertyFee);$i++){
        if ("房屋ID".$res2["house_id"] == $propertyFee[$i]["houseId"] &&
            $res2["endTime"] >= $ownerSearchEndTime){
            $propertyFee[$i]["chargeStatus"] = "已缴费";
            $propertyFee[$i]["chargeTime"] = $res2["charge_time"];
        }
    }
}

$sql3 = "SELECT parking_id FROM parking NATURAL JOIN parkingbuyrecord WHERE owner_id= ".$ownerSearchID;
$sql5 = "SELECT parking_id FROM parking NATURAL JOIN parkingrentrecord WHERE owner_id= ".$ownerSearchID;
$sql4 = "SELECT parking_id,Max(end_time) as endTime,charge_time from parkingadministratefee group by parking_id";

$stmt3=$con->prepare($sql3);
$stmt3->execute();
$result3= $stmt3->fetchAll(PDO::FETCH_ASSOC);

$stmt5=$con->prepare($sql3);
$stmt5->execute();
$result5= $stmt5->fetchAll(PDO::FETCH_ASSOC);

$stmt4=$con->prepare($sql4);
$stmt4->execute();
$result4= $stmt4->fetchAll(PDO::FETCH_ASSOC);
foreach ($result3 as $res3){
    $i=count( $propertyFee);
    $propertyFee[$i]["feeName"] = "车位管理费";
    $propertyFee[$i]["houseId"]="车位ID".$res3["parking_id"];
    $propertyFee[$i]["property"]="50";
    $propertyFee[$i]["chargeStatus"] = "未缴费";
    $propertyFee[$i]["chargeTime"] = "---";
    $i=$i+1;
}
foreach ($result5 as $res5){
    $i=count( $propertyFee);
    $propertyFee[$i]["feeName"] = "车位管理费";
    $propertyFee[$i]["houseId"]="车位ID".$res5["parking_id"];
    $propertyFee[$i]["property"]="50";
    $propertyFee[$i]["chargeStatus"] = "未缴费";
    $propertyFee[$i]["chargeTime"] = "---";
    $i=$i+1;
}

foreach ($result4 as $res4){
    for ($i = 0;$i<count($propertyFee);$i++){
        if ("车位ID".$res4["parking_id"] == $propertyFee[$i]["houseId"] &&
            $res4["endTime"] >= $ownerSearchEndTime){
            $propertyFee[$i]["chargeStatus"] = "已缴费";
            $propertyFee[$i]["chargeTime"] = $res4["charge_time"];
        }
    }
}
echo json_encode($propertyFee);

?>
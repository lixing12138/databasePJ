<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/4
 * Time: 21:44
 */
require_once __DIR__.'/../../libs/mysql_connection.php';

$con=get_connection();
$compHouseholdsId=$_POST["compHouseholdsId"];
$compTime=$_POST["compTime"];
$compType=$_POST["compType"];
$compReason=$_POST["compReason"] ;
$compStep=$_POST["compStep"];
$result=$_POST["result"];

if (select_table_condition($con,'households',["households_id"=>$compHouseholdsId])){
    $res=insert_table($con,'complaintrecord',["households_id"=>$compHouseholdsId,
        "complaint_type"=>$compType,"reason"=>$compReason,"status"=>$compStep,"result"=>$result,"complaint_time"=>$compTime]);
    echo $res;
}else{
    echo 3;//用户不存在
}

?>
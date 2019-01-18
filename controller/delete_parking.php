<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 17:02
 */

require_once __DIR__.'/../libs/mysql_connection.php';
$parking_id=$_POST["parking_id"];
$con=get_connection();
echo delete_table($con,'parking',"parking_id",$parking_id);
?>
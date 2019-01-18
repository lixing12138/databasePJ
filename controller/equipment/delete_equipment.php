<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/3
 * Time: 18:51
 */
require_once __DIR__.'/../../libs/mysql_connection.php';
$eId=$_POST["e_id"];
$con=get_connection();
echo delete_table($con,'equipment',"e_id",$eId);
?>
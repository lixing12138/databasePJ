<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物业管理系统</title>
    <link rel="stylesheet" href="../css/charge_administrate.css">
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header"><p>物业管理系统</p></div>

<div class="container">
    <p class="title">物业费查询</p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="term">房屋ID</th>
            <th class="term">小区名</th>
            <th class="term">楼号</th>
            <th class="term">单元号</th>
            <th class="term">房门号</th>
            <th class="term">面积</th>
            <th class="term">每月物业费</th>
            <th class="term">缴费起始日期</th>
            <th class="term">缴费结束日期</th>
            <th class="term">缴费金额</th>
            <th class="term">缴费时间</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /**
         * Created by PhpStorm.
         * User: lixin
         * Date: 2019/1/4
         * Time: 13:39
         */
        require_once __DIR__ . '/../libs/mysql_connection.php';

        $ownerID = $_POST["ownerID"];
        $con = get_connection();
        $result = select_table_condition($con, 'owner', ["owner_id"=>$ownerID]);
        if ($result!=null){
            echo "身份证号码：".$ownerID."<br>";
            echo "业主名：".$result[0]["owner_name"];

            $sql = "SELECT house_id,community_id,community_name,building_number,unit_number,door_number,square,
start_time,end_time,charge_time,charge_money FROM owner NATURAL JOIN house NATURAL JOIN 
community NATURAL JOIN propertyfeerecord WHERE owner_id = ".$ownerID;

            $con = get_connection();
            $stmt = $con->prepare($sql);;
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($search_result as $res) {
                $propertyFee=0;
                $square=$res["square"];
                if ($res["community_id"]==1) {
                    $propertyFee=$square*1;
                }else if($res["community_id"]==2){
                    $propertyFee=$square*1.5;
                }else{
                    $propertyFee=$square*2;
                }
                echo "<tr><td class='term'>" . $res["house_id"] . "</td><td class='term'>" . $res["community_name"] . "</td><td class='term'>" . $res["building_number"] .
                    "</td><td class='term'>" . $res["unit_number"] . "</td><td class='term'>" . $res["door_number"] .  "</td><td class='term'>" . $res["square"] .
                    "</td><td class='term'>" . $propertyFee . "</td><td class='term'>" . $res["start_time"] . "</td><td class='term'>" . $res["end_time"] .
                    "</td><td class='term'>" . $res["charge_money"]. "</td><td class='term'>" . $res["charge_time"]."</td></tr>";
            }

        }else{
            echo "户主不存在";
        }

        ?>
        </tbody>
    </table>
</div>
</body>
</html>

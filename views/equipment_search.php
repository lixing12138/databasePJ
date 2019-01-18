<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物业管理系统</title>
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/equipment.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if (isset($_POST["baoxiuStartTime"]) && isset($_POST["baoxiuEndTime"])) {
    $baoxiuStartTime = $_POST["baoxiuStartTime"];
    $baoxiuEndTime = $_POST["baoxiuEndTime"];
}
?>
<div class="header"><p>物业管理系统</p></div>
<div class="container" style="margin-top: 100px">

    <div class="count">
        <p style="text-align: center;font-size: 20px">设备类目报修次数统计表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">小区名</th>
                <th class="term">设备类目</th>
                <th class="term">报修次数</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * Created by PhpStorm.
             * User: lixin
             * Date: 2019/1/4
             * Time: 12:01
             */
            //echo $_POST["baoxiuEndTime"];
            //echo $_POST["baoxiuStartTime"];

            require_once __DIR__ . '/../libs/mysql_connection.php';

            $sql = "SELECT community_name,e_name,COUNT(baoxiu_id) FROM equipbaoxiurecord
NATURAL JOIN equipment NATURAL JOIN community WHERE baoxiu_time<='" . $baoxiuEndTime . "'
and baoxiu_time>='" . $baoxiuStartTime . "' group by e_name order by COUNT(baoxiu_id)";

            $con = get_connection();
            $stmt = $con->prepare($sql);;
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //            echo var_dump($search_result);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["community_name"] . "</td><td class='term'>" . $res["e_name"] . "</td><td class='term'>" . $res["COUNT(baoxiu_id)"] . "</td></tr>";
            }

            //echo $res;
            ?>
            </tbody>
        </table>
    </div>

    <div class="householdsStatistics">
        <p style="text-align: center;font-size: 20px">户报修次数统计表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">小区名</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">房门号</th>
                <th class="term">报修次数</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';

            $sql = "SELECT community_name,building_number,unit_number,door_number, 
COUNT(baoxiu_id) FROM equipbaoxiurecord NATURAL JOIN equipment NATURAL JOIN community 
WHERE baoxiu_time<= '" . $baoxiuEndTime . "' AND baoxiu_time>='" . $baoxiuStartTime . "'";

            $con = get_connection();
            $stmt = $con->prepare($sql);;
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //            echo var_dump($search_result);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["community_name"] . "</td><td class='term'>" . $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] . "</td><td class='term'>" . $res["door_number"] . "</td><td class='term'>" . $res["COUNT(baoxiu_id)"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="repairCount">
        <p style="text-align: center;font-size: 20px">设备维修（损坏）次数统计表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">小区名</th>
                <th class="term">设备ID</th>
                <th class="term">设备名称</th>
                <th class="term">维修次数</th>
                <th class="term">维修费用</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * Created by PhpStorm.
             * User: lixin
             * Date: 2019/1/4
             * Time: 12:01
             */

            require_once __DIR__ . '/../libs/mysql_connection.php';

            $sql = "SELECT community_name,e_id,e_name,COUNT(repair_id),SUM(spend_money) 
FROM community NATURAL JOIN equiprepairrecord NATURAL JOIN equipment WHERE 
spend_time<='" . $baoxiuEndTime . "' AND spend_time>='" . $baoxiuStartTime . "' GROUP BY e_id order by COUNT(repair_id)";

            $con = get_connection();
            $stmt = $con->prepare($sql);;
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //            echo var_dump($search_result);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["community_name"] . "</td><td class='term'>" . $res["e_id"] . "</td><td class='term'>" . $res["e_name"] . "</td><td class='term'>" . $res["COUNT(repair_id)"] .
                    "</td><td class='term'>" . $res["SUM(spend_money)"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="totalRepairMoney">
        <?php
        $sql="SELECT SUM(spend_money) FROM equiprepairrecord WHERE 
spend_time<='".$baoxiuEndTime."' AND spend_time>='".$baoxiuStartTime."'";

        $conn=get_connection();
        $stmt = $conn->prepare($sql);;
        $stmt->execute();
        $total_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<p style='text-align: right'>总维修费用为：".$total_result[0]["SUM(spend_money)"]."</p>";
        ?>
    </div>

</div>
</body>
</html>

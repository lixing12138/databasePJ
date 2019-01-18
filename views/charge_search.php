<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物业管理系统</title>
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/charge_administrate.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<?php
if (isset($_POST["chargeStartTime"]) && isset($_POST["chargeEndTime"])) {
    $feeStartTime = $_POST["chargeStartTime"];
    $feeEndTime = $_POST["chargeEndTime"];
}
?>
<div class="header"><p>物业管理系统</p></div>
<div class="container" style="margin-top: 100px">
    <div class="householdsStatistics">
        <p style="text-align: center;font-size: 20px">收费费用统计表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">物业费收入</th>
                <th class="term">停车费收入</th>
                <th class="term">车位出租费收入</th>
                <th class="term">车位出售费收入</th>
                <th class="term">车位管理费收入</th>
                <th class="term">其他费用收入</th>
                <th class="term">设备维修支出</th>
                <th class="term">总收入</th>
                <th class="term">总支出</th>
                <th class="term">总盈利</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';


            $sql1 = "SELECT SUM(propertyfeerecord.charge_money) AS propertyfee FROM propertyfeerecord WHERE charge_time>='" . $feeStartTime . "'AND charge_time<='" . $feeEndTime . "'";
            $sql2 = "SELECT SUM(parkingrecord.charge_money) AS parkingfee FROM parkingrecord WHERE charge_time>='$feeStartTime ' AND charge_time<=' $feeEndTime '";
            $sql3 = "SELECT SUM(parkingrentrecord.charge_money) AS parkingrentfee FROM parkingrentrecord WHERE charge_time>='" . $feeStartTime . "' AND charge_time<='" . $feeEndTime . "'";
            $sql4 = "SELECT SUM(parkingbuyrecord.charge_money) AS parkingbuyfee FROM parkingbuyrecord WHERE charge_time>='" . $feeStartTime . "' AND charge_time<='" . $feeEndTime . "'";
            $sql5 = "SELECT SUM(parkingadministratefee.charge_money) AS parkingadministratefee FROM parkingadministratefee WHERE charge_time>='$feeStartTime' AND charge_time<='$feeEndTime'";
            $sql6 = "SELECT SUM(othercharge.charge_money) AS otherfee FROM othercharge WHERE charge_time>='$feeStartTime' AND charge_time<='$feeEndTime'";
            $sql7 = "SELECT SUM(equiprepairrecord.spend_money) AS equiprepairfee FROM equiprepairrecord WHERE spend_time>='$feeStartTime' AND spend_time<='$feeEndTime'";

            $con = get_connection();
            $stmt1 = $con->prepare($sql1);;
            $stmt1->execute();
            $charge_res1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            $stmt2 = $con->prepare($sql2);;
            $stmt2->execute();
            $charge_res2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $stmt3 = $con->prepare($sql3);;
            $stmt3->execute();
            $charge_res3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

            $stmt4 = $con->prepare($sql4);;
            $stmt4->execute();
            $charge_res4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

            $stmt5 = $con->prepare($sql5);;
            $stmt5->execute();
            $charge_res5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

            $stmt6 = $con->prepare($sql6);;
            $stmt6->execute();
            $charge_res6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);

            $stmt7 = $con->prepare($sql7);;
            $stmt7->execute();
            $charge_res7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);

            $totalCharge=$charge_res1[0]["propertyfee"]+$charge_res2[0]["parkingfee"]+$charge_res3[0]["parkingrentfee"]+$charge_res4[0]["parkingbuyfee"]+
                $charge_res5[0]["parkingadministratefee"]+ $charge_res6[0]["otherfee"];
            $totalSpend=$charge_res7[0]["equiprepairfee"];
            $profit=$totalCharge-$totalSpend;
            echo "<tr><td class='term'>" . $charge_res1[0]["propertyfee"] . "</td><td class='term'>" .
                $charge_res2[0]["parkingfee"] . "</td><td class='term'>" . $charge_res3[0]["parkingrentfee"] . "</td><td class='term'>" .
                $charge_res4[0]["parkingbuyfee"] . "</td><td class='term'>" . $charge_res5[0]["parkingadministratefee"] . "</td><td class='term'>" .
                $charge_res6[0]["otherfee"] . "</td><td class='term'>" . $charge_res7[0]["equiprepairfee"] ."</td><td class='term'>". $totalCharge . "</td><td class='term'>"
                . $totalSpend . "</td><td class='term'>" . $profit . "</td></tr>";
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

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
    <script src="../js/charge_administrate.js"></script>

    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<div class="header"><p>物业管理系统</p></div>

<div class="container">
    <p class="title">费用管理系统</p>
    <div class="property">
        <p style="text-align: center;font-size: 20px">物业费列表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">房屋ID</th>
                <th class="term">起始时间</th>
                <th class="term">结束时间</th>
                <th class="term">付费时间</th>
                <th class="term">付费金额</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * Created by PhpStorm.
             * User: lixin
             * Date: 2019/1/4
             * Time: 13:23
             */
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'propertyfeerecord', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["house_id"] . "</td><td class='term'>" . $res["start_time"] . "</td><td class='term'>" . $res["end_time"] . "</td><td class='term'>" . $res["charge_time"] . "</td><td class='term'>" . $res["charge_money"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <p style="text-align: center;font-size: 20px">业主物业费缴纳历史查询</p>
        <form action="search_propertyfee.php" method="post" enctype="multipart/form-data">
            <div class="content">
                <label for="ownerID">业主身份证号：</label>
                <input class="form-control" id="ownerID" name="ownerID" minlength="2"
                       type="text" placeholder="请输入业主身份证号码" required>
            </div>
            <button type="submit" class="btn btn-primary float-right" style="margin: 20px">查询</button>
            <div class="clearfix"></div>
        </form>
    </div>

    <div class="property">
        <p style="text-align: center;font-size: 20px">物业费缴纳</p>
        <div class="content">
            <label for="houseID">房屋ID：</label>
            <input class="form-control" id="houseID" name="houseID" minlength="2"
                   type="text" placeholder="请输入房屋ID" required>
        </div>
        <div class="content">
            <label for="startDate">开始日期（请选择月初）：</label>
            <input class="form-control" id="startDate" name="startDate" minlength="2"
                   type="datetime-local" required>
        </div>
        <div class="content">
            <label for="endDate">结束日期（请选择月末）：</label>
            <input class="form-control" id="endDate" name="endDate" minlength="2"
                   type="datetime-local" required>
        </div>
        <div class="content">
            <label for="chargeDate">缴费日期：</label>
            <input class="form-control" id="chargeDate" name="chargeDate" minlength="2"
                   type="datetime-local" required>
        </div>
        <div class="content">
            <label for="chargeMoney">缴费金额：</label>
            <input class="form-control" id="chargeMoney" name="chargeMoney" minlength="2"
                   type="text" placeholder="请输入缴费金额（元）" required>
        </div>
        <button id="addFee" class="btn btn-primary float-right" style="margin: 20px">确定缴费</button>
        <div class="clearfix"></div>
    </div>

    <div class="parkingTemp">
        <div class="parkingRecordList">
            <p style="text-align: center;font-size: 20px">临时停车费用记录</p>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="term">车位ID</th>
                    <th class="term">车牌号</th>
                    <th class="term">停放起始时间</th>
                    <th class="term">停放结束时间</th>
                    <th class="term">停车费</th>
                    <th class="term">缴费时间</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once __DIR__ . '/../libs/mysql_connection.php';
                $con = get_connection();
                $result = select_table_condition($con, 'parkingrecord', []);
                foreach ($result as $res) {
                    echo "<tr><td class='term'>" . $res["parking_id"] . "</td><td class='term'>" . $res["plate_number"] . "</td><td class='term'>" . $res["start_time"] . "</td><td class='term'>" . $res["end_time"] . "</td><td class='term'>" . $res["charge_money"] . "</td><td class='term'>" . $res["charge_time"] . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                    data-target="#addParkingRecord" style="margin:20px;">添加停车记录
            </button>
            <div class="clearfix"></div>
            <div id="addParkingRecord" class="collapse">
                <div class="content">
                    <label for="parkingId">车位ID：</label>
                    <input class="form-control" id="parkingId" minlength="1"
                           type="text" placeholder="请输入车位ID" required>
                </div>
                <div class="content">
                    <label for="plateNumber">车牌号：</label>
                    <input class="form-control" id="plateNumber" minlength="2"
                           type="text" placeholder="请输入车牌号" required>
                </div>
                <div class="content">
                    <label for="parkingStartTime">停放起始时间：</label>
                    <input class="form-control" id="parkingStartTime" minlength="2"
                           type="datetime-local" required>
                </div>
                <div class="content">
                    <label for="parkingEndTime">停放结束时间：</label>
                    <input class="form-control" id="parkingEndTime" minlength="2"
                           type="datetime-local" required>
                </div>
                <div class="content">
                    <label for="parkingChargeTime">停放缴费时间：</label>
                    <input class="form-control" id="parkingChargeTime" minlength="2"
                           type="datetime-local" required>
                </div>
                <div class="content">
                    <label for="parkingChargeMoneyMoney">停车费：</label>
                    <input class="form-control" id="parkingChargeMoney" minlength="2"
                           type="text" placeholder="请输入停车费" required>
                </div>
                <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                        id="addParkingRecordSingle" style="margin:20px;">确定添加
                </button>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="rentParking">
        <p style="text-align: center;font-size: 20px">车位租用记录</p>
        <!--        <form class="form-inline">-->
        <!--            <label for="keyword">关键字：</label>-->
        <!--            <input type="text" id="keyword" name="keyword" placeholder="请输入户主ID">-->
        <!--            <button type="submit" class="btn btn-primary">查询</button>-->
        <!--        </form>-->
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">户主ID</th>
                <th class="term">车位ID</th>
                <th class="term">租用起始时间</th>
                <th class="term">租用结束时间</th>
                <th class="term">缴费时间</th>
                <th class="term">缴费金额</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'parkingrentrecord', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["owner_id"] . "</td><td class='term'>" .
                    $res["parking_id"] . "</td><td class='term'>" . $res["start_time"] .
                    "</td><td class='term'>" . $res["end_time"] . "</td><td class='term'>" .
                    $res["charge_time"] . "</td><td class='term'>" . $res["charge_money"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addRentRecordContent" style="margin:20px;">添加停车记录
        </button>
        <div class="clearfix"></div>
        <div id="addRentRecordContent" class="collapse">
            <div class="content">
                <label for="ownerRentID">户主ID：</label>
                <input class="form-control" id="ownerRentID" minlength="1"
                       type="text" placeholder="请输入户主ID" required>
            </div>
            <div class="content">
                <label for="parkingRentID">车位ID：</label>
                <input class="form-control" id="parkingRentID" minlength="2"
                       type="text" placeholder="请输入车位ID" required>
            </div>
            <div class="content">
                <label for="rentStartTime">停放起始时间：</label>
                <input class="form-control" id="rentStartTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="rentEndTime">停放结束时间：</label>
                <input class="form-control" id="rentEndTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="rentChargeTime">停放缴费时间：</label>
                <input class="form-control" id="rentChargeTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="rentChargeMoneyMoney">停车费：</label>
                <input class="form-control" id="rentChargeMoney" minlength="2"
                       type="text" placeholder="请输入停车费" required>
            </div>
            <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                    id="addRentRecord" style="margin:20px;">确定添加
            </button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="buyRecord">
        <div class="parkingBuyRecordList">
            <p style="text-align: center;font-size: 20px">车位购买费用列表</p>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="term">车位ID</th>
                    <th class="term">所在小区</th>
                    <th class="term">车位位置</th>
                    <th class="term">业主身份证</th>
                    <th class="term">业主姓名</th>
                    <th class="term">费用</th>
                    <th class="term">缴费时间</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once __DIR__ . '/../libs/mysql_connection.php';
                $sql = "SELECT parking_id,community_name,parking_location,owner_id,owner_name,charge_money,charge_time
FROM parkingbuyrecord NATURAL JOIN parking NATURAL JOIN owner NATURAL JOIN community";
                $con = get_connection();
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($search_result as $res) {
                    echo "<tr><td class='term'>" . $res["parking_id"] . "</td><td class='term'>" . $res["community_name"] . "</td>
                           <td class='term'>" . $res["parking_location"] . "</td><td class='term'>" . $res["owner_id"] . "</td>
                           <td class='term'>" . $res["owner_name"] . "</td><td class='term'>" . $res["charge_money"] . "</td>
                           <td class='term'>" . $res["charge_time"] . "</td></tr>";
                }
                ?>
            </table>

            <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                    data-target="#addBuyRecord" style="margin:20px;">添加车位购买记录
            </button>
            <div class="clearfix"></div>
            <div id="addBuyRecord" class="collapse">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="term">小区</th>
                        <th class="term">车位价格(万元)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class='term'>A</td>
                        <td class='term'>20</td>
                    </tr>
                    <tr>
                        <td class='term'>B</td>
                        <td class='term'>22</td>
                    </tr>
                    <tr>
                        <td class='term'>C</td>
                        <td class='term'>24</td>
                    </tr>
                    </tbody>
                </table>
                <div class="content">
                    <label for="parkingId">车位ID：</label>
                    <input class="form-control" id="buyParkingId" minlength="1"
                           type="text" placeholder="请输入车位ID" required>
                </div>
                <div class="content">
                    <label for="plateNumber">业主身份证号：</label>
                    <input class="form-control" id="buyOwnerID" minlength="2"
                           type="text" placeholder="请输入业主身份证号" required>
                </div>
                <div class="content">
                    <label for="chargeMoney">车位购买费：</label>
                    <input class="form-control" id="buyChargeMoney" minlength="2"
                           type="text" placeholder="请输入车位购买费" required>
                </div>
                <div class="content">
                    <label for="chargeTime">缴费时间：</label>
                    <input class="form-control" id="buyChargeTime" minlength="2"
                           type="datetime-local" required>
                </div>
                <button id="addBuyParking" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="parkingAdministrateFee">
        <p style="text-align: center;font-size: 20px">车位管理费记录</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">户主ID</th>
                <th class="term">车位ID</th>
                <th class="term">租用起始时间</th>
                <th class="term">租用结束时间</th>
                <th class="term">缴费时间</th>
                <th class="term">缴费金额</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'parkingadministratefee', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["owner_id"] . "</td><td class='term'>" .
                    $res["parking_id"] . "</td><td class='term'>" . $res["start_time"] .
                    "</td><td class='term'>" . $res["end_time"] . "</td><td class='term'>" .
                    $res["charge_time"] . "</td><td class='term'>" . $res["charge_money"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addAdministrateRecordContent" style="margin:20px;">添加停车记录
        </button>
        <div class="clearfix"></div>
        <div id="addAdministrateRecordContent" class="collapse">
            <div class="content">
                <label for="ownerAdministrateID">户主ID：</label>
                <input class="form-control" id="ownerAdministrateID" minlength="1"
                       type="text" placeholder="请输入户主ID" required>
            </div>
            <div class="content">
                <label for="parkingAdministrateID">车位ID：</label>
                <input class="form-control" id="parkingAdministrateID" minlength="2"
                       type="text" placeholder="请输入车位ID" required>
            </div>
            <div class="content">
                <label for="AdministrateStartTime">停放起始时间：</label>
                <input class="form-control" id="administrateStartTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="administrateEndTime">停放结束时间：</label>
                <input class="form-control" id="administrateEndTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="administrateChargeTime">停放缴费时间：</label>
                <input class="form-control" id="administrateChargeTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="administrateChargeMoneyMoney">停车费：</label>
                <input class="form-control" id="administrateChargeMoney" minlength="2"
                       type="text" placeholder="请输入停车费" required>
            </div>
            <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                    id="addAdministrateRecord" style="margin:20px;">确定添加
            </button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="otherCharge">
        <p style="text-align: center;font-size: 20px">其他收入</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">收入来源</th>
                <th class="term">时间</th>
                <th class="term">金额</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'othercharge', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["charge_source"] . "</td><td class='term'>" . $res["charge_time"] .
                    "</td><td class='term'>" . $res["charge_money"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addOtherRecordContent" style="margin:20px;">添加停车记录
        </button>
        <div class="clearfix"></div>
        <div id="addOtherRecordContent" class="collapse">
            <div class="content">
                <label for="otherChargeSource">收入来源</label>
                <input class="form-control" id="otherChargeSource" minlength="1"
                       type="text" placeholder="请输入收入来源" required>
            </div>
            <div class="content">
                <label for="otherChargeTime">时间：</label>
                <input class="form-control" id="otherChargeTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="otherChargeMoney">金额：</label>
                <input class="form-control" id="otherChargeMoney" minlength="2"
                       type="text" placeholder="请输入金额" required>
            </div>
            <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                    id="addOther" style="margin:20px;">确定添加
            </button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="chargeStatistics">
        <p style="text-align: center;font-size: 20px">费用统计查询</p>
        <form action="charge_search.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="chargeStartTime">选择开始时间：</label>
                <input class="form-control" id="chargeStartTime" name="chargeStartTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="form-group">
                <label for="chargeEndTime">选择结束时间：</label>
                <input class="form-control" id="chargeEndTime"  name="chargeEndTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <button type="submit" class="btn btn-primary float-right" style="margin: 20px">查询</button>
            <div class="clearfix"></div>
        </form>
    </div>


</div>
<footer style="margin-top: 100px;height: 100px"></footer>
</body>
</html>

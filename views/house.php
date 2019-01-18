<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物业管理系统</title>
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/house.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="../js/house.js"></script>
</head>
<body>
<div class="header"><p>物业管理系统</p></div>
<div class="container">
    <p class="title">住房管理系统</p>
    <div class="houseList">
        <p style="text-align: center;font-size: 20px">空闲房屋列表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">房屋ID</th>
                <th class="term">所在小区</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">门号</th>
                <th class="term">房屋状态</th>
                <th class="term">房屋面积</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $sql = "SELECT house_id,community_name,building_number,
unit_number,door_number,house_status,square FROM house NATURAL JOIN community WHERE house_status='空闲'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" .
                    $res["house_id"] . "</td><td class='term'>" . $res["community_name"] . "</td><td class='term'>" .
                    $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] . "</td><td class='term'>" .
                    $res["door_number"] . "</td><td class='term'>" . $res["house_status"] . "</td><td class='term'>" .
                    $res["square"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addHouseContent" style="margin:20px;">添加房屋
        </button>
        <div class="clearfix"></div>
        <div id="addHouseContent" class="collapse">
            <div class="content">
                <label for="houseOwnerID">户主身份证号：</label>
                <input class="form-control" id="houseOwnerID" minlength="2"
                       type="text" placeholder="请输入户主身份证号" required>
            </div>
            <div class="content">
                <label for="houseCommunity">选择所在小区：</label>
                <select class="form-control" name="houseCommunity" id="houseCommunity">
                    <option>请选择所在小区</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
            </div>
            <div class="content">
                <label for="houseBuildingNumber">楼号：</label>
                <input class="form-control" id="houseBuildingNumber" minlength="2"
                       type="text" placeholder="请输入房屋楼号" required>
            </div>
            <div class="content">
                <label for="houseUnitNumber">单元号：</label>
                <input class="form-control" id="houseUnitNumber" minlength="2"
                       type="text" placeholder="请输入房屋单元号" required>
            </div>
            <div class="content">
                <label for="houseDoorNumber">房门号：</label>
                <input class="form-control" id="houseDoorNumber" minlength="2"
                       type="text" placeholder="请输入房门号" required>
            </div>
            <div class="content">
                <label for="houseStatus">房屋状态：</label>
                <input class="form-control" id="houseStatus" minlength="2"
                       type="text" placeholder="请输入房屋状态" required>
            </div>
            <div class="content">
                <label for="houseSquare">房屋面积：</label>
                <input class="form-control" id="houseSquare" minlength="2"
                       type="text" placeholder="请输入房屋面积" required>
            </div>
            <button id="addHouse" class="btn btn-primary float-right" style="margin: 20px">添加房屋</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="searchHouseContent">
        <div class="form-inline mx-auto" style="width: 1000px;" role="form">
            <div class="form-group">
                <label class="sr-only" for="search_community">小区</label>
                <input type="text" class="form-control" id="search_community"
                       placeholder="请输入小区，可以为空">
            </div>
            <div class="form-group">
                <label class="sr-only" for="name">楼号</label>
                <input type="text" class="form-control" id="search_building"
                       placeholder="请输入楼号，可以为空">
            </div>
            <div class="form-group">
                <label class="sr-only" for="name">单元号</label>
                <input type="text" class="form-control" id="search_unit"
                       placeholder="请输入小区，可以为空">
            </div>
            <div class="form-group">
                <label class="sr-only" for="name">门号</label>
                <input type="text" class="form-control" id="search_door"
                       placeholder="请输入楼号，可以为空">
            </div>
            <button type="button" class="btn btn-primary" id="searchFreeHouse">查询</button>
        </div>
        <p style='text-align: center'>查询结果显示</p>

        <table class="table table-hover" id="search_result" style="margin-top: 10px;">

        </table>
    </div>

    <div class="houseHoldsRecordList">
        <p style="text-align: center;font-size: 20px">住户信息登记</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">住户身份证</th>
                <th class="term">住户姓名</th>
                <th class="term">住户手机号</th>
                <th class="term">所在小区</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">房门号</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $sql = "SELECT households_id,households_name,households_phone,community_name,building_number,unit_number,door_number
FROM households NATURAL JOIN house NATURAL JOIN community;";
            $con = get_connection();
            $stmt = $con->prepare($sql);
            $stmt->execute();
                $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["households_id"] . "</td><td class='term'>" . $res["households_name"] . "</td>
                           <td class='term'>" . $res["households_phone"] . "</td><td class='term'>" . $res["community_name"] . "</td>
                           <td class='term'>" . $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] . "</td>
                           <td class='term'>" . $res["door_number"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addHousehold" style="margin:20px;">添加住户信息
        </button>
        <div class="clearfix"></div>
        <div id="addHousehold" class="collapse">
            <div class="content">
                <label for="householdId">住户身份证号：</label>
                <input class="form-control" id="householdId" minlength="1"
                       type="text" placeholder="请输入身份证号" required>
            </div>
            <div class="content">
                <label for="householdName">住户姓名：</label>
                <input class="form-control" id="householdName" minlength="1"
                       type="text" placeholder="住户姓名" required>
            </div>
            <div class="content">
                <label for="householdPhone">住户手机号：</label>
                <input class="form-control" id="householdPhone" minlength="1"
                       type="text" placeholder="请输入手机号" required>
            </div>
            <div class="content">
                <label for="houseId">所在房屋ID：</label>
                <input class="form-control" id="houseId" minlength="1"
                       type="text" placeholder="请输入房屋ID" required>
            </div>
            <button id="addHouseholds" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="houseOwnersRecordList">
        <p style="text-align: center;font-size: 20px">业主信息登记</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">业主身份证</th>
                <th class="term">业主姓名</th>
                <th class="term">业主手机号</th>
                <th class="term">所在小区</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">房门号</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $sql = "SELECT owner_id,owner_name,owner_phone,community_name,building_number,unit_number,door_number
FROM owner NATURAL JOIN house NATURAL JOIN community;";
            $con = get_connection();
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["owner_id"] . "</td><td class='term'>" . $res["owner_name"] . "</td>
                           <td class='term'>" . $res["owner_phone"] . "</td><td class='term'>" . $res["community_name"] . "</td>
                           <td class='term'>" . $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] . "</td>
                           <td class='term'>" . $res["door_number"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addOwnerContent" style="margin:20px;">添加业主信息
        </button>
        <div class="clearfix"></div>
        <div id="addOwnerContent" class="collapse">
            <div class="content">
                <label for="ownerId">业主身份证号：</label>
                <input class="form-control" id="ownerId" minlength="1"
                       type="text" placeholder="请输入身份证号" required>
            </div>
            <div class="content">
                <label for="ownerName">业主姓名：</label>
                <input class="form-control" id="ownerName" minlength="1"
                       type="text" placeholder="住户姓名" required>
            </div>
            <div class="content">
                <label for="ownerPhone">业主手机号：</label>
                <input class="form-control" id="ownerPhone" minlength="1"
                       type="text" placeholder="请输入手机号" required>
            </div>
            <div class="content">
                <label for="ownHouseId">所购房屋ID：</label>
                <input class="form-control" id="ownHouseId" minlength="1"
                       type="text" placeholder="请输入房屋ID" required>
            </div>
            <button id="addOwner" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="ownerChargeSearch">
        <p style="text-align: center;font-size: 20px">业主缴费查询</p>
        <div class="content">
            <label for="OwnerSearchID">户主身份证号：</label>
            <input class="form-control" id="OwnerSearchID" minlength="2"
                   type="text" placeholder="请输入户主身份证号" required>
        </div>
        <div class="content">
            <label for="ownerSearchStartTime">选择开始时间：</label>
            <input class="form-control" id="ownerSearchStartTime"  minlength="2"
                   type="datetime-local" required>
        </div>
        <div class="content">
            <label for="ownerSearchEndTime">选择结束时间：</label>
            <input class="form-control" id="ownerSearchEndTime"  minlength="2"
                   type="datetime-local" required>
        </div>
        <button type="button" id="searchCharge" class="btn btn-primary float-right" style="margin: 20px">查询</button>
        <div class="clearfix"></div>
    </div>
    <table id="ownerChargeSearch" class="table table-hover">

    </table>
</div>

</body>
<footer style="margin-top: 100px;height: 100px;"></footer>
</html>

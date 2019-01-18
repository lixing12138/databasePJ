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
    <script src="../js/equipment.js"></script>
</head>
<body>
<div class="header"><p>物业管理系统</p></div>
<div class="container">
    <p class="title">设备管理系统</p>
    <div class="equipmentList">
        <p style="text-align: center;font-size: 20px">设备列表</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">设备ID</th>
                <th class="term">设备名称</th>
                <th class="term">设备位置</th>
                <th class="term">设备价格</th>
                <th class="term">设备类别</th>
                <th class="term">所在小区</th>
                <th class="term">删除</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'equipment', []);
            foreach ($result as $res) {
                $searchID = $res["community_id"];
                $community_res = select_table_condition($con, 'community', ["community_id" => $searchID]);
                echo "<tr><td class='term'>" . $res["e_id"] . "</td><td class='term'>" . $res["e_name"] . "</td><td class='term'>" . $res["e_location"] . "</td><td class='term'>" . $res["e_price"] . "</td><td class='term'>" . $res["e_type"] . "</td><td class='term'>" . $community_res[0]["community_name"] . "</td><td class='term'><a href='#'onclick='deleteEquipment(" . $res['e_id'] . ")'>删除</a>" . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addContentEquipment" style="margin:20px;">添加设备
        </button>
        <div class="clearfix"></div>
        <div id="addContentEquipment" class="collapse">
            <div class="content">
                <label for="equipmentName">设备名称：</label>
                <input class="form-control" id="equipmentName" minlength="1"
                       type="text" placeholder="请输入设备名称" required>
            </div>
            <div class="content">
                <label for="equipmentLocation">设备位置：</label>
                <input class="form-control" id="equipmentLocation" minlength="2"
                       type="text" placeholder="请输入设备位置" required>
            </div>
            <div class="content">
                <label for="equipmentPrice">设备价格：</label>
                <input class="form-control" id="equipmentPrice" minlength="2"
                       type="text" placeholder="请输入设备价格" required>
            </div>
            <div class="content">
                <label for="equipmentType">选择设备类别：</label>
                <select class="form-control" name="equipmentType" id="equipmentType">
                    <option>请选择设备类别</option>
                    <option>室内</option>
                    <option>室外</option>
                </select>
            </div>
            <div class="content">
                <label for="equipmentCommunity">设备所在小区：</label>
                <select class="form-control" name="equipmentCommunity" id="equipmentCommunity">
                    <option>请选择所在小区</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
            </div>
            <button id="addEquipment" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="checkRecord" style="margin-top: 100px">
        <p style="text-align: center;font-size: 20px">排查记录</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">设备ID</th>
                <th class="term">排查时间</th>
                <th class="term">设备情况</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'equipcheckrecord', []);
            foreach ($result as $res) {
                if (!isset($res["repair_id"])) {
                    $res["repair_id"] = "无";
                }
                echo "<tr><td class='term'>" . $res["e_id"] . "</td><td class='term'>" . $res["check_time"] . "</td><td class='term'>" . $res["e_status"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addCheckRecord" style="margin:20px;">添加排查记录
        </button>
        <div class="clearfix"></div>
        <div id="addCheckRecord" class="collapse">
            <div class="content">
                <label for="equipmentCheckID">设备ID：</label>
                <input class="form-control" id="equipmentCheckID" minlength="1"
                       type="text" placeholder="请输入设备ID" required>
            </div>
            <div class="content">
                <label for="equipmentCheckTime">排查时间：</label>
                <input class="form-control" id="equipmentCheckTime" minlength="1"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="equipmentCheckSituation">设备情况：</label>
                <select class="form-control" name="equipmentCheckSituation" id="equipmentCheckSituation">
                    <option>请选择设备排查情况</option>
                    <option>正常</option>
                    <option>异常-未维修</option>
                    <option>异常-已维修</option>
                </select>
            </div>
            <button id="addRecord" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="repairRecord" style="margin-top: 100px">
        <p style="text-align: center;font-size: 20px">维修记录</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">维修单号</th>
                <th class="term">设备ID</th>
                <th class="term">付费时间</th>
                <th class="term">维修费用</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'equiprepairrecord', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["repair_id"] . "</td><td class='term'>" . $res["e_id"] . "</td><td class='term'>" . $res["spend_time"] . "</td><td class='term'>" . $res["spend_money"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addRepairRecordContent" style="margin:20px;">添加维修记录
        </button>
        <div class="clearfix"></div>
        <div id="addRepairRecordContent" class="collapse">
            <div class="content">
                <label for="equipmentRepairID">设备ID：</label>
                <input class="form-control" id="equipmentRepairID" minlength="2"
                       type="text" placeholder="请输入设备ID" required>
            </div>
            <div class="content">
                <label for="equipmentSpendTime">付费时间：</label>
                <input class="form-control" id="equipmentSpendTime" minlength="1"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="equipmentSpendMoney">付费金额：</label>
                <input class="form-control" id="equipmentSpendMoney" minlength="2"
                       type="text" placeholder="请输入设备ID" required>
            </div>
            <button id="addRepairRecord" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="baoxiuRecord" style="margin-top: 100px">
        <p style="text-align: center;font-size: 20px">报修记录</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">设备ID</th>
                <th class="term">报修时间</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">房门号</th>
                <th class="term">报修项目</th>
                <th class="term">报修原因</th>
                <th class="term">完成情况</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            $con = get_connection();
            $result = select_table_condition($con, 'equipbaoxiurecord', []);
            foreach ($result as $res) {
                echo "<tr><td class='term'>" . $res["e_id"] . "</td><td class='term'>" . $res["baoxiu_time"] . "</td><td class='term'>" . $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] . "</td><td class='term'>" . $res["door_number"] . "</td><td class='term'>" . $res["baoxiu_item"] . "</td><td class='term'><textarea style=\"width: 100%;height: 100px;resize: none;border: 0px;\" readonly>" . $res["reason"] . "</textarea></td><td class='term'>" . $res["baoxiu_situation"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addBaoxiuRecordContent" style="margin:20px;">添加报修记录
        </button>
        <div class="clearfix"></div>
        <div id="addBaoxiuRecordContent" class="collapse">
            <div class="content">
                <label for="equipmentBaoxiuID">设备ID：</label>
                <input class="form-control" id="baoxiuID" minlength="2"
                       type="text" placeholder="请输入设备ID" required>
            </div>
            <div class="content">
                <label for="equipmentBaoxiuTime">报修时间：</label>
                <input class="form-control" id="baoxiuTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="buildingNumber">楼号：</label>
                <input class="form-control" id="buildingNumber" minlength="2"
                       type="text" placeholder="请输入楼号" required>
            </div>
            <div class="content">
                <label for="unitNumber">单元号：</label>
                <input class="form-control" id="unitNumber" minlength="2"
                       type="text" placeholder="请输入单元号" required>
            </div>
            <div class="content">
                <label for="doorNumber">房门号：</label>
                <input class="form-control" id="doorNumber" minlength="2"
                       type="text" placeholder="请输入房门号" required>
            </div>
            <div class="content">
                <label for="baoxiu_item">报修项目：</label>
                <select class="form-control" id="baoxiuItem">
                    <option>请选择报修项目</option>
                    <option>健身设施</option>
                    <option>小区照明灯</option>
                    <option>公告牌</option>
                    <option>楼道声控灯</option>
                    <option>门禁设备</option>
                    <option>电梯</option>
                    <option>其他</option>
                </select>
            </div>
            <div class="content">
                <label for="baoxiureason">报修原因：</label>
                <textarea id="baoxiureason" style="width: 100%;height: 100px;resize: none"
                          placeholder="请输入报修原因"></textarea>
            </div>
            <div class="content">
                <label for="baoxiuSituation">报修情况：</label>
                <select class="form-control" id="baoxiuSituation">
                    <option>请选择报修情况</option>
                    <option>已维修</option>
                    <option>未维修</option>
                    <option>维修中</option>
                </select>
            </div>
            <button id="addBaoxiu" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="statistics" style="margin-top: 100px">
        <p style="text-align: center;font-size: 20px">报修统计查询</p>
        <form action="equipment_search.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="baoxiuStartTime">选择报修开始时间：</label>
                <input class="form-control" id="baoxiuStartTime" name="baoxiuStartTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <div class="form-group">
                <label for="baoxiuEndTime">选择报修结束时间：</label>
                <input class="form-control" id="baoxiuEndTime"  name="baoxiuEndTime" minlength="2"
                       type="datetime-local" required>
            </div>
            <button type="submit" class="btn btn-primary float-right" style="margin: 20px">查询</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>

</div>
</body>
<footer style="margin-top: 30px;height: 100px">

</footer>
</html>

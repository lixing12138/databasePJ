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
    <script src="../js/complaint.js"></script>

</head>
<body>
<div class="header"><p>物业管理系统</p></div>
<div class="container">
    <p class="title">投诉管理系统</p>
    <div class="complaintRecordList">
        <p style="text-align: center;font-size: 20px">投诉意见</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="term">投诉单号</th>
                <th class="term">所在小区</th>
                <th class="term">楼号</th>
                <th class="term">单元号</th>
                <th class="term">房门号</th>
                <th class="term">投诉时间</th>
                <th class="term">投诉类别</th>
                <th class="term">投诉原因</th>
                <th class="term">处理过程</th>
                <th class="term">处理结果</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once __DIR__ . '/../libs/mysql_connection.php';
            //compliant_time在表中漏了
            $sql = "SELECT complaint_id,community_name,building_number,unit_number,door_number,complaint_time,complaint_type,reason,status,result
FROM complaintrecord NATURAL JOIN households NATURAL JOIN house NATURAL JOIN community";
            $con = get_connection();
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($search_result as $res) {
                echo "<tr><td class='term'>" . $res["complaint_id"] . "</td><td class='term'>" . $res["community_name"] .
                    "</td><td class='term'>" . $res["building_number"] . "</td><td class='term'>" . $res["unit_number"] .
                    "</td><td class='term'>" . $res["unit_number"] . "</td><td class='term'>" . $res["complaint_time"] .
                    "</td><td class='term'>" . $res["complaint_type"] . "</td><td class='term'><textarea style='resize: none;height: 100px;width: 100%;' readonly>" . $res["reason"] .
                    "</textarea></td><td class='term'>" . $res["status"] . "</td><td class='term'>" . $res["result"] . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary float-right" data-toggle="collapse"
                data-target="#addComplaintRecord" style="margin:20px;">添加投诉记录
        </button>
        <div class="clearfix"></div>
        <div id="addComplaintRecord" class="collapse">
            <div class="content">
                <label for="compHouseholdsId">投诉住户身份证号：</label>
                <input class="form-control" id="compHouseholdsId" minlength="1"
                       type="text" placeholder="请输入身份证号" required>
            </div>
            <div class="content">
                <label for="compTime">投诉时间：</label>
                <input class="form-control" id="compTime" minlength="1"
                       type="datetime-local" required>
            </div>
            <div class="content">
                <label for="compType">投诉类别：</label>
                <input class="form-control" id="compType" minlength="1"
                       type="text" placeholder="请输入类别" required>
            </div>
            <div class="content">
                <label for="compReason">投诉原因：</label>
                <textarea placeholder="请输入原因" id="compReason"
                          style="resize: none;height: 100px;width: 100%;required"></textarea>
            </div>
            <div class="content">
                <label for="compStep">处理过程：</label>
                <input class="form-control" id="compStep" minlength="1"
                       type="text" placeholder="请输入过程" required>
            </div>
            <div class="content">
                <label for="result">处理结果：</label>
                <input class="form-control" id="result" minlength="1"
                       type="text" placeholder="请输入结果" required>
            </div>
            <button id="addComplaint" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="complaintRecordStatistics"  style="margin-top: 100px;">
        <p style="text-align: center;font-size: 20px">投诉意见分布查询</p>
        <div class="form-inline mx-auto" style="width: 1000px;" role="form">
            <div class="form-group">
                <label for="search_community">起始时间：</label>
                <input type="datetime-local" class="form-control" id="compFCStartTime">
            </div>
            <div class="form-group">
                <label for="search_community">结束时间：</label>
                <input type="datetime-local" class="form-control" id="compFCEndTime">
            </div>
            <div class="form-group">
                <label for ="kinds">分布种类</label>
                <select class="form-control" id="compFCType">
                    <option>小区</option>
                    <option>楼宇 </option>
                    <option>单元</option>
                    <option>户</option>
                    <option>投诉种类</option>
                </select>
            </div>
            <button id="searchComplaint" type="button" class="btn btn-primary float-right" style="margin: 20px">查询</button>
            <div class="clearfix"></div>
        </div>
        <p style="font-size: 20px;text-align: center">搜索结果</p>
        <table id="resultShow" class="table table-hover">

        </table>
    </div>
    <?php
    /**
     * Created by PhpStorm.
     * User: yly
     * Date: 2019/1/4
     * Time: 19:44
     */
    ?>
</div>

<footer style="margin-top: 100px;height: 100px;"></footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>物业管理系统</title>
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/parking.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="../js/parking.js"></script>
</head>
<body>
<div class="header"><p>物业管理系统</p></div>
<div class="container">
        <div class="parking">
            <p class="title">车位管理系统</p>
            <div class="content">
                <p style="text-align: center;font-size: 20px">车位列表</p>
                <table id="parkingMessage" class="mx-auto table table-hover">
                    <thead>
                    <tr>
                        <th class="term">所在小区名称</th>
                        <th class="term">车位ID</th>
                        <th class="term">车位位置</th>
                        <th class="term">类型</th>
                        <th class="term">删除</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once __DIR__ . '/../libs/mysql_connection.php';

                    $con = get_connection();
                    $result = select_table_condition($con, 'parking', []);
                    foreach ($result as $res) {
                        $searchID = $res["community_id"];
                        $community_res = select_table_condition($con, 'community', ["community_id" => $searchID]);
                        echo "<tr><td class='term'>" . $community_res[0]["community_name"] . "</td><td class='term'>" . $res["parking_id"] . "</td><td class='term'>" . $res["parking_location"] . "</td><td class='term'>" . $res["type"] ."</td><td class='term'><a href='#'onclick='deleteParking(".$res['parking_id'].")'>删除</a>"."</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary float-right" style="margin:20px;"  data-toggle="collapse" data-target="#addContent">添加信息</button>
                <div class="clearfix"></div>
                <div id="addContent" class="collapse">
                    <div class="content">
                        <label for="">选择小区名称：</label>
                        <select class="form-control" name="community" id="communityName">
                            <option>请选择小区</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="content">
                        <label for="parkingLocation">车位位置：</label>
                        <input class="form-control" id="parkingLocation" name="parkingLocation" minlength="2"
                               type="text" placeholder="请输入车位位置" required>
                    </div>
                    <div class="content">
                        <label for="parkingType">选择车位类型：</label>
                        <select class="form-control" name="parkingType" id="parkingType">
                            <option>请选择车位类型</option>
                            <option>临时车位</option>
                            <option>购买车位</option>
                            <option>租用车位</option>
                        </select>
                    </div>
                    <button id="addParking" class="btn btn-primary float-right" style="margin: 20px">确定添加</button>
                </div>
            </div>
        </div>

</div>
</body>
</html>
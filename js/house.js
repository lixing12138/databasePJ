$(
    function () {
        $("#addHouse").click(function () {
            let houseOwnerID=$("#houseOwnerID").val();
            let houseCommunity=$("#houseCommunity").val();
            let houseBuildingNumber=$("#houseBuildingNumber").val();
            let houseUnitNumber=$("#houseUnitNumber").val();
            let houseDoorNumber=$("#houseDoorNumber").val();
            let houseStatus=$("#houseStatus").val();
            let houseSquare=$("#houseSquare").val();

            if (houseOwnerID==""||houseCommunity==""||houseBuildingNumber==""||houseUnitNumber==""||
                houseDoorNumber==""||houseStatus==""||houseSquare==""){
                alert("请检查输入");
            } else {
                $.post("../controller/house/insert_house.php",{
                    houseOwnerID:houseOwnerID,
                    houseCommunity:houseCommunity,
                    houseBuildingNumber:houseBuildingNumber,
                    houseUnitNumber:houseUnitNumber,
                    houseDoorNumber:houseDoorNumber,
                    houseStatus:houseStatus,
                    houseSquare:houseSquare
                },function (data) {
                    if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    } else {
                        alert("插入失败");
                    }
                })
            }
        });
        
        $("#addHouseholds").click(function () {
            let householdId=$("#householdId").val();
            let householdName=$("#householdName").val();
            let householdPhone=$("#householdPhone").val();
            let houseId=$("#houseId").val();
            if (houseId==""||householdId==""||householdName==""||householdPhone=="") {
                alert("请检查输入");
            }else {
                $.post("../controller/house/insert_household.php",{
                    householdId:householdId,
                    householdName:householdName,
                    householdPhone:householdPhone,
                    houseId:houseId
                },function (data) {
                    if (data==3){
                        alert("住户已存在");
                    } else if (data==2){
                        alert("房屋不存在");
                    } else if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    }else {
                        alert("插入失败");
                    }
                })
            }
        });

        $("#addOwner").click(function () {
            let ownerId=$("#ownerId").val();
            let ownerName=$("#ownerName").val();
            let ownerPhone=$("#ownerPhone").val();
            let ownHouseId=$("#ownHouseId").val();
            if (ownHouseId==""||ownerId==""||ownerName==""||ownerPhone==""){
                alert("请检查输入");
            } else {
                $.post("../controller/house/insert_owner.php",{
                    ownerId:ownerId,
                    ownerName:ownerName,
                    ownerPhone:ownerPhone,
                    ownHouseId:ownHouseId
                },function (data) {
                    //alert(data);
                    if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    } else if(data==2){
                        alert("房屋不存在");
                    }else if (data==3){
                        alert("房屋已有户主");
                    } else {
                        alert("插入失败");
                    }
                })
            }

        });

        $("#searchFreeHouse").click(function () {
            let search_community=$("#search_community").val();
            let search_building=$("#search_building").val();
            let search_unit=$("#search_unit").val();
            let search_door=$("#search_door").val();

            $.post("../controller/house/search_house.php",{
                search_community:search_community,
                search_building:search_building,
                search_unit:search_unit,
                search_door:search_door
            },function (data) {
                let arr=JSON.parse(data);
                $("#search_result").empty();
                $("#search_result").append("<thead><tr><th class='term'>房屋ID</th><th class=\"term\">所在小区</th><th class=\"term\">楼号</th><th class=\"term\">单元号</th><th class=\"term\">门号</th><th class=\"term\">房屋状态</th><th class=\"term\">房屋面积</th></tr></thead>");
               for(let value of arr){
                   let tmp="<tr><td class='term'>"+value["house_id"]+"</td><td class='term'>"+
                       value["community_id"]+"</td><td class='term'>"+value["building_number"]+"</td><td class='term'>"+
                       value["unit_number"]+"</td><td class='term'>"+value["door_number"]+"</td><td class='term'>"+
                       value["house_status"]+"</td><td class='term'>"+ value["square"]+"</td><tr>";
                   $("#search_result").append(tmp);
               }
            })
        });

        $("#searchCharge").click(function () {
            let ownerSearchID=$("#OwnerSearchID").val();
            let ownerSearchStartTime=$("#ownerSearchStartTime").val();
            let ownerSearchEndTime=$("#ownerSearchEndTime").val();
            if (ownerSearchID==""||ownerSearchStartTime==""||ownerSearchEndTime==""){
                alert("请检查输入");
            } else {
                $.post("../controller/house/search_owner_charge.php",{
                    ownerSearchID:ownerSearchID,
                    ownerSearchStartTime:ownerSearchStartTime,
                    ownerSearchEndTime: ownerSearchEndTime
                },function (data) {
                    let arr=JSON.parse(data);
                    $("#ownerChargeSearch").empty();
                    $("#ownerChargeSearch").append("<thead><tr><th class='term'>费用名</th><th class=\"term\">对应项目</th><th class=\"term\">费用</th><th class=\"term\">缴费进度</th><th class=\"term\">缴费时间</th></tr></thead>");
                    for (let value of arr){
                        console.log(value);
                        let tmp="<tr><td class='term'>"+value["feeName"]+"</td><td class='term'>"+
                            value["houseId"]+"</td><td class='term'>"+value["property"]+"</td><td class='term'>"+
                            value["chargeStatus"]+"</td><td class='term'>"+ value["chargeTime"]+"</td><tr>";
                        $("#ownerChargeSearch").append(tmp);
                    }
                });
            }
        });
    }
);
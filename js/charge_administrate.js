$(
    function () {
        $("#addFee").click(function () {
            let houseID=$("#houseID").val();
            let chargeDate=$("#chargeDate").val();
            let startDate=$("#startDate").val();
            let endDate=$("#endDate").val();
            let chargeMoney=$("#chargeMoney").val();
            if (houseID==""||chargeDate==""||chargeMoney==""){
                alert("请检查输入");
            } else {
                $.post("../controller/property/insert_property_fee_record.php",{
                    houseID:houseID,
                    chargeDate:chargeDate,
                    chargeMoney:chargeMoney,
                    startTime:startDate,
                    endTime:endDate
                },function (data) {
                    if ((data==1)){
                        alert("插入成功");
                        window.history.go(0);
                    }else {
                        alert("插入失败");
                    }
                })
            }
        });

        $("#addParkingRecordSingle").click(function () {
            let parkingId=$("#parkingId").val();
            let plateNumber=$("#plateNumber").val();
            let parkingStartTime=$("#parkingStartTime").val();
            let parkingEndTime=$("#parkingEndTime").val();
            let parkingChargeMoney=$("#parkingChargeMoney").val();
            let parkingChargeTime=$("#parkingChargeTime").val();

            if(parkingId==""||plateNumber==""||parkingStartTime==""||parkingEndTime==""||parkingChargeMoney==""){
                alert("请检查输入");
            }else {
                $.post("../controller/property/insert_parking_record.php",{
                    parkingId:parkingId,
                    plateNumber:plateNumber,
                    parkingStartTime:parkingStartTime,
                    parkingEndTime:parkingEndTime,
                    parkingChargeMoney:parkingChargeMoney,
                    parkingChargeTime:parkingChargeTime
                },function (data) {
                    if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    }else {
                        alert("插入失败");
                    }
                })
            }
        });

        $("#addRentRecord").click(function () {
            let ownerRentID=$("#ownerRentID").val();
            let parkingRentID=$("#parkingRentID").val();
            let rentStartTime=$("#rentStartTime").val();
            let rentEndTime=$("#rentEndTime").val();
            let rentChargeTime=$("#rentChargeTime").val();
            let rentChargeMoney=$("#rentChargeMoney").val();

            if (ownerRentID==""||parkingRentID==""||rentStartTime==""||rentEndTime==""|| rentChargeTime==""|| rentChargeMoney==""){
                alert("请检查输入");
            }else {
                $.post("../controller/property/insert_rent_record.php",{
                    ownerRentID:ownerRentID,
                    parkingRentID:parkingRentID,
                    rentStartTime:rentStartTime,
                    rentEndTime:rentEndTime,
                    rentChargeTime: rentChargeTime,
                    rentChargeMoney: rentChargeMoney
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

        $("#addAdministrateRecord").click(function () {
            let ownerAdministrateID=$("#ownerAdministrateID").val();
            let parkingAdministrateID=$("#parkingAdministrateID").val();
            let administrateStartTime=$("#administrateStartTime").val();
            let administrateEndTime=$("#administrateEndTime").val();
            let administrateChargeTime=$("#administrateChargeTime").val();
            let administrateChargeMoney=$("#administrateChargeMoney").val();

            if (administrateChargeMoney==""||ownerAdministrateID==""||parkingAdministrateID==""||
                administrateStartTime==""||administrateEndTime==""||administrateChargeTime=="") {
                alert("请检查输入");
            }else {
                $.post("../controller/property/insert_administrate_fee.php",{
                    ownerAdministrateID:ownerAdministrateID,
                    parkingAdministrateID:parkingAdministrateID,
                    administrateStartTime:administrateStartTime,
                    administrateEndTime:administrateEndTime,
                    administrateChargeTime:administrateChargeTime,
                    administrateChargeMoney:administrateChargeMoney
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
        
        $("#addBuyParking").click(function () {
            let buyParkingId=$("#buyParkingId").val();
            let buyOwnerID=$("#buyOwnerID").val();
            let buyChargeMoney=$("#buyChargeMoney").val();
            let buyChargeTime=$("#buyChargeTime").val();

            if (buyChargeTime==""||buyParkingId==""|| buyOwnerID==""||buyChargeMoney=="") {
                alert("请检查输入");
            }else {
                $.post("../controller/property/insert_parking_buy_record.php",{
                    buyParkingId:buyParkingId,
                    buyOwnerID: buyOwnerID,
                    buyChargeMoney:buyChargeMoney,
                    buyChargeTime:buyChargeTime
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

        $("#addOther").click(function () {
            let otherChargeSource=$("#otherChargeSource").val();
            let otherChargeTime=$("#otherChargeTime").val();
            let otherChargeMoney=$("#otherChargeMoney").val();

            if (otherChargeMoney==""||otherChargeSource==""||otherChargeTime==""){
                alert("请检查输入");
            } else {
                $.post("../controller/property/insert_other_charge.php",{
                    otherChargeSource:otherChargeSource,
                    otherChargeTime:otherChargeTime,
                    otherChargeMoney:otherChargeMoney
                },function (data) {
                    if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    } else {
                        alert("插入失败");
                    }
                })
            }
        })
    }
);
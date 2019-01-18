$(
    function () {

        $("#addEquipment").click(function () {
            let equipmentName=$("#equipmentName").val();
            let equipmentLocation=$("#equipmentLocation").val();
            let equipmentPrice=$("#equipmentPrice").val();
            let equipmentType=$("#equipmentType").val();
            let equipmentCommunity=$("#equipmentCommunity").val();
            if (equipmentCommunity.length==0||equipmentLocation.length==0||equipmentName.length==0||equipmentPrice.length==0||equipmentType.length==0){
                alert("请检查输入");
            }else {
                $.post("../controller/equipment/insert_equipment.php",{
                    equipmentName:equipmentName,
                    equipmentLocation:equipmentLocation,
                    equipmentPrice:equipmentPrice,
                    equipmentType:equipmentType,
                    equipmentCommunity:equipmentCommunity
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
        $("#addRecord").click(function () {
            let equipmentCheckID=$("#equipmentCheckID").val();
            let equipmentCheckTime=$("#equipmentCheckTime").val();
            let equipmentCheckSituation=$("#equipmentCheckSituation").val();
            if (equipmentCheckID==""||equipmentCheckTime==""||equipmentCheckSituation==""){
                alert("请检查输入");
            }else {
                $.post("../controller/equipment/insert_equipment_check_record.php",{
                    equipmentCheckID:equipmentCheckID,
                    equipmentCheckTime:equipmentCheckTime,
                    equipmentCheckSituation:equipmentCheckSituation
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
        $("#addRepairRecord").click(function () {
            let equipmentRepairID=$("#equipmentRepairID").val();
            let equipmentSpendTime=$("#equipmentSpendTime").val();
            let equipmentSpendMoney=$("#equipmentSpendMoney").val();
            if (equipmentRepairID==""||equipmentSpendTime==""||equipmentSpendMoney==""){
                alert("请检查输入");
            } else {
                $.post("../controller/equipment/insert_equipment_repair_record.php",{
                    equipmentRepairID:equipmentRepairID,
                    equipmentSpendTime:equipmentSpendTime,
                    equipmentSpendMoney:equipmentSpendMoney
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
        $("#addBaoxiu").click(function () {
           let baoxiuID=$("#baoxiuID").val();
           let baoxiuTime=$("#baoxiuTime").val();
           let buildingNumber=$("#buildingNumber").val();
           let unitNumber=$("#unitNumber").val();
           let doorNumber=$("#doorNumber").val();
           let baoxiuItem=$("#baoxiuItem").val();
           let baoxiureason=$("#baoxiureason").val();
           let baoxiuSituation=$("#baoxiuSituation").val();
           if (baoxiuID==""||baoxiuTime==""||buildingNumber==""||unitNumber==""||doorNumber==""||baoxiuItem==""||baoxiureason==""||baoxiuSituation=="") {
               alert("请检查输入");
           }else {
               $.post("../controller/equipment/insert_equipment_baoxiu.php",{
                   baoxiuID:baoxiuID,
                   baoxiuTime:baoxiuTime,
                   buildingNumber:buildingNumber,
                   unitNumber:unitNumber,
                   doorNumber:doorNumber,
                   baoxiuItem:baoxiuItem,
                   baoxiureason:baoxiureason,
                   baoxiuSituation:baoxiuSituation
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

        // $("#searchBaoxiu").click(function () {
        //     let baoxiuStartTime=$("#baoxiuStartTime").val();
        //     let baoxiuEndTime=$("#baoxiuEndTime").val();
        //     if (baoxiuEndTime==""||baoxiuStartTime==""){
        //         alert("请检查输入");
        //     } else {
        //         $.post("../controller/equipment/search_baoxiu_record.php",{
        //             baoxiuStartTime:baoxiuStartTime,
        //             baoxiuEndTime:baoxiuEndTime
        //         })
        //     }
        // })
    }
);
function deleteEquipment(e_id) {
    if (window.confirm("确认删除")){
        $.post("../controller/equipment/delete_equipment.php",{
            e_id:e_id
        },function (data) {
            if (data==1){
                alert("删除成功");
                window.history.go(0);
            } else {
                alert("删除失败");
            }
        })
    }
}
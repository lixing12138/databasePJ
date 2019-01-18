$(
    function () {
        $("#addComplaint").click(function () {
            let compId=$("#compId").val();
            let compHouseholdsId=$("#compHouseholdsId").val();
            let compTime=$("#compTime").val();
            let compType=$("#compType").val();
            let compReason=$("#compReason").val();
            let compStep=$("#compStep").val();
            let result=$("#result").val();
            if (compId==""||compHouseholdsId==""||compTime==""||compType==""||compReason==""||compStep==""||result=="") {
                alert("请检查输入");
            }else {
                $.post("../controller/complaint/insert_complaint_record.php",{
                    compHouseholdsId:compHouseholdsId,
                    compTime:compTime,
                    compType:compType,
                    compReason:compReason,
                    compStep:compStep,
                    result:result
                },function (data) {
                    if (data==1){
                        alert("插入成功");
                        window.history.go(0);
                    } else if (data==3){
                        alert("用户不存在");
                    } else {
                        alert("插入失败");
                    }
                })
            }
        });

        $("#searchComplaint").click(function () {
            let compFCStartTime=$("#compFCStartTime").val();
            let compFCEndTime=$("#compFCEndTime").val();
            let compFCType=$("#compFCType").val();

            if (compFCStartTime==""||compFCEndTime==""||compFCType==""){
                alert("请检查输入");
            } else {
                $.post("../controller/complaint/search_complaint_record.php",{
                    compFCStartTime:compFCStartTime,
                    compFCEndTime:compFCEndTime,
                    compFCType:compFCType
                },function (data) {
                    let arr=JSON.parse(data);
                    $("#resultShow").empty();
                    $("#resultShow").append("<thead><tr><th class='term'>分布点</th><th class=\"term\">数量</th></tr></thead>");
                    for(let value of arr){
                     let tmp="<tr><td class='term'>"+value['fcName']+"</td><td class='term'>"+value["fcCount"]+"</td></tr>";
                     $("#resultShow").append(tmp);
                    }
                })
            }
        })
    }
);
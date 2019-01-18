$(
    function () {
        $("#addParking").click(function () {
            let location=$("#parkingLocation").val();
            let type=$("#parkingType").val();
            let name=$("#communityName").val();
            if (location.length==0||type.length==0||name.length==0){
                alert("请检查输入");
            }else {
                $.post("../controller/insert_parking.php",{
                    location:location,
                    type:type,
                    name:name
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
    }
);
function deleteParking(id) {
    if (window.confirm("确认删除")){
        $.post("../controller/delete_parking.php",{
            parking_id:id
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
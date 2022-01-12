$(document).on("click","#test",function () {
    $.ajax({
        url: "components/testing/testing.php",
        data:{
            act:"get",
        },
        success: function (response) {
            console.log(response);
        }
    });
})

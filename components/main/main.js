$(document).on("click","#create",function () {
    var pageName = $("#component").val();
    $.ajax({
        url: "components/main/main.php",
        data: {
            method  :"CreateComponent",
            name    :pageName,
        },
        success: function (response) {
            alert("Component Created");
            $(".generator").css("margin-left","25%");
            $(".todo").show();
        }
    });
});

$(document).on("click","#delete",function(){
    $.ajax({
        url: "components/main/main.php",
        data: {
            method  :"DeleteGenerator",
        },
        success: function (response) {
            alert("Component Created");
            $(".generator").css("margin-left","25%");
            $(".todo").show();
        }
    });
})
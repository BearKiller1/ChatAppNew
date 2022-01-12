$(document).on("click","#start_chat",function () {
    var name = $("#username").val();
    var gender_id = $("#user_gender").val();
    var partner_gender_id = $("#partner_gender").val();

    if(name == ""){
        alert("name is required");
    }
    else if(gender_id == "" || gender_id == null){
        alert("gender is required");
    }
    else if(partner_gender_id == "" || partner_gender_id == null){
        alert("partner gender is required");
    }
    else{
        $.ajax({
            url: "components/welcome/welcome.php",
            data: {
                act:"AddUser",
                name:name,
                gender_id:gender_id,
                partner_gender_id:partner_gender_id
            },
            success: function (response) {
                response = JSON.parse(response);

                if(response.result == 1){
                    alert("Username is in use");
                }
                else{
                    Router("chat");   
                }
            }
        });
    }
})
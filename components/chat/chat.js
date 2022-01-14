

var SetSearch = false; // Search toggler
var GetChats  = false; // Get Messages toggler
var partner_id;

$(document).ready(function () {    
    SetSearch = false;
    ChangeStatus(4);
    SearchPartner()
})

// Runs Searcher every 100ms if search is ON
setInterval( () => {
    if(SetSearch != false){
        SearchPartner();
    }
    if(GetChats != false){
        GetChat();
    }
}, 1000);

$(document).on("click","#start",function () {

    // SearchPartner();
    // $.ajax({
    //     url: "components/chat/chat.php",
    //     data: {
    //         method: "ChangePartner",
    //         partner_id : 1
    //     },
    //     success: function (response) {
    //         console.log(response);
    //     }
    // });
});

// Menu Toggle
    $(document).on("click","#open_menu",function(){
        $(".b-background").fadeIn(100);
        $("#menu").fadeIn(100);
        $("#menu").css("display","flex");
    });

    $(document).on("click","#close_menu", function () {
        $(".b-background").fadeOut(100);
        $("#menu").fadeOut(100);
    })

    $(document).on("click","#save_menu", function () {
        $(".b-background").fadeOut(100);
        $("#menu").fadeOut(100);
    })
// // // // // // // // // // 

// Start/Stop Search
    $(document).on("click","#start_search",function () {
        ChangeStatus(4);
        SearchPartner();
        //SetSearch = true;
    });

    $(document).on("click","#stop_search, #cancel",function () {
        ChangeStatus(1);
        SetSearch = false;
        GetChats = false;
        $("#partner_name").html("");
        $(".chat_content").html("");
    })
// // // // // // // // // // 

// Send Message
    $(document).on("click","#send_message",function() {
        var msg = $("#main_input").val();
        SendMessage(msg);
    })
// // // // // // // // // // 

// Global Functions
    SearchPartner = () => {
        $.ajax({
            url: "components/chat/chat.php",
            data: {
                method: "GetPartner",
            },
            success: function (response) {
                response = JSON.parse(response);
                if(response.result == 1){
                    SetSearch = false;
                    // 1. Set Partner name  - Done
                    // 2. Clear Old Chat    - Done
                    // 3. Start SetInterval To get Chat Details - kinda done
                    // 4. vso

                    $("#partner_name").html(response.partner['name']);
                    $(".chat_content").html("");

                    partner_id = response.partner['id'];

                    $(".chat_container_test").show();

                    GetChats = true;

                    $.ajax({
                        url: "components/chat/chat.php",
                        data :{
                            method:"SetChat",
                            partner_id: partner_id
                        },
                        success: function (response) {
                            alert(response);
                        }
                    })
                }
                else if(response.result == 0){
                    SearchPartner();
                    console.log(response.result);
                }
            }
        });
    }

    ChangeStatus = (status_id) => {
        $.ajax({
            url: "components/chat/chat.php",
            data: {
                method: "ChangeStatus",
                status: status_id,
            },
            success: function (response) {

            }
        });
    }

    SendMessage = (msg) => {
        var msg_html = '<div class="user_message"><p>' +msg+ '</p></div>';
        $(".chat_content").append(msg_html);

        $(".chat_content").animate({
            scrollTop: $(".chat_content").css("height")
        }, 2000);

        $.ajax({
            url: "components/chat/chat.php",
            data: {
                method: "SetMessage",
                partner: partner_id,
                user_msg: msg,
            },
            success: function (response) {
            }
        });
    }

    GetChat = () => {
        $.ajax({
            url: "components/chat/chat.php",
            data: {
                method:"GetChat",
                partner_id:partner_id,
            },
            success: function (response) {
                response = JSON.parse(response);
                // console.log(response['result']['user_msg']);
                // var msg_html = '        <div class="user_message"><p>' +response['result']['user_msg'][0]+ '</p></div>';
                // var partner_html = '        <div class="partner_message"><p>' +response['result']['partner_msg'][1]+ '</p></div>';
                // $(".chat_content").append(msg_html);
                // $(".chat_content").append(partner_html);
            }
        });
    }
// // // // // // // // // // 
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


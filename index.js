var MainPage = "chat";
var RouterURL = "router.php";

window.onload = () => {
    Router(MainPage);   
}

Router = (Page) => {
    $.ajax({
        url: RouterURL,
        data: {
            method  : "GetPage",
            page    : Page,
        },
        success: function (response) {
            var result = JSON.parse(response);
            document.title = Page;
            $("#content").html(result.page);
        }
    });
}
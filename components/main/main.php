<?php
    include "../../router.php";
    
    $method     = $_REQUEST["method"];

    if($method == "CreateComponent"){
        $pagename   = $_REQUEST["name"];
    
        mkdir("../" .$pagename); // Creates The folder

        // Creates The html/css/js/php file
        $html   = fopen("../" .$pagename. "/" .$pagename. ".html", "w");
        $css    = fopen("../" .$pagename. "/" .$pagename. ".css", "w");
        $js     = fopen("../" .$pagename. "/" .$pagename. ".js", "w");
        $php    = fopen("../" .$pagename. "/" .$pagename. ".php", "w");

        // Write shablon Text in html file
        fwrite($html, $pagename ." Works!");
    }
    else if($method == "DeleteGenerator"){
        unlink("../../components/main");
    }
    
?>
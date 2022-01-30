<?php
    include "includes/autoloader.php";
    include "includes/mysql.php";
    $data       = array();             // Array To store data and send it back to Ajax
    $method     = $_REQUEST["method"]; // Get The Method Sent From Ajax
    $PageName   = $_REQUEST["page"];   // Get The page Name Send From Ajax
    
    // $components[$i][0] -> Defins The Name of the folder/file
    // $components[$i][1] -> Defins The Name of the Components Name to show up in the header
    // $components[$i][2] -> Defins if the component shows up in the header
    $components = array(
        array("main", "main", 0),
        array("welcome", "welcome", 0),
        array("chat", "chat", 0),
    );


    // Check Method 
    switch ($method) {
        case 'GetPage':
            $data['page'] .= GetPage($PageName);     // Get the Page source
            $data['page'] .= GetPageURL($PageName); // Creates the page CSS/JS paths
            echo json_encode($data); 
            break;
        
        default:
            $data['error'] = "Method Is incorrect"; // If Method is not valid
            break;
    }

    // Return Data back To Ajxa

    // Get The Page Name, Create Path And Get Content From HTML File
    function GetPage($PageName){
        if(file_get_contents("components/".$PageName."/".$PageName.".html") == ""){
            return file_get_contents("components/error.html");
        }
        return file_get_contents("components/".$PageName."/".$PageName.".html");
    }

    function GetPageURL($PageName){
        $url = '<div class="url">
                    <script src="components/' .$PageName. '/' .$PageName. '.js"></script>
                    <link rel="stylesheet" href="components/' .$PageName. '/' .$PageName. '.css">
                </div>';
        return $url;
    }

    function GetComponents(){
        global $components;
        $routes = '';
        for ($i=0; $i < COUNT($components); $i++) { 
            if($components[$i][2] == 1){
                $routes .= '<p onclick='.'Router("'.$components[$i][0].'")'.'>'.$components[$i][1].'</p>';
            }
        }
        return $routes;
    }

?>
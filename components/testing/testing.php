<?php
    session_start();
    include "../../includes/mysql.php";
    $db = new Connection();
    $act = $_REQUEST['act'];
    if($act == "set"){
    }
    else{
        $data = $_SESSION["user_id"];
    }
    //$data = $db->SetQuery("INSERT INTO users(name,gender_id,partner_gender_id) VALUES('satesto kodidan',1,1)");
    echo $data;
?>
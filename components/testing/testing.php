<?php
    session_start();
    include "../../includes/mysql.php";
    $db = new Connection();
    
    $data = $conn->query("SELECT * FROM chat_detail")->fetch_assoc();
    $user_msg = array();
    foreach ($data as $key => $value) {
        $user_msg[$key] = $value['user_msg'];
    }
    var_dump($user_msg);
?>
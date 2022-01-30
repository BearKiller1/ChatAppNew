<?php
error_reporting(E_ERROR | E_PARSE);

    session_start();
    include "../../includes/mysql.php";
    $db = new Connection();
    $data = array();

    $name               = $_REQUEST['name'];
    $gender_id          = $_REQUEST['gender_id'];
    $parnter_gender_id  = $_REQUEST['partner_gender_id']; 

    // This checks if username exists (might be removed later)
    $userChecker = $db->GetData("   SELECT  COUNT(*)AS count 
                                    FROM    users 
                                    WHERE   name = '$name' 
                                    LIMIT 1 ")['count'];

    if($userChecker > 0){
        // If username is in use
        $data['result'] = 1;
    }
    else if($userChecker == 0){
        // Creating new account For an user 
        $db->SetQuery(" INSERT INTO users 	(name, gender_id, partner_gender_id)
                        VALUES 	    ('$name', $gender_id, $parnter_gender_id) ");
    
        // Getting the last id of the user we created
        $id = $db->GetData("SELECT id FROM users ORDER BY id DESC LIMIT 1")['id'];
        
        // Adding important info into sessions;
        $_SESSION["user_id"] = $id;
        $_SESSION["gender_id"] = $gender_id;
        $_SESSION["parnter_gender_id"] = $parnter_gender_id;

        $data['result'] = 2;
    }
    
    echo json_encode($data);
?>
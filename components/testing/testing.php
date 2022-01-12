<?php
    include "../../includes/mysql.php";
    $db = new Connection();

    $data = $db->SetQuery("INSERT INTO users(name,gender_id,partner_gender_id) VALUES('satesto kodidan',1,1)");
    
    var_dump($data);

?>
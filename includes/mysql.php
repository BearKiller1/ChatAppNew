<?php
    $servername = "bpsin91g95fditjmzhzw-mysql.services.clever-cloud.com";
    $username = "uditv2kgxca2jstv";
    $password = "sjanM2u8FHVdfmd6McZo";
    $dbname = "bpsin91g95fditjmzhzw";
    

    $conn = new mysqli($servername, $username, $password, $dbname);

    class Connection{

        public $data;
    
        public function SetQuery($sql){
            global $conn;
            try {
                $conn->query($sql);
            } catch(Exception $e) {
                echo "Connection Error ->".$e;
            }
        }

        public function GetData($sql){
            global $conn;
            
            try {
                $data = $conn->query($sql)->fetch_assoc();
            } catch(Exception $e) {
                $data = "Error ->" . $e;
            } finally{
                return $data;
            }
        }
    }

?>
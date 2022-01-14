<?php
    session_start();
    include "../../includes/mysql.php";
    $db = new Connection();

    $data = array();

    $chat   = new Chat();
    $method = $_REQUEST["method"];
    $chat->$method();

    class Chat {

        public function GetPartner(){
            global $conn;
            global $data;

            global $db;
            $my_gender      = $_SESSION["gender_id"];
            $partner_gender = $_SESSION['parnter_gender_id'];
            $partner = $db->GetData("   SELECT  * 
                                        FROM    users
                                        WHERE   users.gender_id = $partner_gender 
                                        AND partner_gender_id = $my_gender 
                                        AND status_id = 4 LIMIT 1");

            if($partner == NULL || $partner == ""){
                $data["result"] = 0;
            }
            else{
                $data["result"] = 1;
                $data["partner"] = $partner;
                // Here We Want to:
                //  1. output that partner is found
                //  2. Create new chat 
                //  3. Add this Found partner and user both in that chat
                //  4. update partners and users status to 2 (onchat)
            }
        }

        public function ChangeStatus(){
            global $db;

            $status = $_REQUEST["status"];
            $user   = $_SESSION["user_id"];

            $db->SetQuery("UPDATE users SET status_id = $status WHERE id = $user");

        }

        public function ChangePartner(){
            global $db;
            $partnerID = $_REQUEST["partner_id"];
            $db->SetQuery("UPDATE users SET partner_gender_id = $partnerID");
        }

        public function SetChat(){
            global $db;

            $user       = $_SESSION["user_id"];
            $partner_id = $_REQUEST["partner_id"];

            $db->SetQuery("INSERT INTO chat (user_id, partner_id,date) VALUES ($user,$partner_id,NOW())");

            $db->SetQuery(" UPDATE users SET status_id = 2 WHERE id = $user");

            $db->SetQuery(" UPDATE users SET status_id = 2 WHERE id = $partner_id");
        }
        
        public function SetMessage(){
            global $db;
            
            $user       = $_SESSION["user_id"];
            $partner_id = $_REQUEST["partner"];
            $user_msg   = $_REQUEST["user_msg"];
            $chat_id = $db->GetData("SELECT id FROM chat WHERE user_id = $user")['id'];

            echo $chat_id;
            if($chat_id == null || $chat_id == ""){
                $data['result'] = "You are not in chat currently";
            }
            else{
                $db->SetQuery(" INSERT INTO chat_detail (chat_id, user_id, partner_id, user_msg)
                VALUES ($chat_id, $user, $partner_id, '$user_msg')");
            }
        }

        public function GetChat(){
            global $data;
            global $db;
            $id = 0;
            $user       = $_SESSION["user_id"];
            $partner_id = $_REQUEST["partner_id"];

            $id = $db->GetData("SELECT partner_msg, id 
                                FROM chat_detail 
                                WHERE partner_id IN($partner_id,$user) AND NOT ISNULL(partner_msg) ORDER BY id DESC LIMIT 1")['id'];
                                
            $data["result"]  = $db->GetData("   SELECT partner_msg, id 
                                                FROM chat_detail 
                                                WHERE partner_id IN($partner_id,$user) AND NOT ISNULL(partner_msg) ORDER BY id DESC LIMIT 1")['partner_msg'];
            echo $id;
            
        }
    }
    echo json_encode(["result" => $data["result"], "partner" => $data['partner']]);
?>
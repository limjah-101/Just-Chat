<?php
include "../init.php";
$helper = new Base_class();

if (isset($_POST["emoji"])){    
    $emoji = $_POST["emoji"];
    $m_type = "emoji";
    $m_user_id = $_SESSION["user_ID"];
    if ($helper->normal_query(" INSERT INTO messages (m_msg, m_type, m_user_id) 
                                VALUES (?,?,? )", 
                                [$emoji, $m_type, $m_user_id])){
        echo json_encode(["status" => 200]);
    }
}


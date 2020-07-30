<?php
include "../init.php";
$helper = new Base_class();

if (isset($_POST["message"])){
    
    $m_msg = $helper->sanitize_input($_POST["message"]);
    $m_type = "text";
    $m_user_id = $_SESSION["user_ID"];

    $stmt = $helper->normal_query(" INSERT INTO messages (m_msg, m_type, m_user_id) 
                                    VALUES (?,?,?)", 
                                    [$m_msg, $m_type, $m_user_id]);
    if ($stmt){
        echo json_encode(["status" => 200]);
    }          
}

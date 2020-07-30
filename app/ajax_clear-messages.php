<?php
include "../init.php";
$helper = new Base_class;
$user_id = $_SESSION["user_ID"];

if(isset($_POST['clearMessages'])){
    
    if ($helper->normal_query(" SELECT m_id 
                                FROM messages 
                                ORDER BY m_id 
                                DESC 
                                LIMIT 1")){
        $res = $helper->get_user_email();
        //Display only new messages
        $d_msg_id = $res->m_id + 1;

        if($helper->normal_query(" UPDATE discussion 
                                SET d_msg_id = ? 
                                WHERE d_user_id = ?",[$d_msg_id, $user_id])){

            echo json_encode(["status" => 200]);
        }
    }
}
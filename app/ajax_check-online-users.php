<?php
include "../init.php";
$helper = new Base_class;
$session_user_id = $_SESSION["user_ID"];

if ($helper->normal_query("SELECT * FROM sessions")){
    $res = $helper->get_all();

    foreach($res as $user){
        $s_user_id = $user->s_user_id;
        $s_log_time = $user->s_log_time;
        //
        $current_time = time();
        $time_diff = $current_time - $s_log_time;
        if($session_user_id == $s_user_id){
            //if user is logged in more than 30mn then logged him Out.
            if ($time_diff > 1800){
                $helper->normal_query("UPDATE users SET status = 0 WHERE id = ?",[$s_user_id]);
                unset($_SESSION["user_ID"]);
                echo json_encode(["status" => "href"]);
            }
        }else{
            if ($time_diff > 1800){
                $helper->normal_query("UPDATE users SET status = 0 WHERE id = ? AND status = 1",[$s_user_id]);                
            }
        }

    }
}
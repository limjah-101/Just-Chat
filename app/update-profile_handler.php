<?php
$helper = new Base_class();

if (isset($_POST["update-profile"])){
        
    $user_ID = $_SESSION["user_ID"];
    $username = $helper->sanitize_input($_POST["username"]);
    if(empty($username)){
        $error_msg = "Username is required.";
    }else{
        $helper->normal_query("UPDATE users SET username = ? WHERE id = ?", [$username, $user_ID]);                    
        $helper->set_session("success", "Username was successfully updated.");
        header("Location: index");
    }
}
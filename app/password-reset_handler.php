<?php
// include "init.php";
$helper = new Base_class();

if (isset($_POST["reset"])){

    $pwd = $helper->sanitize_input($_POST['current_password']);
    $new_pwd = $helper->sanitize_input($_POST['new_password']);
    $confirm_pwd = $helper->sanitize_input($_POST['retype_new_password']);
    $pwd_status = 1;

    if (empty($pwd)){
        $pwd_error = "Please enter current password.";
        $pwd_status = "";
    }
    if (empty($new_pwd)){
        $new_error = "Please enter a new password.";
        $pwd_status = "";
    }else if (strlen($new_pwd) < 6){
        $new_error = "New password at least 6 characters long.";
        $pwd_status = "";
    }
    if (empty($confirm_pwd)){
        $confirm_error = "Please confirm new password.";
        $pwd_status = "";
    }else if ($new_pwd != $confirm_pwd){
        $confirm_error = "Password don't match.";
        $new_error = "Password don't match.";
        $pwd_status = "";
    }   
    //========================if all done => proceed to Update=================================// 
    if (!empty($pwd_status)){
        
        $user_ID = $_SESSION["user_ID"];
        if ($helper->normal_query("SELECT password FROM users WHERE id = ?", [$user_ID])){
            $res = $helper->get_user_email();
            if (password_verify($pwd, $res->password)){

                $hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);                              
                if($helper->normal_query("UPDATE users SET password = ? WHERE id = ?", [$hashed_pwd, $user_ID])){                    
                    $helper->set_session("success", "Password was updated successfully.");
                    header("Location: index");
                }
            }else{
                $pwd_error = "Please enter the right password.";              
            }
        }
    }
}




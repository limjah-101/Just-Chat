<?php
include "init.php";
$helper = new Base_class();


if (isset($_POST["sign_in"])){    
    $email       = $helper->sanitize_input($_POST["email"]);
    $password    = $helper->sanitize_input($_POST["password"]);
    $email_status = $password_status = 1;
    //==================Check for empty fields first====================//
    if (empty($email)){
        $email_error = "Email is required.";
        $email_status = "";
    }
    if (empty($password)){
        $password_error = "Password is required.";
        $password_status = "";        
    } 
    //====================Check if user email exists=========================//
    if (!empty($email_status) && !empty($password_status)){        
        
        if ($helper->normal_query("SELECT * FROM users WHERE email = ?", [$email])){
            if ($helper->count_rows() == 0){
                $email_error = "Email and password don't match.";
                $email_status = "";                
            }else {
                //Fetch Single user data
                $res = $helper->get_user_email();
                $user_id    = $res->id;
                $user_email = $res->email;
                $user_pwd   = $res->password;
                $username = $res->username;
                $user_img = $res->image;  
                $u_discussion_status = $res->u_discussion_status;              

                //============Check if Passwords matches => We do things=============
                if (password_verify($password, $user_pwd)){
                    //Logged In user => set status = 1 || When logged Out => set status = 0
                    $helper->normal_query(" UPDATE users 
                                            SET status = 1 
                                            WHERE id = ?", [$user_id]);
                    //if Fresh User => @To explain
                    //Get the one last message and skip all old ones
                    if ($u_discussion_status == 0){
                        //@To explain => + 1
                        if ($helper->normal_query(" SELECT m_id 
                                                    FROM messages 
                                                    ORDER BY m_id 
                                                    DESC 
                                                    LIMIT 1")){
                            $res = $helper->get_user_email();
                            $d_msg_id = $res->m_id + 1;

                            //Insert the last messageID && userID in Discussion table
                            if ($helper->normal_query(" INSERT INTO discussion (d_msg_id, d_user_id) 
                                                        VALUES (?,?)", [$d_msg_id, $user_id])){
                                // @To explain
                                $helper->normal_query(" UPDATE users 
                                                        SET u_discussion_status = 1 
                                                        WHERE id = ?",[$user_id]);

                                //@expailn => Store user in session table for being able to check them later===============================================
                                $login_time = time();
                                if ($helper->normal_query(" SELECT * 
                                                            FROM sessions
                                                            WHERE s_user_id = ?", [$user_id])){
                                    $response = $helper->get_user_email();
                                    if ($response == 0 ){
                                        $helper->normal_query("INSERT INTO sessions (s_user_id, s_log_time ) 
                                                                VALUES (?, ?)", [$user_id, $login_time]);
                                        $helper->set_session("username", $username);
                                        $helper->set_session("user_ID", $user_id);
                                        $helper->set_session("user_img", $user_img);                                
                                        header("Location: index");
                                    }else{
                                        $helper->normal_query("UPDATE sessions SET s_log_time = ? WHERE s_user_id = ?", [$login_time, $user_id]);
                                        $helper->set_session("username", $username);
                                        $helper->set_session("user_ID", $user_id);
                                        $helper->set_session("user_img", $user_img);                                
                                        header("Location: index");
                                    }
                                }
                            }
                        }
                    //Otherwise if Regular user => I mean already have an account
                    }else{
                        $login_time = time();
                        if ($helper->normal_query(" SELECT * 
                                                    FROM sessions
                                                    WHERE s_user_id = ?", [$user_id])){
                            $response = $helper->get_user_email();
                            if ($response == 0 ){
                                $helper->normal_query("INSERT INTO sessions (s_user_id, s_log_time ) 
                                                        VALUES (?, ?)", [$user_id, $login_time]);
                                $helper->set_session("username", $username);
                                $helper->set_session("user_ID", $user_id);
                                $helper->set_session("user_img", $user_img);                                
                                header("Location: index");
                            }else{
                                $helper->normal_query("UPDATE sessions SET s_log_time = ? WHERE s_user_id = ?", [$login_time, $user_id]);
                                $helper->set_session("username", $username);
                                $helper->set_session("user_ID", $user_id);
                                $helper->set_session("user_img", $user_img);                                
                                header("Location: index");
                            }
                        }                        
                    }
                }else{
                    $password_error = "Please enter a correct password.";
                    $password_status = "";
                }
            }
        }
    }
    
}
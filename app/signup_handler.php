<?php 
    include "init.php"; 
    $helper = new Base_class();

    //Handle FORM
    if (isset($_POST['signup'])){
        $username    = $helper->sanitize_input($_POST["username"]);
        $email       = $helper->sanitize_input($_POST["email"]);
        $password    = $helper->sanitize_input($_POST["password"]);

        //Handle image upload
        $img_name    = $_FILES["profile_img"]["name"];
        $img_tmp     = $_FILES["profile_img"]["tmp_name"];
        $img_path    = "assets/img/";
        $allowed_ext = ["jpg", "jpeg", "png"];
        $get_ext = explode(".", $img_name);
        $img_ext = end($get_ext);

        $username_status = $email_status = $password_status = $img_status = 1;
        
        //=======================Username validation===========================//
        if (empty($username)){
            $username_error = "Username is required.";
            $username_status = "";
        }
        //=======================Email validation================================//
        if (empty($email)){
            $email_error = "Email address is required.";
            $email_status = "";
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_error = "Please provide a valid email format.";
                $email_status = "";
            }else {
                if ($helper->normal_query("SELECT email FROM users WHERE email = ?", [$email])){
                    if ($helper->count_rows() == 0){

                    }else {
                        $email_error = "Sorry, email address is already taken.";
                        $email_status = "";
                    }
                }
            }
        }
        //=======================Password validation===============================//
        if (empty($password)){
            $password_error = "Password is required.";
            $password_status = "";
        }else if(strlen($password) < 6){
            $password_error = "Password at least 6 characters.";
            $password_status = "";
        }
        //=======================Image upload validation============================//
        if (empty($img_name)){
            $img_error = "Profile image is required.";
            $img_status = "";
        }else if(!in_array($img_ext, $allowed_ext)){
            $img_error = "Allowed image format: jpg, jpeg, png.";
            $img_status = "";
        }
        //========================If all checked => Register a new user===============================//
        if (!empty($username_status) && !empty($email_status) && !empty($password_status) &&!empty($img_status)){
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            move_uploaded_file($img_tmp, "$img_path/$img_name");
            $status = 0;
            $d_status = 0;

            $signup = $helper->normal_query(
                "INSERT INTO users (username, email, password, image, status, u_discussion_status) 
                VALUES (?,?,?,?,?,?)",
                [$username, $email, $hashed_password, $img_name, $status, $d_status]);
            if ($signup){
                $helper->set_session("success", "Your account is successfully created.");
                header("Location: sign-in");                
            }
        }
    }
?>

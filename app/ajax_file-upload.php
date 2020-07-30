<?php
include "../init.php";
$helper = new Base_class();

//Retrieve input text file name 
if (isset($_FILES["upload-file"]["name"])){
    
    //Handle image upload
    $img_name    = $_FILES["upload-file"]["name"];
    $img_tmp     = $_FILES["upload-file"]["tmp_name"];
    $img_path    = "../assets/img/";
    $allowed_ext = ["jpg", "JPG", "jpeg", "JPEG", "png", "zip", "pdf", "docx", "xlsx"];
    $get_ext = explode(".", $img_name);
    $img_ext = end($get_ext);

    //=======================Image upload validation============================//        
    if (empty($img_name)){
        echo "Please choose an image.";
        
    }else if(!in_array($img_ext, $allowed_ext)){
        // echo "Allowed image format: jpg, jpeg, png.";
        echo "file format error";
    } else{
        move_uploaded_file($img_tmp, "$img_path/$img_name");
        $user_ID = $_SESSION['user_ID'];        
        if ($helper->normal_query("INSERT INTO messages (m_msg, m_type, m_user_id) VALUE (?,?,?)", [$img_name, $img_ext, $user_ID])){            
            echo "success";
        }
    }
    
}
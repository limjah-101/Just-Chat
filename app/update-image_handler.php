<?php
$helper = new Base_class();

if (isset($_POST['update-profile_img'])){

    //Handle image upload
    $img_name    = $_FILES["profile_img"]["name"];
    $img_tmp     = $_FILES["profile_img"]["tmp_name"];
    $img_path    = "assets/img/";
    $allowed_ext = ["jpg", "jpeg", "png"];
    $get_ext = explode(".", $img_name);
    $img_ext = end($get_ext);

    //=======================Image upload validation============================//
    if (empty($img_name)){
        $img_error = "Please choose an image.";
        
    }else if(!in_array($img_ext, $allowed_ext)){
        $img_error = "Allowed image format: jpg, jpeg, png.";

    } else{
        move_uploaded_file($img_tmp, "$img_path/$img_name");

        $user_ID = $_SESSION['user_ID'];
        $stmt = $helper->normal_query("UPDATE users SET image = ? WHERE id = ?", [$img_name, $user_ID]);
        if ($stmt){
            $helper->set_session("success", "Profile image was successfully updated");
            header("Location: index");
        }
    }
    
}
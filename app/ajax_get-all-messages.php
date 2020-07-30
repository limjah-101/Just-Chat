<?php
include "../init.php";
$helper = new Base_class();

if (isset($_GET["message"])){    
    $user_id = $_SESSION["user_ID"];
    //
    if ($helper->normal_query("SELECT d_msg_id FROM discussion WHERE d_user_id = ?",[$user_id])){
        $res = $helper->get_user_email();
        $d_msg_id = $res->d_msg_id;
        // echo "User_id " . $user_id;
        //Select last message ID
        $helper->normal_query("SELECT m_id FROM messages ORDER BY m_id DESC LIMIT 1");
        $result= $helper->get_user_email();
        $m_msg_id = $result->m_id;
        
        //@To explain
        $helper->normal_query(" SELECT * FROM messages 
                                INNER JOIN users ON messages.m_user_id = users.id 
                                WHERE messages.m_id BETWEEN $d_msg_id AND $m_msg_id
                                ORDER BY messages.m_id ASC");
        //Handle if no msg
        if($helper->count_rows() == 0){
            echo "Let's start discussion dude!";
        }else{
            $m_result = $helper->get_all();
            foreach($m_result as $data){
                // echo "<pre>";
                // print_r($data);
                $u_name = ucwords($data->username);
                $u_img = $data->image;
                $u_msg = $data->m_msg;
                $u_msg_type = $data->m_type;
                $u_id = $data->id;
                $u_msg_timestamp = $helper->time_handler($data->m_date);
                $u_status = $data->status;
                if ($u_status == 0){
                    $u_check_status = '<span class="offline-icon"></span>';
                } else {
                    $u_check_status = '<span class="online-icon"></span>';
                }
                
                //Check if Right User
                if ($user_id == $u_id){
                    // echo "SESSION ID => ". $user_id;
                    // echo "DB user id => " . $u_id;
                    if($u_msg_type == "text"){
                        
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">         
                                    <span class="sent_msg-icon">&#10004</span>                   
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg">
                                    <p>'. $u_msg .'</p>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "jpg" || $u_msg_type == "JPG" || $u_msg_type == "JPEG" || $u_msg_type == "jpeg"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">  
                                    <span class="sent_msg-icon">&#10004</span>                            
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <img src="assets/img/'. $u_msg .'" class="img_file" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "png" || $u_msg_type == "PNG"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">  
                                    <span class="sent_msg-icon">&#10004</span>                            
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <img src="assets/img/'. $u_msg .'" class="img_file" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "zip" || $u_msg_type == "ZIP"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">   
                                    <span class="sent_msg-icon">&#10004</span>                           
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <a href="assets/img/'. $u_msg .'"><i class="fas fa-arrow-circle-down"></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "docx"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">  
                                    <span class="sent_msg-icon">&#10004</span>                            
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <a href="assets/img/'. $u_msg .'"><i class="far fa-file-word "></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "pdf" ){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">   
                                    <span class="sent_msg-icon">&#10004</span>                           
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <a href="assets/img/'. $u_msg .'" target="_blank"><i class="far fa-file-pdf pdf"></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "emoji"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">  
                                    <span class="sent_msg-icon">&#10004</span>                            
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <img src="'. $u_msg .'" class="animated-emoji" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "xlsx"){
                        echo '<div class="right-message common-margin">                    
                            <div class="right-msg-area">
                                <div class="user-name-date right">      
                                    <span class="sent_msg-icon">&#10004</span>                        
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="right-msg__files">
                                    <a href="assets/img/'. $u_msg .'"><i class="far fa-file-excel "></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }
                }else{
                    // echo "No messages";
                    if($u_msg_type == "text"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg">
                                    <p>'. $u_msg .'</p>
                                </div>
                            </div>
                        </div>';
                        
                    }else if($u_msg_type == "jpg" || $u_msg_type == "JPG" || $u_msg_type == "JPEG" || $u_msg_type == "jpeg"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">
                                <img src="assets/img/'. $u_msg .'" class="img_file" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "png" || $u_msg_type == "PNG"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">
                                <img src="assets/img/'. $u_msg .'" class="img_file" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "zip" || $u_msg_type == "ZIP"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">                                    
                                    <a href="assets/img/'. $u_msg .'"><i class="fas fa-arrow-circle-down"></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "docx"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">                                    
                                    <a href="assets/img/'. $u_msg .'"><i class="far fa-file-word "></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "pdf" ){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">                                    
                                    <a href="assets/img/'. $u_msg .'" target="_blank"><i class="far fa-file-pdf pdf"></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "emoji"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">                                    
                                    <img src="'. $u_msg .'" class="animated-emoji" />
                                </div>
                            </div>
                        </div>';
                    }else if($u_msg_type == "xlsx"){
                        echo '<div class="left-message common-margin">
                            <div class="sender-img-block">
                                <img src="assets/img/'. $u_img .'" alt="" class="sender-img">
                                '. $u_check_status .'
                            </div>
                            <div class="left-msg-area">
                                <div class="user-name-date">
                                    <span class="sender-name">'. $u_name .'</span>                                    
                                    <span class="date">'. $u_msg_timestamp  .'</span>
                                </div>
                                <div class="left-msg__file">                                    
                                    <a href="assets/img/'. $u_msg .'"><i class="far fa-file-word "></i>'. $u_msg .'</a>
                                </div>
                            </div>
                        </div>';
                    }
                }
            }
        }

    }

}
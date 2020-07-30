$(document).ready(() => {
    //===============SCROLL DOWN TILL LAST MESSAGE================//
    
    
    //===============SEND TEXT MESSAGE HANDLER====================//
    $('.chat-form').keypress(e => {
        // e.preventDefault();        
        if (e.keyCode == 13){
            let message = $('.textarea').val(); 

            if (message.length != ""){
                $.ajax({
                    type: "POST",
                    url: "app/ajax_send-message.php",
                    data: { message: message },
                    dataType: 'JSON',
                    success: response => {
                        if (response.status == 200){                            
                            $('.chat-form').trigger('reset');
                            get_all_messages();
                            $('.chat-right__msg').animate({ scrollTop: $('.chat-right__msg')[0].scrollHeight }, 500);
                        }
                    }
                }) ;
            } else {
                alert("Please type your message.")
            }
        }
    });
    //===============SEND FILE | IMAGES HANDLER => ===============//
    $('#upload-file').change(() => {
        let fileName = $('#upload-file').val();
        if (fileName.length != ""){
            $.ajax({
                type: "POST",
                url: "app/ajax_file-upload.php",
                data: new FormData($('.chat-form')[0]),
                contentType: false,
                processData: false,
                success: response =>{
                    // alert(response);
                    if(response == "file format error"){    
                        let errorMsg = "Allowed file format: jpg, jpeg, pdf, docx, zip"                  ;
                        $('.upload-file__error').addClass('show-error');
                        $('.upload-file__error').html('<span class="error-icon">&#x2715;</span>'+errorMsg);
                        setTimeout(() => {
                            $('.show-error').fadeOut('slow')
                        }, 5000);                        
                    }else if(response == "success"){                        
                        get_all_messages();
                        $('.chat-right__msg').animate({ scrollTop: $('.chat-right__msg')[0].scrollHeight }, 500);
                    }
                }
            })
        }
    });
    //==================SEND EMOJI HANDLER========================//
    $('.emoji-icon').click(function(){
        let emoji = $(this).attr("src");             
        $.ajax({
            type: 'POST',
            url: 'app/ajax_emoji-upload.php',
            data: { emoji: emoji },
            dataType: 'JSON',
            success: response => {
                if (response.status == 200){
                    get_all_messages();
                    $('.chat-right__msg').animate({ scrollTop: $('.chat-right__msg')[0].scrollHeight }, 500);
                }
            }
        })
    });
    //==================CLEAR ALL MESSAGES========================//
    $('.clear-msg').click(e => {
        e.stopImmediatePropagation();
        let clearMessages = 1;
        $.ajax({
            type: 'POST',
            url: 'app/ajax_clear-messages.php',
            data: {clearMessages: clearMessages},
            dataType: 'JSON',
            success: response => {
                if(response.status == 200){
                    get_all_messages();
                    window.location = 'index';
                }
            }
        })
    })
    //=====================REFRESH MESSAGES | ONLINE USERS========//
    setInterval(() => {
        get_all_messages();
        checkUserStatus()  ;
        displayOnlineUsers();      
    }, 1500);
    
});

//====================DISPLAY ONLINE USERS=========================//
function displayOnlineUsers(){
    $.ajax({
        type: 'GET',
        url: 'app/ajax_fetch-online-users.php',
        dataType: 'JSON',
        success: response => {   
            if(response.users > 0){
                $('.online-users').html(response.users);
            }            
        }
    })
}

//===============CHECK ONLINE USERS THEN DISCONNECT 30mn===========//
function checkUserStatus(){
    $.ajax({
        type: 'GET',
        url: 'app/ajax_check-online-users.php',
        dataType: 'JSON',
        success: response => {
            if (response.status == 'href'){
                window.location = 'sign-in.php';
            }
        }
    });
}
//====================FETCH ALL MESSAGES==========================//
function get_all_messages(){
    let msg = true;
    $.ajax({
        type: 'GET',
        url: 'app/ajax_get-all-messages.php',        
        data: { 'message' : msg },
        success: response => {            
            $('.chat-right__msg').html(response);
        }
    })
}
get_all_messages()
$('.chat-right__msg').animate({ scrollTop: $('.chat-right__msg')[0].scrollHeight }, 500);
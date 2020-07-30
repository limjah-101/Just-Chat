$(document).ready(() => {
    //===========MANAGE INPUT FILE===============//
    $(document).on('change', '.input-file', () => {        
        let file_name = $('.input-file').val();
        $('.input-file__label').html(file_name.slice(12));
    })
    //============APP PRELOADER==================//
    setTimeout(function(){
        $('body').addClass('loaded');          
    }, 500); 
    
    //============HANDLE SIDEBAR TOGGLE==========//
    $('.nav-icon').click((e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
        $('.sidebar').fadeToggle();        
    })

    //=============HANDLE POPUP MODAL============//
    $('.close-btn').click((e) => {  
        e.preventDefault();      
        $('.popup').hide();
    });
    //============================================//
    setTimeout(() => {
        $('.popup').fadeOut('slow');
        // $('.upload-file__error').fadeOut('slow')
    }, 3000)
    

})
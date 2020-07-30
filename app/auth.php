<?php if(!isset($_SESSION["user_ID"])): ?>
    <?php 
        $helper = new Base_class;
        $helper->set_session("auth", "Please login first ;-)");
        header("Location: sign-in"); 
    ?>
<?php endif; ?>
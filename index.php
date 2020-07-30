<?php include "init.php"; ?>

<?php include "app/auth.php"; ?>

<?php include "layouts/header.php"; ?>

<?php if(!isset($_SESSION["user_ID"])): ?><!--remove popup on load-->
    <?php header("Location: sign-in"); ?>
<?php endif; ?>

<?php if(isset($_SESSION["success"])): ?>
    <div class="popup">
        <span class="close-btn">&times;</span>
        <div class="popup__heading success">
            <h3><span>&#10004;</span>SUCCESS</h3>
        </div>
        <div class="popup__body">
            <p class="success"><?=$_SESSION["success"]?></p>
            <?php unset($_SESSION["success"]) ?>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION["error"])): ?>
    <div class="popup">
        <span class="close-btn">&times;</span>
        <div class="popup__heading error">
            <h3><span>&#x2715;</span>ERROR</h3>
        </div>
        <div class="popup__body">
            <p class="error"><?=$_SESSION['error']?></p>  
            <?php unset($_SESSION["error"]) ?>          
        </div>
    </div>
<?php endif; ?>

<?php include "components/navbar.php"; ?>
    <section class="chat-container">
        <?php include "components/sidebar.php"; ?>

        <article class="chat-right">
            <?php include "components/message-container.php" ?>
            

            
            <?php include "components/message-form.php"; ?>

            <?php include "components/emoji.php"; ?>
            <!--@end emoji-->
        </article><!--@end chat-right-->
    </section>


    
    <?php include "components/js.php"; ?>
</body>
</html>
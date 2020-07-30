
<?php include "app/signin_handler.php"; ?>

<?php include "layouts/header.php"; ?> 


<?php if(isset($_SESSION["auth"])): ?>
    <div class="popup">
        <span class="close-btn">&times;</span>
        <div class="popup__heading error">
            <h3><span>&#x2715;</span>NICE TRY BUT</h3>
        </div>
        <div class="popup__body">
            <p class="error"><?=$_SESSION['auth']?></p>  
            <?php unset($_SESSION["auth"]) ?>          
        </div>
    </div>
<?php endif; ?>  
    <section class="signup__container">
        <div class="signup__left"></div><!--@end signup__left-->
        <div class="signup__right">
            <div class="form-area">
                <?php if(isset($_SESSION["success"])): ?>
                    <div class="alert-success">                                
                        <?=$_SESSION["success"];?>                
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['success']); ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <h1 class="form-heading">Sing In</h1>
                    </div>                
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" 
                            placeholder="Email address" 
                            autocomplete="off"
                            value="<?php if (isset($email)): echo $email; endif;?>"
                        >
                        <span class="username_error error">
                            <?php if(isset($email_error)): ?>
                                <?=$email_error?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" 
                            placeholder="Create password"
                            value="<?php if (isset($password)): echo $password; endif;?>"
                        >
                        <span class="username_error error">
                            <?php if(isset($password_error)): ?>
                                <?=$password_error?>
                            <?php endif; ?>
                        </span>
                    </div>                
                    <div class="form-group">
                        <input type="submit" name="sign_in" class="btn signup-btn" value="Sign In">
                    </div>
                    <div class="form-group">
                        <p class="form-footer">Create an account ? <a href="sign-up">Sign Up</<a></p>
                    </div>
                </form>
            </div>
        </div><!--@end signup__right-->
    </section> <!--@end signup-container-->   
    
    <?php include "components/js.php"; ?>
</body>
</html>
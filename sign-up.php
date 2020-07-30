<?php include "app/signup_handler.php"; ?>

<?php include "layouts/header.php"; ?> 

    
<section class="signup__container">
    <div class="signup__left"></div><!--@end signup__left-->
    <div class="signup__right">
        <div class="form-area">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <h1 class="form-heading">Create new account</h1>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" 
                        placeholder="Username" 
                        autocomplete="off"
                        value="<?php if (isset($username)): echo $username; endif;?>"
                    >
                    <span class="username_error error">
                        <?php if(isset($username_error)): ?>
                            <?=$username_error?>
                        <?php endif; ?>
                    </span>
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
                    <label for="input-file" class="input-file__label">
                    <i class="fas fa-cloud-upload-alt input-file__icon"></i>    
                    Choose image</label>
                    <input type="file" name="profile_img" class="input-file" id="input-file">
                    <span class="username_error error">
                        <?php if(isset($img_error)): ?>
                            <?=$img_error?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="form-group">
                    <input type="submit" name="signup" class="btn signup-btn" value="Create Account">
                </div>
                <div class="form-group">
                    <p class="form-footer">Already have an account ? <a href="sign-in">Sign In here</<a></p>
                </div>
            </form><!--@end form-->
        </div>
    </div><!--@end signup__right-->
</section> <!--@end signup-container-->   

<?php include "components/js.php"; ?>

</body>
</html>
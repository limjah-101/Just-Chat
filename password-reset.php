<?php include "init.php"; ?>

<?php include "app/auth.php"; ?>

<?php include "app/password-reset_handler.php"; ?>

<?php include "layouts/header.php"; ?> 

<?php include "components/navbar.php"; ?> 

       <section class="chat-container">           
           <?php include "components/sidebar.php"; ?>

           <article class="right-area">
               <div class="form-section">
                    <div class="form-grid">
                        <form action="" method="POST">
                            <div class="form-group">
                                <h1 class="form-heading">Reset password</h1>
                            </div>
                            <div class="form-group">
                                <input type="password" name="current_password" class="form-control" 
                                    placeholder="Current password"
                                    value="<?php if (isset($pwd)): echo $pwd; endif;?>"
                                >
                                <span class="username_error error">
                                    <?php if(isset($pwd_error)): ?>
                                        <?=$pwd_error?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" class="form-control" 
                                    placeholder="New password"
                                    
                                >
                                <span class="username_error error">
                                    <?php if(isset($new_error)): ?>
                                        <?=$new_error?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="retype_new_password" class="form-control" 
                                    placeholder="Confirm new password"
                                    
                                >
                                <span class="username_error error">
                                    <?php if(isset($confirm_error)): ?>
                                        <?=$confirm_error?>
                                    <?php endif; ?>
                                </span>
                            </div>                
                            <div class="form-group">
                                <input type="submit" name="reset" class="btn signup-btn" value="Confirm">
                            </div>
                            
                        </form>
                   </div><!--@end form-grid-->
               </div><!--@end form-section-->
           </article><!--@end form-area-->
        </section>
        <?php include "components/js.php"; ?>
    </body>
</html>
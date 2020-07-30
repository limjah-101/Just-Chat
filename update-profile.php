<?php include "init.php"; ?>
<?php include "app/auth.php"; ?>
<?php include "app/update-profile_handler.php"; ?>
<?php include "layouts/header.php"; ?>
<?php include "components/preloader.php"; ?>
<?php include "components/navbar.php"; ?>
        <section class="chat-container">
            <?php include "components/sidebar.php"; ?>
            
            <article class="right-area">
                <div class="form-section">
                    <div class="form-grid">
                        <form action="" method="POST">
                        <div class="form-group">
                            <h1 class="form-heading">Update username</h1>
                        </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" 
                                    placeholder="Username ..." 
                                    autocomplete="off"                                    
                                    value="<?=$user->username?>"
                                >
                                <span class="username_error error">
                                    <?php if(isset($error_msg)): ?>
                                        <?=$error_msg?>
                                    <?php endif; ?>
                                </span>
                            </div>                                           
                            <div class="form-group">
                                <input type="submit" name="update-profile" class="btn signup-btn" value="Save changes">
                            </div>
                        </form>
                    </div><!--@end form-grid-->
                </div><!--@end form-section-->
            </article><!--@end form-area-->
        </section>
        <?php include "components/js.php"; ?>
    </body>
</html>
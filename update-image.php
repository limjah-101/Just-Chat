<?php include "init.php"; ?>
<?php include "app/auth.php"; ?>
<?php include "app/update-image_handler.php"; ?>
<?php include "layouts/header.php"; ?>

<?php include "components/navbar.php"; ?>
        <section class="chat-container">
            <?php include "components/sidebar.php"; ?>
            
            <article class="right-area">
                <div class="form-section">
                    <div class="form-grid">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <h1 class="form-heading">Update Profile Picture</h1>
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
                            </div><!--@end input file-->                                      
                            <div class="form-group">
                                <input type="submit" name="update-profile_img" class="btn signup-btn" value="Save changes">
                            </div>
                        </form>
                    </div><!--@end form-grid-->
                </div><!--@end form-section-->
            </article><!--@end form-area-->
        </section>
        <?php include "components/js.php"; ?>
    </body>
</html>
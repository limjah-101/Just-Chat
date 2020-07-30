<?php $helper = new Base_class(); ?>
<aside class="sidebar">
    <ul class="sidebar-items">
    
    <?php if(isset($_SESSION['user_ID'])): ?>
            <?php 
                $user_ID = $_SESSION['user_ID'];
                $helper->normal_query("SELECT * FROM users WHERE id = ?", [$user_ID]);
                $user = $helper->get_user_email();                 
            ?>
        <li>
            <a href="update-image">
                <span class="sidebar-items__img">
                    <img src="assets/img/<?=$user->image?>" alt="profile image" class="profile-img"/>
                </span>
            </a>
        </li>
        <li><a href="index">Home</a></li>
        <li><a href="update-profile"><?=ucfirst($user->username)?></a></li>       
        <?php endif; ?>        
        <li><a href="password-reset">Password</a></li>
        <li><a href="javascript:void(0)"><span class="online-users"></span></a></li>
        <li><a href="javascript:void(0)" class="clear-msg">Clear Inbox</a></li>
        <li><a href="app/logout">Log Out</a></li>
    </ul>
</aside>
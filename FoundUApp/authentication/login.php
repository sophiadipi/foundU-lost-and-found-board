<!--****************************************************************************
 * FoundU - Authentication
 * 
 * login.php
 * 
 * This file acts as the view for the Login page in the Authentication module of 
 * the FoundU application. It displays an input field for email and password. 
 * The form submits data to the controller for validation and processing. 
 * Validation error messages are displayed if the user enters invalid data. 
 * If the user enters a valid email and matching password, the controller loads 
 * the Browse Listings view.  
 * 
 ****************************************************************************-->
<?php 
    $bodyClass = "authPage";
    include('../view/header.php'); 
?>

<div class="authDiv">
    <div class="intro">
        <h1>Welcome Back</h1>
        <p>Sign in to your FoundU account to continue.</p>
    </div>
    <!--Login form-->
    <div class="authForm" id="loginForm">
        <form id="aligned" action="index.php" method="post">
            <input type="hidden" name="action" value="login">
    
            <div class="labelRow">
                <label><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;Email</label>
                <span class="error"><?php echo $fields->getField('email')->getHTML(); ?></span>
            </div>
            <input type="text" name="email"
                value="<?php echo htmlspecialchars($email); ?>">
            <br>
    
            
            <div class="labelRow">
                <label><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Password</label>
                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
            </div>
            <input type="password" name="password" 
                value="<?php echo htmlspecialchars($password); ?>">
            <br>

            <input type="submit" value="Login">
            <br>
        </form>
    
        <span class="bottom">Don't have an account? <a href="index.php?action=show_register">Register now</a></span>
    
    </div>
</div>

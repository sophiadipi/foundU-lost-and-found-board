<!--****************************************************************************
 * FoundU - Authentication
 * 
 * register.php
 * 
 * This file acts as the view for the Register page in the Authentication module 
 * of the FoundU application. It displays input fields for first name, 
 * last name, email, phone, and password, as well as a dropdown list to select
 * your home university. The form submits data to the controller for validation 
 * and processing. Validation error messages are displayed if the user enters 
 * invalid data. If the user enters valid data, the controller loads the Browse 
 * Listings view.  
 * 
 ****************************************************************************-->
<?php 
    $bodyClass = "authPage";
    include('../view/header.php'); 
?>

<div class="authDiv">
    <div class="intro">
        <h1>Create an Account</h1>
        <p>Sign up to start posting lost or found items and help others recover what
        they've misplaced.</p>
    </div>
    <!--Login form-->
    <div class="authForm" id="registerForm">
        <form id="aligned" action="index.php" method="post">
            <input type="hidden" name="action" value="register">
            
            <div class="labelRow">
                <label><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;First Name</label>
                <span class="error"><?php echo $fields->getField('firstName')->getHTML(); ?></span>
            </div>
            <input type="text" name="firstName" 
                   value="<?php echo htmlspecialchars($firstName); ?>">
            <br>
            
            <div class="labelRow">
                <label><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;Last Name</label>
                <span class="error"><?php echo $fields->getField('lastName')->getHTML(); ?></span>
            </div>
            <input type="text" name="lastName" 
                   value="<?php echo htmlspecialchars($lastName); ?>">
            <br>
            
            <div class="labelRow">
                <label><i class="fa-solid fa-graduation-cap"></i>&nbsp;&nbsp;University</label>
            </div>
            <select id="universityID" name="universityID">
                <?php foreach ($universities as $university) : ?>
                    <option value="<?php echo htmlspecialchars($university->getID()); ?>"
                            <?php if ($universityID == $university->getID()) { echo 'selected'; } ?>>
                        <?php echo htmlspecialchars($university->getFullName()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <div class="labelRow">
                <label><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;Email</label>
                <span class="error"><?php echo $fields->getField('email')->getHTML(); ?></span>
            </div>
            <input type="text" name="email" 
                value="<?php echo htmlspecialchars($email); ?>">
            <br>
            
            <div class="labelRow">
                <label><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;Phone Number</label>
                <span class="error"><?php echo $fields->getField('phone')->getHTML(); ?></span>
            </div>
            <input type="text" name="phone" 
                value="<?php echo htmlspecialchars($phone); ?>">
            <br>
    
            <div class="labelRow">
                <label><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Password</label>
                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
            </div>
            <input type="password" name="password">
            <p id="passRules">*Must be 8-16 characters with an uppercase, a lowercase, a number, and a special character.</p><br>
            
            <div class="labelRow">
                <label><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Re-enter Password</label>
                <span class="error"><?php echo $fields->getField('confirmPassword')->getHTML(); ?></span>
            </div>
            <input type="password" name="confirmPassword">
            <br>

            <input type="submit" value="Create Account">
            <br>
        </form>
    
        <span class="bottom">Already have an account? <a href="index.php?action=show_login">Log in</a></span>
    
    </div>
</div>

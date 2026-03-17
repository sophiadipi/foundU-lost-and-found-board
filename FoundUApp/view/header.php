<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum_scale=1.0">
        
        <title>FoundU</title>
        
        <link rel="stylesheet" type="text/css" href="/FoundUApp/main.css">
        
        <!-- Font Awesome stylesheet for icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    </head>
    
    <body class="<?php if(isset($bodyClass)) { echo $bodyClass; } ?>">
        <header>
            <div class="logo">
                <!-- Logo links to landing page -->
                <a href="/FoundUApp/index.php"><img src="/FoundUApp/images/foundULogo.png" alt=""></a>
            </div>
            
            <nav class="navBar">
                <!-- Nav icon for responsive dropdown navigation menu-->
                <a id="navIcon" href="#"><i class="fa-solid fa-bars"></i></a>
                <ul id="navMenu">
                    <li class="navLinks">
                        <a href="/FoundUApp/index.php">Home</a>
                    </li>
                    <li class="navLinks">
                        <a href="/FoundUApp/browseListings/index.php">Browse Listings</a>
                    </li>
                    <?php if (empty($_SESSION['userID'])): ?>
                        <li class="navLinks">
                            <a href="/FoundUApp/authentication/index.php">Login</a>
                        </li>
                        <li class="navLinks">
                            <a href="/FoundUApp/authentication/index.php?action=show_register">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="navLinks">
                            <a href="/FoundUApp/createListing/index.php">Create Listing</a>
                        </li>
                        <li class="navLinks dropdown">
                            <a href="/FoundUApp/accountManagement/index.php">
                                My Account&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i>
                            </a>
                            
                            <ul class="dropdownMenu">
                                <li><a href="/FoundUApp/accountManagement/index.php">Profile</a></li>
                                <li><a href="/FoundUApp/accountManagement/index.php?action=show_listings">My Listings</a></li>
                                <li><a href="/FoundUApp/accountManagement/index.php?action=show_claims">Claims</a></li>
                                <li><a href="/FoundUApp/accountManagement/index.php?action=logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        
        <main>
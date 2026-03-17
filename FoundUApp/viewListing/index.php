<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 17, 2026
 * 
 * FoundUApp - View Listing
 * 
 * index.php
 * 
 * This script acts as the controller for the BrowseListings module of the 
 * FoundUApp application. It handles incoming user requests, 
 * validates input, performs database operations, and loads the appropriate
 * view.  
 * 
 ******************************************************************************/
// Redirect HTTP requests to HTTPS
$https = filter_input(INPUT_SERVER, 'HTTPS');
if (empty($https) || $https === 'off') {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $url = 'https://' . $host . $uri;
    header("Location: " . $url);
    exit();
}

// Start session manageement with a session cookie if no session exists
if (session_id() === '') {
    $lifetime = 0;
    $path = '/FoundUApp';
    $domain = '';
    $secure = TRUE;
    $httponly = TRUE;
    
    session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
    session_start();
}

require('../model/Database.php');
require('../model/Listing.php');
require('../model/ListingDB.php');
require('../model/University.php');
require('../model/UniversityDB.php');
require('../model/ItemCategory.php');
require('../model/ItemCategoryDB.php');
require('../util/DateFormat.php');


// Get requested action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'viewListing';
    }
}

if ($action === 'viewListing') {
    $listingID = filter_input(INPUT_GET, 'listingID');
    
    if ($listingID === NULL | $listingID === FALSE) {
        include('../view/databaseError.php');
        exit();
    }
    
    $listing = ListingDB::getListingByID($listingID);
    
    if ($listing === NULL) {
        include('../view/databaseError.php');
        exit();
    }
    
    include('viewListing.php');
} else if ($action === 'submitClaim') {
    // Redirect user to login page if they are not logged in
    if (empty($_SESSION['userID'])) {
        header("Location: /FoundUApp/authentication/index.php?action=show_login");
        exit();
    }
    
    // Get listingID 
    $listingID = filter_input(INPUT_POST, 'listingID');
    
    // Get the listing
    $listing = ListingDB::getListingByID($listingID);
    
    if ($listing === NULL) {
        include('../view/databaseError.php');
        exit();
    }
    
    // Load claim form page
    include('submitForm.php');
} else if ($action == 'createClaim') {
    
}


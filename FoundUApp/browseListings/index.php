<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 14, 2026
 * 
 * FoundUApp - Browse Listings
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

require('../model/Validate.php');
require('../model/Database.php');
require('../model/Fields.php');
require('../util/DateFormat.php');
require('../model/University.php');
require('../model/UniversityDB.php');
require('../model/ItemCategory.php');
require('../model/ItemCategoryDB.php');
require('../model/User.php');
require('../model/UserDB.php');
require('../model/Listing.php');
require('../model/ListingDB.php');

// Get requested action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'showBrowseListings';
    }
}

if ($action === 'showBrowseListings') {
    $keyword = '';
    $universityID = NULL;
    $categoryID = NULL;
    $listingType = NULL;
    $universities = UniversityDB::getUniversities();
    $categories = ItemCategoryDB::getItemCategories();
    
    if (empty($_SESSION['userID'])) {
        $listings = ListingDB::getOpenListings();
    } else {
        $listings = ListingDB::getOpenListingsByUniversityID($_SESSION['universityID']);
    }
    
    include('browseListings.php');
} else if ($action === 'search') {
    // Get data from form
    $keyword = trim(filter_input(INPUT_POST, 'keyword'));
    $universityID = NULL;
    $categoryID = NULL;
    $listingType = NULL;
    $universities = UniversityDB::getUniversities();
    $categories = ItemCategoryDB::getItemCategories();
    
    if (empty($_SESSION['userID'])) {
        $listings = ListingDB::searchAndFilterOpenListings($keyword);
    } else {
        $listings = ListingDB::searchAndFilterOpenListings($keyword, NULL, NULL, $_SESSION['universityID']);
    }
    
    include('browseListings.php');
    
} else if ($action === 'filter') {
    // Get data from the form
    $keyword = trim(filter_input(INPUT_POST, 'keyword'));
    $categoryID = filter_input(INPUT_POST, 'categoryID');
    $universityID = filter_input(INPUT_POST, 'universityID');
    $listingType = filter_input(INPUT_POST, 'listingType');
    
    $listings = ListingDB::searchAndFilterOpenListings($keyword, $listingType, $categoryID, $universityID);
    
    $universities = UniversityDB::getUniversities();
    $categories = ItemCategoryDB::getItemCategories();
    
    include('browseListings.php');   
}
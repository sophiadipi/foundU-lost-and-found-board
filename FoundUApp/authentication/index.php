<?php
/*******************************************************************************
 * FoundU - Authentication 
 * 
 * index.php
 * 
 * This script acts as the controller for the Authentication module of the 
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
require('../model/University.php');
require('../model/UniversityDB.php');
require('../model/User.php');
require('../model/UserDB.php');

// Create Validate object and set up fields that will be validated
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('firstName');
$fields->addField('lastName');
$fields->addField('email');
$fields->addField('phone');
$fields->addField('password');
$fields->addField('confirmPassword');

// Get requested action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_login';
    }
}

if ($action === 'show_login') {
    $email = '';
    $password = '';
    
    include('login.php');
} else if ($action === 'login') {
    // Get form data
    $email = trim(filter_input(INPUT_POST, 'email'));
    $password = filter_input(INPUT_POST, 'password');
    
    // Validate form data
    $validate->email('email', $email, TRUE);
    $validate->text('password', $password, TRUE);
    
    // If input fails validation checks, reload login page
    if ($fields->hasErrors()) {
        include('login.php');
        exit();
    }
    
    // Try to find the user record matching the provided email
    $user = UserDB::getUserByEmail($email);
    
    // If user not found, set error message and reload login page
    if ($user === NULL) {
        $fields->getField('email')->setErrorMessage('Email not found.');
        include('login.php');
        exit();
    }
    
    /* If the password provided does not match the password hash in the DB, set
     * error message and reload login page. */
    if (UserDB::isValidUser($email, $password) === FALSE) {
        $fields->getField('password')->setErrorMessage('Incorrect password.');
        include('login.php');
        exit();
    }
    
    // Save logged-in user ID to session array
    $_SESSION['userID'] = $user->getID();
    $_SESSION['firstName'] = $user->getFirstName();
    $_SESSION['universityID'] = $user->getUniversityID();
    
    // Redirect to browse listings page
    header("Location: ../browseListings/index.php");
    exit();
    
} else if ($action === 'show_register') {
    $firstName = '';
    $lastName = '';
    $universityID = '';
    $email = '';
    $phone = '';
    $password = '';
    $universities = UniversityDB::getUniversities();
    
    include('register.php');
} else if ($action === 'register') {
    // Get data from form
    $firstName = trim(filter_input(INPUT_POST, 'firstName'));
    $lastName = trim(filter_input(INPUT_POST, 'lastName'));
    $universityID = filter_input(INPUT_POST, 'universityID');
    $email = trim(filter_input(INPUT_POST, 'email'));
    $phone = trim(filter_input(INPUT_POST, 'phone'));
    $password = filter_input(INPUT_POST, 'password');
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
    
    // Validate form data 
    $validate->text('firstName', $firstName, TRUE, 2, 50);
    $validate->text('lastName', $lastName, TRUE, 2, 50);
    $validate->email('email', $email, TRUE);
    $validate->phone('phone', $phone, TRUE);
    $validate->password('password', $password, TRUE);
    
    $universities = UniversityDB::getUniversities();
    
    if ($fields->hasErrors()) {
        include('register.php');
        exit();
    }
    
    if (UserDB::emailExists($email) === TRUE) {
        $fields->getField('email')->setErrorMessage('This email is already in use.');
        include('register.php');
        exit();
    }
    
    if ($confirmPassword !== $password) {
        $fields->getField('confirmPassword')->setErrorMessage('Passwords must match.');
        include('register.php');
        exit();
    }
    
    // Add the user to the database
    UserDB::addUser($firstName, $lastName, $universityID, $email, $phone, $password);
    
    $user = UserDB::getUserByEmail($email);
    
    $_SESSION['userID'] = $user->getID();
    $_SESSION['firstName'] = $user->getFirstName();
    $_SESSION['universityID'] = $user->getUniversityID();
    
    // Redirect to browse listings page
    header("Location: ../browseListings/index.php");
    exit();
}



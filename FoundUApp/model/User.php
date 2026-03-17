<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * User.php
 * 
 * The User class represents a user object in the FoundU
 * application. It stores user information including user ID, 
 * first name, last name, university ID, email, phone number, and a hash of the
 * user's password. The class provides getter and setter methods for accessing 
 * and modifying object properties. 
 * 
 ******************************************************************************/
class User {
    private $userID, $firstName, $lastName, $universityID, $email, $phone,
            $passwordHash;
    
    public function __construct($firstName, $lastName, $universityID, $email, 
            $phone, $passwordHash) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->universityID = $universityID;
        $this->email = $email;
        $this->phone = $phone;
        $this->passwordHash = $passwordHash;
    }
    
    public function getID() {
        return $this->userID;
    }
    
    public function setID($id) {
        $this->userID = $id;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function setFirstName($name) {
        $this->firstName = $name;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function setLastName($name) {
        $this->lastName = $name;
    }
    
    public function getUniversityID() {
        return $this->universityID;
    }
    
    public function setUniversityID($id) {
        $this->universityID = $id;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    public function getPasswordHash() {
        return $this->passwordHash;
    }
    
    public function setPasswordHash($hash) {
        $this->passwordHash = $hash;
    }
}

<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * Claim.php
 * 
 * The Claim class represents a claim object in the FoundU
 * application. It stores claim information including claim ID, listing ID, 
 * user ID, and a message. The class provides getter and setter methods for 
 * accessing and modifying object properties. 
 * 
 ******************************************************************************/
class Claim {
    private $claimID, $listingID, $userID, $message, $status, $dateSubmitted;
    
    public function __construct($listingID, $userID, $message, $dateSubmitted, 
            $status = 'pending') {
        $this->listingID = $listingID;
        $this->userID = $userID;
        $this->message = $message;
        $this->dateSubmitted = $dateSubmitted;
        $this->status = $status;
    }
    
    public function getID() {
        return $this->claimID;
    }
    
    public function setID($id) {
        $this->claimID = $id;
    }
    
    public function getListingID() {
        return $this->listingID;
    }
    
    public function setListingID($id) {
        $this->listingID = $id;
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($id) {
        $this->userID = $id;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function getDateSubmitted() {
        return $this->dateSubmitted;
    }
    
    public function setDateSubmitted($date) {
        $this->dateSubmitted = $date;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
}
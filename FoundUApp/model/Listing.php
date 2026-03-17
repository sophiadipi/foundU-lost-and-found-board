<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * Listing.php
 * 
 * The Listing class represents a listing object in the FoundU
 * application. It stores listing information including listingID, 
 * item name, item description, university ID, listing type, categoryID, date 
 * lost/found, date posted, and listing status. The class provides getter and 
 * setter methods for accessing and modifying object properties. 
 * 
 ******************************************************************************/
class Listing {
    private $listingID, $itemName, $itemDescription, $universityID, $listingType,
            $imagePath, $categoryID, $userID, $dateLostOrFound, $datePosted, 
            $status;
    
    public function __construct($itemName, $itemDescription, $universityID,
            $listingType, $categoryID, $userID, $dateLostOrFound, 
            $datePosted, $status = 'open', $imagePath = NULL) {
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
        $this->universityID = $universityID;
        $this->listingType = $listingType;
        $this->categoryID = $categoryID;
        $this->userID = $userID;
        $this->dateLostOrFound = $dateLostOrFound;
        $this->datePosted = $datePosted;
        $this->status = $status;
        $this->imagePath = $imagePath;
    }
    
    public function getID() {
        return $this->listingID;
    }
    
    public function setID($id) {
        $this->listingID = $id;
    }
    
    public function getItemName() {
        return $this->itemName;
    }
    
    public function setItemName($name) {
        $this->itemName = $name;
    }
    
    public function getItemDescription() {
        return $this->itemDescription;
    }
    
    public function setItemDescription($description) {
        $this->itemDescription = $description;
    }
    
    public function getUniversityID() {
        return $this->universityID;
    }
    
    public function setUniversityID($id) {
        $this->universityID = $id;
    }
    
    public function getListingType() {
        return $this->listingType;
    }
    
    public function setListingType($type) {
        $this->listingType = $type;
    }
    
    public function getCategoryID() {
        return $this->categoryID;
    }
    
    public function setCategoryID($id) {
        $this->categoryID = $id;
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($id) {
        $this->userID = $id;
    }
    
    public function getDateLostOrFound() {
        return $this->dateLostOrFound;
    }
    
    public function setDateLostOrFound($date) {
        $this->dateLostOrFound = $date;
    }
    
    public function getDatePosted() {
        return $this->datePosted;
    }
    
    public function setDatePosted($date) {
        $this->datePosted = $date;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }    
    
    public function getImagePath() {
        return $this->imagePath;
    }
    
    public function setImagePath($path) {
        $this->imagePath = $path;
    }
}

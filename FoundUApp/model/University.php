<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * University.php
 * 
 * The University class represents a uinversity object in the FoundU
 * application. It stores university information including university ID, 
 * university name, abbreviate university name, and city. The class provides 
 * getter and setter methods for accessing and modifying object properties. 
 * 
 ******************************************************************************/
class University {
    private $universityID, $fullName, $shortName, $city;
    
    public function __construct($fullName, $shortName, $city) {
        $this->fullName = $fullName;
        $this->shortName = $shortName;
        $this->city = $city;
    }
    
    public function getID() {
        return $this->universityID;
    }
    
    public function setID($id) {
        $this->universityID = $id;
    }
    
    public function getFullName() {
        return $this->fullName;
    }
    
    public function setFullName($name) {
        $this->fullName = $name;
    }
    
    public function getShortName () {
        return $this->shortName;
    }
    
    public function setShortName($name) {
        $this->shortName = $name;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function setCity($city) {
        $this->city = $city;
    }
}

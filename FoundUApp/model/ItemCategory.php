<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * ItemCategory.php
 * 
 * The ItemCategory class represents an item category object in the FoundU
 * application. It stores item category information including categoryID and 
 * name. The class provides getter and setter methods for accessing and 
 * modifying object properties. 
 * 
 ******************************************************************************/
class ItemCategory {
    private $categoryID, $categoryName;
    
    public function __construct($categoryName) {
        $this->categoryName = $categoryName;
    }
    
    public function getID() {
        return $this->categoryID;
    }
    
    public function setID($id) {
        $this->categoryID = $id;
    }
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    public function setCategoryName($name) {
        $this->categoryName = $name;
    }
}

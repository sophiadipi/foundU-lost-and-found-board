<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * ItemCategoryDB.php
 * 
 * The ItemCategoryDB class provides database access methods for item category
 * objects in the FoundU application. It contains static methods to 
 * 
 ******************************************************************************/
class ItemCategoryDB {
    public static function getItemCategories() {
        $db = Database::getDB();
    
        $query = 'SELECT * FROM itemcategories
                  ORDER BY categoryName';
    
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
        
            $categories = array();
        
            foreach ($result as $row) {
                $category = new ItemCategory($row['categoryName']);
                $category->setID($row['categoryID']);
            
                $categories[] = $category;
            }
        
            return $categories;
        
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getCategoryByID($categoryID) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM itemcategories
                  WHERE categoryID = :categoryID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return NULL;
            }
            
            $category = new ItemCategory($row['categoryName']);
            
            $category->setID($row['categoryID']);
            
            return $category;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
}

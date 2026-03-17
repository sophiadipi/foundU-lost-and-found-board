<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * ListingDB.php
 * 
 * The ListingDB class provides database access methods for listing
 * objects in the FoundU application. It contains static methods to 
 * 
 ******************************************************************************/
class ListingDB {
    public static function getListingByID($listingID) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM listings
                  WHERE listingID = :listingID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':listingID', $listingID);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return NULL;
            }
            
            $listing = new Listing($row['itemName'],
                                   $row['itemDescription'],
                                   $row['universityID'],
                                   $row['listingType'],
                                   $row['categoryID'],
                                   $row['userID'],
                                   $row['dateLostOrFound'],
                                   $row['datePosted'],
                                   $row['status'],
                                   $row['imagePath']);
            
            $listing->setID($row['listingID']);
            
            return $listing;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function addListing($listing) {
        $db = Database::getDB();
        
        // Get values from the provided listing object
        $itemName = $listing->getItemName();
        $itemDescription = $listing->getItemDescription();
        $universityID = $listing->getUniversityID();
        $listingType = $listing->getListingType();
        $categoryID = $listing->getCategoryID();
        $userID = $listing->getUserID();
        $dateLostOrFound = $listing->getDateLostOrFound()->format('Y-m-d H:i:s');
        $datePosted = $listing->getDatePosted()->format('Y-m-d H:i:s');
        $status = $listing->getStatus();
        $imagePath = $listing->getImagePath();
        
        $query = 'INSERT INTO listings (itemName, itemDescription, universityID, 
                        listingType, imagePath, categoryID, userID, 
                        dateLostOrFound, datePosted, status)
                  VALUES (:itemName, :itemDescription, :universityID,
                          :listingType, :imagePath, :categoryID, :userID, 
                          :dateLostOrFound, :datePosted, :status)';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':itemName', $itemName);
            $statement->bindValue(':itemDescription', $itemDescription);
            $statement->bindValue(':universityID', $universityID);
            $statement->bindValue(':listingType', $listingType);
            $statement->bindValue(':imagePath', $imagePath);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':dateLostOrFound', $dateLostOrFound);
            $statement->bindValue(':datePosted', $datePosted);
            $statement->bindValue(':status', $status);
            $statement->execute();
            $result = $statement->rowCount();
            $statement->closeCursor();
            
            if ($result === 0) {
                return FALSE;
            }
            
            return TRUE;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function deleteListing($listingID) {
        $db = Database::getDB();
        
        $query = 'DELETE FROM listings
                  WHERE listingID = :listingID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':listingID', $listingID);
            $statement->execute();
            $result = $statement->rowCount();
            $statement->closeCursor();
            
            if ($result === 0) {
                return FALSE;
            }
            
            return TRUE;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function updateListing($listingID, $itemName, $itemDescription,
            $universityID, $listingType, $categoryID, $userID, $dateLostOrFound,
            $datePosted, $status, $imagePath) {
        $db = Database::getDB();
        
        $query = 'UPDATE listings
                  SET itemName = :itemName,
                      itemDescription = :itemDescription,
                      universityID = :universityID,
                      listingType = :listingType,
                      imagePath = :imagePath,
                      categoryID = :categoryID,
                      userID = :userID,
                      dateLostOrFound = :dateLostOrFound,
                      datePosted = :datePosted,
                      status = :status
                  WHERE listingID = :listingID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':itemName', $itemName);
            $statement->bindValue(':itemDescription', $itemDescription);
            $statement->bindValue(':universityID', $universityID);
            $statement->bindValue(':listingType', $listingType);
            $statement->bindValue(':imagePath', $imagePath);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':dateLostOrFound', $dateLostOrFound);
            $statement->bindValue(':datePosted', $datePosted);
            $statement->bindValue(':status', $status);
            $statement->bindValue(':listingID', $listingID);
            $result = $statement->execute();
            $statement->closeCursor();
            
            if ($result === FALSE) {
                return FALSE;
            }
            
            return TRUE;
          
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getOpenListings() {
        $db = Database::getDB();
        
        $query = "SELECT * FROM listings
                  WHERE status = 'open'
                  ORDER BY datePosted DESC";
        
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $listings = array();
            
            foreach ($result as $row) {
                $listing = new Listing($row['itemName'], 
                                       $row['itemDescription'], 
                                       $row['universityID'], 
                                       $row['listingType'], 
                                       $row['categoryID'], 
                                       $row['userID'], 
                                       $row['dateLostOrFound'], 
                                       $row['datePosted'], 
                                       $row['status'],
                                       $row['imagePath']);
                
                $listing->setID($row['listingID']);
                
                $listings[] = $listing;
            }
            
            return $listings;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseErrors.php');
            exit();
        }
    }
    
    public static function getOpenListingsByUniversityID($universityID) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM listings
                  WHERE universityID = :universityID AND status = 'open'
                  ORDER BY datePosted DESC";
        
         try {
            $statement = $db->prepare($query);
            $statement->bindValue(':universityID', $universityID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $listings = array();
            
            foreach ($result as $row) {
                $listing = new Listing($row['itemName'], 
                                       $row['itemDescription'], 
                                       $row['universityID'], 
                                       $row['listingType'], 
                                       $row['categoryID'], 
                                       $row['userID'], 
                                       $row['dateLostOrFound'], 
                                       $row['datePosted'], 
                                       $row['status'],
                                       $row['imagePath']);
                
                $listing->setID($row['listingID']);
                
                $listings[] = $listing;
            }
            
            return $listings;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseErrors.php');
            exit();
        }
    }
    
    public static function getLostListingsByUniversityID($universityID) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM listings
                  WHERE universityID = :universityID 
                        AND listingType = 'lost'
                        AND status = 'open'";
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':universityID', $universityID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $listings = array();
            
            foreach ($result as $row) {
                $listing = new Listing($row['itemName'], 
                                       $row['itemDescription'], 
                                       $row['universityID'], 
                                       $row['listingType'], 
                                       $row['categoryID'], 
                                       $row['userID'], 
                                       $row['dateLostOrFound'], 
                                       $row['datePosted'], 
                                       $row['status'],
                                       $row['imagePath']);
                
                $listing->setID($row['listingID']);
                
                $listings[] = $listing;
            }
            
            return $listings;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
//    public static function searchOpenListings($keyword, $universityID = NULL) {
//        $db = Database::getDB();
//        
//        $query = "SELECT * FROM listings
//                  WHERE status = 'open' 
//                  AND (itemName LIKE :keyword 
//                       OR itemDescription LIKE :keyword)";
//        
//        if (!empty($universityID)) {
//            $query .= " AND universityID = :universityID";
//        }
//        
//        $query .= " ORDER BY datePosted DESC";
//        
//        try {
//            $statement = $db->prepare($query);
//            $keyword = '%' . $keyword . '%';
//            $statement->bindValue(':keyword', $keyword);
//            
//            if (!empty($universityID)) {
//                $statement->bindValue(':universityID', $universityID);
//            }
//            
//            $statement->execute();
//            $result = $statement->fetchAll();
//            $statement->closeCursor();
//            
//            $listings = array();
//            
//            foreach ($result as $row) {
//                $listing = new Listing($row['itemName'], 
//                                       $row['itemDescription'], 
//                                       $row['universityID'], 
//                                       $row['listingType'], 
//                                       $row['categoryID'], 
//                                       $row['userID'], 
//                                       $row['dateLostOrFound'], 
//                                       $row['datePosted'], 
//                                       $row['status'],
//                                       $row['imagePath']);
//                
//                $listing->setID($row['listingID']);
//                
//                $listings[] = $listing;
//            }
//            
//            return $listings;
//         
//        } catch (PDOException $e) {
//            $errorMessage = $e->getMessage();
//            include('../view/databaseError.php');
//            exit();
//        }
//    }
//    
//    public static function filterOpenListings($listingType = NULL, 
//            $categoryID = NULL, $universityID = NULL) {
//        $db = Database::getDB();
//        
//        $query = "SELECT * FROM listings
//                  WHERE status = 'open'";
//        
//        if (!empty($listingType)) {
//            $query .= " AND listingType = :listingType";
//        }
//        
//        if (!empty($categoryID)) {
//            $query .= " AND categoryID = :categoryID";
//        }
//        
//        if (!empty($universityID)) {
//            $query .= " AND universityID = :universityID";
//        }
//        
//        $query .= " ORDER BY datePosted DESC";
//        
//        try {
//            $statement = $db->prepare($query);
//            
//            if (!empty($listingType)) {
//                $statement->bindValue(':listingType', $listingType);
//            }
//            
//            if (!empty($categoryID)) {
//                $statement->bindValue(':categoryID', $categoryID);
//            }
//            
//            if (!empty($universityID)) {
//                $statement->bindValue(':universityID', $universityID);
//            }
//            
//            $statement->execute();
//            $result = $statement->fetchAll();
//            $statement->closeCursor();
//            
//            $listings = array();
//            
//            foreach ($result as $row) {
//                $listing = new Listing($row['itemName'], 
//                                       $row['itemDescription'], 
//                                       $row['universityID'], 
//                                       $row['listingType'], 
//                                       $row['categoryID'], 
//                                       $row['userID'], 
//                                       $row['dateLostOrFound'], 
//                                       $row['datePosted'], 
//                                       $row['status'],
//                                       $row['imagePath']);
//                
//                $listing->setID($row['listingID']);
//                
//                $listings[] = $listing;
//            }
//            
//            return $listings;
//         
//        } catch (PDOException $e) {
//            $errorMessage = $e->getMessage();
//            include('../view/databaseError.php');
//            exit();
//        }
//    }
    
    public static function searchAndFilterOpenListings($keyword = NULL, 
            $listingType = NULL, $categoryID = NULL, $universityID = NULL) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM listings
                  WHERE status = 'open'";
        
        if (!empty($keyword)) {
            $query .= " AND (itemName LIKE :keyword 
                      OR itemDescription LIKE :keyword)";
        }
        
        if (!empty($listingType)) {
            $query .= " AND listingType = :listingType";
        }
        
        if (!empty($categoryID)) {
            $query .= " AND categoryID = :categoryID";
        }
        
        if (!empty($universityID)) {
            $query .= " AND universityID = :universityID";
        }
        
        $query .= " ORDER BY datePosted DESC";
        
        try {
            $statement = $db->prepare($query);
            
            if (!empty($keyword)) {
                $keyword = '%' . $keyword . '%';
                $statement->bindValue(':keyword', $keyword);
            }
            
            if (!empty($listingType)) {
                $statement->bindValue(':listingType', $listingType);
            }
            
            if (!empty($categoryID)) {
                $statement->bindValue(':categoryID', $categoryID);
            }
            
            if (!empty($universityID)) {
                $statement->bindValue(':universityID', $universityID);
            }
            
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $listings = array();
            
            foreach ($result as $row) {
                $listing = new Listing($row['itemName'], 
                                       $row['itemDescription'], 
                                       $row['universityID'], 
                                       $row['listingType'], 
                                       $row['categoryID'], 
                                       $row['userID'], 
                                       $row['dateLostOrFound'], 
                                       $row['datePosted'], 
                                       $row['status'],
                                       $row['imagePath']);
                
                $listing->setID($row['listingID']);
                
                $listings[] = $listing;
            }
            
            return $listings;
              
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
}

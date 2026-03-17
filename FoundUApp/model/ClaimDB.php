<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * ClaimDB.php
 * 
 * The ClaimDB class provides database access methods for claim
 * objects in the FoundU application. It contains static methods to 
 * 
 ******************************************************************************/
class ClaimDB {
    public static function getClaimByID($claimID) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM claims
                  WHERE claimID = :claimID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':claimID', $claimID);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return NULL;
            }
            
            $claim = new Claim($row['listingID'], 
                               $row['userID'], 
                               $row['message'], 
                               $row['dateSubmitted'],
                               $row['status']);
            
            $claim->setID($row['claimID']);
            
            return $claim;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getClaimsByUserID($userID) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM claims
                  WHERE userID = :userID
                  ORDER BY dateSubmitted';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $claims = array();
            
            foreach ($result as $row) {
                $claim = new Claim($row['listingID'], 
                                   $row['userID'], 
                                   $row['message'], 
                                   $row['dateSubmitted'],
                                   $row['status']);
                
                $claim->setID($row['claimID']);
                
                $claims[] = $claim;
            }
            
            return $claims;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getClaimsByListingID($listingID) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM claims
                  WHERE listingID = :listingID
                  ORDER BY dateSubmitted';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':listingID', $listingID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $claims = array();
            
            foreach ($result as $row) {
                $claim = new Claim($row['listingID'], 
                                   $row['userID'], 
                                   $row['message'], 
                                   $row['dateSubmitted'],
                                   $row['status']);
                
                $claim->setID($row['claimID']);
                
                $claims[] = $claim;
            }
            
            return $claims;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getPendingClaimsByListingID($listingID) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM claims
                  WHERE listingID = :listingID AND status = 'pending'
                  ORDER BY dateSubmitted";
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':listingID', $listingID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $claims = array();
            
            foreach ($result as $row) {
                $claim = new Claim($row['listingID'], 
                                   $row['userID'], 
                                   $row['message'], 
                                   $row['dateSubmitted'],
                                   $row['status']);
                
                $claim->setID($row['claimID']);
                
                $claims[] = $claim;
            }
            
            return $claims;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function getSettledClaimsByListingID($listingID) {
        $db = Database::getDB();
        
        $query = "SELECT * FROM claims
                  WHERE listingID = :listingID 
                        AND status IN ('approved', 'rejected')
                  ORDER BY dateSubmitted";
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':listingID', $listingID);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $claims = array();
            
            foreach ($result as $row) {
                $claim = new Claim($row['listingID'], 
                                   $row['userID'], 
                                   $row['message'], 
                                   $row['dateSubmitted'], 
                                   $row['status']);
                
                $claim->setID($row['claimID']);
                
                $claims[] = $claim;
            }
            
            return $claims;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
}
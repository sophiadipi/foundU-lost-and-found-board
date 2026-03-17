<?php
/*******************************************************************************
 * FoundU - Model
 * 
 * UniversityDB.php
 * 
 * The UniversityDB class provides database access methods for university
 * objects in the FoundU application. It contains static methods to retrieve 
 * all universities and get a university by ID.   
 * 
 ******************************************************************************/
class UniversityDB {
    /* Retrieves all universities from the database and returns them as an array
     * of University objects. 
     */
    public static function getUniversities() {
        $db = Database::getDB();
        $query = 'SELECT * FROM universities';
        
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $universities = array();
            
            foreach ($result as $row) {
                $university = new University($row['fullName'], 
                                             $row['shortName'], 
                                             $row['city']);
                
                $university->setID($row['universityID']);
                
                $universities[] = $university;
            }
            
            return $universities;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    /* Retrieves a university from the database by ID and returns a University 
     * object. 
     */
    public static function getUniversityByID($universityID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM universities
                  WHERE universityID = :universityID';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':universityID', $universityID);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return NULL;
            }
            
            $university = new University($row['fullName'], 
                                         $row['shortName'], 
                                         $row['city']);
            
            $university->setID($row['universityID']);
            
            return $university;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();

        }
    }
}

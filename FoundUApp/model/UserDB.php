<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * UserDB.php
 * 
 * The UserDB class provides database access methods for user
 * objects in the FoundU application. It contains static methods to 
 * 
 ******************************************************************************/
class UserDB {
    /* Retrieves a user from the database by email and returns a User object. */
    public static function getUserByEmail($email) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM users
                  WHERE email = :email';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return NULL;
            }
            
            $user = new User($row['firstName'], 
                             $row['lastName'], 
                             $row['universityID'], 
                             $row['email'], 
                             $row['phone'], 
                             $row['passwordHash']);
            
            $user->setID($row['userID']);
            
            return $user;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function addUser($firstName, $lastName, $universityID, $email, 
            $phone, $password) {
        $db = Database::getDB();
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = 'INSERT INTO users (firstName, lastName, universityID, email, 
                    phone, passwordHash)
                  VALUES (:firstName, :lastName, :universityID, :email, :phone,
                    :passwordHash)';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':universityID', $universityID);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':passwordHash', $passwordHash);
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
    
    public static function deleteUser($email) {
        $db = Database::getDB();
        
        $query = 'DELETE FROM users
                  WHERE email = :email';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
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
    
    public static function changePassword($email, $password) {
        $db = Database::getDB();
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = 'UPDATE users 
                  SET passwordHash = :passwordHash
                  WHERE email = :email';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':passwordHash', $passwordHash);
            $statement->bindValue(':email', $email);
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
    
    public static function isValidUser($email, $password) {
        $db = Database::getDB();
        
        $query = 'SELECT passwordHash FROM users
                  WHERE email = :email';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return FALSE;
            }
            
            $isValidPassword = password_verify($password, $row['passwordHash']);
            
            return $isValidPassword;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
    
    public static function emailExists($email) {
        $db = Database::getDB();
        
        $query = 'SELECT * FROM users
                  WHERE email = :email';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            
            if ($row === FALSE) {
                return FALSE;
            }
            
            return TRUE;
            
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include('../view/databaseError.php');
            exit();
        }
    }
}


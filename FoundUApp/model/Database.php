<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * Database.php
 * 
 * The Database class manages the FoundU application's connection to the 
 * database. It ensures only one PDO object is created and used for the 
 * application. 
 * 
 * The getDB() method initializes the connection if it does not already exist 
 * and returns the PDO object. If an error occurs while trying to connect to the 
 * database, the user is redirected to the database error page. 
 * 
 ******************************************************************************/
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=foundu';
    private static $username = 'root';
    private static $password = 'Ketchup13141516';
    private static $db;
    
    private function __construct() {}
    
    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
                include('../view/databaseError.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>


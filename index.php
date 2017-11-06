<?php

    ini_set('display_errors', 'On');				//Debugging messages set to 'ON'
    error_reporting(E_ALL);

    class Manage {						//Defining a class with autoload function to attempt to load undefined class - in this case htmlTags class
        public static function autoload($class) {
            include $class . '.php';
        }
    }
    spl_autoload_register(array('Manage', 'autoload'));

    define('SERVERNAME', 'sql2.njit.edu');
    define('USERNAME','tn76');
    define('PASSWORD','DblDTPzb');
    define('DBNAME','tn76');
    
    class dbConn {
        protected static $conn;
        public function __construct() {
            try {
                self::$conn = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DBNAME, USERNAME, PASSWORD);   //try statement to test database connection
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully" . "</br>";
            }
            catch (PDOException $e) {                                                       //catch statement to handle any exception
                echo "Connection failed: " . $e->getMessage() . "</br>";
            }
        }
        static public function getConnection() {
            if (!self::$conn) {
                new dbConn;
            }
            return self::$conn;
        }
    }
    $table = DisplayTable::getData();
?>

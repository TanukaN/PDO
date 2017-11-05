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

    try {
        $conn = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DBNAME, USERNAME, PASSWORD);   //try statement to test database connection
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully" . "</br>";

        $stmt = $conn->prepare("select * from accounts where id < 6;");                    //Preparing SQL statement with DB connection
        $stmt->execute();   
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        echo "No. of records is " . $stmt->rowCount() . "<br>";                    //Display no. of rows returned by the fired SQL query

        htmlTags::tableFormat();                                                    //Display data in a tabular format - htmlTags class called for table tags
        foreach ($result as $data) {
            foreach ($data as $value) {
                htmlTags::tableContent($value);                                      
            }
            htmlTags::breakTableRow();
        }
    }
    catch (PDOException $e) {                                                       //catch statement to handle any exception
        echo "Connection failed: " . $e->getMessage() . "</br>";
    }
?>

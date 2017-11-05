<?php

ini_set('display_errors', 'On');				//Debugging messages set to 'ON'
error_reporting(E_ALL);

class Manage {						//Defining a class with autoload function to attempt to load undefined class
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
    $conn = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DBNAME, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . "</br>";

    $stmt = $conn->prepare("select * from accounts where id < 6;");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    echo "No. of records is " . $stmt->rowCount() . "<br>";

    htmlTags::tableFormat();
    foreach ($result as $data) {
        foreach ($data as $value) {
            htmlTags::tableContent($value);
        }
        htmlTags::breakTableRow();
    }
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "</br>";
}
?>
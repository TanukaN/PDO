<?php
class DisplayTable {
    static public function getData() {
        $conn = dbConn::getConnection();
        $stmt = $conn->prepare("select * from accounts where id < 6;");              //Preparing SQL statement with DB connection
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
}
?>

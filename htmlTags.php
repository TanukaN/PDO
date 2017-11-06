<?php
    class htmlTags {				//html tags used in PDO assignment
        static public function tableFormat() {
            echo "<table cellpadding='5px' border='1px' style='border-collapse: collapse'>";
        }
        static public function tableContent($text) {
            echo '<td>'.$text.'</td>';
        }
        static public function breakTableRow() {
            echo '</tr>';
        }
    }
?>

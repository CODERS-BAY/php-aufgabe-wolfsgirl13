<?php 

$dbcon = new mysqli('localhost','root','','firmenweb');

if($dbcon->connect_error) {
    echo 'Verbindung fehlgeschlagen ' . $dbcon->connect_error;
    exit();
}
//echo "Wir sind verbunden!";


?>
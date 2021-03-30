<?php 

$dbcon = new mysqli('localhost','root','','firmenweb');

if($dbcon->connect_error) {
    echo 'Verbindung fehlgeschlagen ' . $dbcon->connect_error;
    exit("Connection failed: " . mysqli_connect_error());
}
//echo "Wir sind verbunden!";


?>
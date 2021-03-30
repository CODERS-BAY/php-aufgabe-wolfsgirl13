<?php 

include_once('include/database_con.php');


$delete = 'DELETE FROM notes where note_id=' . $_POST['noteId'];
//delete from notes where id ist gleich im js script: let myData = {'noteID' : noteId};

if($dbcon->query($delete)) {  //Weitergabe an die DB

    echo 'true';
} else
    echo 'false'; 





?>

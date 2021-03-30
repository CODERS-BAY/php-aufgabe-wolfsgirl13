<?php include_once('header.php')?>


<main>

<?php 
//var_dump($_FILES); //--kann Array ausgeben, um zu schauen, was für ein Inhalt

//Bilder oder Dateien hochladen
if(is_uploaded_file($_FILES['teamsimage']['tmp_name'])) { //ist ein file unter .. gespeichert unter tmp_name
    move_uploaded_file($_FILES['teamsimage']['tmp_name'], 'images/'. $_FILES['teamsimage']['name']); //File soll so heißen wie beim upload

    include_once('include/database_con.php');

    $filename = 'images/'. $_FILES['teamsimage']['name'];

    $update = 'UPDATE teams SET teams_picture="'. $filename . '" WHERE teams_picture="'. $_POST['teams_picture'].'"';

    if($dbcon->query($update)) {
        echo '<h3>Bild konnte erfolgreich hochgeladen werden!</h3>';
    }
    else {
        echo '<h3>Bild konnte nicht hochgeladen werden!</h3>';
    }
    $dbcon->close();

} else {
    echo '<h3>Bild konnte nicht hochgeladen werden!</h3>';
}



?> 



</main>
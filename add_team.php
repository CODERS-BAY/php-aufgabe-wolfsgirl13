<?php include_once('header.php')?>
<main>

<?php

include_once('include/database_con.php'); //Datenbankverbindung

//Selectieren Username - damit keine doppelten Namen vorkommen

$select = 'SELECT * FROM teams WHERE teams_name="' .$_POST['teams_name']. '"';

$result = $dbcon->query($select);

if($result->num_rows > 0) {
    $arr[0] = "Der Teamname ist schon vergeben!";
    echo json_encode($arr);  //string
} else {

/* Insert */
    $insert = $dbcon->prepare('INSERT INTO teams(teams_name, teams_color, teams_picture) VALUES (?,?,?)');
    $insert->bind_param("sss", $teams_name, $teams_color, $teams_picture);

    $teams_name = $_POST['teams_name'];
    $teams_color = $_POST['teams_color'];
    $teams_picture = $_POST['teams_picture'];

    if($insert->execute()) {
        $arr[0] = "Das Team wurde erfolgreich angelegt";
    } else {
        $arr[1] = "Das Team wurde nicht angelegt"; 
    }

    echo json_encode($arr); //wird an javascript geschickt
    $insert->close();

}


$dbcon->close();


?>
</main>
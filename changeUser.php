<?php include_once('header.php')?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h3>Der Mitarbeiter wurde geändert</h3>
<?php 

include_once('include/database_con.php'); //Datenbankverbindung


/* update */
$update = 'UPDATE user_list SET teams_name="'.$_POST['teams_name'].'" WHERE user_username=' . $_POST['user_username'];

if($dbcon->query($update)) {
    echo 'true';
} else {
    echo 'false';
}


$dbcon->close();
 
?>

        </div>
    </div>
</div>
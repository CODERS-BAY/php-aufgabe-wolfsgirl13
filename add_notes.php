
    <?php 

session_start();

if(isset($_SESSION['username'])) :

include_once('include/database_con.php');

if($_POST['noteId'] == '') {

    $insert =$dbcon->prepare("INSERT INTO notes (note_username, note_text) VALUES (?,?)");
    $insert->bind_param("ss", $username, $note);


    $note= $_POST['text'];
    $username=$_SESSION['username'];
    
    //$sql="INSERT INTO notes (note_text, note_username) VALUES ('" . $note . "','" . $_SESSION['username'] . "');";

    
    if($insert->execute()) 
    {
        echo 'true';

    } else {
        echo 'false';
    }

    $insert->close();

    } else {
        $update = 'UPDATE notes SET note_text="'.$_POST['text'].'" WHERE note_id=' . $_POST['noteId'];

        if($dbcon->query($update)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
$dbcon->close();
    




?>

<?php endif; ?>



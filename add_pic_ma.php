<?php include_once('header.php')?>


<main>
<div  id="pop_up" class="form_box"> 
        <form id="change_user" action="add_pic_ma.php" method="post" enctype="multipart/form-data">  <!-- wenn man datei mitschickt-->
        <h2>User ändern</h2>
        <label>Userimage</label>
        <input type="file" name="image"/>
        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>"><!--Userimage hinzufügen-->
        <input type="submit" value="Userdaten ändern"> <!--Button zum Abschicken-->
        
        </form>
        
        </div>
<?php 
//var_dump($_FILES); //--kann Array ausgeben, um zu schauen, was für ein Inhalt

//Bilder oder Dateien hochladen
if(is_uploaded_file($_FILES['image']['tmp_name'])) { //ist ein file unter .. gespeichert unter tmp_name
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'. $_FILES['image']['name']); //File soll so heißen wie beim upload

    include_once('include/database_con.php');

    $filename = 'images/'. $_FILES['image']['name'];

    $update = 'UPDATE user_list SET user_picture="'. $filename . '" WHERE user_username="'. $_POST['username'].'"';

    if($dbcon->query($update)) {
        echo '<h3>Bild konnte erfolgreich hochgeladen werden!</h3>';
        $_SESSION['user_picture'] = $filename; //Image in diese Session speichern -> im login wird dies eh schon abgefragt
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


<?php include_once('footer.php')?>
<?php include_once('header.php')?>


<main>



<?php 

var_dump(json_decode($_GET['remindlist']));
if(isset($_GET['remindlist']) && $_GET['remindlist'] != 'null'):
$remindlist = json_decode($_GET['remindlist']);

include_once('include/database_con.php');


//----NOTIZEN - auslagern und in include
for($i = 0; $i < count($remindlist); $i++) {
$select = 'SELECT * FROM notes WHERE note_id=' .$remindlist[$i]; //wir holen uns die Notizen, welche im localstorage gespeichert sind

$result = $dbcon->query($select);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>

        <div data-id="<?php echo $row['note_id']; ?> "class="note">
            <div class="note_headline"><?php echo $row['note_username']; ?></div>
            <div class="note_text"><?php echo $row['note_text']; ?></div>

            <div class="button remind">Merken</div>  <!--eine Notiz merken-->

<!--Eintrag darf nur von dem Ersteller der Nachricht oder vom Admin gelöscht oder bearbeitet werden-->
        

    <?php }
    
        }
        
    
}
$dbcon->close();
else :
 echo '<h3>Du hast Dir noch keine Notiz gemerkt</h3>';
endif;
?>


</main>



<?php include_once('footer.php')?>
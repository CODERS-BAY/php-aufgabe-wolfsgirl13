<?php include_once('header_ma.php')?>


<main>
<!--wenn Username gesetzt, dann werden die Notizen ausgegeben-->
    <?php if(isset($_SESSION['username'])) : ?>

    <?php 
    include_once('inc/database_con.php');
    
    $result = $dbcon->query("SELECT * FROM notes");


    if($result->num_rows > 0) {

        echo '<div id="notes">';
        
        while($row = $result->fetch_assoc()) { ?>

        <div data-id="<?php echo $row['note_id']; ?> "class="note">
            <div class="note_headline"><?php echo $row['note_username']; ?></div>
            <div class="note_text"><?php echo $row['note_text']; ?></div>

            <div class="button remind">Merken</div>  <!--eine Notiz merken-->

        <?php if($_SESSION['rights'] == 'admin' || $_SESSION['username'] 
        == $row['note_username']) : ?>
           
            <div class="button delete">Löschen</div> 
            <div class="button edit">Bearbeiten</div>

<!--Eintrag darf nur von dem Ersteller der Nachricht oder vom Admin gelöscht oder bearbeitet werden-->
        
        <?php endif; ?>
    </div>

    <?php }
    
    echo '</div>';
        }
        
    $dbcon->close();

    if($_SESSION['rights'] != 'user') : ?>

<!--Eintrag hinzufügen------------------>
        <div id="addentryform">
            <form method="post" id="addForm">
                <textarea name="text">Hier Eintrag hinzufügen ...</textarea>
                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                <input type="hidden" name="noteId" value="">  <!--Eintrag ändern-->
                <input type="submit" value="hinzufügen">
            </form>
        </div>

<!-- User wird upgedate .... keine action, wenn mit ajax weggschickt wird-->

        <div  id="pop_up" class="form_box"> 
        <form id="change_user" action="user_update.php" method="post" enctype="multipart/form-data">  <!-- wenn man datei mitschickt-->
        <h2>User ändern</h2>
        <label>Userimage</label>
        <input type="file" name="userimage"/>
        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>"><!--Userimage hinzufügen-->
        <input type="submit" value="Userdaten ändern"> <!--Button zum Abschicken-->
        
        </form>
        
        </div>
        
    <?php endif;
    ?>

    <?php else: ?>


<!--Login form------------------>

<div class="d-flex" id="wrapper">

<div id="sidebar">

    <div class="text-center">
    </div>
</div>

<div class="container fluid bg-faded mt-5 mb-5">
    <div class="row">
        <div class="col col-6 text-center">
                <h1 class="h4 mb-3 font-weight-normal">Herzlich willkommen!</h1>
                <form method="post" action="login.php" class="form_box">
                    <h4 class="h5 mb-3 font-weight-normal">Bitte logge Dich ein:</h4>

                    <label for="username" class="sr-only"></label>
                    <input type="text" name="username" class="form-control mt-5" placeholder="Username">

                    <label for="password" class="sr-only"></label>
                    <input type="password" name="userpwd" class="form-control mt-3 mb-5" placeholder="Passwort">

                    <div class="mt-3">
                        <button class="btn btn-lg btn-primary btn-block">Einloggen</button></div>
                </form>

            
        </div>

    </div>
</div>
</div>

    <?php endif; ?>


</main>




<div class="col col-12" id="footer">
      <?php include_once('footer.php')?>
    </div>
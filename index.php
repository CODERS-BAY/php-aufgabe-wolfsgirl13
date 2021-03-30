<?php include_once('header.php')?>



<div id="content" class="site-content">
    <div id="primary" class="content-area column two-thirds">
        <main id="main" class="site-main" role="main">
            
                <!--wenn Username gesetzt, dann werden die Notizen ausgegeben-->
                <?php if(isset($_SESSION['username'])) : ?>

                <?php 
    include_once('include/database_con.php');
    
    $result = $dbcon->query("SELECT * FROM notes");


    if($result->num_rows > 0) {

        echo '<div id="notes">';
        
        while($row = $result->fetch_assoc()) { ?>

                <div data-id="<?php echo $row['note_id']; ?> " class="note">
                    <div class="note_headline"><?php echo $row['note_username']; ?></div>
                    <div class="note_text"><?php echo $row['note_text']; ?></div>

                    <div class="button remind">Merken</div>
                    <!--eine Notiz merken-->

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
                        <input type="hidden" name="noteId" value="">
                        <!--Eintrag Ändern-->
                        <input type="submit" value="hinzufügen">
                    </form>
                </div>

               

                <?php endif;
    ?>

                <?php else: ?>

                <!--------------------login.php LOGIN form------------------>

                <img src="images/logo-12.svg" class="w-50 img-fluid rounded mx-auto d-block" alt="Logo">

                <div class="w-50 img-fluid rounded mx-auto d-block">
                    <div class="card my-auto shadow">
                        <div class="card-header text-center">
                            <h4>Loggen Sie sich ein:</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="username">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userpwd">Passwort</label>
                                    <input type="password" id="userpwd" class="form-control" name="userpwd">
                                </div>
                                <input type="submit" class="btn btn-dark w-100" value="login" name="einloggen">
                        </div>
                        <div class="card-footer text-right">
                            <small>&copy; My Company</small>
                        </div>


                        </form>
                    </div>
                </div>

                <?php endif; ?>

            </div>
            <div class="clearfix">
            </div>
            <nav class="pagination"></nav>
        </main>
        <!-- #main -->
    </div>
    <!-- #primary -->


    <?php include_once('footer.php')?>
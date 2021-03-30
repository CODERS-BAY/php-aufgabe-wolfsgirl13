<?php include_once('header.php');?>
<link rel="stylesheet" href="css/style.css" />
<main>
<div class="container">
        <?php 

session_unset(); //Session löschen
?>

            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
    <img src="images/logo-12.svg" class="rounded mx-auto d-block center" width="350px" alt="Logo">
                </div>
            </div>
            <div class="row">
            <div class="col-lg-4"></div>
                <div class="col-lg-4 mb-4">
                <h4>Sie sind erfolgreich ausgeloggt</h4>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4 "></div>
                <div class="col-lg-4 mt-4">
                <a href="index.php"><button>Wieder einloggen</button></a>
                </div>
            </div>
            </div>
</div>
    
   

</main>


<?php include_once('footer.php'); ?>
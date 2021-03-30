<?php include_once('header.php')?>
<!-- zuerst header und footer, dann main-->


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="d-block w-100 p-5">
                <div class="card my-auto shadow">
                    <div class="card-header text-center">


                        <!-- Formular "neues Team" anlegen -->
                        <form method="post" action="add_team.php">
                            <h4>Neues Team anlegen:</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="teams_name" class="sr-only"></label>
                            <input type="text" name="teams_name" class="form-control mt-2" placeholder="Teamname">

                            <label for="teams_color" class="sr-only"></label>
                            <input type="text" name="teams_color" class="form-control mt-2" placeholder="Teamfarbe wie z.B. red, brown, ..">

                            <!-- User-Picture wird hinzugefügt .... "keine action, wenn mit ajax weggschickt wird"-->
                            <form id="add_pic_team" action="add_pic_team.php" method="post" enctype="multipart/form-data"
                                mt-4>
                                <!-- wenn man datei mitschickt-->
                                <label>Teamimage</label>
                                <input type="file" name="teams_picture" />
                                
                                <!--Userimage hinzufügen-->
                        </div>
                    </div>

                    <input type="submit" class="btn btn-dark" role="button" value="registrieren"
                        name="registrieren">

                    </form>
                </div>
            </div>
        </div>


    <!--Ausgabe der vorhandenen Teams -->
    <div class="col-md-6">
        <div class="table">
            <table class="table table-striped mt-3 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Team Name</th>
                        <th scope="col">Team Farbe</th>
                        <th scope="col">Team Picture</th>
                    </tr>
                </thead>


                <?php 
        include('include/database_con.php');

        $sql = "SELECT teams_name, teams_color, teams_picture FROM teams;";

        $result = $dbcon->query($sql);
        
        while ($datensatz=$result->fetch_assoc()) {
            echo "<tr><td>".$datensatz["teams_name"]."</td>
            <td>".$datensatz["teams_color"]."</td>
            <td>".$datensatz["teams_picture"]."</td>
            </tr>";
        } 
        
        $dbcon->close(); 
        ?>

        </div>
    </div>



<!----------------Team Image hinzufügen---------------------->
<div class="row">
    <div class="col-md-12 mt-5 mb-5">
        <div class="card my-auto shadow">
            <form id="teams_image" action="add_pic_team.php" method="post" enctype="multipart/form-data">
                <!-- wenn man datei mitschickt-->
                <h4>Team-Picture ändern:</h4>
                <label></label>
                <label for="teams_name" class="sr-only"></label>
                <input type="text" name="teams_name" class="form-control mt-2" placeholder="Teamname">
                <input type="file" name="teams_image" />
                <input type="submit" value="ändern">
                <!--Button zum Abschicken-->

            </form>
        </div>
    </div>
</div>
</div>
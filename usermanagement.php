<?php include_once('header.php')?>
<!-- zuerst header und footer, dann main-->


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="d-block w-100 p-5">
                <div class="card my-auto shadow">
                    <div class="card-header text-center">


                        <!-- Formular "neuen Mitarbeiter" anlegen -->
                        <form method="post" action="add_user.php">
                            <h4>Neuen Mitarbeiter anlegen:</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="first_name" class="sr-only"></label>
                                <input type="text" name="first_name" class="form-control mt-2" placeholder="Vorname">

                                <label for="last_name" class="sr-only"></label>
                                <input type="text" name="last_name" class="form-control mt-2" placeholder="Nachname">

                                <label for="user_username" class="sr-only"></label>
                                <input type="text" name="user_username" class="form-control mt-2"
                                    placeholder="Username">

                                <label for="user_pwd" class="sr-only"></label>
                                <input type="password" name="user_pwd" class="form-control mt-2 mb-2"
                                    placeholder="Passwort">

                                <label for="teams_name" class="sr-only">Team:</label>
                                <select name="teams_name[]" multiple>
                                    <?php 
                                    
                            //check connection   
                            include('include/database_con.php');  
                            //alle Team-Namen ausgeben
                            $sql ="SELECT teams_name FROM teams;";
                            $result = $dbcon->query($sql);

                            while ($options = $result->fetch_object()) {
                                echo "<option value='" . $options->teams_name."'>" . $options->teams_name . "</option>"; //das 2. sieht der User
                            }
                            echo json_encode($arr);
                            $dbcon->close(); //connection close

                            ?>
                            
                                    <label for="user_rights" class="sr-only">Userrechte</label>
                                    <select name="user_rights[]" multiple>
                                        <?php 
                            include('include/database_con.php');  
                            //alle User-Rights-Namen ausgeben
                            $sql ="SELECT rights_name FROM user_rights;";
                            $result = $dbcon->query($sql);

                            while ($options = $result->fetch_object()) {
                                echo "<option value='" . $options->rights_name."'>" . $options->rights_name . "</option>"; //das 2. sieht der User
                            }
                            
                            $dbcon->close(); //connection close
                            ?>

                                        <input type="text" name="user_rights" class="form-control mt-2" placeholder="Userrechte">

                                        <!-- User-Picture wird hinzugefügt .... "keine action, wenn mit ajax weggschickt wird"-->
                                        <form id="change_user" action="add_pic_ma.php" method="post"
                                            enctype="multipart/form-data" mt-4>
                                            <!-- wenn man datei mitschickt-->
                                            <label>Userimage</label>
                                            <input type="file" name="userimage" />
                                            <input type="hidden" name="username"
                                                value="<?php echo $_SESSION['username'] ?>">
                                            <!--Userimage hinzufügen-->
                            </div>

                            <input type="submit" class="btn btn-dark w-100" value="registrieren" name="registrieren">

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-------------User löschen-->
        <div class="col-md-6">
            <div class="d-block w-100 p-5">
                <div class="card my-auto shadow">
                    <div class="card-header text-center">

                        <form method="post" action="delete_user.php">
                            <h4>Mitarbeiter entfernen:</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="delete_user.php">
                            <div class="form-group">

                                <label for="first_name" class="sr-only"></label>
                                <input type="text" name="first_name" class="form-control mt-2" placeholder="Vorname">
                                <label for="last_name" class="sr-only"></label>
                                <input type="text" name="last_name" class="form-control mt-2" placeholder="Nachname">
                                <label for="user_username" class="sr-only"></label>
                                <input type="text" name="user_username" class="form-control mt-2"
                                    placeholder="Username">
                                    <label for="user_username" class="sr-only"></label>

                                <input type="submit" class="btn btn-dark w-100" value="entfernen" name="entfernen">


                        </form>
                    </div>
                    <div class="card-footer mt-3 mb-3">
                    </div>

                </div>
            </div>
            <div class="table">
                <table class="table table-striped mt-3 mb-5">
                    <h5>Alle Mitarbeiter:</h5>
                    <thead>
                        <tr>
                            <th scope="col">Vorname</th>
                            <th scope="col">Nachname</th>
                            <th scope="col">Username</th>
                            <th scope="col">Team</th>
                        </tr>
                    </thead>


                    <?php 
        include('include/database_con.php');
        $sql = "SELECT first_name, last_name, user_username, teams_name FROM user_list;";

        $result = $dbcon->query($sql);
        
        while ($datensatz=$result->fetch_assoc()) {
            echo "<tr><td>".$datensatz["first_name"]."</td>
            <td>".$datensatz["last_name"]."</td>
            <td>".$datensatz["user_username"]."</td>
            <td>".$datensatz["teams_name"]."</td></tr>";
        } 
        
        $dbcon->close(); 
        ?>

            </div>

        </div>

    </div>
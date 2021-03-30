<?php include_once('header.php')?>
<!-- zuerst header und footer, dann main-->


<div class="container">
    <div class="row">
        <div class="col-md-6">
        <form method="post" action="changeUser.php">
        <label for="user_username" class="sr-only"></label>
                            <input type="text" name="user_username" class="form-control mt-2" placeholder="Username">
                            <label for="teams_name" class="sr-only"></label>
                            <input type="text" name="teams_name" class="form-control mt-2" placeholder="Team">
                            <input type="submit" class="btn btn-dark" role="button" value="ändern" name="ändern">
        </form>


        <div class=col-6>
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
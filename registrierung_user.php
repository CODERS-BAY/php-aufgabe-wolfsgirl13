<?php include_once('header.php')?>
<!-- zuerst header und footer, dann main-->


<main>

    <form id="registry" class="form-box">
        <h2>Registrieren:</h2>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="userpwd" placeholder="Password">
        <select name="color">
            <option value="blue">Blau</option>
            <option value="red">Rot</option>
            <option value="yellow">Gelb</option>
            <option value="green">Grün</option>
        </select>

        <select name="rights">
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
            <option value="user">User</option>

        </select>
        <input type="submit" value="registrieren">
    </form>


    <form id="delete_user" action="form_box">
        <!--User löschen-->
        <select name="username">
        
        <?php 
            include_once('include/database_con.php');
            $select = "SELECT user_username FROM user_list"; //alle user raussuchen und in Variable
            $result = $dbcon->query($select);

            if($result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    echo '<option value="'.$row->user_username.'" >'.$row->user_username.'</option>';
                }
            }
        ?>
        </select>

        <input type="submit" value="User löschen">


    </form>



</main>




<?php include_once('footer.php')?>
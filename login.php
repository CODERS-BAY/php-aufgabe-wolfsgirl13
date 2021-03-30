<?php include_once('header.php');?>

<!-------USER LOGGT SICH EIN------------->


    <?php 

//prepare Statement
$select = $dbcon->prepare("SELECT user_username, user_rights, user_picture, teams_name FROM user_list WHERE user_username=? AND user_pwd=?");

$select->bind_param("ss", $username, $user_pwd);
//set paramenter
$username= $_POST['username'];
$user_pwd= md5($_POST['userpwd']);


//execute
$select->execute();
$result = $select->get_result();


if($result->num_rows > 0) {
//USER loggt sich ein
    while($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['user_username'];
        $_SESSION['teams_name'] = $row['teams_name'];
        $_SESSION['rights'] = $row['user_rights'];

        if($row['user_picture'])
            $_SESSION['picture'] = $row['user_picture'];
    }
}
else {
    echo '<h3>Password or Username not correct.</h3>';
}


$select->close();  //execute gehört auch geschlossen
$dbcon->close();
?>

<div class="eingeloggt">
    <p style="text-align: center">Du bist eingeloggt!</p>
    <a href="mitarbeiter.php"><b>Klick!</b></a>
</div>


</main>


<?php include_once('footer.php'); ?>
<?php include_once('header.php');?>

<!-------USER LOGGT SICH EIN------------->

<main>
    <?php 
include_once('include/database_con.php');


//prepare Statement
$select = $dbcon->prepare("SELECT user_username, user_rights, user_picture, teams_name, teams_picture, teams_color FROM user_list WHERE user_username=? AND user_pwd=?");

$select->bind_param("ss", $username, $user_pwd);
//set paramenter
$user_pwd= md5($_POST['userpwd']);
$username= $_POST['username'];

//execute
$select->execute();
$result = $select->get_result();


if($result->num_rows > 0) {
//USER loggt sich ein
    while($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['user_username']; //$row - Name aus der DB
        $_SESSION['teams_name'] = $row['teams_name'];
        $_SESSION['color'] = $row['teams_color'];
        $_SESSION['rights'] = $row['user_rights'];

        if($row['user_picture'])
            $_SESSION['user_picture'] = $row['user_picture'];
        if($row['teams_picture'])
           $_SESSION['teams_picture'] = $row['teams_picture'];
    }
}
else {
    echo '<h3>Password or Usernam not correct.</h3>';
}


$select->close();  //execute gehört auch geschlossen
$dbcon->close();
?>
<div class="container">
    <img src="images/logo-12.svg" class="rounded mx-auto d-block" width="350px" alt="Logo">

        <div class="row justify-content-center h-100">
            <div class="card w-25 my-auto shadow">
                <div class="card-header text-center bg.dark ">
               <h4>Sie sind erfolgreich eingeloggt</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                <a href="index.php"><button>Klick!</button></a>
            </div>
            </form>
        </div>



</main>


<?php include_once('footer.php'); ?>
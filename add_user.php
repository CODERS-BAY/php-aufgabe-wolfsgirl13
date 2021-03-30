<?php include_once('header.php')?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h3>Der Mitarbeiter wurde hinzugefügt</h3>
<?php 

include_once('include/database_con.php'); //Datenbankverbindung

//Selectieren Username - damit keine doppelten Namen vorkommen

$select = 'SELECT * FROM user_list WHERE user_username="' .$_POST['user_username']. '"';

$result = $dbcon->query($select);

if($result->num_rows > 0) {
    $arr[0] = false;
    $arr[1] = "Der Username ist schon vergeben!";
    echo json_encode($arr);  //string
} else {

/* Insert */
    $insert = $dbcon->prepare('INSERT INTO user_list(first_name, last_name, user_username, user_pwd, teams_name, user_rights, user_picture) VALUES (?,?,?,?,?,?,?)');
    $insert->bind_param("sssssss", $first_name,$last_name,$user_username,$user_pwd,$teams_name,$user_rights,$user_picture);

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_username = $_POST['user_username'];
    $user_pwd = md5($_POST['user_pwd']); //userformular post = aus oder in formular
    $teams_name = $_POST['teams_name'];
    $user_rights = $_POST['user_rights'];
    $user_picture = $_POST['userimage'];

    if($insert->execute()) {
        $arr[0] = "Der User wurde erfolgreich angelegt";
    } else {
        $arr[1] = "Der User wurde nicht angelegt"; 
    }

    $user_id = $dbcon->insert_id;  //id vom letzten User
    $insert->close();

    if(isset($_POST["teams_name"])) {
        foreach($_POST["teams_name"] as $teamsSelect) //geht ARRAY durch und speichert
        {
            $insertNew = $dbcon->prepare("INSERT INTO team_user_list( user_id, teams_id) VALUES (?,?);"); //immer werte
            $insertNew->bind_param("ii", $user_id, $teamsSelect);
            echo $user_id;
            echo $featureSelect;
             
            if($insertNew->execute()) {
                $arr[0] = "Der neue User wurde hinzugefügt";

            } else {
                echo $insertNew->error;
            }
            echo json_encode($arr);
            $insertNew->close();  
        }
    }


}

$dbcon->close();
 
?>

        </div>
    </div>
</div>
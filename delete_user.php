<?php 
include_once('include/database_con.php');

$delete = 'DELETE FROM user_list WHERE user_username="'. $_POST['user_username'].'"';  //löschen

if($dbcon->query($delete)) {  //Weitergabe an die DB

    $arr['msg'] = 'User wurde erfolgreich gelöscht';
    
} else {
    $arr['msg'] = 'User konnte nicht gelöscht werden';
}
echo json_encode($arr);

$dbcon->close();

?>
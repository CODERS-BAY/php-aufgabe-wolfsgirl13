<?php 

function emptyInputSignup($first_name, $last_name, $user_username, $user_email, $user_pwd, $user_pwdrepeat) {
$result;
    if(empty($first_name) || empty($last_name) || empty($user_username) || empty($user_email) || empty($user_pwd) || empty($user_pwdrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($first_name, $last_name, $user_username, $user_email, $user_pwd, $user_pwdrepeat) {
    $result;
        if(preg_match("/^[a-zA-Z0-9]*$/") $user_username || empty($user_email) || empty($user_pwd) || empty($user_pwdrepeat)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

?>
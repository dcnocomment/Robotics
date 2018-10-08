<?php
require('includes/config.php');

if($user->is_logged_in()){
    $res=array("code"=>false, "error"=>"Your are already logged in."); 
    printf("%s", json_encode($res, True)); 
    exit();
}

$_data = file_get_contents("php://input");
$data = json_decode($_data, true);

if (!isset($data['username'])) $error[] = "Please fill out all fields";
if (!isset($data['password'])) $error[] = "Please fill out all fields";

$username = $data['username'];
if ( $user->isValidUsername($username)){
    if (!isset($data['password'])){
        $error[] = 'A password must be entered';
    }
    $password = $data['password'];

    if($user->login($username,$password)){
        $res = array("code"=>true, "error"=>"", "username"=>$username, "uuid"=>$_SESSION['uuid'], "invited"=>$_SESSION['invited']);
    } else {
        $error[] = 'Wrong username or password or your account has not been activated.';
        $res = array("code"=>false, "error"=>$error[0]);
    }
}else{
    $error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
    $res = array("code"=>false, "error"=>$error[0]);
}

printf("%s", json_encode($res, True));
?>

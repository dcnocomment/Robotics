<?php 
require('includes/config.php');
require('sendmail_via_gmail.php');

$_data = file_get_contents("php://input");
$data = json_decode($_data, true);


if (!isset($data['username'])) $error[] = "Please fill out all fields";
if (!isset($data['email'])) $error[] = "Please fill out all fields";
if (!isset($data['password'])) $error[] = "Please fill out all fields";

$username = $data['username'];

//very basic validation
if(!$user->isValidUsername($username)){
    $error[] = 'Usernames must be at least 3 Alphanumeric characters';
} else {
    $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['username'])){
        $error[] = 'Username provided is already in use.';
    }
}

if(strlen($data['password']) < 3){
    $error[] = 'Password is too short.';
}

if(strlen($data['passwordConfirm']) < 3){
    $error[] = 'Confirm password is too short.';
}

if($data['password'] != $data['passwordConfirm']){
    $error[] = 'Passwords do not match.';
}

//email validation
$email = htmlspecialchars_decode($data['email'], ENT_QUOTES);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error[] = 'Please enter a valid email address';
} else {
    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['email'])){
        $error[] = 'Email provided is already in use.';
    }
}



if(isset($error)){
    $res = array(
            "code" => False,
            "error" => $error[0]
            );
}else{
    //hash the password
    $hashedpassword = $user->password_hash($data['password'], PASSWORD_BCRYPT);

    //create the activasion code
    $activasion = md5(uniqid(rand(),true));

    //insert into database with a prepared statement
    $stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
    $stmt->execute(array(
        ':username' => $username,
        ':password' => $hashedpassword,
        ':email' => $email,
        ':active' => $activasion
    ));
    $id = $db->lastInsertId('id');

    //send email
    $username = $data['username'];
    $to = $data['email'];
    $body = "<p>Thank you for registering at demo site.</p><p>To activate your account, please click on this link:</p><p><a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p><p>Regards Site Admin</p>";

    $sent_res = send_via_gmail($username, $to, $body);

    $res = array(
            "code" => $sent_res,
            "error" => ""
            );

}

printf("%s", json_encode($res, True));
?>

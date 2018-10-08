<?php
require_once('includes/config.php');
$res = $user->is_logged_in() ? 
    array("code"=>true, "username"=>$_SESSION["username"], "uuid"=>$_SESSION["uuid"], "invited"=>$_SESSION['invited']) : array("code"=>false);
printf("%s", json_encode($res, True));
?>

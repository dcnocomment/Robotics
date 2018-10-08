<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Asia/Shanghai');

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','robotics');

//application address
define('DIR','http://104.199.186.255/');
define('SITEEMAIL','noreply@roboslab.me');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
$user = new User($db);
include('classes/cloudserver.php');
$cloudserver = new Cloudserver($db);
?>

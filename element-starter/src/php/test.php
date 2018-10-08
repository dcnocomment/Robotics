<?php
$res = session_start();
var_dump($res);
$data = file_get_contents("php://input");
$data_array = json_decode($data, true);
echo $data_array["student"];
echo "1000";
var_dump($_SESSION);
?>

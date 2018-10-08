<?php
require_once('includes/config.php');
$res = $cloudserver->check_instance();
printf("%s", $res);
?>

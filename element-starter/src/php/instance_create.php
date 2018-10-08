<?php
require_once('includes/config.php');
$res = $cloudserver->create_instance();
printf("%s", $res);
?>

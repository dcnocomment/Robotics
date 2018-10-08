<?php
require_once('includes/config.php');
$res = $cloudserver->delete_instance();
printf("%s", $res);
?>

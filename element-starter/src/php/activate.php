<?php
require('includes/config.php');

//collect values from the url
$id = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if(is_numeric($id) && !empty($active)){

	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $db->prepare("UPDATE members SET active = 'Yes' WHERE id = :id AND active = :active");
	$stmt->execute(array(
		':id' => $id,
		':active' => $active
	));

	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){
        echo "<p>Your account is now activated.</p>";
        exit;
	} else {
		echo "<p>Your account could not be activated.</p>"; 
        exit;
	}
}
echo "<p>Your account could not be activated.</p>"; 
?>

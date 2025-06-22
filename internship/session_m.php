<?php
session_start();
if(isset($_POST['uid1'])){
	$_SESSION['uid'] = $_POST['uid1']; 
	header("Location: edit.php");
}
else{
	header("Location: index.php");
}



?>
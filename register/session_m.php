<?php
session_start();
if(isset($_POST['id1'])){
	$_SESSION['ID'] = $_POST['id1']; 
	header("Location: push.php");
}
else{
	header("Location: index.php");
}



?>
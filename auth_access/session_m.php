<?php
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

if(isset($_POST['column']) && isset($_POST['order'])){
	$_SESSION['column'] = $_POST['column']; 
	$_SESSION['order'] = $_POST['order']; 
    echo $_SESSION['order'];
	header("Location: sort.php"); 
}
else{
	header("Location: access.php");
}



?>
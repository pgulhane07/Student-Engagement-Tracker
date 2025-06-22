<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
    header("location: ../../admin_login.php");
    exit;
}

$id = isset($_SESSION['ADID']) ? $_SESSION['ADID'] : '';
$uid = isset($_POST['id2']) ? $_POST['id2'] : '';
$sql = 'DELETE FROM stu_temp WHERE ID=:id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':id' => $uid])) {
		header("Location: index.php");
	}	


?>
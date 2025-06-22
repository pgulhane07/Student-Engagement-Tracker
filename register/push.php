<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
    header("location: ../../admin_login.php");
    exit;
}
$id = isset($_SESSION['ADID']) ? $_SESSION['ADID'] : '';
$uid = isset($_POST['id1']) ? $_POST['id1'] : '';

$sql = 'SELECT * FROM stu_temp WHERE ID=:uid';
$statement1 = $connection->prepare($sql);
if($statement1->execute([':uid' => $uid ])){
	$person = $statement1->fetch(PDO::FETCH_OBJ);
	$sql1 = 'INSERT INTO student SELECT * FROM stu_temp WHERE ID=:uid';
  	$statement = $connection->prepare($sql1);
  	if($statement->execute([':uid' => $uid])) {
  	$sql2 = 'DELETE FROM stu_temp WHERE ID=:id';
	$statement2 = $connection->prepare($sql2);
	if ($statement2->execute([':id' => $uid])) {
		header("Location: index.php");
	}else{
		echo "Error in deletion";
	}	
 
  }else{
  	echo "User ID already exists!!!";
  }

}else{
	echo "Couldn't found in database";
}

?>
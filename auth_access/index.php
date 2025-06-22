<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$cls = isset($_POST['cls']) ? $_POST['cls'] : $_SESSION['cls'];
$_SESSION['cls'] = $cls;

$sql = "SELECT * FROM  authority ";

$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$_SESSION['people'] = $people; 
$_SESSION['print'] = $print;
header("location:allocate.php");


?>
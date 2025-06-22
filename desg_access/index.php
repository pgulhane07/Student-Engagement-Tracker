<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$dsg = isset($_POST['dsg']) ? $_POST['dsg'] : $_SESSION['Desg'];
$_SESSION['Desg'] = $dsg;
$dpt = isset($_POST['dpt']) ? $_POST['dpt'] : $_SESSION['Dept'];
$_SESSION['Dept'] = $dpt;

$sql = "SELECT * FROM  authority ";

$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$_SESSION['people'] = $people; 
$_SESSION['print'] = $print;
header("location:allocate.php");


?>
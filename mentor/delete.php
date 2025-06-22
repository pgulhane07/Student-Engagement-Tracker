<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
    header("location: ../Admin_login.html");
    exit;
}

if(isset($_POST['cls']) && isset($_POST['bct'])){
$cls = $_POST['cls'];
$bct = $_POST['bct'];


$sql = "DELETE FROM mentor WHERE Class = '$cls' AND Batch = '$bct'";
$result = mysqli_query ($conn,$sql) or die ('Error');
 if($result){
 	header("location: view.php");
 }


}



?>
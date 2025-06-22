<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../../Admin_login.php');
}
$dsg = isset($_SESSION['Desg']) ? $_SESSION['Desg'] : '' ;
$dpt = isset($_SESSION['Dept']) ? $_SESSION['Dept'] : '' ;
$sid = isset($_POST['sid']) ? $_POST['sid'] : '';
$id = $_SESSION['ADID'];


 
       $sql = "UPDATE designation_access SET TeacherID ='$sid' WHERE Designation ='$dsg' AND Department = '$dpt'";
       $result = mysqli_query ($link,$sql) or die ('Error');
       if($result){
        $sql1 = "UPDATE authority SET Designation ='$dsg', Department = '$dpt'  WHERE ID ='$sid' ";
        $result1 = mysqli_query ($link,$sql1) or die ('Error1');
        if($result1){
          header("Location:access.php");
        }
       }

    

 ?>

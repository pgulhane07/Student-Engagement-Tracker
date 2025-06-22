<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.php');
}
$cls = isset($_POST['cls']) ? $_POST['cls'] : '';
$sid = isset($_POST['sid']) ? $_POST['sid'] : '';
$id = $_SESSION['ADID'];

echo "$cls";
echo "$sid";

 
       $sql = "UPDATE access SET TeacherID ='$sid' WHERE Class ='$cls'";
       $result = mysqli_query ($link,$sql) or die ('Error');
       if($result){
        $sql1 = "UPDATE authority SET Class ='$cls'  WHERE ID ='$sid' ";
        $result1 = mysqli_query ($link,$sql1) or die ('Error');
        if($result1){
          header("Location:access.php");
        }
       }

    

 ?>

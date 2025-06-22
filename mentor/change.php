<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../index.html");
    exit;
}
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';
$sid = isset($_POST['sid']) ? $_POST['sid'] : '';
$id = $_SESSION['AID'];


      $sql2 = "select Full_Name from authority WHERE ID ='$sid'";
       $result2 = mysqli_query ($conn,$sql2) or die ('Error');
       $row = mysqli_fetch_array ($result2);
       $name=$row['Full_Name'];

       $sql = "UPDATE mentor SET TeacherID ='$sid',Teacher='$name' WHERE Batch ='$batch'";
       $result = mysqli_query ($conn,$sql) or die ('Error');
       if($result){
        $sql1 = "UPDATE authority SET Class ='$cls'  WHERE ID ='$sid' ";
        $result1 = mysqli_query ($conn,$sql1) or die ('Error');
        if($result1){
          header("Location: authority_access.php");
        }
       }

    

 ?>

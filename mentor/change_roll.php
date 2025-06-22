<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../index.html");
    exit;
}
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';
$end = isset($_POST['rollto']) ? $_POST['rollto'] : '';
$start = isset($_POST['rollfrm']) ? $_POST['rollfrm'] : '';
if(strlen($start)==0 || strlen($end)==0 )
     {
      trigger_error("Roll No fields cannot be empty ", E_USER_WARNING);
     // alert("Roll No fields cannot be empty ");
      header("location: allocate_roll.php");
      
      exit;
     }
    if(strlen($start)!=5 )
    {
      //alert("Roll No fields invalid ");
      header("location: allocate_roll.php");
      trigger_error("Roll No fields invalid  ", E_USER_WARNING);
      exit;
    }
      if( strlen($end)!=5 )
    {//alert("Roll No fields invalid ");
      header("location: allocate_roll.php");
      trigger_error("Roll No fields invalid  ", E_USER_WARNING);
      exit;
    }
    
$id = $_SESSION['AID'];

       $sql = "UPDATE mentor SET Roll_from ='$start',Roll_to='$end' WHERE Batch ='$batch'";
       $result = mysqli_query ($conn,$sql) or die ('Error');
       if($result){
        $sql1 = "UPDATE authority SET Class ='$cls'  WHERE ID ='$sid' ";
        $result1 = mysqli_query ($conn,$sql1) or die ('Error');
        if($result1){
          header("Location: authority_access.php");
        }
       }

    

    
 ?>

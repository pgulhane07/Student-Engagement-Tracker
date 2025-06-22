<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
  if (isset ($_POST['name'])  && isset($_POST['grantname']) && isset($_POST['authority'])   && isset($_POST['DO']) && isset($_POST['period'])  && isset($_POST['order']) && isset($_POST['amount'])   ) {
    $id = $_POST['ID'];	
    $name = $_POST['name'];
   $grantname = $_POST['grantname'];
   $authority = $_POST['authority'];
     $currdate=date("Y-m-d");
   $rawdate = $_POST['DO'];
   $period=$_POST['period'];
   
   $order=$_POST['order'];
   $amount=$_POST['amount'];
   $dob = date('Y-m-d',strtotime($rawdate));
 
   $uid = uniqid("FG-");
   $sql = 'INSERT INTO formg(UID,ID,Name,Grantname,Authority,Period,OrderNo,Date_start,Amount) VALUES(:uid,:id,:name,:grantname,:authority,:period,:order,:dob,:amount)';
   $statement = $connection->prepare($sql);
   if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':grantname' => $grantname,':authority' => $authority,':dob' => $dob,':period'=>$period,':order'=>$order,':amount'=>$amount])) {
     $message = 'data inserted successfully';
   }
   
 }
 else{
     $message = 'data insertion Unsuccessful';
   }
// $id = $_SESSION['AID'];
 ?>
 <html lang="en">
  <head>
    <title>Create</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Achievements</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>G.  Grants Received 
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormG/file_entry.php"> -->
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Name of Principal Investigator</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="grantname">Name of Grant</label>
          <input type="text" name="grantname" id="grantname" class="form-control">
        </div>
        <div class="form-group">
          <label for="authority">Sanctioning Authority</label>
          <input type="text" name="authority" id="authority" class="form-control">
        </div>
        
       
         <div class="form-group">
          <label for="period">Period of Grant</label>
          <input type="text" name="period" id="period" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="order">Sanctioned order no.</label>
          <input type="text" name="order" id="order" class="form-control">
        </div>
    
         <div class="form-group">
          <label for="DO">Date of Sanction</label>
          <input type="date" name="DO" id="DO" class="form-control">
        </div>


         <div class="form-group">
          <label for="amount">Amount</label>
          <input type="text" name="amount" id="amount" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Upload Document Proof</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';
}
else{
  if($_SESSION['login_flag'] == 2){
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
    
    
}
?>
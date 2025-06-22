<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
  if (isset ($_POST['name'])  && isset($_POST['sponsor']) && isset($_POST['support'])    && isset($_POST['grant1'])  && isset($_POST['year']) ) {
    $id = $_POST['ID'];	
    $name = $_POST['name'];
  $sponsor = $_POST['sponsor'];
  $support = $_POST['support'];
  
    $currdate=date("Y-m-d");
  $grant1=$_POST['grant1'];
  
  $year=$_POST['year'];
  $uid = uniqid("SP-");
  $sql = 'INSERT INTO formf(UID,ID,Name,Sponsor,Support,Grant_money,Year,Date_start) VALUES(:uid,:id,:name,:sponsor,:support,:grant1,:year,:ds)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':sponsor' => $sponsor,':support' => $support,':grant1'=>$grant1,':year'=>$year,':ds'=>$currdate])) {
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
      <h2>F.  Industry sponsored Labs.
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormF/file_entry.php"> -->
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Name of sponsoring  Industry/Company</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="sponsor">Name of sponsored Lab.</label>
          <input type="text" name="sponsor" id="sponsor" class="form-control">
        </div>
        <div class="form-group">
          <label for="support">Type of support</label>
          <input type="text" name="support" id="support" class="form-control">
        </div>
        
       
         <div class="form-group">
          <label for="grant1">Grant in Rs. (if any)</label>
          <input type="text" name="grant1" id="grant1" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="year">Year of establishment</label>
          <input type="text" name="year" id="year" class="form-control">
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
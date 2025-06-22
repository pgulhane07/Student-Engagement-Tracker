<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = $_SESSION['AID'];
if (isset ($_POST['name'])  && isset($_POST['cls'])  && isset($_POST['achievement']) &&  isset($_POST['remark'])  ) {
  $name = $_POST['name'];
  $cls = $_POST['cls'];
  $achievement = $_POST['achievement'];
 
  $id = $_POST['ID'];
  $currdate=date("Y-m-d");
  
  $remark=$_POST['remark'];
  $uid = uniqid("FO-");
  $sql = 'INSERT INTO formO(UID,ID,Name,Class,Achievement,Remark,Date_start) VALUES(:uid,:id,:name,:cls,:achievement,:remark,:ds)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':cls' => $cls,':achievement' => $achievement,':remark'=>$remark,':ds'=>$currdate])) {
    $message = 'data inserted successfully';
  }
  
}
else{
    $message = 'data insertion Unsuccessful';
  }

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
      <h2>O.  Student Achievement
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormO/file_entry.php"> -->

      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        
        <div class="form-group">
          <label for="name">Name of Student</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>

         <div class="form-group">
          <label for="cls">Class</label>
          <input type="text" name="cls" id="cls" class="form-control">
        </div>
        <div class="form-group">
          <label for="achievement">Achievement</label>
          <input type="text" name="achievement" id="achievement" class="form-control">
        </div>
        
        
        
        
         <div class="form-group">
          <label for="remark">Remark</label>
          <input type="text" name="remark" id="remark" class="form-control">
        </div>
    

        <div class="form-group">
          <button type="submit" class="btn btn-info">Upload Document Proof</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';}
else
{
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
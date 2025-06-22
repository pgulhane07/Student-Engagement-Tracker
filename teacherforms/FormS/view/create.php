<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
if (isset ($_POST['name'])  && isset($_POST['fdp']) && isset($_POST['lvl'])   && isset($_POST['DO']) && isset($_POST['topic']) && isset($_POST['organizer'])   ) {
  $id = $_POST['ID']; 
  $name = $_POST['name'];
  $fdp = $_POST['fdp'];
  $lvl = $_POST['lvl'];
  $topic = $_POST['topic'];
  $currdate=date("Y-m-d");
  $rawdate = $_POST['DO'];
  $organizer=$_POST['organizer'];
  $id = $_POST['ID'];
  $dob = date('Y-m-d',strtotime($rawdate));

  $uid = uniqid("FS-");
  $sql = 'INSERT INTO forms(UID,ID,Name,FDP,Level,Topic,Date_start,Organizer) VALUES(:uid,:id,:name,:fdp,:lvl,:topic,:dob,:organizer)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':fdp' => $fdp,':lvl' => $lvl,':topic' => $topic,':dob' => $dob,':organizer'=>$organizer])) {
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
      <h2>
S.  Resource Person:
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/formS/file_entry.php"> -->

      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        
        <div class="form-group">
          <label for="name">Name of faculty</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="fdp">Name of FDP / Workshop / Other</label>
          <input type="text" name="fdp" id="fdp" class="form-control">
        </div>
        <div class="form-group">
          <label for="lvl">Level</label>
          <input type="text" name="lvl" id="lvl" class="form-control">
        </div>
         <div class="form-group">
          <label for="topic">Topic</label>
          <input type="text" name="topic" id="topic" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="DO">Date</label>
          <input type="date" name="DO" id="DO" class="form-control">
        </div>
       
         <div class="form-group">
          <label for="organizer">Organizer </label>
          <input type="text" name="organizer" id="organizer" class="form-control">
        </div>
        
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';}
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
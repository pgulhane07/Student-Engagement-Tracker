<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$message = '';
$sql = 'SELECT * FROM forms WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['name'])  && isset($_POST['fdp']) && isset($_POST['lvl'])   && isset($_POST['DO']) && isset($_POST['topic']) && isset($_POST['organizer'])   ) {

  $name = $_POST['name'];
  $fdp = $_POST['fdp'];
  $lvl = $_POST['lvl'];
  $topic = $_POST['topic'];
  
  $rawdate = $_POST['DO'];
  $organizer=$_POST['organizer'];
  
  $dob = date('Y-m-d',strtotime($rawdate));


   $sql = 'UPDATE forms SET Name=:name,FDP=:fdp,Level=:lvl,Topic=:topic,Date_start=:dob,Organizer=:organizer WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':fdp' => $fdp,':lvl' => $lvl,':topic' => $topic,':dob' => $dob,':organizer'=>$organizer,'uid' => $uid])) {
    header("Location: index.php");
  }
  
}
else{
     $message = 'data updation Unsuccessful';
  }
 


 ?>
 <html lang="en">
  <head>
    <title>Edit </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../../Authority_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Achievements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Add Data</a>
      </li>
      
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edit</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        
        <div class="form-group">
          <label for="name">Name of faculty</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="fdp">Name of FDP / Workshop / Other</label>
          <input value="<?= $person->FDP; ?>" type="text" name="fdp" id="fdp" class="form-control">
        </div>
        <div class="form-group">
           <label for="lvl">Level</label>
          <input value="<?= $person->Level; ?>" type="text" name="lvl" id="lvl" class="form-control">
        </div>

        <div class="form-group">
           <label for="topic">Topic</label>
          <input value="<?= $person->Topic; ?>" type="text" name="topic" id="topic" class="form-control">
        </div>
        

         <div class="form-group">
           <label for="DO">Date</label>
          <input value="<?= $person->Date_start; ?>" type="date" name="DO" id="DO" class="form-control">
        </div>
        
         <div class="form-group">
         <label for="organizer">Organizer </label>
          <input value="<?= $person->Organizer; ?>" type="text" name="organizer" id="organizer" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';
?>
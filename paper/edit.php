<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
 //$uid = $_GET['uid'];
$message = '';
$sql = 'SELECT * FROM paper_presentation WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['Type'])  && isset($_POST['Domain']) && isset($_POST['Guide']) && isset($_POST['publish'])  && isset($_POST['DOB'])) {
    $type = $_POST['Type'];
    $dom = $_POST['Domain'];
    $guide = $_POST['Guide'];
    $pub = $_POST['publish'];
    $rawdate = $_POST['DOB'];
    $dob = date('Y-m-d',strtotime($rawdate));

    $sql1 = 'UPDATE paper_presentation SET Title=:fname,Domain=:lname,Guide=:cls,Organisation_publish=:pub,Date_publish=:dob WHERE UID=:uid';
    $statement1 = $connection->prepare($sql1);
    if ($statement1->execute([':fname' => $type,':lname' => $dom,':cls' => $guide,':pub' => $pub,':dob' => $dob,':uid' => $uid])) {
      header("Location: index.php");
      //echo $dob;
      //echo $type;
      
      //echo $venue;
      //echo $achieve;
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
  <a class="navbar-brand" href="../Student_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Achievements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Add Achievements</a>
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
      <form action='edit.php' method="post">
        
        <div class="form-group">
          <label for="Type">Title</label>
          <input value="<?= $person->Title; ?>" type="text" name="Type" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Domain">Domain</label>
          <input value="<?= $person->Domain; ?>" type="text" name="Domain" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Venue">Guide</label>
          <input value="<?= $person->Guide; ?>" type="text" name="Guide" id="cls" class="form-control">
        </div>
         <div class="form-group">
          <label for="publish">Organisation_publish</label>
          <input value="<?= $person->Organisation_publish; ?>" type="text" name="publish" id="depart" class="form-control">
        </div>
         <div class="form-group">
          <label for="DOB">Date of Occasion</label>
          <input value="<?= $person->Date_publish; ?>" type="date" name="DOB" id="dob" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
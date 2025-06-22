<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';

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
        <a class="nav-link" href="">Add Achievements</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create Achievement</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form action="file_entry.php" method="post">
        
        <div  class="form-group">
          <label for="Name">Company name</label>
          <input type="text" name="Company" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Address">Address</label>
          <input type="text" name="Address" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Duration">Duration</label>
          <input type="text" name="Duration" id="depart" class="form-control">
        </div>
        <div class="form-group">
          <label for="Type">Type of Job</label>
          <input type="text" name="Type" id="depart" class="form-control">
        </div>
        <div class="form-group">
          <label for="Description">Description</label>
          <input type="text" name="Description" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Job_Role">Job Role</label>
          <input type="text" name="Job_Role" id="cls" class="form-control">
        </div>
        <div class="form-group">
          <label for="Stipend">Stipend</label>
          <input type="text" name="Stipend" id="depart" class="form-control">
        </div>
        <div class="form-group">
          <label for="Source">Source</label>
          <input type="text" name="Source" id="depart" class="form-control">
        </div>
        <div class="form-group">
          <label for="Approve">Approve</label>
          <input type="text" name="Approve" id="depart" class="form-control">
        </div>
        <div class="form-group">
          <label for="Date_Join">Date Join</label>
          <input type="date" name="Date_Join" id="dob" class="form-control">
        </div> 
        <div class="form-group">
          <label for="Date_End">Date End</label>
          <input type="date" name="Date_End" id="dob" class="form-control">
        </div>

        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

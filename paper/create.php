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
        <a class="nav-link" href="index.php">Presentation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Add Presentation</a>
      </li>
      
    </ul>
  </div>
  
</nav>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create Presentation</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form action="file_entry.php" method="post">
        
        <div  class="form-group">
          <label for="Type">Title for Presentation</label>
          <input type="text" name="Type" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Domain">Domain</label>
          <input type="text" name="Domain" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Guide">Guide</label>
          <input type="text" name="Guide" id="cls" class="form-control">
        </div>
         <div class="form-group">
          <label for="publish">Organisation_publish</label>
          <input type="text" name="publish" id="depart" class="form-control">
        </div>
         <div class="form-group">
          <label for="DOB">Date of Occasion</label>
          <input type="date" name="DOB" id="dob" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
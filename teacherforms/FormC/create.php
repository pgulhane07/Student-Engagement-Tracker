<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = $_SESSION['AID'];


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
        <a class="nav-link" href="">Add Data</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post" action="file_entry.php">
        
       
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>

         <div class="form-group">
          <label for="type">Type/Nature</label>
          <input type="text" name="type" id="type" class="form-control">
        </div>

        <div class="form-group">
          <label for="organiser">Name of organizer</label>
          <input type="text" name="organiser" id="organiser" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="DO">Start Date</label>
          <input type="date" name="DO" id="DO" class="form-control">
        </div>
        <div class="form-group">
          <label for="DE">End Date</label>
          <input type="date" name="DE" id="DE" class="form-control">
        </div>

         <div class="form-group">
          <label for="staff">Name of the Staff</label>
          <input type="text" name="staff" id="staff" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="sponsorship">Sponsorship Details</label>
          <input type="text" name="sponsorship" id="sponsorship" class="form-control">
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
?>
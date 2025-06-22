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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../css/NavStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-custom navbar-light darker">
        <a class="navbar-brand gap" href="../Student_Home.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item gap2">
              <a class="nav-link" href="index.php">Achievements</a>
            </li>
            <li class="nav-item gap2">
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
          <label for="Type">Sports Name</label>
          <input type="text" name="Type" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Description">Description</label>
          <input type="text" name="Description" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Venue">Venue</label>
          <input type="text" name="Venue" id="cls" class="form-control">
        </div>
         <div class="form-group">
          <label for="Achievements">Achievements</label>
          <input list="search1" type="text" name="Achievements" id="srch1" class="form-control  " autocomplete="off" placeholder="Achievements" required >
            <datalist id="search1">
              <select  name="search1" id="searchs1">
              <option  value="Winner">Winner</option>
              <option  value="Runner Up">Runner Up</option>
              <option  value="Participation">Participation</option>
              </select>  
            </datalist>
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

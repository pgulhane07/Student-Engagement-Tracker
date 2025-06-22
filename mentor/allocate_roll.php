<?php
require '../db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../index.html");
    exit;
}
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';
$id = $_SESSION['AID'];

$sid ='';
$name='';
        
         
 ?>

<html lang="en">
  <head>
    <title>Allocate Batch</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/projects/Auth_page1.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="access.php">Mentors Data</a>
      </li>
  </ul>
</nav>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Allocate Batch</h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <div> 
        <p>Please enter Correct Roll No(5 digits)</p>
          <form class="stu" action="change_roll.php" method="post">
               <label for="rollfrm">Enter Start roll No</label>
              <input  type="number" id="rollfrm" name="rollfrm"/>

<label for="rollto">Enter Last roll No</label>
              <input  type="number" id="rollto "name="rollto"/>
             <input  type="hidden" name="batch" value="<?php echo urlencode($batch)?>" />
              <button type="submit" style="margin:5%;" class="btn btn-info">submit</button>
              </form>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

<?php

?>
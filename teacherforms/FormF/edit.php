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
$sql = 'SELECT * FROM formf WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['sponsor']) && isset($_POST['support'])    && isset($_POST['grant1'])  && isset($_POST['year']) ) {
  
  $name = $_POST['name'];
  $sponsor = $_POST['sponsor'];
  $support = $_POST['support'];
  
  
  $grant1=$_POST['grant1'];
  
  $year=$_POST['year'];
 


   $sql = 'UPDATE formf SET Name=:name,Sponsor=:sponsor,Support=:support,Grant_money =:grant1,Year=:year WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':sponsor' => $sponsor,':support' => $support,':grant1'=>$grant1,':year'=>$year,':uid' => $uid])) {
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
          <label for="name">Name of sponsoring  Industry/Company</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="sponsor">Name of sponsored Lab.</label>
          <input value="<?= $person->Sponsor; ?>" type="text" name="sponsor" id="sponsor" class="form-control">
        </div>
        <div class="form-group">
          <label for="support">Type of support</label>
          <input value="<?= $person->Support; ?>" type="text" name="support" id="support" class="form-control">
        </div>
        
        
         <div class="form-group">
          <label for="grant1">Grant in Rs. (if any)</label>
          <input value="<?= $person->Grant_money; ?>" type="text" name="grant1" id="grant1" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="year">Year of establishment</label>
          <input value="<?= $person->Year; ?>" type="text" name="year" id="year" class="form-control">
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
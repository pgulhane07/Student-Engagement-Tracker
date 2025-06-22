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
$sql = 'SELECT * FROM formc WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['organiser'])   && isset($_POST['DO']) && isset($_POST['DE'])&& isset($_POST['staff'])  && isset($_POST['sponsorship']) ) {
  $type = $_POST['type'];
  $title = $_POST['title'];
  $organiser = $_POST['organiser'];
  
  $rawdate = $_POST['DO'];
  $rawdate1 = $_POST['DE'];
  $staff=$_POST['staff'];
  
  $sponsorship=$_POST['sponsorship'];
  $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));

   $sql = 'UPDATE formc SET Title=:title,Type=:type,Organiser=:organiser,Date_start=:ds,Date_end=:de,Staff=:staff,Sponsorship=:sponsorship WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title,':type' => $type,':organiser' => $organiser,':ds' => $ds,':de' => $de,':staff'=>$staff,':sponsorship'=>$sponsorship,':uid' => $uid])) {
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
          <label for="title">Title</label>
          <input value="<?= $person->Title; ?>" type="text" name="title" id="title" class="form-control">
        </div>

         <div class="form-group">
          <label for="type">Type/Nature</label>
          <input value="<?= $person->Type; ?>" type="text" name="type" id="type" class="form-control">
        </div>

        <div class="form-group">
          <label for="organiser">Name of organizer</label>
          <input value="<?= $person->Organiser; ?>" type="text" name="organiser" id="organiser" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="DO">Start Date</label>
          <input value="<?= $person->Date_start; ?>" type="date" name="DO" id="DO" class="form-control">
        </div>
        <div class="form-group">
          <label for="DE">End Date</label>
          <input value="<?= $person->Date_end; ?>" type="date" name="DE" id="DE" class="form-control">
        </div>
         <div class="form-group">
          <label for="staff">Name of the Staff</label>
          <input value="<?= $person->Staff; ?>" type="text" name="staff" id="staff" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="sponsorship">Sponsorship Details</label>
          <input value="<?= $person->Sponsorship; ?>" type="text" name="sponsorship" id="sponsorship" class="form-control">
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
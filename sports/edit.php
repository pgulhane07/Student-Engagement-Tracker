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
$sql = 'SELECT * FROM sports WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Type'])  && isset($_POST['Description']) && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB'])) {
  $type = $_POST['Type'];
  $descp = $_POST['Description'];
  $venue = $_POST['Venue'];
  $achieve = $_POST['Achievements'];
  $rawdate = $_POST['DOB'];
  $dob = date('Y-m-d',strtotime($rawdate));

  $sql1 = 'UPDATE sports SET Sports_Name=:fname,Description=:lname,Venue=:cls,Achievements=:achieve,Date_Sports=:dob WHERE UID=:uid';
  $statement1 = $connection->prepare($sql1);
  if ($statement1->execute([':fname' => $type,':lname' => $descp,':cls' => $venue,':achieve' => $achieve,':dob' => $dob,':uid' => $uid])) {
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../../css/NavStyle.css">
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
          <label for="Type">Sports Name</label>
          <input value="<?= $person->Sports_Name; ?>" type="text" name="Type" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Description">Description</label>
          <input value="<?= $person->Description; ?>" type="text" name="Description" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Venue">Venue</label>
          <input value="<?= $person->Venue; ?>" type="text" name="Venue" id="cls" class="form-control">
        </div>
         <div class="form-group">
          <label for="Achievements">Achievements</label>
          <input value="<?= $person->Achievements; ?>" type="text" name="Achievements" id="depart" class="form-control">
        </div>
         <div class="form-group">
          <label for="DOB">Date of Occasion</label>
          <input value="<?= $person->Date_Sports; ?>" type="date" name="DOB" id="dob" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

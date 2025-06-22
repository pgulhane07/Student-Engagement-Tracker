<?php
require 'db.php';
session_start();
// $id = $_GET['ID'];
// $uid = $_GET['uid'];
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  header("location: ../index.html");
  exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$message = '';
$sql = 'SELECT * FROM competitive WHERE ID=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Type'])  && isset($_POST['Description']) && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB'])) {
  $type = $_POST['Type'];
  $descp = $_POST['Description'];
  $venue = $_POST['Venue'];
  $achieve = $_POST['Achievements'];
  $rawdate = $_POST['DOB'];
  $dob = date('Y-m-d',strtotime($rawdate));
  
  $sql = 'UPDATE competitive SET Event=:fname,Description=:lname,Venue=:cls,Achievements=:achieve,Date_comp=:dob WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':fname' => $type,':lname' => $descp,':cls' => $venue,':achieve' => $achieve,':dob' => $dob,':uid' => $uid])) {
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
  <a class="navbar-brand" href="/projects/stu_page1.php?ID=<?php echo $id?>">Home</a>
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
      <form method="post">
        
        <div class="form-group">
          <label for="Type">Event</label>
          <input value="<?= $person->Event; ?>" type="text" name="Type" id="fname" class="form-control">
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
          <input value="<?= $person->Date_comp; ?>" type="date" name="DOB" id="dob" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

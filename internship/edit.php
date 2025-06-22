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
$sql = 'SELECT * FROM internship WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);


if (isset ($_POST['Company']) && isset($_POST['Address']) && isset($_POST['Description']) && isset($_POST['Type'])&& isset($_POST['Job_Role']) && isset($_POST['Source']) 
            && isset($_POST['Stipend']) && isset($_POST['Approve']) && isset($_POST['Duration']) && isset($_POST['Date_Join']) && isset($_POST['Date_End'])) 
            {
  $Com = $_POST['Company'];
  $descp = $_POST['Description'];
  $job_role = $_POST['Job_Role'];
  $type = $_POST['Type'];
  $Stipend = $_POST['Stipend'];
  $duration = $_POST['Duration'];
  $rawdata= $_POST['Date_Join'];
  $rawend=$_POST['Date_End'];
  $source=$_POST['Source'];
  $approve=$_POST['Approve'];
  $address=$_POST['Address'];
  $doj = date('Y-m-d',strtotime($rawdata));
  $doe=date('Y-m-d',strtotime($rawend));
              
  
  $sql1 = 'UPDATE internship SET Company=:fname,Address=:add,Duration=:duration,Type=:type,Description=:lname,Job_Role=:cls,Stipend=:Stipend,Source=:src,Approve=:app,Date_Join=:doj,Date_end=:doe WHERE UID=:uid';
  $statement1 = $connection->prepare($sql1);
  if ($statement1->execute([':fname' => $Com,':add' => $address,':duration' => $duration ,':type' => $type,':lname' => $descp,':cls' => $job_role,':Stipend' => $Stipend,':src' => $source, ':app' => $approve ,':doj'=>$doj,':doe' => $doe,':uid' => $uid])) {
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
          <label for="Name">Company Name</label>
          <input value="<?= $person->Company; ?>" type="text" name="Company" id="fname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Address">Address</label>
          <input value="<?= $person->Address; ?>" type="text" name="Address" id="add" class="form-control">
        </div>
        <div class="form-group">
          <label for="Duration">Duration</label>
          <input value="<?= $person->Duration; ?>" type="text" name="Duration" id="duration" class="form-control">
        </div>
        <div class="form-group">
          <label for="Type">Type of Job</label>
          <input value="<?= $person->Type; ?>" type="text" name="Type" id="type" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="Description">Description</label>
          <input value="<?= $person->Description; ?>" type="text" name="Description" id="lname" class="form-control">
        </div>
        <div class="form-group">
          <label for="Job_Role">Job_Role</label>
          <input value="<?= $person->Job_Role; ?>" type="text" name="Job_Role" id="cls" class="form-control">
        </div>
         <div class="form-group">
          <label for="Stipend">Stipend</label>
          <input value="<?= $person->Stipend; ?>" type="text" name="Stipend" id="Stipend" class="form-control">
        </div>
        <div class="form-group">
          <label for="Source">Source</label>
          <input value="<?= $person->Source; ?>" type="text" name="Source" id="src" class="form-control">
        </div>
        <div class="form-group">
          <label for="Approve">Approve</label>
          <input value="<?= $person->Approve; ?>" type="text" name="Approve" id="app" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="Date_Join">Date Join</label>
          <input value="<?= $person->Date_Join; ?>" type="date" name="Date_Join" id="doj" class="form-control">
        </div>

        <div class="form-group">
          <label for="Date_End">Date End</label>
          <input value="<?= $person->Date_End; ?>" type="date" name="Date_End" id="doe" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

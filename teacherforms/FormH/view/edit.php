<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$id = isset($_SESSION['A']) ? $_SESSION['A'] : '';
$message = '';
$sql = 'SELECT * FROM formh WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['year'])  && isset($_POST['course']) && isset($_POST['activity'])    && isset($_POST['finance'])  && isset($_POST['count']) ) {
  
  $year = $_POST['year'];
  $course = $_POST['course'];
  $activity = $_POST['activity'];
  
  
  $finance=$_POST['finance'];
  
  $count=$_POST['count'];
 


   $sql = 'UPDATE formh SET Year=:year,Course=:course,Activity=:activity,Finance =:finance,Count1=:count WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':year' => $year,':course' => $course,':activity' => $activity,':finance'=>$finance,':count'=>$count,':uid' => $uid])) {
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
    <h2>Edit Achievement of Reg.ID : <?php echo $id; ?></h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        
        <div class="form-group">
          <label for="year">Academic Year</label>
          <input value="<?= $person->Year; ?>" type="text" name="year" id="year" class="form-control">
        </div>
        <div class="form-group">
          <label for="course">Course</label>
          <input value="<?= $person->Course; ?>" type="text" name="course" id="course" class="form-control">
        </div>
        <div class="form-group">
          <label for="activity">Activity</label>
          <input value="<?= $person->Activity; ?>" type="text" name="activity" id="activity" class="form-control">
        </div>
        
        
         <div class="form-group">
          <label for="finance">Financial Support provided</label>
          <input value="<?= $person->Finance; ?>" type="text" name="finance" id="finance" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="count">No. of students availing the support</label>
          <input value="<?= $person->Count1; ?>" type="text" name="count" id="count" class="form-control">
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
      }
      else{
        if($_SESSION['login_flag'] == 2){
              header("location: ../../../index.html");
              exit;
          }
      
          else if($_SESSION['login_flag'] == 3){
              header("location: ../../../Admin_login.html");
              exit;
          }
          
          
      }
?>
